<?php
include_once "include/helper_functions.php";
/*
Написать функцию логирования.
Функция должна принимать какую либо переменную и записывать её содержимое с новой строки файла.
При этом, каждая запись (строка) должна начинаться с префикса, представляющего собой дату,
время и разделитель. Формат префикса “дд.мм.гггг“.
*/

if (!function_exists("printLogs")) {
    /**
     * Функция логирования
     * по умолчанию печатает в $defaultFileDir
     *
     * @param mixed $arFields - Массив или строка, которую необходимо записать в лог
     * @param string $namePrintFileLog Можно указать путь и имя файла. По умолчанию /logs/printLogs.log
     */

    function printLogs($arFields, string $namePrintFileLog = "printLogs.log")
    {
        $defaultFileDir = '/TestTask-SouthMedia/logs/';
        $arDirFile = explode('/', $namePrintFileLog);

        if (count($arDirFile) > 1) {
            $fileName = array_pop($arDirFile);
            $dirFile = implode('/', $arDirFile);

        } else {
            $dirFile = $defaultFileDir;
            $fileName = $namePrintFileLog;
        }

        $arFileName = explode('.', $fileName);
        if (empty($arFileName[1])) {
            $fileName .= '.txt';
        }

        $trace = debug_backtrace();
        $date = date("d.m.Y | H:i:s");
        $file = str_replace($_SERVER["DOCUMENT_ROOT"], '', $trace[0]['file']);
        $arInfo = array('file' => $file, 'line' => $trace[0]['line'],);

        mkdir($_SERVER["DOCUMENT_ROOT"] . $dirFile, 0775, true);
        file_put_contents(
            $_SERVER["DOCUMENT_ROOT"] . '/' . $dirFile . '/' . $fileName,
            print_r(array($date => $arFields, "INFO" => $arInfo), true),
            FILE_APPEND
        );
    }
}

$arDate = [
    "1 quarter 2014 year.",
    "1 quarter 2020 year.",
    "3 quarter 2017 year.",
    "4 quarter 2020 year."
];

printLogs($arDate, "new.log");

pre(file_get_contents("logs/new.log"));