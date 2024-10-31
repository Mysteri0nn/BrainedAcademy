<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Генератор анонсов</title>
</head>
<body>
    <h1>Генератор анонсов для статей</h1>
    <form action="generate_summary.php" method="POST">
        <label for="articleText">Текст статьи:</label><br>
        <textarea id="articleText" name="articleText" rows="10" cols="50" required></textarea><br><br>

        <label for="articleLink">Ссылка на статью:</label><br>
        <input type="text" id="articleLink" name="articleLink" size="50" required><br><br>

        <input type="submit" value="Сгенерировать анонс">
    </form>
</body>
</html>
