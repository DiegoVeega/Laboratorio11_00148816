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
