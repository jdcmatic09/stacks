<?php

class JSON_Table {
    
    const JSONPATH = 'path';
    
    
    /**
     * The table name.
     *
     * @var string
     */
    protected $_name = null;
    
    /**
     * The table column names derived from JSON.
     *
     * @var array
     */
    protected $_cols;
    
    
    public function __construct($config = array())
    {
        /**
         * Allow a scalar argument to be the Adapter object or Registry key.
         */
        if (!isset($config[self::JSONPATH])) {
            $config = array(self::JSONPATH => sys_get_temp_dir());
        }

        if ($config) {
            $this->setOptions($config);
        }

        /*$this->_setup();
        $this->init();*/
    }
    
    public function setOptions(array $config) {
        
        if (isset($config['columns'])) {
        
        }
        
        if (isset($config['metadata'])) {
            
        }
    }
}

?>