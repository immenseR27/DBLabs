<html lang="ru">
<head>
    <title>Lab2</title>
</head>
<body>
<?PHP
    $Name=$_REQUEST['Name'];
    $Birthday=$_REQUEST['Birthday'];
    $LastName=$_REQUEST['LastName'];
    $FirstName=$_REQUEST['FirstName'];
    $FatherName=$_REQUEST['FatherName'];

    if (isset($Name))
    { echo "ФИО: $Name <br>" ;}
    else
    { echo "Переменная с именем Name недоступна <br>"; }

    if (isset($Birthday)) {
        $today = floor(date("Y.m.d"));
        $Age = $today - $Birthday;
        print("Возраст: $Age лет <br>");
        if (isset($LastName)&isset($FirstName)&isset($FatherName)) {
            if($Age<10) {
                $f = fopen("C:/WebServers/home/DB1/www/young.txt", 'a') or die("Не удалось открыть файл");
                $t="Младший возраст";
            }
            else if($Age<13) {
                $f = fopen("C:/WebServers/home/DB1/www/middle.txt", 'a') or die("Не удалось открыть файл");
                $t="Средний возраст";
            }
            else if($Age<16) {
                $f = fopen("C:/WebServers/home/DB1/www/old.txt", 'a') or die("Не удалось открыть файл");
                $t="Старший возраст";
            }
            fwrite($f, "$LastName;");
            fwrite($f, "$FirstName;");
            fwrite($f, "$FatherName;");
            fwrite($f, "$Age;");
            fwrite($f, "\n");
            fclose($f);
            echo "Запись добавлена в таблицу <br> \"$t\"";

            if($Age<10) {
                $f = fopen("C:/WebServers/home/DB1/www/young.txt", 'r') or die("Не удалось открыть файл");
            }
            else if($Age<13) {
                $f = fopen("C:/WebServers/home/DB1/www/middle.txt", 'r') or die("Не удалось открыть файл");
            }
            else if($Age<16) {
                $f = fopen("C:/WebServers/home/DB1/www/old.txt", 'r') or die("Не удалось открыть файл");
            }
            print ("<table><tr><td>Фамилия</td><td>Имя</td><td>Отчество</td><td>Лет</td></tr>");
            while(!feof($f)) {
                $str = explode(";", fgets($f));
                print("<tr>");
                for ($i=0; $i<count($str)-1; $i++) {
                echo "<td>$str[$i]</td>";}
                }
                print ("</tr></table>");
                fclose($f);
            }
            else {
                echo "Не удалось добавить запись, т.к. часть данных ФИО недоступна";
            }
        }
        else {
            echo "Невозможно определить возраст, т.к. переменная с именем Birthday недоступна<br>";
        }
        print("<input type=\"button\" onclick=\"window.location.href='Lab_1.php'\" value=\"В начало\">");
    ?>
</body>
</html>
