{{-- Extends Master Layout --}}
@extends($viewNamespace . '::layouts.master')

{{-- Meta Title --}}
@section('title', 'Show section - Dashboard')

{{-- Page Title --}}
@section('page-title', 'Sections')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Show')

{{-- Content Section --}}
@section('content')

    {{-- Show Box --}}
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Section ID#{{ $product->id }}</h3>
        </div>
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>ID</dt>
                <dd>{{ $product->id }}</dd>
                <dt>Product Code</dt>
                <dd>{{ $product->code }}</dd>
                <dt>Product Name</dt>
                <dd>{{ $product->title }}</dd>
                <dt>Category Name</dt>
                <dd>
                    @if(isset($product->section))
                        <a href="{{ route('categories.show', ['id' => $product->section->category->id]) }}">{{ $product->section->category->title }}</a>
                    @else
                        -
                    @endif
                </dd>
                <dt>Section Name</dt>
                <dd>
                    @if(isset($product->section))
                        <a href="{{ route('sections.show', ['id' => $product->section->id]) }}">{{ $product->section->title }}</a>
                    @else
                        -
                    @endif
                </dd>
            </dl>
        </div>
    </div>

    {{-- Include Form Actions for Show --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('dashboard::dashboard.global.actions') }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-default" title="{{ trans('dashboard::dashboard.buttons.edit') }}"><i class="fa fa-pencil"></i> {{ trans('dashboard::dashboard.buttons.edit') }}</a>
        </div>
    </div>

@stop
