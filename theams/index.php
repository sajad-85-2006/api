
<?php
// localhost:8000
error_reporting(~E_WARNING);
try {
    $e='mysql:host=localhost;dbname=tabel_project;';
    $link=new PDO($e,'root','');
//    echo '<pre>';
//    var_dump($_SERVER);
//
//    echo '</pre>';

    if ($_SERVER["PHP_SELF"]=='/theams/index.php/delete' && $_GET['id']){
        $SQL_1='DELETE FROM theams WHERE id = '.$_GET['id'];
        $link->query($SQL_1);
    }
    if ($_SERVER["PHP_SELF"]=='/theams/index.php/update' && $_GET['id']){
        $stmt_1=$link->query('select * from theams where id = '.$_GET['id'])->fetch();
        $SQL='UPDATE `theams` SET `name` = ?, `members` = ?, `alfa` = ? WHERE `theams`.`id` = ?';
        $stmt = $link->prepare($SQL);
        if ($_POST['name']) {
            $stmt->bindValue(1, $_POST['name']);
        }else{
            $stmt->bindValue(1, $stmt_1['name']);
        }
        if ($_POST['members']) {
            $stmt->bindValue(2, json_encode($_POST['members']));
        }else{
            $stmt->bindValue(2,$stmt_1['members']);
        }
        if ($_POST['members']) {
            $stmt->bindValue(3, $_POST['alfa']);
        }else{
            $stmt->bindValue(3, $stmt_1['alfa']);
        }
        $stmt->bindValue(4,$_GET['id']);
        $stmt->execute();
    }
    if ($_SERVER["PHP_SELF"]=='/theams/index.php/create' && $_POST ){
        var_dump($_POST['members']);
        $SQL='INSERT INTO theams ( name, members, alfa) VALUES ( ?, ?, ?)';
        $stmt = $link->prepare($SQL);
        $stmt->bindValue(1,$_POST['name']);
        $stmt->bindValue(2,json_encode($_POST['members']));
        $stmt->bindValue(3,$_POST['alfa']);
        $stmt->execute();

    }
    $stmt_2=$link->query('select * from theams');
    echo json_encode($stmt_2->fetchAll());
}catch (Exception $k){
    echo $k->getMessage().' ';
    echo $k->getLine();

}



?>
