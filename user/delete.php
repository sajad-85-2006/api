<?php
if ($_GET['id']){
    $e='mysql:host=localhost;dbname=tabel_project;';
    $link=new PDO($e,'root','');
    $SQL='DELETE FROM user WHERE user id = 1';
    $stmt = $link->query($SQL);
//    header('location: http://localhost:8000/user');
}else{
    header('location: http://localhost:8000/user');
}
