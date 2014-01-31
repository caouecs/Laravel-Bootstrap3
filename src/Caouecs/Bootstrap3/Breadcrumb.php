<?php namespace Caouecs\Bootstrap3;

use \HTML;

class Breadcrumb extends Core {

    /**
     * Elements of breadcrumb
     *
     * @access protected
     * @var array
     */
    protected $elements = array();
 
    /**
     * Attributes of breadcrumb
     *
     * @access protected
     * @var array
     */
    protected $attributes = array();

    /**
     * Construct
     * 
     * @access public
     * @param array $attributes Attributes of breadcrumb
     * @return void
     */
    public function __construct($attributes = array())
    {
        if (!empty($attributes) && is_array($attributes)) {
            $this->attributes = $attributes;
        }
    }

    /**
     * Create a new Breadcrumb
     *
     * @access public
     * @param array $attributes Attributes of breadcrumb
     * @return Breadcrumb
     */
    public static function create($attributes = array())
    {
        return new Breadcrumb($attributes);
    }

    /**
     * Add element
     *
     * @access public
     * @param string $title Title of element
     * @param string $link Link of element
     * @param array $attributes Attributes of element
     * @return Breadcrumb
     */
    public function add($title, $link = null, $attributes = array())
    {
        $this->elements[] = array(
            "title" => e($title),
            "link" => (string) $link,
            "attributes" => $attributes
        );

        return $this;
    }

    /**
     * Display breadcrumb
     *
     * @access public
     * @return string
     */
    public function show()
    {
        if (empty($this->elements)) {
            return null;
        }

        $attributes = Helpers::addClass($this->attributes, "breadcrumb");

        $res = '<ol'.HTML::attributes($attributes).' itemprop="breadcrumb">';

        foreach ($this->elements as $element) {

            $res .= '<li'.HTML::attributes($element['attributes']).'>';

            // link
            if (isset($element['link']) and $element['link'] != null) {
                $res .= '<a href="'.$element['link'].'">'.$element['title'].'</a>';
            } else {
                $res .= $element['title'];
            }

            $res .= '</li>';
        }
        $res .= '</ol>';

        return $res;
    }
}