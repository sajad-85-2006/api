
<?php
// localhost:8000
error_reporting(~E_WARNING);
try {

    $e='mysql:host=localhost;dbname=task;';
    $link=new PDO($e,'root','');
    if ($_SERVER["PHP_SELF"]=='/task/index.php/delete' && $_REQUEST['id']){
        $SQL_1='DELETE FROM bord WHERE id = '.$_REQUEST['id'];
        $link->query($SQL_1);
    }

    if ($_SERVER["PHP_SELF"]=='/task/index.php/update' && $_REQUEST['id']){
        $stmt_1=$link->query('select * from bord where id = '.$_REQUEST['id'])->fetch();
        $SQL='UPDATE `bord` SET `name` = ?, `caption` = ?,number = ? WHERE `bord`.`id` = ?';
        $stmt = $link->prepare($SQL);
        if ($_REQUEST['name']) {
            $stmt->bindValue(1, $_REQUEST['name']);
        }else{
            $stmt->bindValue(1, $stmt_1['name']);
        }
        if ($_REQUEST['caption']) {
            $stmt->bindValue(2, $_REQUEST['caption']);
        }else{
            $stmt->bindValue(2, $stmt_1['caption']);
        }if ($_REQUEST['number']) {
            $stmt->bindValue(3, $_REQUEST['number']);
        }else{
            $stmt->bindValue(3, $stmt_1['number']);
        }
        $stmt->bindValue(4,$_REQUEST['id']);
        $stmt->execute();
    }
    if ($_SERVER["PHP_SELF"]=='/task/index.php/create' && $_REQUEST ){
        $SQL='INSERT INTO bord    ( name, caption,number) VALUES ( ?, ?,?)';
        $stmt = $link->prepare($SQL);
        $stmt->bindValue(1,$_REQUEST['name']);
        $stmt->bindValue(2,$_REQUEST['caption']);
        $stmt->bindValue(3,$_REQUEST['number']);
        $stmt->execute();
    }
    $stmt=$link->query('select * from bord');
//    var_dump($stmt->fetchAll());
    echo json_encode($stmt->fetchAll());
}catch (Exception $k){
    echo $k->getMessage().' ';
    echo $k->getLine();

}



?>
