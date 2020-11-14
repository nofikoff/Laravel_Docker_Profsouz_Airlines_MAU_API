<div class="form-group row">
    <label class="col-md-3 col-form-label" for="status">{{ trans('posts::form.branches') }}</label>
    <div class="col-md-9">
        <select id="status" name="branch_id" class="form-control {{ $errors->has('branch_id') ? 'is-invalid' : '' }}">
            @foreach(( \Modules\Posts\Entities\Branch::postable()->userAccess()->get() ) as $branch)
                <option {{ old('branch_id', $post->branch_id) == $branch->id ? "selected" : "" }}
                        value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
        </select>
        @if($errors->has('branch_id'))
            <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
        @endif
    </div>
</div>