@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('actions.edit')</div>
                <div class="panel-body">

                    {!! Form::open(['route' => ['shop.customization'], 'class' => 'form-horizontal', 'files' => true]) !!}
                        
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            {{ Form::label('photo', trans('forms.photo'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::file('photo', ['class' => 'form-control', 'accept' => '.jpeg, .jpg, .png']) }}

                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
                            {{ Form::label('banner', trans('forms.banner'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::file('banner', ['class' => 'form-control', 'accept' => '.jpeg, .jpg, .png']) }}

                                @if ($errors->has('banner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('banner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                {{ Form::submit(trans('actions.save'), ['class' => 'btn btn-info']) }}
                                <a href="{{ route('shop.index') }}" class="btn btn-default">@lang('actions.cancel')</a>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

