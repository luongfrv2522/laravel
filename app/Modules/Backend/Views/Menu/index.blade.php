@extends('Backend::shared.layout')

@section('tittle','Quản trị hệ thống')

@section('styles')
	<link href="easy-tree/skin-win8/ui.easytree.css" rel="stylesheet" class="skins" type="text/css" />
@endsection
@section('title-left', 'Quản lý danh mục')
@php
	$menus = $_data['menus'];
	function showMenusRecursion($menus0, $parent_id = 0, $lvl = 0){
		if($menus0){
			$menus = [];
			foreach($menus0 as $key => $el){
				// Nếu là chuyên mục con thì hiển thị
				if($el->parent_id == $parent_id){
					array_push($menus, $el);
					// Xóa chuyên mục đã lặp
					unset($menus0[$key]);
				}

			} 
			
			if($menus){
				echo('<ul>');
				foreach($menus as $key => $el){
					echo '<li class="">'.htmlspecialchars($el->name);
					showMenusRecursion($menus0, $el->id, $lvl+1);
					echo '</li>';
				}	
				echo('</ul>');
			}
		}	 
	}
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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div id="gender" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
										</label>
										<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" name="gender" value="female"> Female
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
								</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button class="btn btn-primary" type="reset">Reset</button>
									<button type="submit" class="btn btn-success">Submit</button>
								</div>
							</div>

						</form>	
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<br />
						<div id="demo1_menu">
						    {{ showMenusRecursion($menus) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection

@section('scripts')
<script src="easy-tree/jquery.easytree.min.js"></script>
	
<script>
	$(document).ready(function() {
		//#region Tree build

		//#endregion
	});
	//#region Tree evet
	function stateChanged(nodes, nodesJson){
		console.log(nodesJson);
	}
	//
</script>
@endsection