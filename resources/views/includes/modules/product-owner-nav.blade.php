<div class="row">
	<div class="col-md-4">
		<img src="{{ Storage::url($product->shop->photo) }}" class="img-responsive img-circle">
	</div>
	<div class="col-md-8">
		{{ $product->shop->name }} <br>
		<span class="text-muted">{{ title_case($product->shop->getCity()->name) }}, {{ title_case($product->shop->getProvince()->name) }}</span>
	</div>
</div>