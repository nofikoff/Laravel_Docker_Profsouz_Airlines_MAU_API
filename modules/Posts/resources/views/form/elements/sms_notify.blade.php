<div class="form-group row">
    <label class="col-md-3 col-form-label" for="sms_notify">{{ trans('posts::form.sms_notify') }}</label>
    <div class="col-md-9 col-form-label">
        <div class="form-check form-check-inline mr-1">
            <input name="sms_notify" type="checkbox" class="form-check-input" id="sms_notify" value="1" {{ old('sms_notify', $post->sms_notify) ? 'checked' : "" }}>
        </div>
    </div>
</div>