{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show SMS Setting - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Show SMS Setting')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show SMS Setting')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">SMS Setting ID#{{ $setting->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $setting->id }}</dd>
                <dt>Username</dt>
                <dd>{{ $setting->username }}</dd>
                <dt>Password</dt>
                <dd>{{ $setting->password }}</dd>
                <dt>Sender</dt>
                <dd>{{ $setting->sender }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            {!! BootForm::open()->delete()->action(route('sms.settings.delete', ['id' => $setting->id])) !!}
            <a href="{{ route('sms.settings.edit', ['id' => $setting->id]) }}" class="btn btn-sm btn-default"
               title="{{ trans('dashboard::dashboard.buttons.edit') }}">
                <i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}
            </a>
            {!! BootForm::submit('<i class="fa fa-trash"></i> ' . trans('dashboard::dashboard.buttons.delete'))->addClass('btn-sm btn-danger')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>

@stop
