<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Lab7_3</title>
</head>
<body>
    <?php
        if (!isset($_POST[Submit])) {
            print("<form  action=\"Lab7_3.php\" method=POST>");
            print("Введите информацию<br>");
            print("ISBN");
            print("<input type=text name=\"ISBN\"><br>");
            print("Автор");
            print("<input type=text name=\"Author\"><br>");
            print("Название");
            print("<input type=text name=\"Name\"><br>");
            print("Цена");
            print("<input type=text name=\"Price\"><br>");
            print("<input type=\"submit\" name=\"Submit\" value=\"Send\">");
            print("</form>");
        }
        else {
            $Host="localhost"; $User="root"; $DBName="books"; $Password="";
            @ $db = new mysqli($Host, $User, $Password, $DBName);
             if (mysqli_connect_errno()):
                 echo 'Ошибка: Не удалось установить соединение с  базой данных';
                 exit;
                 endif;
             $ISBN=$_POST['ISBN'];
             $Author=$_POST['Author'];
             $Name=$_POST['Name'];
             $Price=$_POST['Price'];

             if(!($ISBN=="")&&(!$Author=="")&&(!$Name=="")&&(!$Price=="")):
                 $sql = "insert into books values('".$ISBN."', '".$Author."', '".$Name."', '".$Price."')";
                 $result = $db->query($sql);
                 if ($result):
                     echo "<br>".$db->affected_rows." Книга добавлена  в базу данных.";
                     print ("<input type=\"button\" name=\"Button\" value=\"Next\" onclick=\"window.location.href='Lab7_1.php'\"");
                 else:
                     echo "<br> <font color=red>Книга Не добавлена в базу данных.<br>";
                     echo "<br>Ошибка MySql= ".mysqli_error($db).",result= ".$result.", affected_rows= ".$db->affected_rows ;
                     endif;
             else:
                print("<font color=red>Не все данные были введены. Вернитесь и заполните все поля.");
             endif;
        }
    ?>
</body>
</html>
