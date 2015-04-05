<?php
namespace Caouecs\Bootstrap3;

use HTML;

class Breadcrumb extends Core
{
    /**
     * Elements of breadcrumb.
     *
     * @var array
     */
    protected $elements = [];

    /**
     * Attributes of breadcrumb.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Construct.
     *
     * @param array $attributes Attributes of breadcrumb
     */
    public function __construct($attributes = [])
    {
        if (!empty($attributes) && is_array($attributes)) {
            $this->attributes = $attributes;
        }
    }

    /**
     * Create a new Breadcrumb.
     *
     * @param array $attributes Attributes of breadcrumb
     *
     * @return Breadcrumb
     */
    public static function create($attributes = [])
    {
        return new Breadcrumb($attributes);
    }

    /**
     * Add element.
     *
     * @param string $title      Title of element
     * @param string $link       Link of element
     * @param array  $attributes Attributes of element
     *
     * @return Breadcrumb
     */
    public function add($title, $link = null, $attributes = [])
    {
        $this->elements[] = [
            "title" => e($title),
            "link" => (string) $link,
            "attributes" => $attributes,
        ];

        return $this;
    }

    /**
     * Display breadcrumb.
     *
     * @return string
     */
    public function show()
    {
        if (empty($this->elements)) {
            return;
        }

        $attributes = Helpers::addClass($this->attributes, "breadcrumb");

        $res = '<ol'.HTML::attributes($attributes).' itemprop="breadcrumb">';

        foreach ($this->elements as $element) {
            $res .= '<li'.HTML::attributes($element['attributes']).'>';

            // link
            if (isset($element['link']) && !empty($element['link'])) {
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
