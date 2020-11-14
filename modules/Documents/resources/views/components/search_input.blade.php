
            <form method="GET" action="{{ route('documents.search') }}" class="form-group row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_query"
                               value="{{ Request::get('search_query') }}" placeholder="{{ trans('documents::master.search-text') }}">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary" style="margin-top: 0;">{{ trans('users::pages.search-button') }}</button>
                        </span>
                    </div>
                </div>
            </form>