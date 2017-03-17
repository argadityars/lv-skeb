@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('actions.edit')</div>
                <div class="panel-body">

                    {!! Form::open(['route' => ['profile.password'], 'class' => 'form-horizontal']) !!}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', trans('forms.password-old'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::password('password', ['class' => 'form-control']) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('password-new') ? ' has-error' : '' }}">
                            {{ Form::label('password-new', trans('forms.password-new'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::password('password-new', ['class' => 'form-control']) }}

                                @if ($errors->has('password-new'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password-new') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password-new-confirm') ? ' has-error' : '' }}">
                            {{ Form::label('password-new-confirm', trans('forms.password-confirm'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::password('password-new_confirmation', ['class' => 'form-control']) }}

                                @if ($errors->has('password-new-confirm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password-new-confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                {{ Form::submit(trans('actions.save'), ['class' => 'btn btn-info']) }}
                                <a href="{{ route('profile.index') }}" class="btn btn-default">@lang('actions.cancel')</a>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
