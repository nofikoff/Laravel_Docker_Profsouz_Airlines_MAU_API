
<div class="form-group row">
    <label class="col-md-3 col-form-label"
           for="select_parent">{{ trans('admin::branch.parent') }}</label>
    <div class="col-md-9">
        <select id="select_parent" name="parent_id" class="form-control">
            <option value="" data-type="{{ json_encode(\Modules\Posts\Entities\Branch::TYPES) }}">{{ trans('admin::branch.w-parent') }}</option>
            @foreach($branches as $child)
                <option data-type="{{ json_encode($child->available_types) }}"
                        {{ $child->id === ($branch->parent_id ?? 0) ? 'selected' : '' }}
                        value="{{ $child->id }}">{{ $child->name }}</option>
            @endforeach
        </select>
    </div>
</div>