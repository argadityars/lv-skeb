@extends('layouts.default')

@section('title', 'Shop')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
	        	<div class="panel panel-default">
	                <div class="panel-background">
                        <img src="{{ $shop->banner ? Storage::url($shop->banner) : url('images/default/banner.png') }}" class="img-responsive">
	                </div>
	                <div class="panel-body">
                        <img src="{{ $shop->photo ? Storage::url($shop->photo) : url('images/default/shop.png') }}" class="img-responsive img-circle img-avatar-lg" alt="{{ $shop->name }}">
	                    <h4>{{ $shop->name }}</h4>
	                    <a href="{{ route('shop.create') }}" class="btn btn-primary btn-sm">@lang('actions.add_product')</a>
	                    <a href="{{ route('shop.index') }}" class="btn btn-primary btn-sm">@lang('actions.manage_product')</a>
	                    <a href="{{ route('shop.customization') }}" class="btn btn-default btn-sm pull-right">@lang('actions.edit')</a>
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
	                        <tr>
	                            <td class="col-md-2">@lang('forms.name')</td>
	                            <td><strong>{{ $shop->name }}</strong></td>
	                        </tr>
	                        <tr>
	                            <td>@lang('forms.tagline')</td>
	                            <td><strong>{{ $shop->tagline }}</strong></td>
	                        </tr>
	                        <tr>
	                            <td>@lang('forms.email')</td>
	                            <td><strong>{{ $shop->email }}</strong></td>
	                        </tr>
	                        <tr style="border-top: 1px solid #eee">
	                            <td>@lang('forms.address')</td>
	                            <td><strong>{{ $shop->address }}</strong></td>
	                        </tr>
	                        <tr>
	                            <td>@lang('forms.province')</td>
	                            <td>
	                            @if ($shop->province_id) 
	                                <strong>{{ title_case($shop->getProvince()->name) }}</strong>
	                            @endif
	                            </td>
	                        </tr>
	                        <tr>
	                            <td>@lang('forms.city')</td>
	                            <td>
	                            @if ($shop->city_id)
	                                <strong>{{ title_case($shop->getCity()->name) }}</strong>
	                            @endif
	                            </td>
	                        </tr>
	                        <tr style="border-top: 1px solid #eee">
	                            <td>@lang('forms.work_day')</td>
	                            <td><strong>{{ $shop->getWorkDays() }}</strong></td>
	                        </tr>
	                        <tr>
	                            <td>@lang('forms.work_hour')</td>
	                            <td><strong>{{ $shop->getWorkHours() }}</strong></td>
	                        </tr>
	                        <tr style="border-top: 1px solid #eee">
	                            <td>@lang('forms.note')</td>
	                            <td><strong>{{ $shop->note }}</strong></td>
	                        </tr>
	                    </table>
	                </div>
	                <div class="panel-footer text-right">
	                    <a href="{{ route('shop.edit') }}" class="btn btn-default btn-sm">@lang('actions.edit')</a>
	                </div>
	            </div>
	        
        </div>
    </div>
</div>
@endsection
