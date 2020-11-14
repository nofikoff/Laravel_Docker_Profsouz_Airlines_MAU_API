                    <form method="GET" action="{{ route('admin.users.search') }}" class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search"
                                       value="{{ Request::get('search') }}" placeholder="{{ trans('users::pages.search-text') }}">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 0;">{{ trans('users::pages.search-button') }}</button>
                                </span>
                            </div>
                        </div>
                    </form>