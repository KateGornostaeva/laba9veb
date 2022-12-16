<?php
    $min_value = -100;// минимальное значение, останавливающее вычисления
    $max_value = 1000;// максимальное значение, останавливающее вычисления

    $start = -10;  // start arg
    $encouning = 100;  // кол-во вычисляемых значений
    $step = 2;// шаг изменения аргумента
    $type = 'D';// тип верстки
     
    $all = [];

    switch ($type) {//выбор из вариантов (вместо if else) (конструкция выбора)
        case 'A':
            break;
        case 'B':
            echo '<ul>';
            break;
        case 'C':
            echo '<ol>';
            break;
        case 'D':
            echo '<table class="table_block">';
            break;
        case 'E':
            echo '<div class="block">';
            break;
    }

//вызов функции
    algFixedIteration();     
    switch ($type) {//выбор из вариантов (конструкция выбора)
        case 'A':
            break;
        case 'B':
            echo '</ul>';
            break;
        case 'C':
            echo '</ol>';
            break;
        case 'D':
            echo '</table>';
            break;
        case 'E':
            echo '</div>';
            break;
    }
?>


<?php

// цикл с заданным количеством итераций
    function algFixedIteration() {
        global $min_value;
        global $max_value;
        global $start;
        global $encouning;
        global $step;
        global $type;
        global $all;

        $arr = [];
        $arr = $all;

        $x = $start;

        $f = 0;

        for ($i = 0; $i < $encouning; $i++, $x += $step) {
            $f = getValueFunc($x);

            if (($f >= $max_value || $f <= $min_value) && $f != 'error') {// если аргумент > или = max_value или
                //< или = min_value
                break;
            }

            if ($f != 'error') {
                array_push($arr, $f);
            }

            addTag($type, $x, $f, $i);
        }

        echo '<div class="box">';
        echo 'SUM: ' . array_sum($arr) . '<br>';
        echo 'MIN: ' . min($arr) . '<br>';
        echo 'MAX: ' . max($arr) . '<br>';
        echo 'AVG: ' . array_sum($arr) / count($arr) . '<br></div>';
    }

// цикл с предусловием
    function algPrecondition() {
        global $min_value;
        global $max_value;
        global $start;
        global $encouning;
        global $step;
        global $type;

        global $all;

        $arr = [];
        $arr = $all;

        $x = $start;

        $i = 0;
        $f = 0;
    
        while ($i < $encouning && ($f >= $max_value || $f < $min_value || !$i)) {
            $f = getValueFunc($x);

            if ($f != 'error') {
                array_push($arr, $f);
            }

            addTag($type, $x, $f, $i);

            $i ++;
            $x += $step;
        }

        echo '<div class="box">';
        echo 'SUM: ' . array_sum($arr) . '<br>';
        echo 'MIN: ' . min($arr) . '<br>';
        echo 'MAX: ' . max($arr) . '<br>';
        echo 'AVG: ' . array_sum($arr) / count($arr) . '<br></div>';
    }

// цикл с постусловием
    function algPostcondition() {
        global $min_value;
        global $max_value;
        global $start;
        global $encouning;
        global $step;
        global $type;

        global $all;

        $arr = [];
        $arr = $all;

        $x = $start;

        $i = 0;

        do {
            $f = getValueFunc($x);

            if ($f != 'error') {
                array_push($arr, $f);
            }

            addTag($type, $x, $f, $i);

            $i ++;
            $x += $step;
        }
        
        while ($i < $encouning && ($f >= $max_value || $f < $min_value || !$i));

        echo '<div class="box">';
        echo 'SUM: ' . array_sum($arr) . '<br>';
        echo 'MIN: ' . min($arr) . '<br>';
        echo 'MAX: ' . max($arr) . '<br>';
        echo 'AVG: ' . array_sum($arr) / count($arr) . '<br></div>';
    }

// модальная функция для вывода 
    function addTag($type, $x, $f, $i) {
        switch ($type) {
            case 'A':
                echo 'f(' . $x . ')=' . $f;
                echo '<br>';
                break;
            case 'B':
                echo '<li>f(' . $x . ')=' . $f . '</li>';
                break;
            case 'C':
                echo '<li>f(' . $x . ')=' . $f . '</li>';
                break;
            case 'D':
                $i += 1;
                echo '<tr><td>' . $i . '</td><td>f(' . $x . ')</td><td>' . $f . '</td></tr>';
                $i -= 1;
                break;
            case 'E':
                echo '<div class="block_item">f('. $x . ')=' . $f . '</div>';
                break;
        }
    }

// модальная функция для вычеслния f
    function getValueFunc($x){
        if ($x <= 10){
            if ($x == 0){
                $f = 'error';
            }
            else {
                $f = round((10 + $x)/$x, 3);
            }
        }
        else if($x > 10 && $x < 20){
            $f = round(($x / 7) * ($x - 2), 3);
        }
        else{
            $f = round(($x * 8) + 2, 3);
        }

        return $f;
    }
?>