{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit category')

{{-- Page Title --}}
@section('page-title', 'Categories')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('categories.edit', ['id' => $category->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($category) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Category Name', 'title') !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop
