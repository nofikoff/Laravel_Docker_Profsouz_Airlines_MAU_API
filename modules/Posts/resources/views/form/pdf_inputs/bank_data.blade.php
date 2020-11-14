<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdf_mfo"></label>
    <div class="col-md-3">
        <input name="pdf_mfo" type="text"
               class="form-control {{ $errors->has('pdf_mfo') ? 'is-invalid' : '' }}"
               placeholder="{{ trans('posts::form.mfo') }}"
               id="pdf_mfo" value="{{ old('pdf_mfo', null) }}">
        @if($errors->has('pdf_mfo'))
            <div class="invalid-feedback">{{ $errors->first('pdf_mfo') }}</div>
        @endif
    </div>
    <div class="col-md-6">
        <input name="pdf_edrpoy" type="text"
               class="form-control {{ $errors->has('pdf_edrpoy') ? 'is-invalid' : '' }}"
               id="pdf_edrpoy" value="{{ old('pdf_edrpoy', null) }}"
               placeholder="{{ trans('posts::form.edrpoy') }}">
        @if($errors->has('pdf_edrpoy'))
            <div class="invalid-feedback">{{ $errors->first('pdf_edrpoy') }}</div>
        @endif
    </div>
</div>
