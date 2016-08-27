{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit unit')

{{-- Page Title --}}
@section('page-title', 'Units')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('units.edit', ['id' => $unit->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($unit) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Unit Name', 'title') !!}
            {!! BootForm::text('Unit Symbol', 'symbol') !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop
