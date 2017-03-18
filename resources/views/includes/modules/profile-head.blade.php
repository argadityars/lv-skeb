<div class="panel panel-default">
    <div class="panel-background">
        <img src="{{ $profile->banner ? Storage::url($profile->banner) : url('images/default/banner.png') }}" class="img-responsive">
    </div>
    <div class="panel-body">
        <img src="{{ $profile->avatar ? Storage::url($profile->avatar) : url('images/default/avatar.png') }}" class="img-responsive img-circle img-avatar-lg" alt="{{ Auth::user()->name }}">
        <h4>{{ Auth::user()->name }}</h4>
        <a href="{{ route('profile.customization') }}" class="btn btn-default btn-sm pull-right">@lang('actions.edit')</a>
    </div>
</div>