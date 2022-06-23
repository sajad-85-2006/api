<?php
if ($_POST['id']){
    $e='mysql:host=localhost;dbname=tabel_project;';
    $link=new PDO($e,'root','');
    $SQL='delete from user  where id = '.$_POST['id'];
    $stmt = $link->query($SQL);
    header('location: http://localhost:8000/user');
}else{
//    header('location:');
}
