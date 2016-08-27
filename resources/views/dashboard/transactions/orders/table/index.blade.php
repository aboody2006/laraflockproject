{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Orders - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Orders')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Orders')

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
            <h3 class="box-title">{{ $view }} Orders</h3>
        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>Product code</th>
                    <th>Product title</th>
                    <th>Rate</th>
                    <th>QTY</th>
                    <th>Total amount</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="">
                        <td>{{ $order['company'] }}</td>
                        <td>{{ $order['code'] }}</td>
                        <td>{{ $order['title'] }}</td>
                        <td>{{ $order['rate'] }}</td>
                        <td>{{ $order['qty'] }}</td>
                        <td>{{ $order['total_amount'] }}</td>
                        <td class="text-center col-xs-1">
                            <?php $route = 'transactions.orders.' . $view; ?>
                            @if($view == 'pending')
                                <a href="{{ route($route . '.edit', ['id' => $order['id']]) }}"
                                   class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i></a>
                            @endif
                            <a href="{{ route($route . '.show', ['id' => $order['id']]) }}"
                               class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Show"><i
                                        class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('footer-extras')

    {{-- Data Table Scripts --}}
    <script src="{{ asset('vendor/laraflock/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/laraflock/datatables/dataTables.bootstrap.min.js') }}"
            type="text/javascript"></script>

    {{-- Initiate DataTable --}}
    <script type="text/javascript">
        $(function ()
        {
            $('#index').dataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false
                }]
            });
        });
    </script>
@stop