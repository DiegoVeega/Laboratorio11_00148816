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
