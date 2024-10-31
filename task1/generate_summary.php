<?php
// Функция для генерации анонса
function generateSummary($articleText, $articleLink) {
    $cleanText = trim($articleText);

    if (mb_strlen($cleanText) > 250) {
        $cleanText = mb_substr($cleanText, 0, 250);
    }

    $cleanText = rtrim($cleanText);

    if (mb_strlen($cleanText) == 250) {
        $cleanText .= '...';
    } else {
        if (substr($cleanText, -1) !== ' ') {
            $cleanText .= '...';
        }
    }

    $words = explode(' ', $cleanText);
    $lastWords = array_slice($words, -3);
    $lastWordsLink = implode(' ', $lastWords) . ' <a href="' . $articleLink . '">Читать полностью</a>';

    $summary = implode(' ', array_slice($words, 0, -3)) . ' ' . $lastWordsLink;

    return $summary;
}

// Проверка, были ли отправлены данные через POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $articleText = $_POST['articleText'];
    $articleLink = $_POST['articleLink'];

    // Генерация анонса
    $summary = generateSummary($articleText, $articleLink);
    ?>
    
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Результат анонса</title>
    </head>
    <body>
        <h1>Сгенерированный анонс</h1>
        <p><?php echo $summary; ?></p>
        <a href="index.html">Вернуться назад</a>
    </body>
    </html>

    <?php
}
?>
