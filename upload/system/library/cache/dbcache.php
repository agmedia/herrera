<?php
/*------------------------------------------------------------------------
# Database Cache
# ------------------------------------------------------------------------
# The Krotek
# Copyright (C) 2011-2021 The Krotek. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: https://thekrotek.com
# Support: support@thekrotek.com
-------------------------------------------------------------------------*/

class DBCache
{
	private static $instance;
	public $cachepath;
	private $config;
    
    public function __construct()
    {  	
    	$this->cachepath = DIR_CACHE.'dbcache/';
    	
    	if (!file_exists($this->cachepath)) mkdir($this->cachepath);
    	
    	$this->config = Registry::getInstance()->get('config');
    }
    	
	public function processDbQuery($db, $sql, $params = null)
	{
		if ($this->config->get((version_compare(VERSION, '3', '>=') ? 'module_' : '').'dbcache_status') && (stripos($_SERVER['REQUEST_URI'], 'token=') === false) && (stripos($_SERVER['REQUEST_URI'], 'user_token=') === false) && ($this->config->get((version_compare(VERSION, '3', '>=') ? 'module_' : '').'dbcache_search') || (stripos($_SERVER['REQUEST_URI'], 'search') === false))) {
			if ($params === null) $params = array();
        
        	if (!$this->isModificationQuery($sql) && $this->config->get((version_compare(VERSION, '3', '>=') ? 'module_' : '').'dbcache_tables') && !array_diff($this->extractTables($sql), $this->config->get((version_compare(VERSION, '3', '>=') ? 'module_' : '').'dbcache_tables'))) {
                $query = $this->loadCache($sql);
               
                if ($query == null) {
                    $query = $db->defaultQuery($sql);
                    $this->saveCache($sql, $query);
                }
            } else {
        		$query = $db->defaultQuery($sql);
			}
		} else {
        	$query = $db->defaultQuery($sql);
		}
        
        return $query;
	}
		
    public function clear()
    {
        $files = array_diff(scandir($this->cachepath), array('.', '..'));
        
        foreach ($files as $file) {
            @unlink($this->cachepath.$file);
            clearstatcache(true, $this->cachepath.$file);
        }
    }
 
    public function getCacheTimeout()
    {
        $timeout = $this->config->get((version_compare(VERSION, '3', '>=') ? 'module_' : '').'dbcache_timeout');
        
        if (!$timeout) $timeout = 3600;
        
        return $timeout;
    }
            
    private function saveCache($sql, $query)
    {
		$query->time = time();

        $handle = fopen($this->getQueryFile($sql), 'w');
        
        flock($handle, LOCK_EX);
        fwrite($handle, serialize($query));
        fflush($handle);
        fclose($handle);
    }
       
    private function loadCache($sql)
    {
		$file = $this->getQueryFile($sql);
		
        if (file_exists($file) && (filesize($file) > 0) && ($handle = @fopen($file, "r"))) {
        	flock($handle, LOCK_SH);
      		
      		$cache = fread($handle, filesize($file));
        			
        	$query = unserialize($cache);
        		
        	if (empty($query->time)) $query->time = time();
					
            $seconds_passed = time() - $query->time;

			if ($seconds_passed < $this->getCacheTimeout()) return $query;
            else $this->removeCache($sql);
            
			fclose($handle);
		}
        
        return null;
    }

    private function getQueryFile($sql)
    {
        return $this->cachepath.'query.'.md5($sql);
    }

    private function removeCache($sql)
    {
		$queryfile = $this->getQueryFile($sql);
		
		if (file_exists($queryfile)) {
			@unlink($queryfile);   
			clearstatcache(true, $queryfile);
		}
    }
	
	private static function isModificationQuery($sql)
	{
        $statements = array('select', 'show tables', 'show columns');
        
        foreach ($statements as $statement) {
            if (stripos(trim($sql), $statement) === 0) return false;
        }
        
        return true;
	}
    
	private function extractTables($sql)
	{
		$tables = preg_grep('/'.DB_PREFIX.'.+/', explode(' ', $sql));
		
        return array_map(function($a) { return trim($a, '\'\"\`'); }, $tables);
	}
	    
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }    
}

?>