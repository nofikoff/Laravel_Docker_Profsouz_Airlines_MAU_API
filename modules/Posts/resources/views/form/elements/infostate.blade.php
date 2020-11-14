<div class="form-group row">
    <label class="col-md-3 col-form-label" for="info_status">{{ trans('posts::form.info_status') }}</label>
    <div class="col-md-9">
        <select id="info_status" name="info_status_id" class="form-control">
            <option value="">{{ trans('posts::form.not_choose') }}</option>
            @foreach(\Modules\Posts\Entities\InfoStatus::all() as $item)
                <option {{ old('status', $post->info_status_id) == $item->id ? "selected" : "" }}
                        value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>