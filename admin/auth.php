<?php
include_once '../classes/dbclass.php';
include_once '../classes/configuration.php';
session_start();
if(!empty($_SESSION['login']) && $_SESSION['login']){
    
    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $config = new Configuration($connection);
    //value is considered in seconds
    $duration = $config->duration();
    $requestLimits = $config->requestLimit();
    // echo $requestLimits;exit;
    header( 'Location: dashboard.php?duration='.$duration.'&limit='.$requestLimits .'');die();
}else{
    $username = md5($_POST['username']);
    $password =md5($_POST['password']);
    if(!empty($username) && !empty($password)){
        if($username == md5('admin345') && $password == md5('Admin@dfg')){
            $_SESSION['login'] = true;
            $dbclass = new DBClass();
            $connection = $dbclass->getConnection();
            $config = new Configuration($connection);
            //value is considered in seconds
            $duration = $config->duration();
            $requestLimits = $config->requestLimit();
            // echo $requestLimits;exit;
            header( 'Location: dashboard.php?duration='.$duration.'&limit='.$requestLimits .'');die();
        }
    }
header("Location: index.php");die();
}

?>