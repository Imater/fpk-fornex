<?php
// Подключение и выбор БД
// Подключение и выбор БД

$db = mysql_connect('localhost', 'root', 'See6thoh');
mysql_query("SET NAMES utf8");
mysql_select_db('h116');

    # ВНИМАНИЕ!!!
    # Данный код не имеет проверок запрашиваемых данных
    # что может стать причиной взлома! Обязательно проверяйте все данные
    # поступающие от клиента

    $userdata = $_REQUEST['userdata'];
    $page = $_REQUEST['page'];      // Номер запришиваемой страницы
    $limit = $_REQUEST['rows'];     // Количество запрашиваемых записей
    $sidx = $_REQUEST['sidx'];      // Номер элемента массива по котору следует производить сортировку
                                    // Проще говоря поле, по которому следует производить сортировку
    $sord = $_REQUEST['sord'];      // Направление сортировки

    $get = $_REQUEST['get'];  // Фильтр
    
    // Если не указано поле сортировки, то производить сортировку по первому полю
    if(!$sidx) $sidx =1;

    switch ($get){
        //*********************************************************************
        // Подтаблица
        case 'subgrid':
            $id = $_REQUEST['id'];

            // Выполним запрос, который вернет суммарное кол-во записей в таблице
            $result = mysql_query("SELECT COUNT(*)AS count FROM cities WHERE country_code LIKE '".$id."'");
            if(@mysql_num_rows($result) == 1){
                $row = mysql_fetch_assoc($result);
                $count = $row['count'];     // Теперь эта переменная хранит кол-во записей в таблице

                // Рассчитаем сколько всего страниц займут данные в БД
                if( $count > 0 && $limit > 0) {
                    $total_pages = ceil($count/$limit);
                } else {
                    $total_pages = 0;
                }
                // Если по каким-то причинам клиент запросил
                if ($page > $total_pages) $page=$total_pages;

                // Рассчитываем стартовое значение для LIMIT запроса
                $start = $limit*$page - $limit;
                // Зашита от отрицательного значения
                if($start <0) $start = 0;
                
                // Запрос выборки данных
                $query = "SELECT city, latitude, longitude FROM cities  WHERE country_code LIKE '".$id."' ORDER BY ".$sidx." ".$sord." LIMIT ".$start.", ".$limit;
                $result = mysql_query($query);
                if(@mysql_num_rows($result) >= 1){
                    // Начало формирование массива
                    // для последующего преобразоования
                    // в JSON объект
                    $data->page       = $page;
                    $data->total      = $total_pages;
                    $data->records    = $count;

                    // Строки данных для таблицы
                    $i = 0;
                    while($row = mysql_fetch_assoc($result)) {
                        // Строки данных для таблицы

                            $data->rows[$i]['cell'] = array('<strong><em>'.$row['city'].'</em></strong>',$row['latitude'],$row['longitude']);
                            $i++;
                    }
                 }else{
                    $data->page       = $page;
                    $data->total      = 0;
                    $data->records    = 0;
                }
            }else{
                 $data->page       = $page;
                 $data->total      = 0;
                 $data->records    = 0;
            }
            break;
         //*********************************************************************
         //
         //*********************************************************************
         // Родительская таблица
         default:
            // Вернуть названия стран
            // Выполним запрос, который вернет суммарное кол-во записей в таблице
            $year=2011;
            $month_from=1;
            $month_to=12;
            
                //$row = mysql_fetch_assoc($result);
                $count = $month_to;     // Теперь эта переменная хранит кол-во записей в таблице


                // Рассчитаем сколько всего страниц займут данные в БД
                if( $count > 0 && $limit > 0) {
                    $total_pages = ceil($count/$limit);
                } else {
                    $total_pages = 0;
                }
                // Если по каким-то причинам клиент запросил
                if ($page > $total_pages) $page=$total_pages;

                // Рассчитываем стартовое значение для LIMIT запроса
                $start = $limit*$page - $limit;
                // Зашита от отрицательного значения
                if($start <0) $start = 0;

                // Начало формирование массива
                // для последующего преобразоования
                // в JSON объект
                $data['page']       = $page;
                $data['total']      = $total_pages;
                $data['records']    = $count;
  $fp = fopen('its2.txt', "w");

                // Строки данных для таблицы
                for($i=1;$i<=$month_to;$i++) {
                    //--------------------------------------------
                    // Сосчитаем города
                    $cities = @mysql_fetch_object(mysql_query("SELECT count(*) cnt FROM `1_clients` WHERE dg LIKE '2011-0".$i."%' AND brand = 'Peugeot'"));
                    //--------------------------------------------

                    $data['rows'][$i]['id'] = $i;
                    $data['rows'][$i]['cell'][] = $i;
                    $data['rows'][$i]['cell'][] = "Januar".$i;
                    $data['rows'][$i]['cell'][] = "$cities->cnt";
                }

         //*********************************************************************
    }
        // Перед выводом не забывайте выставить header
        // с типом контента и кодировкой
        header("Content-type: text/script;charset=utf8");
        echo json_encode($data);
  @fwrite($fp, json_encode($data));

  fclose($fp);

?>
