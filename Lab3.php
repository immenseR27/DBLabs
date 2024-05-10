<!DOCTYPE html>
<?php
    $days['Январь']=31;
    $days['Февраль']=29;
    $days['Март']=31;
    $days['Апрель']=30;
    $days['Май']=31;
    $days['Июнь']=30;
    $days['Июль']=31;
    $days['Август']=31;
    $days['Сентябрь']=30;
    $days['Октябрь']=31;
    $days['Ноябрь']=30;
    $days['Декабрь']=31;

    $nums['Январь']=1;
    $nums['Февраль']=2;
    $nums['Март']=3;
    $nums['Апрель']=4;
    $nums['Май']=5;
    $nums['Июнь']=6;
    $nums['Июль']=7;
    $nums['Август']=8;
    $nums['Сентябрь']=9;
    $nums['Октябрь']=10;
    $nums['Ноябрь']=11;
    $nums['Декабрь']=12;

    if (!isset($_POST[submit])) {
        print("<form action=\"Lab3.php\" method=POST>");
        print("Введите названия месяцев через запятую: <br>");
        print("<input type=\"text\" name=\"month\" size=50>");
        print("<input type=\"submit\" name=\"submit\" value=\"OK\">");
        print("<input type=\"reset\" name=\"reset\" value=\"CANCEL\"><br><br>");
        print("Сортировать по: ");
        print ("<select name=\"sorting\">
            <option value=\"none\">Не выбрано</option>
            <option value=\"name\">По названию</option>
            <option value=\"days\">По количеству дней</option>
            <option value=\"queue\">По порядку</option>
            </select><br>");
        print("</form>");
    }
    else {
        $sorting = $_POST[sorting];

        if ($sorting=="none") {
            print("<font color=\"red\">Выберите способ сортировки!</font>");
        }

        if ($sorting=="name") {
            print("<b>Сортировка по названию:</b><br>");
            $month = explode(",", $_POST[month]);
            sort($month);
            $month = implode("<br>", $month);
            print("$month");
        }

        if ($sorting=="days") {
            print("<b>Сортировка по количеству дней:</b><br>");
            $month = explode(",", $_POST[month]);
            foreach($days as $key=>$value) {
                if(in_array($key, $month)) {
                    $months[$key]=$value;
                }
            }
            asort($months);
            foreach($months as $key=>$value) {
                print("$key-$value<br>");
            }
        }

        if ($sorting=="queue") {
            print("<b>Сортировка по порядку:</b><br>");
            $month = explode(",", $_POST[month]);
            foreach($nums as $key=>$value) {
                if(in_array($key, $month)) {
                    $months[$key]=$value;
                }
            }
            asort($months);
            foreach($months as $key=>$value) {
                print("$key-$value<br>");
            }
        }
    }