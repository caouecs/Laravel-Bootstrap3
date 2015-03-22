<div class="form-group">
  <div class="col-md-offset-2 col-md-10">
    <div class="checkbox">
      <label>{{ $title }}
      {{ $text }}

    @if (!empty($help))
      <span class="help-block">{{ $help }}</span>
    @endif

    @if (!is_null($errors) && $errors->has($name))
      <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
      </label>
    </div>
  </div>
</div>
