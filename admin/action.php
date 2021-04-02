<?php
include_once '../classes/dbclass.php';
include_once '../classes/configuration.php';
$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$config = new Configuration($connection);
//value is considered in seconds
$duration = $config->duration();
$requestLimits = $config->requestLimit();

        if(isset($_POST['configSubmit'])){
            $limit = (int)$_POST['limit'] > 0  ? $_POST['limit'] : $requestLimits;
            $duration = (int)$_POST['duration'] > 0 ? $_POST['duration'] : $duration;
            $config->resetConfigurations($duration,$limit);
            header("Location: auth.php");die();

        }
        else if(isset($_GET['action']) && $_GET['action']=='logout'){
            session_start();
            // Destroying session
            session_destroy();
            header("Location: index.php");die();


        }else{
            header("Location: auth.php");die();

        }
       

?>