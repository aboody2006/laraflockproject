{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add new godown - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Godowns')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Create')

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('godowns.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Godown Name', 'name') !!}
            {!! BootForm::text('Godown Address', 'address') !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop
