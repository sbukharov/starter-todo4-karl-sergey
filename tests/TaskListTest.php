<?php

use PHPUnit\Framework\TestCase;

class TaskListTest extends TestCase {
    private $CI;

    public function setUp() {
        $this->CI = &get_instance();
    }

    public function testUncompletedTasksGreaterThanCompleted() {
        $incomplete = 0;
        $tasks = $this->CI->tasks->all();

        foreach ($tasks as $task) {
            if ($task->status != 2) {
                $incomplete++;
            }
        }
        
        //alt(7,11) = 11 less than 7? true
        $this->assertLessThan(count($tasks)/2,$incomplete);
    }
}