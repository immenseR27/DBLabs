<html lang="ru">
<head>
    <title>Lab7_2</title>
</head>
<body>
    <?php
        $search=$_POST['search'];
        $term=$_POST['term'];
        $Host="localhost";
        $User="root";
        $DBName="books";
        $Password="";

        if (!$search || !$term):
            echo "вы не ввели информацию для поиска";
            exit;
        endif;
        @ $db = mysql_pconnect($Host, $User, $Password);
        if (!$db) {
            echo 'Не удалось установить соединение с базой данных';
            exit;
        }
        mysql_select_db("books");
        $query="select * from books where ".$search." like '%".$term."%'";
        $result = mysql_query($query);
        $num_results = mysql_num_rows($result);
        echo "Найдено книг: ".$num_results."<br>";
        for ($i=0; $i<$num_results; $i++) {
            $row = mysql_fetch_array($result);
            echo "".($i+1)." . Название: ";
            echo $row["title"];
            echo ", Автор: ";
            echo $row["author"];
            echo ",ISBN: ";
            echo $row["isbn"];
            echo ", Цена: ";
            echo $row["price"]."<br>";
        }
    ?>
</body>
</html>