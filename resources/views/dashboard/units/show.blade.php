{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show unit')

{{-- Page Title --}}
@section('page-title', 'Units')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Unit ID#{{ $unit->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $unit->id }}</dd>
                <dt>Unit Name</dt>
                <dd>{{ $unit->title }}</dd>
                <dt>Unit Symbol</dt>
                <dd>{{ $unit->symbol }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            {!! BootForm::open()->delete()->action(route('units.delete', ['id' => $unit->id])) !!}
            <a href="{{ route('units.edit', ['id' => $unit->id]) }}" class="btn btn-sm btn-default" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
            {!! BootForm::submit('<i class="fa fa-trash"></i> ' . trans('dashboard::dashboard.buttons.delete'))->addClass('btn-sm btn-danger')->removeClass('btn-default') !!}
            {!! BootForm::close() !!}
        </div>
    </div>

@stop
