{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show Order - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Show Order')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show Order')

{{-- Header Extras to be Included --}}
@section('header-extras')
@stop

{{-- Content Section --}}
@section('content')
    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Order ID#{{ $order->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $order->id }}</dd>
                <dt>Customer</dt>
                <dd>{{ $order['customer']->company }}</dd>
                <dt>Product code</dt>
                <dd>{{ $order['product']->code }}</dd>
                <dt>Product title</dt>
                <dd>{{ $order['product']->title }}</dd>
                <dt>Rate</dt>
                <dd>{{ $order->rate }}</dd>
                <dt>QTY</dt>
                <dd>{{ $order->qty }}</dd>
                <dt>Total amount</dt>
                <dd>{{ $order->total_amount }}</dd>
            </dl>
        </div>
    </div>
@stop