<?php

// erforderliche Session
@session_start();
$logPath = dirname(__FILE__) . "/log.json";
$log = json_decode(file_get_contents($logPath),true);
$title = $log['project'];
$dbPath = $log['dbpath'];
$cachePath = $dbPath."_cache/";
$userPath = $dbPath."user/";
$categories = $log['category'];

function pregName($username){
    return preg_replace ( '/[^a-z0-9 ]/i', '', $username).".json";
}
// Logout
if(isset($_GET['logout'])){
    if(isset($_SESSION)){
        // Session beenden
        unset($_SESSION);
        session_destroy();
    }

    header("Location: ../../index.php");
}