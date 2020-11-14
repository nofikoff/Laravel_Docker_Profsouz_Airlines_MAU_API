@extends('admin::layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-8 offset-2">
            <div class="card">

                <div class="card-header">
                    <div class="row">

                        <div class="col-md-4 text-right">
                            <a class="btn btn-success" href="{{ route('admin.pages.create') }}" style="margin-top:0px;">
                                <i class="fa fa-plus-circle"></i> {{ trans('admin::pages.create') }}
                            </a>

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    @foreach($pages as $page)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $page->title }}
                                        <div class="card-actions">
                                            @if($page->order)
                                                <a href="{{ route('admin.pages.up', $page) }}"><i
                                                            class="icon-arrow-up-circle"></i></a>
                                            @endif
                                            @if($page->order < count($pages) - 1)
                                                <a href="{{ route('admin.pages.down', $page) }}"><i
                                                            class="icon-arrow-down-circle"></i></a>
                                            @endif
                                            <a href="{{ route('admin.pages.edit', $page) }}"><i class="icon-pencil"></i></a>
                                            <form action="{{ route('admin.pages.destroy', $page) }}"
                                                  style="display: inline-block;">
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button type="button" class="btn btn-delete"><i class="icon-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {{ str_limit(strip_tags($page->text), 100) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@stop
