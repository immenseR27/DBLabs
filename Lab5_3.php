<?php
    $Host="localhost"; $User="root"; $Password=""; $DBName="books";
    @ $db = new mysqli($Host, $User, $Password, $DBName);
     if (mysqli_connect_errno()):
        echo 'Ошибка: Не удалось установить соединение с  базой данных.<br /> 
                Пожалуйста, повторите попытку позже.';
        exit;
     endif;
    $sql = "SELECT t1.orderid, SUM(summ) AS summ 
            FROM (SELECT t.orderid, summ 
            FROM(SELECT order_items.orderid, (order_items.quantity*books.price) AS summ 
            FROM (order_items INNER JOIN books ON order_items.isbn=books.isbn)) AS t) AS t1 
            GROUP BY t1.orderid;";
    $result = $db->query($sql);
    $rows = $result->num_rows; //количество записей в результате запроса
    while($row = mysqli_fetch_array($result)) {
        $arr=$row;
        $ord[$arr[0]]=$arr[1];
    }
    foreach($ord as $key=>$value) {
        $sql = "UPDATE orders SET amount=$value WHERE orders.orderid=$key";
        $result = $db->query($sql);
    }
