<div class="panel panel-default">
    <div class="panel-background">
        <img src="{{ $shop->banner ? Storage::url($shop->banner) : url('images/default/banner.png') }}" class="img-responsive">
    </div>
    <div class="panel-body">
        <img src="{{ $shop->photo ? Storage::url($shop->photo) : url('images/default/shop.png') }}" class="img-responsive img-circle img-avatar-lg" alt="{{ $shop->name }}">
        <h4>{{ $shop->name }}</h4>
        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">@lang('actions.add_product')</a>
        @if (Route::current()->getName() == 'shop.index')
		    <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm">@lang('actions.manage_product')</a>
		    <a href="{{ route('shop.customization') }}" class="btn btn-default btn-sm pull-right">@lang('actions.edit')</a>
		@endif
    </div>
</div>