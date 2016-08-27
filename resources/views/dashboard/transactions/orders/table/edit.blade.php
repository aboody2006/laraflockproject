{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit Pending Order- Dashboard')

{{-- Page Title --}}
@section('page-title', 'Edit Pending Order')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit Pending Order')

@section('header-extras')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop


{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('transactions.orders.create.save', ['orderId' => $order->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($order) !!}

    <div class="box">
        <div class="box-body">
            <label class="control-label" for="products">Select product</label>
            <select id="products" name="products" class="form-control enable-select-dropdown">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->code }} {{ $product->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="box-body">
            {!! BootForm::text('Product\'s quantity', 'qty') !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop

@section('footer-extras')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/enableSelect2.js') }}"></script>
@stop