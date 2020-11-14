@extends('admin::layouts.master')

@section('content')
    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Logs
                </div>
                <div class="card-body">
                    @foreach($logs as $log)

                        <div class="container">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        @include('admin::modules.log._'.$log->type)
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    {{ $logs->appends(\Illuminate\Support\Facades\Input::all())->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection