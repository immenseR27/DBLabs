<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Lab4</title>
</head>
<body>
    <?PHP
        $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
        $name = $_POST['name'];
        $seenform=$_POST['seenform'];
        $email=$_POST['email'];
        $job=$_POST['job'];
        $language=$_POST['language'];
        $field=$_POST['field'];
        $form = " 
        <form action=\"Lab4.php\" method=\"post\"> 
        <input type=\"hidden\" name=\"seenform\" value=\"z\"> 
        <b>Укажите Ваши данные!<br>
        Фамилия, имя:<br>  
        <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"20\" value=\"$name\"><br> 
        Ваш Email:<br> 
        <input type=\"text\" name=\"email\" size=\"20\" maxlength=\"40\" value=\"$email\"><br> 
        
        Ваш предпочитаемый язык:<br> 
        <select name=\"language\"> 
        <option value=\"none\">Выберите язык: 
        <option value=\"English\">Английский 
        <option value=\"Spanish\">Испанский 
        <option value=\"Italian\">Итальянский 
        <option value=\"French\">Французкий 
        </select><br> 
        Ваше занятие:<br> 
        <select name=\"job\"> 
        <option value=\"none\">Кто Вы?: 
        <option value=\"student\">Студент 
        <option value=\"programmed\">Программист 
        <option value=\"manager\">Менeджер 
        <option value=\"slacker\">Пенсионер 
        </select><br> 
        Хотели бы вы получать новостную рассылку?<br> </b>
        <input type=\"radio\" name=\"field\" value=\"Да\">Да<br>
        <input type=\"radio\" name=\"field\" value=\"Нет\">Нет<br>
        <input type=\"submit\" value=\"Зафиксировать в файле\">
        </form>";

        if ($seenform != "z"):
            print "$form";
        else:
            $error_flag = "n";
            if ($name == ""):
                print "<font color=\"red\"> Вы забыли ввести Ваше имя</font><br>";
                $error_flag = "y";
            else:
                if ($email == ""):
                    $error_flag = "y";
                    print "<font color=\"red\">Укажите правильный email address!</font><br>";
                else:
                    if ($field == ""):
                        $error_flag = "y";
                        print "<font color=\"red\">Пожалуйста, ответьте на последний вопрос</font><br>";
                    else:
                    $email = strtolower(trim($email));
                    endif;
                endif;
            endif;

            if(!empty($_POST['email'])and $error_flag == "n"):
                if(preg_match("|^[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email'])):
                    $error_flag = "n";
                    if ($_POST['field']=="Да") {
                        $fd = fopen($DOCUMENT_ROOT."/../Lab_Y.txt", 'ab');
                    }
                    if ($_POST['field']=="Нет") {
                        $fd = fopen($DOCUMENT_ROOT."/../Lab_N.txt", 'ab');
                    }
                    if (!$fd):
                        echo '<p><strong> Файл не доступен. <br></strong></p></body></html>';
                        exit;
                        endif;
                    $name = str_replace("|", "", $name);
                    $email = str_replace("|", "", $email);
                    $user_row = $name." ".$email."|".$language." ".$job."\n";
                    fwrite($fd, $user_row) or die("Could not write to file!");
                    fclose($fd);
                    print "<br>Строка в файле: ".$user_row;
                else:
                    $error_flag = "y";
                    echo $_POST['email']. " Email - неправильный.<br>";
                    print "<font color=\"red\"> Пример правильного возможного email: user@mail.ru</font><br>";
                    endif;
            else:
                if ($error_flag == "y"):
                    print "$form";
                endif;
            endif;
        endif;
    ?>
</body>
</html>
