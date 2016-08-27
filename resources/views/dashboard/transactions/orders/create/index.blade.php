{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Create Order - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Create Order')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Create Order')

{{-- Header Extras to be Included --}}
@section('header-extras')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('transactions.orders.create.index')) !!}
    <div class="box">
        <div class="box-body">
            <label class="control-label" for="customers">Select customer</label>
            <select id="customers" name="customers" class="form-control enable-select-dropdown">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->company }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <button type="submit" class="btn btn-success">Select product</button>
        </div>
    </div>
    {!! BootForm::close() !!}
@stop

@section('footer-extras')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/enableSelect2.js') }}"></script>
@stop