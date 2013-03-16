<?php
require_once('dbdata.php');

try {
    //читаем новые значения
    $id = $_POST['id'];
    $fio = $_POST['fio'];
    $job = $_POST['job'];
    $brand = $_POST['brand'];
    $email = $_POST['email'];
    
    //подключаемся к базе
    $dbh = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
    //указываем, мы хотим использовать utf8
    $dbh->exec('SET CHARACTER SET utf8');



    //переименовываем менеджера в делах
    $stm = $dbh->prepare('UPDATE 1_clients SET manager=? WHERE manager=?');
    $stm->execute(array($fio, $id));

    //определяем количество записей в таблице
    $stm = $dbh->prepare('UPDATE 1_users SET fio=?, job=?, brand=?, email=? WHERE id=?');
    $stm->execute(array($fio, $job, $brand, $email, $id));
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

// end of saverow.php