@extends('Backend::shared.layout')

@section('tittle','Quản trị hệ thống')

@section('styles')
	<link rel="stylesheet" href="js-tree/themes/default/style.min.css">
@endsection
@section('title-left', 'Quản lý danh mục')
@php
	$menusOptions = $_data['menusOptions'];
	
@endphp
@section('body')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Chỉnh sửa danh mục <small>Thực hiện các chỉnh sửa danh mục</small></h2>
				
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<br />
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12">
						<form id="menu-form" data-parsley-validate class="form-horizontal form-label-left">
							<input id="id" hidden>
							<div class="form-group">
								<label class="required control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tên danh mục
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" id="name" name="name" required="required" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="middle-name" class="required control-label col-md-3 col-sm-3 col-xs-12">Cấp cha</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select name="parent_id" id="parent_id" class="form-control col-md-7 col-xs-12">
										<option value="0">Chọn</option>
										{!! $menusOptions !!}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Route
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" id="route" name="route" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Icon</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
									<input id="icon_class" class="form-control has-feedback-left" type="text" name="icon_class">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<button type="submit" value="add" class="btn btn-primary">Thêm mới</button>
									<button type="reset" class="btn btn-primary">Nhập lại</button>
									<button type="submit" value="update" class="btn btn-success">Cập nhật</button>
								</div>
							</div>

						</form>	
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<br />
						<div id="demo1_menu" style="border: 1px solid;">
						    
						</div>
						<div class="ln_solid"></div>
						<button type="button" value="delete" class="btn btn-success">Xóa</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection

@section('scripts')
<script src="js-tree/jstree.min.js"></script>
	
<script>
	$(document).ready(function() {
		$('button[value="delete"]').click(function(event) {
			let uri = '{{route('menu.delete',':id')}}';
			let id = $('#id').val();
			let name = $('#name').attr('origin');
			if(id > 0){
				let flag = confirm(`Bạn chắc chắn muốn xóa danh mục: ${ name }?`);
				uri = uri.replace(':id',id);
				if(flag){
					$.get(uri,function(data){
						console.log(data.message);
						window.location.reload();
					});
				}
			}
		});
		$('#menu-form').submit(function(){
			event.preventDefault();
			let data = {
				"_token": "{{ csrf_token() }}",
				id : $('#id').val(),
				name : $('#name').val().trim(),
				route: $('#route').val().trim(),
				parent_id : $('#parent_id').val(),
				icon_class : $('#icon_class').val().trim()
			}

			let url = '{{ route('menu.add') }}'
			if(this.value === 'update')	url = '{{ route('menu.update') }}';
			$.ajax({
				url : url,
				contentType : 'application/json',
				method : 'post',
				data : JSON.stringify(data),
				success : function(data){
					console.log(data.message);
				},
				error : function(err){
					console.log(err);
				},
				complete : function(){
					//$('#demo1_menu').jstree(true).refresh();
					window.location.reload();
				}
			});
		});
		//#region Thay đổi icon khi thay đổi class fontanwesome
		$('#icon_class').change(function(event) {
			let span = $(this).siblings('span');
			span.removeClass();
			span.addClass(this.value);
			span.addClass('form-control-feedback left');
		});
		//endregion
		//#region Tree build
		$('#demo1_menu').jstree({
			'core' : {
				'multiple' : false,
				'data' : {
					"url" : "{{ route('menu.json-menu') }}",
					"dataType" : "json" // needed only if you do not supply JSON headers
				}
			}
		}).on("changed.jstree", function (e, data) {
			if(data.selected.length) {
				callChangeInfoAjax(data.node);
			}
		});

		//#endregion
	});
	//#region Tree evet
	function callChangeInfoAjax(node){
		//console.log(node);
		$('#id').val(node.id);
		$('#name').val(node.text);
		$('#name').attr('origin',node.text);
		$('#route').val(node.data.url);
		$('#icon_class').val(node.data.icon_class);
		$('#icon_class').trigger('change');
		$('#parent_id').val(node.parent);
	}
	//
</script>
@endsection