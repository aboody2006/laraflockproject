{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add new SMS Template - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Add new SMS Template')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Add new SMS Template')

{{-- Header Extras to be Included --}}
@section('header-extras')
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('sms.templates.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Template message', 'message') !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop