<?php

function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        if (!empty($_FILES)) {
            foreach ($_FILES as $key => $file) {
                $_AAux[$key] = $file; 
            }
        } else {
            $_AAux = "No se ha enviado ningún archivo.";
        }
        return $_AAux;
}

?>