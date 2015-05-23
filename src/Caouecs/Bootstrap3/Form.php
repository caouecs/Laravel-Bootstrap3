<?php
namespace Caouecs\Bootstrap3;

use Collective\Html\FormFacade as FacadeForm;
use Request;
use View;

class Form extends FacadeForm
{
    /**
     * Open form-horizontal.
     *
     * @param array $options
     *
     * @return string
     */
    public static function openHorizontal($options = [])
    {
        return self::open(Helpers::addClass($options, "form-horizontal"));
    }

    /**
     * Display input for form basic.
     *
     * @param string         $type       Type of input
     * @param string         $name       Name of input
     * @param string         $title      Title of input
     * @param mixed          $value      Value of input
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function inputBasic(
        $type,
        $name,
        $title = null,
        $value = null,
        $errors = null,
        $attributes = [],
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
     * Display select for form basic.
     *
     * @param string         $name       Name of select
     * @param string         $title      Title of select
     * @param array          $list       List of values
     * @param mixed          $value      Value of select
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function selectBasic(
        $name,
        $title,
        $list,
        $value = null,
        $errors = null,
        $attributes = [],
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
     * Display input for form-group.
     *
     * @param string         $type       Type of input
     * @param string         $name       Name of input
     * @param string         $title      Title of input
     * @param mixed          $value      Value of input
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     * @param boolean        $label      Display label
     * @param string         $iconpre    Display icon previous
     * @param string         $iconpost   Display icon post
     *
     * @return string
     */
    public static function inputGroup(
        $type,
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = [],
        $help = null,
        $label = true,
        $iconpre = null,
        $iconpost = null
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
     * Display input for form-group for multi-language.
     *
     * @param array          $languages  List of languages
     * @param string         $type       Type of input
     * @param string         $name       Name of input
     * @param string         $title      Title of input
     * @param mixed          $value      Value of input
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function inputMultiLanguageGroup(
        $languages,
        $type,
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = [],
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

        foreach ($languages as $val) {
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
     * Display textarea for form-group.
     *
     * @param string         $name       Name of textarea
     * @param string         $title      Title of textarea
     * @param mixed          $value      Value of textarea
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function textareaGroup(
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = [],
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
     * Display textarea for form-group.
     *
     * @param string         $name       Name of textarea
     * @param string         $title      Title of textarea
     * @param mixed          $value      Value of textarea
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function textareaLine(
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = [],
        $help = null
    ) {
        $attributes = Helpers::addClass($attributes, "form-control");
        $attributes['rows'] = 5;

        $text = self::textarea($name, Request::old($name) ? Request::old($name) : $value, $attributes);

        return self::view("form.textareaLine", [
            "errors" => $errors,
            "name"   => $name,
            "title"  => $title,
            "help"   => $help,
            "text"   => $text,
        ]);
    }

    /**
     * Display textarea for form-group for multi language.
     *
     * @param array          $languages  List of languages
     * @param string         $name       Name of textarea
     * @param string         $title      Title of textarea
     * @param mixed          $value      Value of textarea
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function textareaMultiLanguageGroup(
        $languages,
        $name,
        $title,
        $value = null,
        $errors = null,
        $attributes = [],
        $help = null
    ) {
        $attributes = Helpers::addClass($attributes, "form-control");
        $attributes['rows'] = 5;

        $text = null;

        foreach ($languages as $val) {
            $value_tmp = Request::old($name."[".$val['id']."]") ? Request::old($name."[".$val['id']."]") : null;

            if (empty($value_tmp)) {
                $value_tmp = isset($value[$val['id']][$name]) ? $value[$val['id']][$name] : null;
            }

            $text .= '<div>'.$val['title'].'</div>';

            $text .= self::textarea($name."[".$val['id']."]", $value_tmp, $attributes);

            if (!is_null($errors) && $errors->has($name."[".$val['id']."]")) {
                $text .= '<span class="text-danger">'.$errors->first($name."[".$val['id']."]").'</span>';
            }
        }

        return self::view("form.textareaMultiLanguageGroup", [
            "errors" => $errors,
            "name"   => $name,
            "title"  => $title,
            "help"   => $help,
            "text"   => $text,
        ]);
    }

    /**
     * Display select for form-group.
     *
     * @param string         $name       Name of select
     * @param string         $title      Title of select
     * @param array          $list       List of values
     * @param mixed          $value      Value of select
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function selectGroup(
        $name,
        $title,
        $list,
        $value = null,
        $errors = null,
        $attributes = [],
        $help = null
    ) {
        $attributes = Helpers::addClass($attributes, "form-control");

        return self::view("form.selectGroup", [
            "errors" => $errors,
            "name"   => $name,
            "title"  => $title,
            "help"   => $help,
            "text"   => self::select($name, $list, Request::old($name) ? Request::old($name) : $value, $attributes),
        ]);
    }

    /**
     * Display checkbox for form-group.
     *
     * @param string         $name       Name of checkbox
     * @param string         $title      Title of checkbox
     * @param mixed          $value      Value if checked
     * @param mixed          $input      Value by input
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function checkboxGroup(
        $name,
        $title,
        $value = 1,
        $input = 0,
        $errors = null,
        $attributes = [],
        $help = null
    ) {
        $input = Request::old($name) ? Request::old($name) : $input;

        return self::view("form.checkboxGroup", [
            "title"  => $title,
            "text"   => self::checkbox($name, $value, ($input == $value), $attributes),
            "help"   => $help,
            "errors" => $errors,
            "name"   => $name,
        ]);
    }

    /**
     * Display input radio for form-group.
     *
     * @param string         $name       Name of radio
     * @param string         $title      Title of radio
     * @param array          $choices    Choices
     * @param mixed          $value      Value if checked
     * @param ExceptionError $errors
     * @param array          $attributes
     * @param string         $help       Help message
     *
     * @return string
     */
    public static function radioGroup(
        $name,
        $title,
        $choices,
        $value = 1,
        $errors = null,
        $attributes = [],
        $help = null
    ) {
        if (!is_array($choices)) {
            return;
        }

        $text = null;

        foreach ($choices as $key => $_value) {
            $text .= self::radio($name, $key, ($key == $value), $attributes).' '.$_value.' ';
        }

        return self::view("form.radioGroup", [
            "title"  => $title,
            "text"   => $text,
            "help"   => $help,
            "errors" => $errors,
            "name"  => $name,
        ]);
    }

    /**
     * Display submit with cancel for form-group.
     *
     * @param array $options
     * @param array $attributes
     *
     * @return string
     */
    public static function submitGroup($options = [], $attributes = [])
    {
        $attributes = Helpers::addClass($attributes, "btn btn-primary");

        $options['submit_title'] = array_get($options, "submit_title", trans('form.submit'));

        $text = self::submit($options['submit_title'], $attributes);

        /*
         * Url for cancel
         */
        if (isset($options['cancel_url'])) {
            $text .= ' '.link_to($options['cancel_url'], trans('form.cancel'));
        }

        /*
         * Reset
         */
        if (isset($options['reset']) && $options['reset'] === true) {
            $text .= ' '.self::reset("Reset", ["class" => "btn btn-default"]);
        }

        return self::view("form.submitGroup", [
            "text" => $text,
        ]);
    }

    /**
     * Display text with title for form-group.
     *
     * @param string $title
     * @param string $text
     *
     * @return string
     */
    public static function textGroup($title, $text)
    {
        return self::view("form.textGroup", [
            "title" => $title,
            "text"  => $text,
        ]);
    }

    /**
     * Personalized views.
     *
     * @param string $viewName Name of the base view
     * @param array  $params   Params
     */
    public static function view($viewName, $params = [])
    {
        return View::make("bootstrap3::".$viewName, $params);
    }
}
