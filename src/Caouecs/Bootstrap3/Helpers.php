<?php namespace Caouecs\Bootstrap3;

class Helpers {
    /**
     * Colors
     *
     * @access public
     * @var array
     *
     * @todo Know why light and dark are just for label and badge
     */
    public static $colors = array("primary", "secondary", "normal", "info", "danger", "warning", "success", "light", "dark");

    /**
     * Add value in an array
     *
     * @access public
     * @param array $array Array object
     * @param string $value Value to add
     * @param string $key Array key to use
     * @return array
     */
    public static function addClass($array, $value, $key = 'class')
    {
        $array[$key] = isset($array[$key]) ? $array[$key].' '.$value : $value;

        return $array;
    }
}