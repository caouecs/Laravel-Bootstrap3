# Laravel4-Bootstrap3

This package includes UI modules of [Bootstrap 3](http://www.getbootstrap.com) for a [Laravel](http://www.laravel.com) project.


## Installation

This package is available through Packagist and Composer.

Add `"caouecs/bootstrap3": "dev-master"` to your composer.json or run `composer require caouecs/bootstrap3`. Then you can add theses aliases in your `app/config/app.php`:

    'Alert'           => 'Caouecs\Bootstrap3\Alert',
    'Breadcrumb'      => 'Caouecs\Bootstrap3\Breadcrumb',
    'Form'            => 'Caouecs\Bootstrap3\Form'

Since the version 1.2, you must add the service provider :

    'Caouecs\\Bootstrap3\\Bootstrap3ServiceProvider'

So, I recommend you use [Package Installer](https://github.com/rtablada/package-installer), Laravel4-Bootstrap3 has a valid provides.json file. After installation of Package Installer, just run `php artisan package:install caouecs/bootstrap3` ; the lists of aliases will be up-to-date.

### Specific installation

If you want the stable version with PSR-2 for Form, choose `"caouecs/bootstrap3": "~1.0"` version. But if you want old version, choose `"caouecs/bootstrap3": "~0.1"`.

## Requirements

Laravel4-Bootstrap3 was tested with Bootstrap 3 and 3.1.

    We look for persons to validate in Bootstrap 3.3.

## Changelog

### Version 1.2

* Display by View

---

## Alerts

You can display alerts with Alert class, you can choose design from Bootstrap or from your personal css.

Displays a alert box with class "alert-success".

    Alert::success("Youpi !")
    <div class="alert alert-success">Youpi !</div>

Displays a alert box with close button

    Alert::success("Youpi !")->close()
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Youpi !
    </div>

## Breadcrumbs

You can display a simple breadcrumb.

    Breadcrumb::create()->add("Home", "/")->add("News", "/news")->add("My News")
    <ul class="breadcrumb"><li><a href="/">Home</a></li><li><a href="/news">News</a></li><li>My News</li></ul>

## Dropdowns

You can display dropdowns with Dropdown class.

Display a simple dropdown with two links.

    Dropdown::create()->addLink("Link 1", "/edit")->addLink("Link 2", "/delete")
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Action
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/edit">Link 1</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/delete">Link 2</a></li>
        </ul>
    </div>

Display a dropdown with four links, a divider and two headers.

    Dropdown::create("Admin")
        ->addHeader("Header 1")
        ->addLink("Link 1", "/edit")
        ->addLink("Link 2", "/delete")
        ->addDivider()
        ->addHeader("Header 2")
        ->addDisabled("Disabled link")
        ->addLink("Link 4", "/delete")
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Admin
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation" class="dropdown-header">Header 1</li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/edit">Link 1</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/delete">Link 2</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation" class="dropdown-header">Header 2</li>
            <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled Link</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="/delete">Link 4</a></li>
        </ul>
    </div>

## Form

### Form horizontal

You can display a horizontal form with :

    Form::openHorizontal()

### Input for basic exemple

    Form::inputBasic($type_input, $name_input, $title, $value, $errors_from_Laravel, $attributes, $help)

    Form::selectBasic($name_input, $title, $list, $value, $errors_from_Laravel, $attributes, $help)

### Input for form horizontal

Input with type text, url, email...

    Form::inputGroup($type_input, $name_input, $title, $value, $errors_from_Laravel, $attributes, $help)

Input with translation

    Form::inputMultiLanguageGroup($languages, $type_input, $name_input, $title, $value, $errors_from_Laravel, $attributes, $help)

Select

    Form::selectGroup($name_input, $title, $list, $value, $errors_from_Laravel, $attributes, $help)

Textarea

    Form::textareaGroup($name_textarea, $title, $value, $errors_from_Laravel, $attributes, $help)

Textarea with translation

    Form::textareaMultiLanguageGroup($languages, $name_textarea, $title, $value, $errors_from_Laravel, $attributes, $help)

Checkbox

    Form:::checkboxGroup($name_checkbox, $title, $value, $input, $errors_from_Laravel, $attributes, $help)

Input radio

    Form::radioGroup($name_radio, $title, $choices, $value, $errors_from_Laravel, $attributes, $help)

Submit

    Form::submitGroup($options, $attributes)

---

MIT Open Source License

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
