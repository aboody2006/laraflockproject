{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', trans('dashboard::dashboard.roles.edit.title'))

{{-- Page Title --}}
@section('page-title', trans('dashboard::dashboard.roles.edit.page_title'))

{{-- Page Subtitle --}}
@section('page-subtitle', trans('dashboard::dashboard.roles.edit.page_subtitle'))
{{-- Header Extras to be Included --}}
@section('header-extras')
    {{-- Select2 Styles --}}
    <link href="{{ asset('/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop
{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('roles.edit', ['id' => $role->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($role) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text(trans('dashboard::dashboard.form.name'), 'name') !!}
            {!! BootForm::text(trans('dashboard::dashboard.form.slug'), 'slug') !!}
            <div class="form-group">
                <label>{{ trans('dashboard::dashboard.form.permissions') }}</label>

                <div class="clearfix"></div>
                <select name="permissions[]" id="permissionSelect" multiple class="form-control">
                    @foreach($selectPermisions as $permissionKey=>$permissionValue)
                        <option value="{{$permissionValue}}"
                                @if(is_array($role->permissions) && array_key_exists($permissionValue, $role->permissions)) selected @endif>{{$permissionKey}}</option>
                    @endforeach

                </select>

            </div>
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
    {!! BootForm::close() !!}
@stop
@section('footer-extras')

    {{-- Select2 Scripts --}}
    <script src="{{ asset('/assets/plugins/select2/select2.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#permissionSelect').select2();
    </script>
@stop