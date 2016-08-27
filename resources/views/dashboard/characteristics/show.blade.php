{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show Technical Characteristic - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Technical Characteristics')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Technical Characteristic ID#{{ $characteristic->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $characteristic->id }}</dd>
                <dt>Product Name</dt>
                <dd><a href="{{ route('products.show', ['id' => $characteristic->product->id]) }}">{{ $characteristic->product->title }}</a></dd>
                <dt>Cutting Length</dt>
                <dd>{{ $characteristic->length or '-' }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ route('characteristics.edit', ['id' => $characteristic->id]) }}" class="btn btn-sm btn-default" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
        </div>
    </div>

@stop
