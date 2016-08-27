{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Edit Weight - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Weights')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Edit')

{{-- Header Extras to be Included --}}
@section('header-extras')
    {{-- Select2 Styles --}}
    <link href="{{ asset('/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Content Section --}}
@section('content')
    {!! BootForm::open()->post()->action(route('weights.edit', ['id' => $weight->id])) !!}

    {{-- Bind Model to Form for Filling out Inputs --}}
    {!! BootForm::bind($weight) !!}

    {{-- Role Box --}}
    <div class="box">
        <div class="box-body">
            {!! BootForm::select('Product Name', 'product')->id('productSelect')
                ->options([$weight->product->title => $weight->product->title])
                ->select($weight->product->title) !!}
            {!! BootForm::select('Unit', 'unit')->options($units)->select($weight->unit->id) !!}
            {!! BootForm::text('1 Piece Weight', 'half_weight') !!}
            {!! BootForm::text('2 Piece Weight', 'full_weight') !!}
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