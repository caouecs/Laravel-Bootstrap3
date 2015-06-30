@if (!is_null($errors) && $errors->has($name))
  <div class="form-group has-error">
@else
  <div class="form-group">
@endif
  <label  class="col-md-2 control-label" for="{!! $name !!}">{!! $title !!}</label>
  <div class="col-md-10">
    {!! $text !!}

  @if (!empty($help))
    <span class="help-block">{!! $help !!}</span>
  @endif

  @if (!is_null($errors) && $errors->has($name))
    <span class="text-danger">{!! $errors->first($name) !!}</span>
  @endif
  </div>
</div>
