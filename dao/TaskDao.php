<?php
                  /*****************Requeriremos los archivos necesarios para poder trabajar*****************************************/
                  require('../models/Task.php'); //Modelo de la tabla task
                  require('../interfaces/metodos.php'); //Interface metodos
                  require('../connecion/Connecion.php'); //Clase para realizar la conexión
                 /******************************************************************************************************************/
                  class TaskDao implements metodos
                  {
                    /*********************Método para extraer todoas la tareas*************************************************************/
                      public function readAll()
                      {
                          //extraemos la instancia de nuestra base de datos
                          $instance = Connecion::getInstance();
                          //obtemos la connecion
                          $conn = $instance->getCnx();

                          $tasks= array(); //arreglo donde estaran todas las tareas
                          $result = $conn->query('select * from tasks'); // ejecutamos la consulta para que nos devuelva todas las tareas
                          while($row = $result->fetch_object()) //convertimos el el resultado de las filas a objectos
                          {
                              array_push($tasks,$row); //agregamos el objeto a nuestro arreglo
                          }
                          $conn->close(); //cerramos la connecion a la base de datos
                          return json_encode($tasks); //devolvemos los datos


                      }
                      /*************************************************************************************************************************/

                      /*********************Método para traer una tarea*************************************************************/
                      public function read($id)
                      {
                          $instance = Connecion::getInstance();
                          $conn = $instance->getCnx();

                          //parametrizando la consulta para evitar sql injection
                          $result = $conn->query(sprintf("select * from tasks where id='%s'",$id));

                          $task = null; //tarea buscada

                          //fetch_object convierte los datos de una fila en objeto de tipo JSON
                          while($row = $result->fetch_object())
                          {
                              $task = $row;
                          }
                          $conn->close();
                          return $task;
                      }
                      /*************************************************************************************************************************/

                      /*********************Método para crear una tarea*************************************************************/
                      public function create($task)
                      {
                          $instance = Connecion::getInstance();
                          $conn = $instance->getCnx();
                          $sql = sprintf("insert into tasks (task, date_task) values('%s','%s')",$task->getTask(),$task->getDateTask());

                          //Cuando es una consulta de tipo isert, delete, update el metodo query nos retorna true o false.
                          if ($conn->query($sql))
                          {
                              $conn->close();
                              return true;
                          }
                          $conn->close();
                          return false;
                      }
                      /*************************************************************************************************************************/


                      /*********************Método para Actualizar una tarea*************************************************************/
                      public function update($task)
                      {
                          $instance = Connecion::getInstance();
                          $conn = $instance->getCnx();
                          $sql = sprintf("update tasks set task='%s', date_task='%s' where id='%s'",$task->getTask(),$task->getDateTask(),$task->getId());
                          if ($conn->query($sql))
                          {
                              $conn->close();
                              return true;
                          }
                          $conn->close();
                          return false;
                      }
                      /*************************************************************************************************************************/

                        /*********************Método para Eliminar una tarea*************************************************************/
                      public function delete($id)
                      {
                          $instance = Connecion::getInstance();
                          $conn = $instance->getCnx();
                          $sql = sprintf("delete from tasks where id='%s'",$id);
                          if($conn->query($sql))
                          {
                              $conn->close();
                              return true;
                          }
                          else
                          {
                              $conn->close();
                              return false;
                          }
                      }
                  }
                    /*************************************************************************************************************************/
                ?>
