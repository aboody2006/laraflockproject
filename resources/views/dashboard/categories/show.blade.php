{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show category')

{{-- Page Title --}}
@section('page-title', 'Categories')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Category ID#{{ $category->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $category->id }}</dd>
                <dt>Category Name</dt>
                <dd>{{ $category->title }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-default" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
        </div>
    </div>

@stop
