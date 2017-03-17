@extends('layouts.app')

@section('title', 'Product - ')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
	        	<div class="panel panel-default">
	                <div class="panel-background">
	                    @if (!$shop->banner)
	                        <img src="{{ url('images/shop/banner/default.png') }}" class="img-responsive">
	                    @else 
	                        <img src="{{ Storage::url($shop->banner) }}" class="img-responsive">
	                    @endif
	                </div>
	                <div class="panel-body">
	                    @if (!$shop->photo)
	                        <img src="{{ url('images/shop/photo/default.png') }}" class="img-responsive img-circle img-avatar-lg" alt="{{ $shop->name }}">
	                    @else 
	                        <img src="{{ Storage::url($shop->photo) }}" class="img-responsive img-circle img-avatar-lg" alt="{{ $shop->name }}">
	                    @endif
	                    <h4>{{ $shop->name }}</h4>
	                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">@lang('actions.add_product')</a>
	                    <a href="{{ route('shop.edit.customization') }}" class="btn btn-default btn-sm pull-right">@lang('actions.edit')</a>
	                </div>
	            </div>
	            <div class="panel panel-default">
	                <div class="panel-body">
	                	@if (session('message'))
	                        <div class="alert alert-success alert-dismissible" role="alert">
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                            {{ session('message') }}
	                        </div>
	                    @endif
	                    
	                    <table class="table table-clean table-striped no-margin-btm">
	                    	@foreach ($products as $product)
	                        <tr>
	                        	<td class="col-md-1"><img src="{{ Storage::url($product->productimages[0]->name) }}" class="img-responsive"></td>
	                            <td class="col-md-10">
	                            	{{ $product->name }} {!! $product->getCondition() !!}<br>
	                            	<span class="text-muted"><small><em>by </em>{{ $product->author }}</small></span>
	                            </td>
	                            <td>{{ $product->price }}</td>
	                        </tr>
	                        @endforeach
	                    </table>
	                </div>
	            </div>
	        
        </div>
    </div>
</div>
@endsection
