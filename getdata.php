<?php
require_once('dbdata.php');

try {
    //читаем параметры
    $curPage = $_POST['page'];
    $rowsPerPage = $_POST['rows'];
    $sortingField = $_POST['sidx'];
    $sortingOrder = $_POST['sord'];
    
	$brand=$_COOKIE['brand'];
    
    //подключаемся к базе
    $dbh = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
    //указываем, мы хотим использовать utf8
    $dbh->exec('SET CHARACTER SET utf8');

    //определяем количество записей в таблице
    $rows = $dbh->query('SELECT COUNT(id) AS count FROM 1_users WHERE brand="'.$brand.'"');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);

    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список пользователей из базы
    $res = $dbh->query('SELECT *, (SELECT count(*) FROM 1_clients WHERE 1_clients.manager=1_users.fio) clients FROM 1_users WHERE 1_users.brand = "'.$brand.'" ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
        
    
    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $response->rows[$i]['id']=$row['id'];
        $response->rows[$i]['cell']=array($row['id'], $row['fio'], $row['job'], $row['clients'], $row['email'], $row['birthday'], $row['lastvizit']);
        $i++;
    }
    echo json_encode($response);
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

// end of getdata.php