{{-- Extends Master Layout --}}
@extends('dashboard::layouts.master')

{{-- Meta Title --}}
@section('title', 'Weights List - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Weights')

{{-- Page Subtitle --}}
@section('page-subtitle', 'List')

{{-- Header Extras to be Included --}}
@section('header-extras')
    {{-- Data Table Styles --}}
    <link href="{{ asset('vendor/laraflock/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Content Section --}}
@section('content')

    {{-- DataTable Box --}}
    <div class="box">
        <div class="box-header">
            <span class="pull-left">
                <h3 class="box-title">Weights</h3>
            </span>
            <span class="pull-right">
                                {!! addButton("weights") !!}
            </span>
        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr class="nosort">
                    <th colspan="3">
                        {!! importButton("weights") !!}

                    </th>
                    <th colspan="3">
                        {!! exportButton("weights") !!}
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>1 Piece Weight</th>
                    <th>2 Piece Weight</th>
                    <th>Average</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($weights as $weight)
                    <tr class="">
                        <td class="text-center col-xs-1">{{ $weight->id }}</td>
                        <td>
                            <a href="{{ route('products.show', ['id' => $weight->product->id]) }}">{{ $weight->product->title }}</a>
                        </td>
                        <td>{{ $weight->half_weight or '-'}} {{ $weight->unit->symbol }}</td>
                        <td>{{ $weight->full_weight or '-'}} {{ $weight->unit->symbol }}</td>
                        <td>{{ ($weight->full_weight + $weight->half_weight) / 2}} {{ $weight->unit->symbol }}</td>
                        <td class="text-center col-xs-1">
                            {!! BootForm::open()->delete()->action(route('weights.delete', ['id' => $weight->id])) !!}
                            {!!showButton("weights", $weight->id)!!}
                            {!!editButton("weights", $weight->id)!!}
                            {!! deleteButton("weights") !!}
                            {!! BootForm::close() !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

{{-- Footer Extras to be Included --}}
@section('footer-extras')

    {{-- Data Table Scripts --}}
    <script src="{{ asset('vendor/laraflock/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/laraflock/datatables/dataTables.bootstrap.min.js') }}"
            type="text/javascript"></script>

    {{-- Initiate DataTable --}}
    <script type="text/javascript">
        $(function () {
            $('#index').dataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false
                }]
            });
        });
    </script>
@stop