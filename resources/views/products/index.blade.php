@extends('layouts.default')

@section('title', 'Product')

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

	                    <table class="table table-clean table-striped table-divided no-margin-btm" id="products">
	                    	@foreach ($products as $product)
	                        <tr class="item{{$product->slug}}">
	                        	<td class="col-md-1"><img src="{{ Storage::url($product->productimages[0]->name) }}" class="img-responsive"></td>
	                            <td class="col-md-8">
	                            	{{ $product->name }} <span class="label {{ $product->condition == 'Baru' ? 'label-primary' : 'label-success' }}">{{ $product->condition }}</span><br>
	                            	<span class="text-muted"><small>
	                            	<span style="padding-right: 20px;">@lang('forms.category'): {{ $product->category }}</span>@lang('forms.subcategory'): {{ $product->subcategory }}</small></span>
	                            </td>
	                            <td class="col-md-2" style="vertical-align: middle;">
	                            	<div class="btn-group pull-right" role="group" aria-label="actions">
										<a href="{{ url('product/edit', $product->slug) }}" class="btn btn-default btn-sm">@lang('actions.edit') Buku</a>
										<button class="delete-modal btn btn-danger btn-sm" data-id="{{$product->slug}}" data-name="{{$product->name}}">x</button>
									</div>
	                            </td>
	                        </tr>
	                        @endforeach
	                    </table>
	                </div>
	            </div>
	        	<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
								<div class="deleteContent">
									Are you sure you want to delete <span class="dname"></span> ? <span class="hidden did"></span>
								</div>
							</div>
							<div class="modal-footer">
									<button type="button" class="btn actionBtn" data-dismiss="modal">
										<span id="footer_action_button"> </span>
									</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
						</div>
					</div>
				</div>
        </div>
    </div>
</div>
@endsection

@section('bottom_script')
<script>
$(document).on('click', '.delete-modal', function() {
    $('#footer_action_button').text('Delete');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete');
    $('.did').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.dname').html($(this).data('name'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function() {
    $.ajax({
        type: 'delete',
        url: 'product/delete/'+ $('.did').text(),
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function(data) {
            $('.item' + $('.did').text()).remove();
        }
    });
});
</script>
@endsection