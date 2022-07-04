
<?php
// localhost:8000
error_reporting(~E_WARNING);
try {

    $e='mysql:host=localhost;dbname=task;';
    $link=new PDO($e,'root','');
    $stmt_3=$link->prepare('select * from bord where id = ?');
    $stmt_3->bindValue(1,$_REQUEST['id']);
    $stmt_3->execute();
    $json=$stmt_3->fetch()['item'];

    if ($_SERVER["PHP_SELF"]=='/item/index.php/delete' && $_REQUEST['name']){
        $re=json_decode($json);
        var_dump($re);
        $SQL='UPDATE `bord` SET item = ? WHERE `id` = ?';
        $stmt = $link->prepare($SQL);
        $stmt->bindValue(1,$json);
        $stmt->bindValue(2,$_REQUEST['id']);
        $stmt->execute();
    }

    if ($_SERVER["PHP_SELF"]=='/item/index.php/update' && $_REQUEST['name']){
        $stmt_1=$link->query('select * from item where id = '.$_REQUEST['id'])->fetch();
        $SQL='UPDATE `bord` SET `name` = ?, `caption` = ?,time = ? WHERE `id` = ?';
//        $stmt = $link->prepare($SQL);
//        if ($_REQUEST['name']) {
//            $stmt->bindValue(1, $_REQUEST['name']);
//        }else{
//            $stmt->bindValue(1, $stmt_1['name']);
//        }
//        if ($_REQUEST['caption']) {
//            $stmt->bindValue(2, $_REQUEST['caption']);
//        }else{
//            $stmt->bindValue(2, $stmt_1['caption']);
//        }if ($_REQUEST['time']) {
//            $stmt->bindValue(3, $_REQUEST['time']);
//        }else{
//            $stmt->bindValue(3, $stmt_1['time']);
//        }
//        $stmt->bindValue(4,$_REQUEST['id']);
//        $stmt->execute();
    }
    if ($_SERVER["PHP_SELF"]=='/item/index.php/create' && $_REQUEST ){
        $r=['id'=>1,'name'=>$_REQUEST['name'],'caption'=>$_REQUEST['caption'],'time'=>$_REQUEST['time']];
        $re=$json?json_decode($json):[];
        foreach ($re as $c){
            var_dump($c);
        }
//        array_push($re,$r);
//        $json=json_encode($re);
//        $SQL='UPDATE `bord` SET item = ? WHERE `id` = ?';
//        $stmt = $link->prepare($SQL);
//        $stmt->bindValue(1,$json);
//        $stmt->bindValue(2,$_REQUEST['id']);
//        $stmt->execute();
    }
    $stmt=$link->prepare('select * from bord where id = ?');
    $stmt->bindValue(1,$_REQUEST['id']);
    $stmt->execute();
    echo $stmt->fetch()['item'];
}catch (Exception $k){
    echo $k->getMessage().' ';
    echo $k->getLine();

}



?>
