<?php

namespace Agmedia\Api\Connection;

use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 *
 */
class Csv
{
    
    /**
     * @var string|null
     */
    protected $path = '';
    
    /**
     * @var
     */
    protected $csv;
    
    
    /**
     * @param string|null $path
     */
    public function __construct(string $path = null)
    {
        $this->path = $path;
        $this->setFile();
    }
    
    
    /**
     * @return mixed
     */
    public function getCsv()
    {
        return $this->csv;
    }
    
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collect()
    {
        return collect(json_decode($this->csv, true));
    }
    
    
    /**
     * @param string $type
     *
     * @return $this
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function setFile(string $type = 'Csv'): Csv
    {
        $reader = IOFactory::createReader($type);
        
        $this->csv = $reader->load($this->path)->getActiveSheet()->toArray();
        
        return $this;
    }
}