<?php

if (!function_exists("pre")) {
    /**
     * Функция вывода массива
     * @param mixed $var Массив, который необходимо вывести
     * @param boolean $hide спрятать методом display:none
     */

    function pre($var, bool $hide = false)
    {
        $trace = debug_backtrace();
        $arPre = array('file' => $trace[0]['file'], 'line' => $trace[0]['line']);
        $pre = '<pre id="pre" style="' . (($hide) ? 'display:none;' : '/*display:none;*/') . '">' . print_r($var, true) . '</pre>';
        $pre .= '<pre id="pre_file" style="display:none;">' . print_r($arPre, true) . '</pre>';
        echo $pre;
    }
}
