<?php
include_once "include/helper_functions.php";
/*
Дан массив, состоящий из следующих строк
"1 квартал 2014 г.",
"1 квартал 2020 г.",
"3 квартал 2017 г.",
"4 квартал 2020 г."
необходимо отсортировать данный массив
в порядке возрастания по дате.
*/

$arDate = [
    "1 квартал 2014 г.",
    "1 квартал 2020 г.",
    "3 квартал 2017 г.",
    "4 квартал 2020 г.",
    "1 квартал 2019 г.",
    "2 квартал 2019 г.",
    "3 квартал 2016 г.",
    "4 квартал 2018 г."
];

echo "Исходный массив:";
pre($arDate);

function stringSortByNumber($a, $b) {
    $quarterA = substr($a, 0,  1);
    $quarterB = substr($b, 0,  1);
    $yearA    = substr($a, 17, 4);
    $yearB    = substr($b, 17, 4);

    if ($yearA == $yearB && $quarterA == $quarterB) {
        return 0;
    }

    if ($yearA <= $yearB) {
        if ($quarterA < $quarterB) {
            return -1;
        }
    } else {
        return 1;
    }
}

usort($arDate, "stringSortByNumber");

echo "Отсортированный массив:";
pre($arDate);
