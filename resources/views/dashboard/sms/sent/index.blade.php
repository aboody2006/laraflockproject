{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Sent SMS - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Sent SMS')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Sent SMS')

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
            <h3 class="box-title">Sent SMS</h3>
        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Message</th>
                    <th>Recipient number</th>
                    <th>Sent date</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sentSms as $sms)
                    <tr class="">
                        <td>{{ $sms->message }}</td>
                        <td>{{ $sms->recipient_number }}</td>
                        <td>{{ $sms->sent_date }}</td>
                        <td class="text-center col-xs-1">
                            <a href="{{ route('sms.sent.show', ['id' => $sms->id]) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye"></i></a>
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
    <script src="{{ asset('vendor/laraflock/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>

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