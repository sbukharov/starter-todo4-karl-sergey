<?php

class Task extends CI_Model {

    /* Data members representing all aspects of a task */
    private $task;
    private $group;
    private $priority;
    private $size;
    private $status;
    private $flag;

    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value) {
        // if a set* method exists for this key, 
        // use that method to insert this value. 
        // For instance, setName(...) will be invoked by $object->name = ...
        // and setLastName(...) for $object->last_name = 
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
        if (method_exists($this, $method))
        {
                $this->$method($value);
                return $this;
        }

        // Otherwise, just set the property value directly.
        $this->$key = $value;
        return $this;
    }
    
    /*Setter for task data member.*/
    public function setTask($value) {
        if (strlen($value) > 64 || !ctype_alnum($value)) {
            throw new Exception('Only alphanumeric strings of length < 64 chars accepted.');
        }
        $this->$task = $value;
      }

    /*Setter for group data member.*/
    public function setGroup($value) {
      if (!($value > 1 && $value < 4)) {
          throw new Exception('Expected group value : 1,2,3 or 4');
      }
      $this->$group = $value;
    }

    /*Setter for priority data member.*/
    public function setPriority($value) {
      if (!($value > 1 && $value < 3)) {
          throw new Exception('Expected group value : 1,2 or 3');
      }
      $this->$priority = $value;
    }

    /*Setter for size data member.*/
    public function setSize($value) {
      if (!($value > 1 && $value < 3)) {
          throw new Exception('Expected size value : 1,2 or 3');
      }
      $this->$size = $value;
    }

    /*Setter for status data member.*/
    public function setStatus($value) {
      if (!(value > 1 && $value < 2)) {
          throw new Exception('Expected group value : 1 (in progress), 2 (complete)');
      }
      $this->$status = $value;
    }

    /*Setter for flag data member.*/
    public function setFlag($value) {
      if ($value != 1) {
          throw new Exception('Expected flag value: 1');
      }
      $this->$flag = $value;
    }
}

