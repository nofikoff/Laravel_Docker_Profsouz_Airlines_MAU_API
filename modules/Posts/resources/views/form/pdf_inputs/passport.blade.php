<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdf_passport_seria">{{ trans('posts::form.passport') }}</label>
    <div class="col-md-3">
        <input name="pdf_passport_seria" type="text"
               class="form-control {{ $errors->has('pdf_passport_seria') ? 'is-invalid' : '' }}"
               placeholder="{{ trans('posts::form.passport_seria') }}"
               id="pdf_passport_seria" value="{{ old('pdf_passport_seria', null) }}">
        @if($errors->has('pdf_passport_seria'))
            <div class="invalid-feedback">{{ $errors->first('pdf_passport_seria') }}</div>
        @endif
    </div>
    <div class="col-md-6">
        <input name="pdf_passport_code" type="text"
               class="form-control {{ $errors->has('pdf_passport_code') ? 'is-invalid' : '' }}"
               id="pdf_passport_code" value="{{ old('pdf_passport_code', null) }}"
               placeholder="{{ trans('posts::form.passport_number') }}">
        @if($errors->has('pdf_passport_code'))
            <div class="invalid-feedback">{{ $errors->first('pdf_passport_code') }}</div>
        @endif
    </div>
</div>
