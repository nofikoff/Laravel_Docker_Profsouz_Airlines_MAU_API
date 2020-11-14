<div class="form-group">
    <div class="col-md-9" style="margin-left: 25%">
        @foreach($post->attachments as $attachment)
            <a href="{{ route('posts.detach',['id' => $attachment->id]) }}" class="btn btn-secondary" type="submit">
                {{ $attachment->name }}
                <i class="fa fa-close"></i>
            </a>
        @endforeach
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 col-form-label" for="attachments">{{ trans('posts::form.attachments') }}</label>
    <div class="col-md-9">
        <input type="file" class="form-control {{ $errors->has('attachments.*') ? 'is-invalid' : '' }}" id="attachments"
               name="attachments[]" multiple="">
        @if($errors->has('attachments.*'))
            <div class="invalid-feedback">
                @foreach($errors->get('attachments.*') as $attachment_error)
                    <div>{{ $attachment_error[0] }}</div>
                @endforeach
            </div>
        @endif
    </div>
</div>
