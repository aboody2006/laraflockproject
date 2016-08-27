{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show section - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Sections')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Section ID#{{ $section->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $section->id }}</dd>
                <dt>Category Name</dt>
                <dd><a href="{{ route('categories.show', ['id' => $section->category->id]) }}">{{ $section->category->title }}</a></dd>
                <dt>Section Name</dt>
                <dd>{{ $section->title }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ route('sections.edit', ['id' => $section->id]) }}" class="btn btn-sm btn-default" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
        </div>
    </div>

@stop
