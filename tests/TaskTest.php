<?php

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    private $CI;
    
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
        
    }
    
    public function testValidProperties()
    {
        
        $task = $this->CI->task->instance();
        
        $task_property = $task->task = "do some yard work";
        $priority_property = $task->priority = 2;
        $size_property = $task->size = 2;
        $group_property = $task->group = 2;
 
        
        $this->assertEquals($task_property, "do some yard work");
        $this->assertEquals($priority_property, 2);
        $this->assertEquals($size_property, 2);
        $this->assertEquals($group_property, 2);

    }
    
    /*Test task length condition.*/
    public function testInvalidTaskLength(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->task = "This name should be too long or somethingsomethingsomethingsomethingsomethingsomethingsomethingsomething";
    }
    
    /*Test task type (must be string) condition.*/
    public function testInvalidTaskType(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->task = 5;
    }
    
    /*Test priority value (1,2 or 3) condition.*/
    public function testInvalidPriorityValue(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->priority = 4;
    }
        
    /*Test priority type (must be int) condition.*/
    public function testInvalidPriorityType(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->priority = "string";
    }
    
    /*Test group value (1,2,3 or 4) condition.*/
    public function testInvalidGroupValue(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->group = 5;
    }
        
    /*Test group type (must be int) condition.*/
    public function testInvalidGroupType(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->group = "test";
    }
    
    /*Test size value (1,2 or 3) condition.*/
    public function testInvalidSizeValue(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->size = 4;
    }
        
    /*Test size type (must be int) condition.*/
    public function testInvalidSizeType(){
        $task = $this->CI->task->instance();
        
        $this->expectException(Exception::class);
        $task->size = "test";
    }

  
}

