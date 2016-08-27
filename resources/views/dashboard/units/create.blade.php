{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add new unit - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Unit')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Create')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('units.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Unit Name', 'title') !!}
            {!! BootForm::text('Unit Symbol', 'symbol') !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop
