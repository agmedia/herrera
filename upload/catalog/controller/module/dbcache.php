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

class ControllerModuleDBCache extends Controller
{
	private $folder = 'module';
	private $extension = 'dbcache';
	private $fieldbase = '';

	public function __construct($registry)
	{
		parent::__construct($registry);
		
		if (version_compare(VERSION, '2.3', '>=')) $this->path = 'extension/';
		
		$this->load->language($this->path.$this->folder.'/'.$this->extension);
		
		$this->fieldbase = (version_compare(VERSION, '3.0', '>=') ? $this->folder.'_' : '').$this->extension;		
	}
		
    public function index()
    { 	
    	if ($this->config->get($this->fieldbase.'_status')) {
			$secret = (!empty($this->request->get['secret']) ? $this->request->get['secret'] : "");
			
    		if ($secret == $this->config->get($this->fieldbase.'_secret')) {    	
    			require_once(DIR_SYSTEM.'library/cache/dbcache.php');
		
				$dbcache = new DBCache();
        
        		$removed = 0;
        
        		$files = scandir($dbcache->cachepath);
        
        		foreach ($files as $file) {
            		if (($file != '.') && ($file != '..') && file_exists($dbcache->cachepath.$file)) {
            			$query = unserialize(file_get_contents($dbcache->cachepath.$file));
            	
        				if (empty($query->time)) $query->time = time();
				
            			$seconds_passed = time() - $query->time;

						if ($seconds_passed >= $dbcache->getCacheTimeout()) {
							unlink($dbcache->cachepath.$file);
							$removed ++;
						}
            		}
        		}
        		
        		echo sprintf($this->language->get('message_removed'), $removed);
			} else {
				echo $this->language->get('error_secret');
			}
		} else {
			echo $this->language->get('error_disabled');
		}
	}
}

?>
