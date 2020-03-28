<?php
if(isset($_POST['install'])){

    //data for log.json
    $tmp = array();
    $tmp['project'] = $_POST['header'];
    $tmp['dbpath'] = $_POST['database'];
    $tmp['id'] = 2;
    $tmp['category'] = [];
    $tmp['created'] = date("d.m.Y");

    //create log.json
    $log = fopen("../backend/config/log.json" , 'w');
    fwrite($log, json_encode($tmp, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fclose($log);

    //create userPath
    $userdir = $tmp['dbpath']."user/";
    mkdir($userdir,0777);
    //create cachePath
    $cachedir = $tmp['dbpath']."_cache/";
    mkdir($cachedir,0777);

    //create Administrator
    $username = $_POST['username'];
    $adminData = array();
    $adminData['id'] = 1;
    $adminData['password'] = sha1($_POST['password']);
    $adminData['username'] = $username;
    $adminData['created'] = date("d.m.Y");

    $admin = fopen($userdir. $username .".json" , 'w');
    fwrite($admin, json_encode($adminData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fclose($admin);


    header("Location: ../index.php");
}else if(isset($_GET['install'])){
    include_once "installtemplate.php";

}else{
    include_once "introtemplate.php";
}

