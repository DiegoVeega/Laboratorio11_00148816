<?php
                //Con la palabra reservada class creamos una clase en PHP
                  class Task
                  {
                      private $id;
                      private $task;
                      private $dateTask;
                      /*Metodos setter*/
                      public function setId($id){
                          $this->id = $id;
                      }
                      public function setTask($task){
                          $this->task=$task;
                      }
                      public function setDateTask($dateTask){
                          $this->dateTask = $dateTask;
                      }
                      /*Metodos setter*/
                      public function getId(){
                          return $this->id;
                      }
                      public function getTask(){
                          return $this->task;
                      }
                      public function getDateTask(){
                          return $this->dateTask;
                      }
                  }
              ?>
