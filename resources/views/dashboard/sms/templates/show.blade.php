{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show SMS Template - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Show SMS Template')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show SMS Template')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">SMS Template ID#{{ $template->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $template->id }}</dd>
                <dt>Message</dt>
                <dd>{{ $template->message }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            {!! BootForm::open()->delete()->action(route('sms.templates.delete', ['id' => $template->id])) !!}
            <a href="{{ route('sms.templates.edit', ['id' => $template->id]) }}" class="btn btn-sm btn-default"
               title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i
                        class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
            {!! BootForm::submit('<i class="fa fa-trash"></i> ' . trans('dashboard::dashboard.buttons.delete'))->addClass('btn-sm btn-danger')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>

@stop
