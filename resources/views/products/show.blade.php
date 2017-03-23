@extends('layouts.default')

@section('title', $product->name)

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<img src="{{ Storage::url($product->productimages[0]->name) }}" class="img-responsive">
							<div class="row" style="margin-top: 20px;">
								@for ($i = 1; $i < count($product->productimages); $i++)
								<div class="col-md-4"><img src="{{ Storage::url($product->productimages[$i]->name) }}" class="img-responsive"></div>
								@endfor
							</div>
						</div>
						<div class="col-md-7">

							<h3 class="product-title">{{ $product->name }}</h3>
							<p class="text-muted"><em>by</em> {{ $product->author }}</p>
							<h4 class="text-primary product-price">Rp {{ $product->price }}</h4>

							<table class="table table-clean table-product-details">
								<tr>
									<td class="col-md-4">@lang('forms.category')</td>
									<td>: {{ $product->category }}</td>
								</tr>
								<tr>
									<td>@lang('forms.condition')</td>
									<td>: <span class="label {{ $product->condition == 'Baru' ? 'label-primary' : 'label-success' }}">{{ $product->condition }}</span></td>
								</tr>
								<tr>
									<td>@lang('forms.weight')</td>
									<td>: {{ $product->weight }} gram</td>
								</tr>
							</table>

							<div class="text-warning bg-warning info-box">
								<h4>@lang('forms.notes')</h4>
								<p>{{ $product->notes ? $product->notes : trans('messages.empty_product_notes') }}</p>
							</div>

							<form class="form-inline">
								<div class="form-group">
									<input type="number" class="form-control" min="1"></input>
								</div>
								<button type="submit" class="btn btn-primary">@lang('actions.buy')</button>
								<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#synopsis" aria-controls="synopsis" role="tab" data-toggle="tab">Synopsis</a></li>
					    <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Additional Information</a></li>
					    <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Reviews</a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="synopsis">{{ $product->synopsis }}</div>
					    <div role="tabpanel" class="tab-pane" id="info">{{ $product->shop->note }}</div>
					    <div role="tabpanel" class="tab-pane" id="review">...</div>
					  </div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			@include('includes.modules.product-owner-nav')
		</div>
	</div>

</div>
@endsection