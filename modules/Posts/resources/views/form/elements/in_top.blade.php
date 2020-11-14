<div class="form-group row">
    <label class="col-md-3 col-form-label" for="in_top">{{ trans('posts::form.in_top') }}</label>
    <div class="col-md-9 col-form-label">
        <div class="form-check form-check-inline mr-1">
            <input name="in_top" type="checkbox" class="form-check-input" id="in_top" value="1" {{ old('in_top', $post->in_top) ? 'checked' : "" }}>
        </div>
    </div>
</div>