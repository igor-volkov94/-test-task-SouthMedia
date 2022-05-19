<?php
/*
Необходимо вычислить значение X, которое является строкой, состоящей из всех заглавных,
четных букв английского алфавита, за исключением буквы “X”.
Существует некий публичный Rest API-сервис,
доступный по адресу http://back-tr.dev.southmedia.ru/api/
Данный сервис ожидает POST-запрос c параметром “key”, равным md5-сумме,
ранее вычисленного значения X. Если API-сервис,
получит верное значение X, то в ответ вернет массив с информацией,
значение параметра “data” которого необходимо отобразить в браузере в “человеко-читабельном” виде.
*/

$alphabet = [
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
    'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
];

$resultException = "";

foreach ($alphabet as $key => $word) {
    if (!($key % 2) == 0 AND $word != "X") {
        $resultException .= $word;
    }
}

function query($string): string
{
    $query = array("key" => md5($string));

    $ch = curl_init('http://back-tr.dev.southmedia.ru/api/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);

    return base64_decode($response["data"]);
}

echo "Чётные буквы кроме Х: {$resultException} <br><br>";

echo "Результат: <b>" . query($resultException) . "</b>";
