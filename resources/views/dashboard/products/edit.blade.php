{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit product')

{{-- Page Title --}}
@section('page-title', 'Products')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('products.edit', ['id' => $product->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($product) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Product Code', 'code') !!}
            {!! BootForm::text('Product Name', 'title') !!}
            {!! BootForm::select('Section Name', 'section')->options($sections)->select($product->section->id) !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop
