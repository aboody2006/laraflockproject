{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show SMS - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Show SMS')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show SMS')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">SMS ID#{{ $sms->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $sms->id }}</dd>
                <dt>Message</dt>
                <dd>{{ $sms->message }}</dd>
                <dt>Recipient number</dt>
                <dd>{{ $sms->recipient_number }}</dd>
                <dt>Sent date</dt>
                <dd>{{ $sms->sent_date }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ route('sms.sent.index') }}"><button type="button" class="btn btn-default">Back</button></a>
        </div>
    </div>
@stop
