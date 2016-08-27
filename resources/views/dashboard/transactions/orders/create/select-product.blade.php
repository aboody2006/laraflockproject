{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Create Order - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Select product')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Select product')

{{-- Header Extras to be Included --}}
@section('header-extras')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('transactions.orders.create.save', ['orderId' => $orderId])) !!}
    <div class="box">
        <div class="box-body">
            <label class="control-label" for="products">Select customer</label>
            <select id="products" name="products" class="form-control enable-select-dropdown">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->code }} {{ $product->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="box-body">
            {!! BootForm::text('Product\'s rate', 'rate') !!}
        </div>

        <div class="box-body">
            {!! BootForm::text('Product\'s quantity', 'qty') !!}
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <button type="submit" class="btn btn-success">Save your order</button>
        </div>
    </div>
    {!! BootForm::close() !!}
@stop

@section('footer-extras')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/enableSelect2.js') }}"></script>
@stop