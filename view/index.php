<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">

</html>
<?php
    define("ROOT_PATH" , dirname(__DIR__));
    require_once ROOT_PATH . '\utils\utils.php';
    
    define("PATH_API", convert_path_to_serveURL(ROOT_PATH));


   
    
    if(isset($_GET['controller'])){
        $controller = $_GET['controller'];
    }else{
        $controller = '';
    }
    
    switch($controller){
        case 'user':
            require_once('controller/user/index.php');
        case 'login':
            require_once('controller/login/index.php');
        case 'uploadfile':
            require_once('controller/uploadfile/index.php');
    }

?>