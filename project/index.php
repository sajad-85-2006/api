
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
    if ($_SERVER["PHP_SELF"]=='/project/index.php/delete' && $_GET['id']){
        $SQL_1='DELETE FROM project WHERE id = '.$_GET['id'];
        $link->query($SQL_1);
    }
    if ($_SERVER["PHP_SELF"]=='/project/index.php/update' && $_GET['id']){
        $stmt_1=$link->query('select * from project where id = '.$_GET['id'])->fetch();
        $SQL='UPDATE `project` SET `name` = ?, `caption` = ? WHERE `project`.`id` = ?';
        $stmt = $link->prepare($SQL);
        if ($_POST['name']) {
            $stmt->bindValue(1, $_POST['name']);
        }else{
            $stmt->bindValue(1, $stmt_1['name']);
        }
        if ($_POST['caption']) {
            $stmt->bindValue(2, $_POST['caption']);
        }else{
            $stmt->bindValue(2, $stmt_1['caption']);
        }
        $stmt->bindValue(3,$_GET['id']);
        $stmt->execute();
    }
    if ($_SERVER["PHP_SELF"]=='/project/index.php/create' && $_POST ){
        $SQL='INSERT INTO project    ( name, caption) VALUES ( ?, ?)';
        $stmt = $link->prepare($SQL);
        $stmt->bindValue(1,$_POST['name']);
        $stmt->bindValue(2,$_POST['caption']);
        $stmt->execute();
    }
    $stmt=$link->query('select * from project');
    echo json_encode($stmt->fetchAll());
}catch (Exception $k){
    echo $k->getMessage().' ';
    echo $k->getLine();

}



?>
