{{-- Extends Master Layout --}}
@extends('dashboard::layouts.master')

{{-- Meta Title --}}
@section('title', 'Section List - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Sections')

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
                <h3 class="box-title">Sections</h3>
            </span>
            <span class="pull-right">
                                        {!! addButton("sections") !!}

            </span>
        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr class="nosort">
                    <th colspan="2">
                        {!! importButton("sections") !!}
                    </th>
                    <th colspan="2">
                        {!! exportButton("sections") !!}
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Section Name</th>
                    <th>Category Name</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sections as $section)
                    <tr class="">
                        <td class="text-center col-xs-1">{{ $section->id }}</td>
                        <td>{{ $section->title }}</td>
                        <td>
                            <a href="{{ route('categories.show', ['id' => $section->category->id]) }}">{{ $section->category->title }}</a>
                        </td>
                        <td class="text-center col-xs-1">
                            {!! BootForm::open()->delete()->action(route('sections.delete', ['id' => $section->id])) !!}
                            {!!showButton("sections", $section->id)!!}
                            {!!editButton("sections", $section->id)!!}
                            {!! deleteButton("sections") !!}
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