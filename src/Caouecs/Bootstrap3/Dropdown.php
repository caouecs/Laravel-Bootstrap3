<?php

namespace Caouecs\Bootstrap3;

use HTML;

class Dropdown extends Core
{
    /**
     * Title of dropdown.
     *
     * @var string
     */
    protected $title = null;

    /**
     * Elements of dropdown.
     *
     * @var array
     */
    protected $elements = [];

    /**
     * Attributes of dropdown.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Construct.
     *
     * @param string $title      Title of dropdown
     * @param array  $attributes Attributes of dropdown
     */
    public function __construct($title = 'Action', $attributes = [])
    {
        $this->title = $title;

        if (!empty($attributes) && is_array($attributes)) {
            $this->attributes = $attributes;
        }
    }

    /**
     * Create a new Dropdown.
     *
     * @param string $title      Title of dropdown
     * @param array  $attributes Attributes of dropdown
     *
     * @return Dropdown
     */
    public static function create($title = 'Action', $attributes = [])
    {
        return new self($title, $attributes);
    }

    /**
     * Add link.
     *
     * @param string $title Title of element
     * @param string $link  Link of element
     *
     * @return Dropdown
     */
    public function addLink($title, $link = null)
    {
        $this->elements[] = [
            'type'  => 'link',
            'title' => e($title),
            'link'  => (string) $link,
        ];

        return $this;
    }

    /**
     * Add header.
     *
     * @param string $title Title of element
     *
     * @return Dropdown
     */
    public function addHeader($title)
    {
        $this->elements[] = [
            'type'  => 'header',
            'title' => e($title),
        ];

        return $this;
    }

    /**
     * Add divider.
     *
     * @return Dropdown
     */
    public function addDivider()
    {
        $this->elements[] = [
            'type' => 'divider',
        ];

        return $this;
    }

    /**
     * Add disabled.
     *
     * @param string $title Title of element
     *
     * @return Dropdown
     */
    public function addDisabled($title)
    {
        $this->elements[] = [
            'type'  => 'disabled',
            'title' => e($title),
        ];

        return $this;
    }

    /**
     * Display dropdown.
     *
     * @return string
     */
    public function show()
    {
        if (empty($this->elements)) {
            return;
        }

        $attributes = Helpers::addClass($this->attributes, "dropdown");

        $res = '<div'.HTML::attributes($attributes).'>
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
            data-toggle="dropdown" aria-expanded="true">
            '.$this->title.'
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';
        foreach ($this->elements as $element) {
            if ($element['type'] === 'link') {
                $res .= '<li role="presentation"><a role="menuitem" tabindex="-1" href="'.$element['link'].'">'
                    .$element['title'].'</a></li>';
            } elseif ($element['type'] === 'disabled') {
                $res .= '<li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">'
                    .$element['title'].'</a></li>';
            } elseif ($element['type'] === 'header') {
                $res .= '<li role="presentation" class="dropdown-header">'.$element['title'].'</li>';
            } elseif ($element['type'] === 'divider') {
                $res .= '<li role="presentation" class="divider"></li>';
            }
        }
        $res .= '</ul></div>';

        return $res;
    }
}
