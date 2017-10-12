<?php


/**
 * Tasks class containing tasks for to-do app.
 */
class Tasks extends CSV_Model {

        public function __construct()
        {
                parent::__construct(APPPATH . '../data/tasks.csv', 'id');
        }

}