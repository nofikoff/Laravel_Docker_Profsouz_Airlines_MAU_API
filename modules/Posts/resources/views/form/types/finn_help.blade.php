{{--@include('posts::form.elements.branches')--}}
<input type="hidden" value="{{ \Modules\Posts\Entities\Branch::getDefaultFinnHelp()->id ?? 0 }}" name="branch_id">

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="name">{{ trans('posts::form.title') }}</label>
    <div class="col-md-9">
        <select name="title" id="name" class="form-control">
            @foreach(\Modules\Posts\Entities\FinnType::all() as $type)
                @php($title = $type[Auth::user()->locale])
                <option value="{{ $title }}" {{ old('title', $post->title) == $title ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        </select>
        @if($errors->has('title'))
            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>
</div>

@include('posts::form.elements.body')

@include('posts::form.elements.attachments')
<input type="hidden" name="importance" value="1">
@include('posts::form.elements.status', ['statuses' => \Modules\Posts\Entities\Post::formStatuses()])
@include('posts::form.elements.infostate')
<hr>
@include('posts::form.pdf_inputs.index')

@section('javascript')
    <script src="{{ asset('assets/vendors/js/jquery.maskedinput.min.js') }}"></script>
    <script>
        jQuery(function ($) {
            $("#pdf_phone").mask("+38 (099) 999-99-99");
        });
    </script>
@endsection