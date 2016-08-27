{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add new category')

{{-- Page Title --}}
@section('page-title', 'Categories')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Create')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('categories.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Category Name', 'title') !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop
