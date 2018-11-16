<?php
                 header("Access-Control-Allow-Origin: *");
                 header("Content-Type: application/json; charset=UTF-8");
                 header("Access-Control-Allow-Methods: POST");
                 header("Access-Control-Max-Age: 3600");
                 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
                 require('../dao/TaskDao.php');

                 //extraemos los datos que enviamos el body de la peticion
                 $data = json_decode(file_get_contents("php://input"));

                  //creamos un objeto de tipo Task
                 $task = new Task();
                 //Agregamos los datos traidos de la petición
                 $task->setTask($data->task);
                 $task->setDateTask($data->date);

                //creamo un objeto de tipo TaskDao
                 $dao = new TaskDao();

                 /*Validamos si los datos fueron insertados de forma correcta*/
                 if($dao->create($task))
                 {
                  http_response_code(201);
                  //convertimos el mensaje a JSON
                  echo json_encode(array("message" => "Tarea creada con exito"));
                 }
                 else{
                  http_response_code(500);
                  echo json_encode(array('message'=>'error'));
                 }

              ?>
              <?php
                header("Access-Control-Allow-Origin: *");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: DELETE");
                header("Access-Control-Max-Age: 3600");
                header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
                require('../dao/TaskDao.php');

                /*Obtenemos los datos enviado atraves del metodo delete*/
                $request = explode("/", substr(@$_SERVER['PATH_INFO'],1));

                /*obtenemos el valor enviado*/
                $id = $request[0];

                /*creamos un objeto de tipo TaskDAO*/
                $dao = new TaskDao();
                /*Enviamos el id*/
                $dao->delete($id);

                http_response_code(200);
                echo json_encode(array("message" => "Product was deleted."));
                ?>
                <?php
                /*Este archivo nos permitira recibir los datos enviados
                  desde un cliente y ser almacenos en una base de datos
                */
                header("Access-Control-Allow-Origin: *");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: DELETE");
                header("Access-Control-Max-Age: 3600");
                header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
                require('../dao/TaskDao.php');

                $request = explode("/", substr(@$_SERVER['PATH_INFO'],1));
                $id = $request[0];
                $dao = new TaskDao();
                http_response_code(200);
                echo json_encode($dao->read($id));
              ?>
              <?php
                /*Este archivo nos devolvera la lista de tareas*/

                require('../dao/TaskDao.php');
                $dao = new TaskDao();
                http_response_code(200);
                echo $dao->readAll();
              ?>
              <?php
                header("Access-Control-Allow-Origin: *");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: PUT");
                header("Access-Control-Max-Age: 3600");
                header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
                require('../dao/TaskDao.php');
                //extraigo los datos
                $data = json_decode(file_get_contents("php://input"));

                $task = new Task();
                $task->setId($data->id);
                $task->setTask($data->task);
                $task->setDateTask($data->date);
                $dao = new TaskDao();
                if($dao->update($task))
                {
                 http_response_code(201);
                 echo json_encode(array("message" => "Tarea Actualizada con exito"));
                }
                else{
                 http_response_code(500);
                 echo json_encode(array('message'=>'error '.$task->getTask()));
                }
              ?>
