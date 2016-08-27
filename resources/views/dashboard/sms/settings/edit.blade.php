{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit SMS Setting - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Edit SMS Setting')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit SMS Setting')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('sms.settings.edit', ['id' => $setting->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($setting) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Username', 'username') !!}
        </div>
        <div class="box-body">
            {!! BootForm::text('Password', 'password') !!}
        </div>
        <div class="box-body">
            {!! BootForm::text('Sender', 'sender') !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop