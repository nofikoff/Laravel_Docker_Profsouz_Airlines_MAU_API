<div class="form-group row">
    <label class="col-md-3 col-form-label">{{ trans('posts::form.importance') }}</label>
    <div class="col-md-9 col-form-label">
        <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" type="radio" id="importance-true" value="0" name="importance" {{ old('importance', $post->importance) == 0 ? 'checked' : ''  }}>
            <label class="form-check-label" for="importance-true">{{ trans('posts::form.importance_default') }}</label>
        </div>
        <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" type="radio" id="importance-false" value="1" name="importance" {{ old('importance', $post->importance) == 1 ? 'checked' : ''  }}>
            <label class="form-check-label" for="importance-false">{{ trans('posts::form.importance_high') }}</label>
        </div>
    </div>
</div>