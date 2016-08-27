{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'SMS Settings - Dashboard')

{{-- Page Title --}}
@section('page-title', 'SMS Settings')

{{-- Page Subtitle --}}
@section('page-subtitle', 'SMS Settings')

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
            <h3 class="box-title">SMS Settings</h3>
        </div>
        <div class="box-body">
            <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Sender</th>
                    <th class="datatable-nosort">{{ trans('dashboard::dashboard.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($settings as $setting)
                    <tr class="">
                        <td class="text-center col-xs-1">{{ $setting->id }}</td>
                        <td>{{ $setting->username }}</td>
                        <td>{{ $setting->sender }}</td>
                        <td class="text-center col-xs-1">
                            {!! BootForm::open()->delete()->action(route('sms.settings.delete', ['id' => $setting->id])) !!}
                            <a href="{{ route('sms.settings.show', ['id' => $setting->id]) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('sms.settings.edit', ['id' => $setting->id]) }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i></a>
                            {!! BootForm::submit('<i class="fa fa-trash"></i><span class="sr-only">' . trans('dashboard::dashboard.buttons.delete') . '</span>')->addClass('btn btn-xs btn-danger')->removeClass('btn-default')->data('toggle', 'tooltip')->data('placement', 'top')->title(trans('dashboard::dashboard.buttons.delete')) !!}
                            {!! BootForm::close() !!}
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