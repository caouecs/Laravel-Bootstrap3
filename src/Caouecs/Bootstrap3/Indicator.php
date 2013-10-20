<?php namespace Caouecs\Bootstrap3;

use \HTML;

class Indicator extends Core {

    /**
     * Class of indicator
     *
     * @access private
     * @var string
     */
    protected $class = 'default';

    /**
     * Message in indicator
     *
     * @access private
     * @var string
     */
    protected $message = null;

    /**
     * Attributes of indicator
     *
     * @access private
     * @var array
     */
    protected $attributes = array();

    /**
     * Construct
     *
     * @access public
     * @param string $class Class of indicator
     * @param string $message Message in indicator
     * @param array $attributes Attributes of indicator
     * @return void
     */
    public function __construct($class, $message, $attributes = array())
    {
        if (ctype_alpha(str_replace(array("-", "_", " "), "", $class))) {
            $this->class = $class;
        }
        
        $this->message = $message;

        if (!empty($attributes) && is_array($attributes)) {
            $this->attributes = $attributes;
        }
    }

    /**
     * Call an indicator by color
     *
     * @access public
     * @param string $method Method called
     * @param array $params Params of method
     * @return Indicator
     */
    public static function __callStatic($method, $params)
    {
        // verif if color exists
        if (in_array($method, Helpers::$colors)) {
            $method = "alert-".$method;
        } else {
            $method = "alert-info";
        }

        array_unshift($params, $method);

        return call_user_func_array('static::create', $params);
    }

    /**
     * Create a custom indicator
     *
     * @access public
     * @param string $class Class custom of indicator
     * @param string $message Message in indicator
     * @param array $attributes Attributes of indicator
     * @return Indicator
     */
    public static function custom($class, $message, $attributes = array())
    {
        return static::create($class, $message, $attributes);
    }

    /**
     * Update tag
     *
     * @access public
     * @param string $tag Tag
     * @return Indicator
     */
    public function tag($tag)
    {
        if (ctype_alpha($tag)) {
            $this->tag = $tag;
        }

        return $this;
    }

    /**
     * Return html
     *
     * @access public
     * @return string
     */
    public function show()
    {
        $attributes = Helpers::addClass($this->attributes, $this->class.' '.$this->type);

        return '<'.$this->tag.HTML::attributes($attributes).'>'.$this->message.'</'.$this->tag.'>';
    }
}