{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add new section')

{{-- Page Title --}}
@section('page-title', 'Sections')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Create')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('sections.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::select('Category Name', 'category')->options($categories) !!}
            {!! BootForm::text('Section Name', 'title') !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop
