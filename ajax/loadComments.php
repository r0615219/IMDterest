<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".php");
});

if (!empty($_POST['comment'])) {
  echo "SHIT";
}

?>
