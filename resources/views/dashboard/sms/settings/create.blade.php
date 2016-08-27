{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add SMS Setting - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Add SMS Setting')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Add SMS Setting')

{{-- Header Extras to be Included --}}
@section('header-extras')
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('sms.settings.index')) !!}

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

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop