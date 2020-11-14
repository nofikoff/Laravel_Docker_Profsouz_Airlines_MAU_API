<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdf_card">{{ trans('posts::form.card') }}</label>
    <div class="col-md-9">
        <input name="pdf_card" type="text" class="form-control {{ $errors->has('pdf_card') ? 'is-invalid' : '' }}"
               id="pdf_card" value="{{ old('pdf_card', null) }}">
        @if($errors->has('pdf_card'))
            <div class="invalid-feedback">{{ $errors->first('pdf_card') }}</div>
        @endif
    </div>
</div>
