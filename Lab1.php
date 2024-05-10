<?PHP 
	if (!isset($_POST[Submit])) {
		print("<form  action=\"Lab1.php\" method=POST>");
		print("<p >Введите данные</p>");
		print("<table><tr><td> Фамилия </td>");
		print("<td><input type=text name=\"LastName\" ></td></tr>");
		print("<tr><td>Имя</td>");
		print("<td><input type=text name=\"FirstName\" ></td></tr>");
		print("<tr><td>Отчество</td>");
		print("<td><input type=text name=\"FatherName\" ></td></tr>");
		print("<tr><td>Дата рождения</td>");
		$d1 = new DateTime();
		$min = $d1->modify('-16 year');
		$mind = $min->format('Y-m-d');
		$d2 = new DateTime();
		$max = $d2->modify('-7 year');
		$maxd = $max->format('Y-m-d');
		print("<td><input type=date name=\"Birthday\" min=\"$mind\" max=\"$maxd\" </td></tr></table>");
		print("<table><tr><td>Дополнительные сведения</td></tr>");
		print("<tr><td><textarea name=\"Comments\" rows=5 cols=25 maxlength=100></textarea></td></tr></table>");
		print("<input type=submit name=\"Submit\" value=\"OK\">");
		print("<input type=reset name=\"Reset\" value=\"Отмена\">");
		print("</form>");
	}
	else {
		$LastName=trim($_POST[LastName]);
		$FirstName=trim($_POST[FirstName]);
		$FatherName=trim($_POST[FatherName]);
		$Birthday=$_POST[Birthday];
		$Birth = date("d.m.Y", strtotime($Birthday));
		if ((empty($LastName))||(empty($FirstName))||(empty($FatherName))||(empty($Birthday))) {
			echo "<br>Следующие данные не были введены:<br><ul>";
			if (empty($LastName)) {
				echo '<li>Фамилия</li>';
			}
			if (empty($FirstName)) {
				echo '<li>Имя</li>';
			}
			if (empty($FatherName)) {
				echo '<li>Отчество</li>';
			}
			if (empty($Birthday)) {
				echo '<li>Дата рождения</li>';
			}
			echo "</ul>Вернитесь и заполните все поля<br>";
			print("<input type=\"button\" onclick=\"history.back();\" value=\"Назад\">");
			exit;
		}
		$Name=$LastName." ".$FirstName." ".$FatherName;
		print("Проверьте введенные данные<br>");
		print("Фамилия: $LastName <br>");
		print("Имя: $FirstName <br>");
		print("Отчество: $FatherName <br>");
		print("Дата рождения: $Birth <br>");
		print("Дополнительные сведения: $Comments <br>");
		print("<input type=\"button\" onclick=\"window.location.href='Lab1_1.php?Name=$Name&Birthday=$Birthday&FirstName=$FirstName&LastName=$LastName&FatherName=$FatherName'\" value=\"Далее\">");
		print("<input type=\"button\" onclick=\"history.back();\" value=\"Назад\">");
	}
?>
