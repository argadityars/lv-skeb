@extends('layouts.default')

@section('title', $product->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="panel panel-default">
        		<div class="panel-body">
        			<div class="row">
        				<div class="col-md-8">
        					<div class="row">
        						<div class="col-md-4">
        							<img src="{{ Storage::url($product->productimages[0]->name) }}" class="img-responsive">
        							<div class="row" style="margin-top: 20px;">
        								@foreach ($product->productimages as $image)
        								<div class="col-md-4"><img src="{{ Storage::url($image->name) }}" class="img-responsive"></div>
        								@endforeach
        							</div>
        						</div>
        						<div class="col-md-8">
        							<h3>{{ $product->name }}</h3>
        							<h4>{{ $product->price }}</h4>
        							<table class="table table-clean">
        								<tr>
        									<td>@lang('forms.category')</td>
        									<td>{{ $product->category }}</td>
        								</tr>
        								<tr>
        									<td>@lang('forms.condition')</td>
        									<td>{{ $product->condition }}</td>
        								</tr>
        								<tr>
        									<td>@lang('forms.weight')</td>
        									<td>{{ $product->weight }} Gram</td>
        								</tr>
        							</table>
        						</div>
        					</div>
        				</div>
        				<div class="col-md-4">
        					<div class="row">
        						<div class="col-md-4">
        							<img src="{{ Storage::url($product->shop->photo) }}" class="img-responsive img-circle">
        						</div>
        						<div class="col-md-8">
        							{{ $product->shop->name }} <br>
        							{{ title_case($product->shop->getCity()->name) }}, {{ title_case($product->shop->getProvince()->name) }}
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection