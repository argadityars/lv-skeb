@extends('layouts.default')

@section('title', 'Shop')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
	        	
	            @include('includes.modules.shop-head')

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
