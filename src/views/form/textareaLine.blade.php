@if (!is_null($errors) && $errors->has($name))
  <div class="form-group has-error" style="margin-bottom:20px">
@else
  <div class="form-group" style="margin-bottom:20px">
@endif
  <label for="{{ $name }}">{{ $title }}</label>

  {{ $text }}

@if (!is_null($errors) && $errors->has($name))
  <span class="text-danger">{{ $errors->first($name) }}</span>
@endif

@if (!empty($help))
  <span class="help-block">{{ $help }}</span>
@endif
</div>
