<?php

/**
 * CSV-persisted collection.
 * 
 * @author		JLP
 * @copyright           Copyright (c) 2010-2017, James L. Parry
 * ------------------------------------------------------------------------
 */
class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------

	/**
	 * Constructor.
	 * @param string $origin Filename of the XML file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Entity name meaningful to the persistence
	 */
	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{
		parent::__construct();

		// guess at persistent name if not specified
		if ($origin == null)
			$this->_origin = get_class($this);
		else
			$this->_origin = $origin;

		// remember the other constructor fields
		$this->_keyfield = $keyfield;
		$this->_entity = $entity;

		// start with loaan empty collection
		$this->_data = array(); // an array of objects
		$this->_fields = array(); // an array of strings
		// and populate the collection
		$this->load();
	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{
            $xmldata;
            //---------------------
            if ((simplexml_load_file($this->_origin))){
                $xmldata = simplexml_load_file($this->_origin);
                $newclass = new stdClass();
                $this->populateClass($xmldata, $newclass);
            }
            
            // --------------------
            // rebuild the keys table
            $this->reindex();
	}
        
        /**
         * Helper function used to populate a class object with data from an array.
         * 
         * @param type $data data in array format to use (key->value format)
         * @param type $class new class object to modify, passed by reference
         * @return boolean returns true if passed data is root note, used for 
         *                  recursive calls.
         */
        private function populateClass($data, &$class)
        {
            $isRootNode = true; //for recursive calls - false if root record
            
            foreach($data as $key => $value) {
                $isRootNode = false; // if any records are found, not root record
                $tmpClass = new stdClass(); //for recursive calls
                
                //proceed only if in root record
                if($this->populateClass($value, $tmpClass)) {
                    if (!in_array($key, $this->_fields))
                        array_push($this->_fields, $key);

                    $class->$key = ((string)$value); //remember to cast
                } else {
                    //write record data
                    $recordKey = $tmpClass->{$this->_keyfield};
                    $this->_data[$recordKey] = $tmpClass;
                }
            }
            
            return $isRootNode; //for recursive calls - is this a root record?
        }
        
        
	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
		// rebuild the keys table
		$this->reindex();
	}

}
