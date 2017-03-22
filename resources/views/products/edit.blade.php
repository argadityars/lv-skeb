@extends('layouts.default')

@section('title', 'Product')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-default">
        		<div class="panel-heading">@lang('actions.create')</div>
        		<div class="panel-body">
        			<!-- div id="product-image">
        			@foreach ($product->productimages as $image)
        				<img class="img-responsive" src="{{ Storage::url($image->name) }}"></img>
        			@endforeach
        			</div> -->
        			<div class="row">
        				<div class="col-md-2"><image-upload></image-upload></div>
        				<div class="col-md-2"><image-upload></image-upload></div>
        				<div class="col-md-2"><image-upload></image-upload></div>
        			</div>
        			
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection
