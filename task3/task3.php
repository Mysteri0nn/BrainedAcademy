<?php

function recognizeFigure($matrix, $width, $height) {
    $minX = $width;
    $maxX = 0;
    $minY = $height;
    $maxY = 0;

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            if ($matrix[$y][$x] == 1) { // Находим черный пиксель
                if ($x < $minX) $minX = $x;
                if ($x > $maxX) $maxX = $x;
                if ($y < $minY) $minY = $y;
                if ($y > $maxY) $maxY = $y;
            }
        }
    }

    // Вычисляем размеры фигуры
    $figureWidth = $maxX - $minX + 1;
    $figureHeight = $maxY - $minY + 1;
    
    // Копируем только область фигуры для анализа
    $figure = [];
    for ($y = $minY; $y <= $maxY; $y++) {
        $row = [];
        for ($x = $minX; $x <= $maxX; $x++) {
            $row[] = $matrix[$y][$x];
        }
        $figure[] = $row;
    }

    // Проверка на круг (округлая форма с равными высотой и шириной)
    if (abs($figureWidth - $figureHeight) < 5) { // небольшая погрешность
        // Проверим, есть ли у фигуры закругленные края
        $corners = [$figure[0][0], $figure[0][$figureWidth-1], $figure[$figureHeight-1][0], $figure[$figureHeight-1][$figureWidth-1]];
        if (array_sum($corners) == 0) {
            return "circle";
        }
    }

    // Проверка на квадрат (равные высота и ширина, с острыми углами)
    if (abs($figureWidth - $figureHeight) < 5) { // квадрат должен быть близок к равностороннему
        $corners = [$figure[0][0], $figure[0][$figureWidth-1], $figure[$figureHeight-1][0], $figure[$figureHeight-1][$figureWidth-1]];
        if (array_sum($corners) == 4) {
            return "square";
        }
    }

    // Если не круг и не квадрат, то это треугольник
    return "triangle";
}

// Чтение данных
fscanf(STDIN, "%d %d", $X, $Y);
$matrix = [];

for ($i = 0; $i < $Y; $i++) {
    $line = trim(fgets(STDIN));
    $matrix[] = array_map('intval', explode(' ', $line));
}

// Вывод результата
echo recognizeFigure($matrix, $X, $Y) . "\n";
