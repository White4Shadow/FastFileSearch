<?php

include_once "../config/require.php";


if(isset($_SESSION['user']['id']) && $_SESSION['user']['id']==1) {


    // **** Import ****
    if(!empty($_FILES["fileUpload"]["name"])) { // Upload File
        $target_file = $dbPath . basename($_FILES["fileUpload"]["name"]);
        $uploadError=0;
        if (file_exists($target_file)) $uploadError++;
        if($uploadError==0) {
            move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
        }
    }

    // **** Usermanagement ****

    if(!empty($_POST['username']) && !empty($_POST['password'])) { // Add User
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $created = date("d.m.Y");
        $file = pregName($username);

        $newUser = array();
        $newUser['id'] = $log['id'];
        $newUser['username'] = $username;
        $newUser['password'] = $password;
        $newUser['created'] = $created;

        if(!file_exists($userPath . $file)){

            $nu = fopen($userPath . $file , "w");
            fwrite($nu, json_encode($newUser, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fclose($nu);
            $log['id']++;
            $logEdit = fopen($logPath, 'wa+');
            fwrite($logEdit, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fclose($logEdit);
        }

    }

    if(isset($_GET['delete']) && !empty($_GET['delete'])) { // Delete User

        unlink($userPath . $_GET['delete']);
        header("Location: ?manage");

    }

    // **** Settings ****
    if(isset($_POST['project'])){ // Change Webistename
        $log['project'] = $_POST['project'];
        $logEdit = fopen($logPath, 'wa+');
        fwrite($logEdit, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $title =  $log['project'];
        fclose($logEdit);
    }
    else if(isset($_POST['cache'])) { // Empty Cache
        // Cache bereinigen
        $cache = opendir($cachePath);
        while ($f = readdir($cache)) {
            unlink($path . $f);
        }
    }else if(isset($_POST['category']) && !empty($_POST['category']) ){ // Add Category

           array_push($categories[$_POST['category']], "");
           $log['category'] = $categories;
           $logEdit = fopen($logPath, 'wa+');
           fwrite($logEdit, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
           fclose($logEdit);

    }else if (isset($_GET['deleteCategory']) && !empty($_GET['deleteCategory'] )){ // Delete Category
       unset($categories[$_GET['deleteCategory']]);
        $log['category'] = $categories;
        $logEdit = fopen($logPath, 'wa+');
        fwrite($logEdit, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fclose($logEdit);
        header("Location: ?settings");
    }else if(isset($_POST['feld']) && !empty($_POST['feld']) && isset($_POST['selectedCat']) && !empty($_POST['selectedCat'])  ){ // Add Feld

            $tmp = $categories[$_POST['selectedCat']]==null ? array() : explode(",", $categories[$_POST['selectedCat']]);
            array_push($tmp, $_POST['feld']);
            $categories[$_POST['selectedCat']] = implode(",", $tmp);
            $log['category'] = $categories;
            $logEdit = fopen($logPath, 'wa+');
            fwrite($logEdit, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fclose($logEdit);

        }else if (isset($_GET['deleteFeld']) && !empty($_GET['deleteFeld'] ) && isset($_GET['cat']) && !empty($_GET['cat'])){ // Delete Feld
            $tmp = explode(",", $categories[$_GET['cat']]);
            unset($tmp[array_search($_GET['deleteFeld'],$tmp)]);
            $categories[$_GET['cat']] = implode(",", $tmp);
            $log['category'] = $categories;
            $logEdit = fopen($logPath, 'wa+');
            fwrite($logEdit, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fclose($logEdit);
            header("Location: ?settings");



    }


    // Admin-Bereich
    include_once "template.php";


}else{
    header("Location: ../../index.php");
}