{{-- Extends Master Layout --}}
@extends('dashboard::layouts.master')

{{-- Meta Title --}}
@section('title', 'Product List - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Products')

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
                <h3 class="box-title">Products</h3>
            </span>
            <span class="pull-right">
                {!! addButton("products") !!}
            </span>

        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr class="nosort">
                    <th colspan="4">
                        {!! importButton("products") !!}
                    </th>
                    <th colspan="2">
                        {!! exportButton("products") !!}
                   </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Section Name</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="">
                        <td class="text-center col-xs-1">{{ $product->id }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->title }}</td>
                        <td>
                            @if(isset($product->section))
                                <a href="{{ route('categories.show', ['id' => $product->section->category->id]) }}">{{ $product->section->category->title }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if(isset($product->section))
                                <a href="{{ route('sections.show', ['id' => $product->section->id]) }}">{{ $product->section->title }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center col-xs-1">
                            {!! BootForm::open()->delete()->action(route('products.delete', ['id' => $product->id])) !!}
                            {!!showButton("products", $product->id)!!}
                            {!!editButton("products", $product->id)!!}
                            {!! deleteButton("products") !!}

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