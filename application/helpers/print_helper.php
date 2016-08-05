<?php


if ( ! function_exists('pre_print'))
{

    function pre_print($array)
    {
        echo "<pre>";print_r($array);echo "</pre>";
    }
}
