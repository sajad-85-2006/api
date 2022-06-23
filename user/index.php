
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
    if ($_SERVER["PHP_SELF"]=='/user/index.php/delete' && $_GET['id']){
        $SQL_1='DELETE FROM user WHERE id = '.$_GET['id'];
        $link->query($SQL_1);
    }
    if ($_SERVER["PHP_SELF"]=='/user/index.php/update' && $_GET['id']){
        $stmt_1=$link->query('select * from user where id = '.$_GET['id'])->fetch();
        $SQL='UPDATE `user` SET `FirstName` = ?, `LastName` = ?, `Email` = ?, `Password` = ? WHERE `user`.`id` = ?';
        $stmt = $link->prepare($SQL);
        if ($_POST['first']) {
            $stmt->bindValue(1, $_POST['first']);
        }else{
            $stmt->bindValue(1, $stmt_1['FirstName']);
        }
        if ($_POST['last']) {
            $stmt->bindValue(2, $_POST['last']);
        }else{
            $stmt->bindValue(2, $stmt_1['LastName']);
        }
        if ($_POST['email']) {
            $stmt->bindValue(3, $_POST['email']);
        }else{
            $stmt->bindValue(3, $stmt_1['Email']);
        }
        if ($_POST['pass']) {
            $stmt->bindValue(4, $_POST['pass']);
        }else{
            $stmt->bindValue(4, $stmt_1['Password']);
        }
        $stmt->bindValue(5,$_GET['id']);
        $stmt->execute();
    }
    if ($_SERVER["PHP_SELF"]=='/user/index.php/create' && $_POST ){
        $SQL='INSERT INTO user ( FirstName, LastName, Email, Password) VALUES ( ?, ?, ?, ?)';
        $stmt = $link->prepare($SQL);
        $stmt->bindValue(1,$_POST['first']);
        $stmt->bindValue(2,$_POST['last']);
        $stmt->bindValue(3,$_POST['email']);
        $stmt->bindValue(4,$_POST['pass']);
        $stmt->execute();
    }
    $stmt=$link->query('select * from user');
    echo json_encode($stmt->fetchAll());
}catch (Exception $k){
    echo $k->getMessage().' ';
    echo $k->getLine();

}



?>
