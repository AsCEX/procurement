<?php


if ( ! function_exists('get_quarter_starting_month'))
{

    function get_quarter_starting_month($quarter  = 1)
    {

        $q = (($quarter-1) * 3) + 1;

        return $q;
    }
}
