<?php
                /*Este archivo nos devolvera la lista de tareas*/

                require('../dao/TaskDao.php');
                $dao = new TaskDao();
                http_response_code(200);
                echo $dao->readAll();
              ?>
