@extends('layouts.default')

@section('title', 'Shop')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('actions.create')</div>
                <div class="panel-body">

                    {!! Form::open(['route' => ['shop.store'], 'class' => 'form-horizontal']) !!}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', trans('forms.name'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::text('name', null, ['class' => 'form-control']) }}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tagline') ? ' has-error' : '' }}">
                            {{ Form::label('tagline', trans('forms.tagline'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::text('tagline', null, ['class' => 'form-control']) }}

                                @if ($errors->has('tagline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tagline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('forms.email'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::text('email', null, ['class' => 'form-control']) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <hr>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            {{ Form::label('address', trans('forms.address'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => '2']) }}

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('province_id') ? ' has-error' : '' }}">
                            {{ Form::label('province_id', trans('forms.province'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::select('province_id', $provinces, null, ['placeholder' => trans('forms.province').'...', 'class' => 'form-control', 'id' => 'province_id']) }}

                                @if ($errors->has('province_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('province_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                            {{ Form::label('city_id', trans('forms.city_id'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::select('city_id', $cities, null, ['placeholder' => trans('forms.city').'...', 'class' => 'form-control', 'id' => 'city_id', $shop->city_id ? '' : 'disabled']) }}

                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
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

@section('bottom_script')
<script>
    $(document).ready(function(){
        var province_id = $('#province_id').val();

        if (province_id) {
            if (!$('#city_id').val()) {
                getCity();
            } 
        } else {
            $('#city_id').prop('disabled', true);
        }
    });

    $('#province_id').on('change', function(){
        getCity();
    });

    function getCity(){
        var province_id = $('#province_id').val();

        $.get('{{ url('api/city') }}/' + province_id, function(data) {
            //console.log(data);
            $('#city_id').empty();
            $('#city_id').prop('disabled', false);
            $('#city_id').append('<option value="">{{ trans('forms.city').'...' }}</option>');
            $.each(data, function(index,subCatObj){
                $('#city_id').append('<option value="'+ index +'">'+subCatObj+'</option>');
            });
        });
    }
</script>
@endsection