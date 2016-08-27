{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show Weight - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Weight')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Weight ID#{{ $weight->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $weight->id }}</dd>
                <dt>Product Name</dt>
                <dd><a href="{{ route('products.show', ['id' => $weight->product->id]) }}">{{ $weight->product->title }}</a></dd>
                <dt>Unit</dt>
                <dd><a href="{{ route('units.show', ['id' => $weight->unit->id]) }}">{{ $weight->unit->title }}</a></dd>
                <dt>1 Piece Weight</dt>
                <dd>{{ $weight->half_weight or '-'}} {{ $weight->unit->symbol }}</dd>
                <dt>2 Piece Weight</dt>
                <dd>{{ $weight->full_weight or '-'}} {{ $weight->unit->symbol }}</dd>
                <dt>Average</dt>
                <dd>{{ ($weight->full_weight + $weight->half_weight) / 2}} {{ $weight->unit->symbol }}</dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ route('weights.edit', ['id' => $weight->id]) }}" class="btn btn-sm btn-default" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
        </div>
    </div>

@stop
