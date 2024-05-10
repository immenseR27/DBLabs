<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Lab2</title>
</head>
<h1>Registration form</h1>
<body>
    <?php
        $email = $_POST['email'];
        $password = $_POST['password'];
        $seenform = $_POST['seenform'];
        $form =
                "<form action=\"Lab2.php\" method=\"post\"> 
                <input type = \"hidden\" name=\"seenform\" value=\"z\">
                <br>Mail: <br>
                <input type=\text\" name=\"email\">
                <br>Password: <br>
                <input type=\"password\" name=\"password\"><br>
                <input type =\"submit\" name=\"click\" value=\"Send\">
                </form>";

        if ($seenform != "z") {
            print "$form";
        }
        else {
            $error_flag = "n";
            if ($email == "") {
                //print ("input mail");
                $error_flag = "y";}
            else {
                $trim = trim($email);
                if (!preg_match("%^[\w](([_\.\-]?[\w]+)*)@([\w]+)(([\.\-]?[\w]+)*)\.([A-Za-z])+$%",  $email) ||
                !preg_match("%^[\w]{4,8}$%", $password)) {
                    echo "<font color=\"red\">Wrong format!</font>";
                    $error_flag = "y";
                }
            }
            if ($error_flag == "y") {
                print ("$form");
            }
            else {
                $Host="localhost"; $User="root"; $DBName="labs"; $Password="";
                @ $db = new mysqli($Host, $User, $Password, $DBName);
                if (mysqli_connect_errno()) {
                    echo 'Ошибка: Не удалось установить соединение с  базой данных.<br /> Пожалуйста, повторите попытку позже.';
                    exit;
                }
                $sql = "SHOW TABLES FROM labs LIKE authorisation";
                $result = $db->query($sql);
                if ($result->num_rows==0) {
                     $sql = "CREATE TABLE avtorisation 
                    (user_mail varchar(255) NOT NULL,
                     user_pass varchar(255) NOT NULL,
                     PRIMARY KEY (user_mail));";
                    $db->query($sql);
                }
                $sql = "SELECT user_mail FROM avtorisation WHERE user_mail=\'$email\'";
                $result = $db->query($sql);
                if ($result->num_rows==0) {
                    $sql = "insert into avtorisation values('$email', '$password')";
                    $result = $db->query($sql);
                    if ($result) {
                        echo "<br>".$db->affected_rows."Запись добавлена в базу данных.";
                    }
                    else {
                        echo "<br> <font color=red>Запись не добавлена в базу данных. Возможно, она там уже есть.<br>";
                    }
                }
            }
        }
    ?>
</body>
</html>
