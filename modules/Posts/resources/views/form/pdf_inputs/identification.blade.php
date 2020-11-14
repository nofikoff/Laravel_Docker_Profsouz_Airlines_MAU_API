<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdf_identification">{{ trans('posts::form.identification') }}</label>
    <div class="col-md-9">
        <input name="pdf_identification" type="text"
               class="form-control {{ $errors->has('pdf_identification') ? 'is-invalid' : '' }}"
               id="pdf_identification" value="{{ old('pdf_identification', null) }}">
        @if($errors->has('pdf_identification'))
            <div class="invalid-feedback">{{ $errors->first('pdf_identification') }}</div>
        @endif
    </div>
</div>
