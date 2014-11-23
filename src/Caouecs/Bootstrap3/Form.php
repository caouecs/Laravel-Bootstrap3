<?php
namespace Caouecs\Bootstrap3;

use Request;
use Illuminate\Support\Facades\Form as FacadeForm;

class Form extends FacadeForm
{
    /**
     * Open form-horizontal
     *
     * @access public
     * @param array $options
     * @return string
     */
    public static function openHorizontal($options = array())
    {
        return self::open(Helpers::addClass($options, "form-horizontal"));
    }

    /**
     * Display input for form basic
     *
     * @access public
     * @param string $type Type of input
     * @param string $name Name of input
     * @param string $title Title of input
     * @param mixed $value Value of input
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function inputBasic(
        $type,
        $name,
        $title = null,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div class="form-group';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= ' has-error';
        }

        $txt .= '">';

        $txt .= '<label for="'.$name.'">'.$title.'</label>';

        $attributes = Helpers::addClass($attributes, "form-control");

        $txt .= self::input($type, $name, Request::old($name) ? Request::old($name) : $value, $attributes);

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '</div>';

        return $txt;
    }

    /**
     * Display select for form basic
     *
     * @access public
     * @param string $name Name of select
     * @param string $title Title of select
     * @param array $list List of values
     * @param mixed $value Value of select
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function selectBasic(
        $name,
        $title,
        $list,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div class="form-group';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= ' has-error';
        }

        $txt .= '">
            <label for="'.$name.'">'.$title.'</label>';

        $attributes = Helpers::addClass($attributes, "form-control");

        $txt .= self::select($name, $list, Request::old($name) ? Request::old($name) : $value, $attributes);

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '</div>';

        return $txt;
    }

    /**
     * Display input for form-group
     *
     * @access public
     * @param string $type Type of input
     * @param string $name Name of input
     * @param string $title Title of input
     * @param mixed $value Value of input
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @param boolean $label Display label
     * @param boolean $iconpre Display icon previous
     * @param boolean $iconpost Display icon post
     * @return string
     */
    public static function inputGroup(
        $type,
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null,
        $label = true,
        $iconpre = false,
        $iconpost = false
    ) {
        $txt = '<div class="form-group';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= ' has-error';
        }

        $txt .= '">';

        if ($label) {
            $txt .= '<label for="'.$name.'" class="col-md-2 control-label">'.$title.'</label>';
            $txt .= '<div class="col-md-10">';
        } else {
            $txt .= '<div class="col-md-12">';
        }

        if ($iconpost || $iconpre) {
            $txt .= '<div class="input-group">';
        }

        if ($iconpre) {
            $txt .= '<span class="input-group-addon"><span class="'.$iconpre.'"></span></span>';
        }

        $attributes = Helpers::addClass($attributes, "form-control");

        $txt .= self::input($type, $name, Request::old($name) ? Request::old($name) : $value, $attributes);

        if ($iconpost) {
            $txt .= '<span class="input-group-addon"><span class="'.$iconpost.'"></span></span>';
        }

        if ($iconpost || $iconpre) {
            $txt .= '</div>';
        }

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '</div></div>';

        return $txt;
    }

    /**
     * Display input for form-group for multi-language
     *
     * @access public
     * @param array $languages List of languages
     * @param string $type Type of input
     * @param string $name Name of input
     * @param string $title Title of input
     * @param mixed $value Value of input
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function inputMultiLanguageGroup(
        $languages,
        $type,
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div class="form-group';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= ' has-error';
        }

        $txt .= '">';
        $txt .= '<label for="'.$name.'" class="col-md-2 control-label">'.$title.'</label>';
        $txt .= '<div class="col-md-10">';

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        $attributes = Helpers::addClass($attributes, "form-control");

        foreach ($languages as $key => $val) {
            $value_tmp = Request::old($name."[".$val['id']."]") ? Request::old($name."[".$val['id']."]") : null;

            if (empty($value_tmp)) {
                $value_tmp = isset($value[$val['id']][$name]) ? $value[$val['id']][$name] : null;
            }

            $txt .= '<div class="pull-left">'.$val['title'].'</div>';

            $txt .= self::input($type, $name."[".$val['id']."]", $value_tmp, $attributes);

            if (!is_null($errors) && $errors->has($name."[".$val['id']."]")) {
                $txt .= '<span class="text-danger">'.$errors->first($name."[".$val['id']."]").'</span>';
            }
        }

        $txt .= '</div></div>';

        return $txt;
    }

    /**
     * Display textarea for form-group
     *
     * @access public
     * @param string $name Name of textarea
     * @param string $title Title of textarea
     * @param mixed $value Value of textarea
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function textareaGroup(
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div class="form-group';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= ' has-error';
        }

        $txt .= '">';

        $txt .= '<label for="'.$name.'" class="col-md-2 control-label">'.$title.'</label>';

        $txt .= '<div class="col-md-10">';

        $attributes = Helpers::addClass($attributes, "form-control");
        $attributes['rows'] = 5;

        $txt .= self::textarea($name, Request::old($name) ? Request::old($name) : $value, $attributes);

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '</div></div>';

        return $txt;
    }

    /**
     * Display textarea for form-group
     *
     * @access public
     * @param string $name Name of textarea
     * @param string $title Title of textarea
     * @param mixed $value Value of textarea
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function textareaLine(
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div style="margin-bottom:20px" ';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= 'class="has-error"';
        }

        $txt .= '>';

        $txt .= '<label for="'.$name.'">'.$title.'</label>';

        $attributes = Helpers::addClass($attributes, "form-control");
        $attributes['rows'] = 5;

        $txt .= self::textarea($name, Request::old($name) ? Request::old($name) : $value, $attributes);

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '</div>';

        return $txt;
    }

    /**
     * Display textarea for form-group for multi language
     *
     * @access public
     * @param array $languages List of languages
     * @param string $name Name of textarea
     * @param string $title Title of textarea
     * @param mixed $value Value of textarea
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function textareaMultiLanguageGroup(
        $languages,
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div class="form-group';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= ' has-error';
        }

        $txt .= '">';

        $txt .= '<label for="'.$name.'" class="col-md-2 control-label">'.$title.'</label>';

        $txt .= '<div class="col-md-10">';

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        $attributes = Helpers::addClass($attributes, "form-control");
        $attributes['rows'] = 5;

        foreach ($languages as $key => $val) {
            $value_tmp = Request::old($name."[".$val['id']."]") ? Request::old($name."[".$val['id']."]") : null;

            if (empty($value_tmp)) {
                $value_tmp = isset($value[$val['id']][$name]) ? $value[$val['id']][$name] : null;
            }

            $txt .= '<div>'.$val['title'].'</div>';

            $txt .= self::textarea($name."[".$val['id']."]", $value_tmp, $attributes);

            if (!is_null($errors) && $errors->has($name."[".$val['id']."]")) {
                $txt .= '<span class="text-danger">'.$errors->first($name."[".$val['id']."]").'</span>';
            }
        }

        $txt .= '</div></div>';

        return $txt;
    }

    /**
     * Display select for form-group
     *
     * @access public
     * @param string $name Name of select
     * @param string $title Title of select
     * @param array $list List of values
     * @param mixed $value Value of select
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function selectGroup(
        $name,
        $title,
        $list,
        $value = null,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div class="form-group';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= ' has-error';
        }

        $txt .= '">
            <label  class="col-md-2 control-label" for="'.$name.'">'.$title.'</label>
            <div class="col-md-10">';

        $attributes = Helpers::addClass($attributes, "form-control");

        $txt .= self::select($name, $list, Request::old($name) ? Request::old($name) : $value, $attributes);

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '</div></div>';

        return $txt;
    }

    /**
     * Display checkbox for form-group
     *
     * @access public
     * @param string $name Name of checkbox
     * @param string $title Title of checkbox
     * @param mixed $value Value if checked
     * @param mixed $input Value by input
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function checkboxGroup(
        $name,
        $title,
        $value = 1,
        $input = 0,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        $txt = '<div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                      <div class="checkbox">
                        <label>';

        $input = Request::old($name) ? Request::old($name) : $input;

        if ($input == $value) {
            $checked = true;
        } else {
            $checked = false;
        }

        $txt .= self::checkbox($name, $value, $checked, $attributes);

        $txt .= ' '.$title.'</label>';

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '     </div>
                    </div>
                  </div>';

        return $txt;
    }

    /**
     * Display input radio for form-group
     *
     * @access public
     * @param string $name Name of radio
     * @param string $title Title of radio
     * @param array $choices Choices
     * @param mixed $value Value if checked
     * @param ExceptionError $errors
     * @param array $attributes
     * @param string $help Help message
     * @return string
     */
    public static function radioGroup(
        $name,
        $title,
        $choices,
        $value = 1,
        $errors = null,
        $attributes = array(),
        $help = null
    ) {
        if (!is_array($choices) || empty($choices)) {
            return null;
        }

        $txt = '<div class="form-group">
            <label  class="col-md-2 control-label">'.$title.'</label>
            <div class="col-md-10">';

        foreach ($choices as $key => $_value) {
            $txt .= self::radio($name, $key, ($key == $value), $attributes).' '.$_value.' ';
        }

        if (!empty($help)) {
            $txt .= '<span class="help-block">'.$help.'</span>';
        }

        if (!is_null($errors) && $errors->has($name)) {
            $txt .= '<span class="text-danger">'.$errors->first($name).'</span>';
        }

        $txt .= '</div></div>';

        return $txt;
    }

    /**
     * Display submit with cancel for form-group
     *
     * @access public
     * @param array $options
     * @param array $attributes
     * @return string
     */
    public static function submitGroup($options = array(), $attributes = array())
    {
        $txt = '<div class="form-group">
            <div class="col-md-offset-2 col-md-10">';

        $attributes = Helpers::addClass($attributes, "btn btn-primary");

        $options['submit_title'] = isset($options['submit_title']) ? $options['submit_title'] : trans('form.submit');

        $txt .= self::submit($options['submit_title'], $attributes);

        /**
         * Url for cancel
         */
        if (isset($options['cancel_url'])) {
            $txt .= ' <a href="'.$options['cancel_url'].'">'.trans('form.cancel').'</a>';
        }

        /**
         * Reset
         */
        if (isset($options['reset']) && $options['reset'] === true) {
            $txt .= ' '.self::reset("Reset", array("class" => "btn btn-default"));
        }

        $txt .= '</div>
        </div>';

        return $txt;
    }

    /**
     * Display text with title for form-group
     *
     * @access public
     * @param string $title
     * @param string $text
     * @return string
     */
    public static function textGroup($title, $text)
    {
        return '<div class="form-group">
            <label  class="col-md-2 control-label">'.$title.'</label>
            <div class="col-md-10">'.$text.'</div>
          </div>';
    }
}
