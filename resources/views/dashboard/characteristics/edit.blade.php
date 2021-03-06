{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit Technical Characteristic - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Technical Characteristics')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit')

{{-- Header Extras to be Included --}}
@section('header-extras')
    {{-- Select2 Styles --}}
    <link href="{{ asset('/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('characteristics.edit', ['id' => $characteristic->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($characteristic) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::select('Product Name', 'product')->id('productSelect')
                ->options([$characteristic->product->title => $characteristic->product->title])
                ->select($characteristic->product->title) !!}
            {!! BootForm::text('Cutting Length', 'length') !!}
        </div>
    </div>

    {{-- Include Form Actions for Edit --}}
    @include($viewNamespace . '::helpers.form.actions-edit')
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
                    url: "{{ route('characteristics.ajax.products') }}",
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