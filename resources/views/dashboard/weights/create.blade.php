{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Add new weight - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Weight')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Create')

{{-- Header Extras to be Included --}}
@section('header-extras')
    {{-- Select2 Styles --}}
    <link href="{{ asset('/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('weights.index')) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::select('Product Name', 'product')->id('productSelect') !!}
            {!! BootForm::select('Unit', 'unit')->options($units) !!}
            {!! BootForm::text('1 Piece Weight', 'half_weight') !!}
            {!! BootForm::text('2 Piece Weight', 'full_weight') !!}
        </div>
    </div>

    {{-- Include Form Actions for Create --}}
    @include($viewNamespace . '::helpers.form.actions-create')
    {!! BootForm::close() !!}
@stop

{{-- Footer Extras to be Included --}}
@section('footer-extras')

    {{-- Select2 Scripts --}}
    <script src="{{ asset('/assets/plugins/select2/select2.min.js') }}" type="text/javascript"></script>

    {{-- Initiate Select2 --}}
    <script type="text/javascript">
        $(function () {
            $('#productSelect').select2({
                tags: true,
                ajax: {
                    url: "{{ route('weights.ajax.products') }}",
                    type: "POST",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        var results = [];
                        $.each(data, function(index, item){
                            results.push({
                                id: item,
                                text: item
                            });
                        });
                        return {
                            results: results,
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@stop