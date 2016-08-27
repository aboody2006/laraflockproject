{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show godown - dashboard')

{{-- Page Title --}}
@section('page-title', 'Godowns')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Godown ID#{{ $godown->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $godown->id }}</dd>
                <dt>Godown Name</dt>
                <dd>{{ $godown->name }}</dd>
                <dt>Godown Address</dt>
                <dd>{{ $godown->address }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            {!! BootForm::open()->delete()->action(route('godowns.delete', ['id' => $godown->id])) !!}
            <a href="{{ route('godowns.edit', ['id' => $godown->id]) }}" class="btn btn-sm btn-default" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
            {!! BootForm::submit('<i class="fa fa-trash"></i> ' . trans('dashboard::dashboard.buttons.delete'))->addClass('btn-sm btn-danger')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>

@stop
