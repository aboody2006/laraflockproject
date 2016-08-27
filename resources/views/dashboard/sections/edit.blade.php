{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit section')

{{-- Page Title --}}
@section('page-title', 'Sections')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('sections.edit', ['id' => $section->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($section) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::select('Category Name', 'category')->options($categories)->select($section->category->id) !!}
            {!! BootForm::text('Section Name', 'title') !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop
