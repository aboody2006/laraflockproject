{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Send SMS - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Send SMS')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Send SMS')

{{-- Header Extras to be Included --}}
@section('header-extras')
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('sms.send.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::text('Recipient number, must contain 10 digits', 'recipient_number')->maxlength(10)->pattern('[0-9]{10}') !!}
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="control-label" for="message_template">Message Template</label>
                <select id="message_template" class="form-control">
                    <option value="" disabled selected>Select your template if you want</option>
                    @foreach($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->message }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="box-body">
            {!! BootForm::text('Your message', 'message') !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-send')
    {!! BootForm::close() !!}
@stop

@section('footer-extras')
    <script src="{{ asset('assets/js/sendSmsTemplatePicker.js') }}" type="text/javascript"></script>
@stop