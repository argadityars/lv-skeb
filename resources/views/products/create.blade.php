@extends('layouts.default')

@section('title', 'Product')
@section('top_script')
<style type="text/css">
.thumbnail{
    height: 100px;
    margin: 10px 10px 10px 0;
}

#files {
  display:block;
}

.img-container {
  display: inline-block;
}

.inputfile {
  width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    color: #000;
    background-color: #d5d5d5;
    display: inline-block;
    padding: 5px 10px;
    border-radius: 3px;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: rgba(0, 0, 0, 0.2);
}

.inputfile + label {
    cursor: pointer; /* "hand" cursor */
}

#result {
  display: block;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('actions.create')</div>
                <div class="panel-body">

                    {!! Form::open(['route' => ['product.store'], 'class' => 'form-horizontal', 'id' => 'product-form', 'files' => true]) !!}
                        
                    	<div class="form-group{{ $errors->has('photos') ? ' has-error' : '' }}">
                            {{ Form::label('photos', trans('forms.photos'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                <input id="files" class="inputfile" name='photos[]' type="file" multiple/>
                                <label for="files" class="btn btn-default">Select Images</label>
                                <output id="result" />

                                @if ($errors->has('photos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photos') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

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

                        <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                            {{ Form::label('author', trans('forms.author'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::text('author', null, ['class' => 'form-control']) }}

                                <span class="help-block">{{ trans('forms.author_helper') }}</span>
                                @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            {{ Form::label('category_id', trans('forms.category'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::select('category_id', $categories, null, ['placeholder' => trans('forms.category').'...', 'class' => 'form-control', 'id' => 'category_id']) }}

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                            {{ Form::label('subcategory_id', trans('forms.subcategory'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::select('subcategory_id', $subcategories, null, ['placeholder' => trans('forms.subcategory').'...', 'class' => 'form-control', 'id' => 'subcategory_id']) }}

                                @if ($errors->has('subcategory_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subcategory_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            {{ Form::label('price', trans('forms.price'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
	                            <div class="input-group">
									<span class="input-group-addon">Rp</span>
									{{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price']) }}
								</div>

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
                            {{ Form::label('condition', trans('forms.condition'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::select('condition', ['Baru' => 'Baru', 'Bekas' => 'Bekas'], null, ['placeholder' => trans('forms.condition').'...', 'class' => 'form-control', 'id' => 'condition']) }}

                                @if ($errors->has('condition_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('condition_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            {{ Form::label('weight', trans('forms.weight'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                            	<div class="input-group">
									{{ Form::text('weight', null, ['class' => 'form-control']) }}
									<span class="input-group-addon">Gram</span>
								</div>

                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('synopsis') ? ' has-error' : '' }}">
                            {{ Form::label('synopsis', trans('forms.synopsis'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::textarea('synopsis', null, ['class' => 'form-control', 'rows' => '4']) }}

                                @if ($errors->has('synopsis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('synopsis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                            {{ Form::label('notes', trans('forms.notes'), ['class' => 'col-md-3 control-label']) }}

                            <div class="col-md-6">
                                {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '2']) }}

                                @if ($errors->has('notes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                {{ Form::submit(trans('actions.save'), ['class' => 'btn btn-info']) }}
                                <a href="{{ route('product.index') }}" class="btn btn-default">@lang('actions.cancel')</a>
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
        var category_id = $('#category_id').val();

        if (category_id) {
            if (!$('#subcategory_id').val()) {
                getSubcategories();
            } 
        } else {
            $('#subcategory_id').prop('disabled', true);
        }
    });

    $('#category_id').on('change', function(){
        getSubcategories();
    });

    function getSubcategories(){
        var category_id = $('#category_id').val();

        $.get('{{ url('api/subcategory') }}/' + category_id, function(data) {
            //console.log(data);
            $('#subcategory_id').empty();
            $('#subcategory_id').prop('disabled', false);
            $('#subcategory_id').append('<option value="">{{ trans('forms.subcategory').'...' }}</option>');
            $.each(data, function(index,subCatObj){
                $('#subcategory_id').append('<option value="'+ index +'">'+subCatObj+'</option>');
            });
        });
    }
</script>
<script type="text/javascript">
    window.onload = function(){
        
        //Check File API support
        if(window.File && window.FileList && window.FileReader)
        {
            var filesInput = document.getElementById("files");
            
            filesInput.addEventListener("change", function(event){
                
                var files = event.target.files; //FileList object
                var output = document.getElementById('result');
                output.innerHTML = "";
                
                if (files.length > 3) {
                
                    filesInput.value = "";
                    output.innerHTML = "<span class='help-block' style='color:red'><strong>Max 3 files</strong></span>";
                  
                } else {
                    
                  //filesInput.className += 'transparent';
                  
                    for(var i = 0; i< files.length; i++)
                  {
                      var file = files[i];

                      //Only pics
                      if(!file.type.match('image'))
                        continue;

                      var picReader = new FileReader();

                      picReader.addEventListener("load",function(event){

                          var picFile = event.target;

                          var div = document.createElement("div");
                          div.className += 'img-container';

                          div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                                  "title='" + picFile.name + "'/>";

                          output.insertBefore(div,null);            

                      });

                       //Read the image
                      picReader.readAsDataURL(file);
                  }
                
                
                }                               
               
            });
        }
        else
        {
            console.log("Your browser does not support File API");
        }
    }
        
</script>
@endsection