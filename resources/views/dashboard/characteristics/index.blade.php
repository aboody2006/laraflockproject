{{-- Extends Master Layout --}}
@extends('dashboard::layouts.master')

{{-- Meta Title --}}
@section('title', 'Technicals characteristics List - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Technicals characteristics')

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
                <h3 class="box-title">Technicals characteristics</h3>
            </span>
            <span class="pull-right">
                <a href="{{ route('characteristics.create') }}">Add new characteristic</a>
            </span>
        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr class="nosort">
                    <th colspan="2"><a href="{{ route('characteristics.import') }}">Import Technicals
                            characteristics</a></th>
                    <th colspan="2">
                        {!! exportButton("characteristics") !!}

                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Cutting Length</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($characteristics as $characteristic)
                    <tr class="">
                        <td class="text-center col-xs-1">{{ $characteristic->id }}</td>
                        <td>
                            <a href="{{ route('products.show', ['id' => $characteristic->product->id]) }}">{{ $characteristic->product->title }}</a>
                        </td>
                        <td>{{ $characteristic->length or '-'}}</td>
                        <td class="text-center col-xs-1">
                            {!! BootForm::open()->delete()->action(route('characteristics.delete', ['id' => $characteristic->id])) !!}
                            {!!showButton("characteristics", $characteristic->id)!!}
                            {!!editButton("characteristics", $characteristic->id)!!}
                            {!! deleteButton("characteristics") !!}

                            {!! BootForm::close() !!}
                        </td>
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