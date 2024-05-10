<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Lab7_1</title>
</head>
<body>
    <form action="Lab7_2.php" method="post">
        Выберите тип поиска в каталоге книг:<br>
        <label>
            <select name="search">
                <option value="author">По автору</option>
                <option value="title">По названию</option>
                <option value="isbn">По ISBN</option>
            </select>
        </label>
        <br/>Введите информацию для поиска:<br>
            <label>
                <input name="term" type="text">
            </label>
        <br/>
        <input type="submit" name="submit" value="Найти">
    </form>
</body>
</html>