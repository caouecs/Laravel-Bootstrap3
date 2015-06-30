<?php

namespace Caouecs\Bootstrap3;

class Helpers
{
    /**
     * Colors.
     *
     * @var array
     */
    public static $colors = [
        'primary', 'secondary', 'normal', 'info', 'danger', 'warning', 'success', 'light', 'dark',
    ];

    /**
     * Add value in an array.
     *
     * @param array  $array Array object
     * @param string $value Value to add
     * @param string $key   Array key to use
     *
     * @return array
     */
    public static function addClass($array, $value, $key = 'class')
    {
        $array[$key] = isset($array[$key]) ? $array[$key].' '.$value : $value;

        return $array;
    }
}
