@extends('layouts.default')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-background">
                    <img 
                        src="{{ $profile->banner ? Storage::url($profile->banner) : url('images/default/banner.png') }}" 
                        class="img-responsive"
                    >
                </div>
                <div class="panel-body">
                    <img 
                        src="{{ $profile->avatar ? Storage::url($profile->avatar) : url('images/default/avatar.png') }}" 
                        class="img-responsive img-circle img-avatar-lg" alt="{{ Auth::user()->name }}"
                    >
                    <h4>{{ Auth::user()->name }}</h4>
                    <a href="{{ route('profile.customization') }}" class="btn btn-default btn-sm pull-right">@lang('actions.edit')</a>
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
                    <h4>@lang('title.user')</h4>
                    <table class="table table-clean table-striped no-margin-btm">
                        <tr>
                            <td class="col-md-3">@lang('forms.name')</td>
                            <td><strong>{{ Auth::user()->name }}</strong></td>
                        </tr>
                        <tr>
                            <td>@lang('forms.email')</td>
                            <td><strong>{{ Auth::user()->email }}</strong></td>
                        </tr>
                        <tr>
                            <td>@lang('forms.password')</td>
                            <td><a href="{{ route('profile.password') }}" class="btn btn-default btn-sm">@lang('actions.edit') Password</a></td>
                        </tr>
                    </table>
                    <hr>
                    <h4>@lang('title.profile')</h4>
                    <table class="table table-clean table-striped no-margin-btm">
                        <tr>
                            <td class="col-md-3">@lang('forms.province')</td>
                            <td>
                            @if ($profile->province_id) 
                                <strong>{{ ucwords(strtolower($profile->getProvince()->name)) }}</strong>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('forms.city')</td>
                            <td>
                            @if ($profile->city_id)
                                <strong>{{ ucwords(strtolower($profile->getCity()->name)) }}</strong>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('forms.address')</td>
                            <td><strong>{{ $profile->address }}</strong></td>
                        </tr>
                        <tr>
                            <td>@lang('forms.dob')</td>
                            <td><strong>{{ $profile->getDateOfBirth() }}</strong></td>
                        </tr>
                        <tr>
                            <td>@lang('forms.phone')</td>
                            <td><strong>{{ $profile->phone }}</strong></td>
                        </tr>
                        
                    </table>
                </div>
                <div class="panel-footer text-right">
                    <a href="{{ route('profile.edit') }}" class="btn btn-default btn-sm">@lang('actions.edit')</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection