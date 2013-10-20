<?php namespace Caouecs\Bootstrap3;

use \HTML;

class Alert extends Indicator {

    /**
     * Type of indicator
     *
     * @access protected
     * @var string
     */
    protected $type = "alert";

    /**
     * Tag
     *
     * @access protected
     * @var string
     */
    protected $tag = "div";

    /**
     * Close
     *
     * @access protected
     * @var boolean
     */
    protected $close = false;

    /**
     * Create a new Alert
     *
     * @access protected
     * @param string $class Class of indicator
     * @param string $message Message in indicator
     * @param array $attributes Attributes of indicator
     * @return Alert
     */
    protected static function create($class, $message, $attributes = array())
    {
        return new Alert($class, $message, $attributes);
    }

    /**
     * Add link for close
     *
     * @access public
     * @return Alert
     */
    public function close()
    {
        $this->close = true;

        return $this;
    }

    /**
     * Display Alert
     *
     * @access public
     * @return string
     */
    public function show()
    {
        // class
        $_class = $this->class.' '.$this->type;

        // close
        if ($this->close === true) {
            $_class .= ' alert-dismissable';
        }

        $attributes = Helpers::addClass($this->attributes, $_class);

        $res = '<'.$this->tag.HTML::attributes($attributes).'>';

        // close
        if ($this->close === true) {
            $res .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        }

        $res .= $this->message.'</'.$this->tag.'>';

        return $res;
    }
}