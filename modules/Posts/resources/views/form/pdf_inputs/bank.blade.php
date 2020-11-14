<div class="form-group row">
    <label class="col-md-3 col-form-label" for="pdf_bank">{{ trans('posts::form.bank') }}</label>
    <div class="col-md-9">
        <input name="pdf_bank" type="text" class="form-control {{ $errors->has('pdf_bank') ? 'is-invalid' : '' }}"
               id="pdf_bank" value="{{ old('pdf_bank', null) }}">
        @if($errors->has('pdf_bank'))
            <div class="invalid-feedback">{{ $errors->first('pdf_bank') }}</div>
        @endif
    </div>
</div>
