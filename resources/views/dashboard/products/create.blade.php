{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add new product - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Products')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Create')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('products.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Product Code', 'code') !!}
            {!! BootForm::text('Product Name', 'title') !!}
            {!! BootForm::select('Section Name', 'section')->options($sections) !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop
