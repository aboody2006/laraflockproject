{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit SMS Template - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Edit SMS Template')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit SMS Template')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('sms.templates.edit', ['id' => $template->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($template) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Template Message', 'message') !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop