<?php

/**
 * @author Michael Reynald <michaelreynald78@gmail.com>
 * This helper function are globally defined when framework is running
 * Please don't try to change any line at this file and another file at bootstrap directory
 */

/**
 * @param $obj
 * Show the object result
 */
function dd($obj) {
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}

/**
 * @param string $to
 * @return string
 */
function url($to = '')
{
    return BASE_URL . '/' . $to;
}

/**
 * @param string $path
 * @return string
 */
function asset($path = '')
{
    return BASE_URL . '/resources/assets/' . $path;
}