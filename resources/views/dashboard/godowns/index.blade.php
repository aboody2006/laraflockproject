{{-- Extends Master Layout --}}
@extends('dashboard::layouts.master')

{{-- Meta Title --}}
@section('title', 'Godowns List - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Godowns')

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
                <h3 class="box-title">Godowns</h3>
            </span>
            <span class="pull-right">
                        {!! addButton("godowns") !!}
            </span>
        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr class="nosort">
                    <th colspan="2">
                        {!! importButton("godowns") !!}
                    </th>
                    <th>
                        {!! exportButton("godowns") !!}
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Godown Name</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($godowns as $godown)
                    <tr class="">
                        <td class="text-center col-xs-1">{{ $godown->id }}</td>
                        <td>{{ $godown->name }}</td>
                        <td class="text-center col-xs-1">
                            {!! BootForm::open()->delete()->action(route('godowns.delete', ['id' => $godown->id])) !!}
                            {!!showButton("godowns", $godown->id)!!}
                            {!!editButton("godowns", $godown->id)!!}
                            {!! deleteButton("godowns") !!}
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