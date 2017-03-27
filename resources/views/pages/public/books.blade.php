@extends('layouts.default')

@section('title', 'Books')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					{!! Form::open(['url' => 'books', 'method' => 'GET', 'id' => 'filter-form']) !!}

						<div class="form-group">
							{{ Form::label('q', trans('forms.search')) }}
							{{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('forms.search')]) }}
						</div>

						<div class="form-group">
							{{ Form::label('category_id', trans('forms.category')) }}
							{{ Form::select('category_id', $categories, null, ['placeholder' => trans('forms.category').'...', 'class' => 'form-control', 'id' => 'category_id']) }}
						</div>

						<div class="form-group">
							{{ Form::label('subcategory_id', trans('forms.subcategory')) }}
							{{ Form::select('subcategory_id', $subcategories, null, ['placeholder' => trans('forms.subcategory').'...', 'class' => 'form-control', 'id' => 'subcategory_id']) }}
						</div>

						<div class="form-group">
                                {{ Form::submit(trans('actions.filter'), ['class' => 'btn btn-info btn-block']) }}
                        </div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="col-md-9">
			
			<div class="row">
				@foreach($products as $product)
					<a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="col-md-3">
						<img class="img-responsive" src="{{ Storage::url($product->productImages[0]->name) }}"></img>
						<h4 title="{{ $product->name }}">{{ str_limit($product->name, 15) }}</h4>
						<p>Rp {{ $product->price }}</p>
					</a>
				@endforeach
			</div>

			<center>{{ $products->links() }}</center>

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
@endsection