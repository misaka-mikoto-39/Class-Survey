<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> Class Survey </title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">
	<!-- Thanh navbar -->
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Class Survey</a>
			</div>
	
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<!-- Chức năng -->
				<ul class="nav navbar-nav">
					<li><a href="student-manager">Quản lí sinh viên</a></li>
					<li><a href="lecturers-manager">Quản lí giảng viên</a></li>
					<li class="active"><a>Quản lí đánh giá</a></li>
					<li><a href="report">Kết quả đánh giá</a></li>
				</ul>
				<!-- End Chức năng -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Dropdown -->
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->username}} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="change-password">Đổi mật khẩu</a></li>
						<li><a href="logout">Đăng xuất</a></li>
					</ul>
					</li>
					<!-- End dropdown -->
				</ul>
			</div>
		</div>
	</nav>
	<!-- End thanh navbar -->
	



	
	<div class="row">
		<!-- Quản lý Phiếu khảo sát -->
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Phiếu khảo sát</h3>
					</div>
				<div class="panel-body" id='datart'><p>

					<button type="submit" id="addTC" data-toggle="modal" data-target="#addTCModal"><i class="fa fa-plus-square-o fa-lg"></i> Thêm tiêu chí</button>

					<!-- Danh sách tiêu chí mặc định -->
					<ol>
					<b><li>Cơ sở vật chất:</li></b>
					<ul>
					@foreach($tieuchi as $tc)
						@if($tc->status === 'y' && $tc->type === 'coso')
							<li><a class="editTC" id="editTC" data-etcid="{{$tc->id}}" data-etcnd="{{$tc->tieuchi}}" data-etct="{{$tc->type}}"><i class="fa fa-pencil fa-lg"></i></a> <a class="deleteTC" id="deleteTC" data-dtcid="{{$tc->id}}" data-dtcnd="{{$tc->tieuchi}}"><i class="glyphicon glyphicon-remove fa-lg"></i></a> {{$tc->tieuchi}} </li>
						@endif
					@endforeach
					</ul>

					<b><li>Môn học:</li></b>
					<ul>
					@foreach($tieuchi as $tc)
						@if($tc->status === 'y' && $tc->type === 'monhoc')
							<li><a class="editTC" id="editTC" data-etcid="{{$tc->id}}" data-etcnd="{{$tc->tieuchi}}" data-etct="{{$tc->type}}"><i class="fa fa-pencil fa-lg"></i></a> <a class="deleteTC" id="deleteTC" data-dtcid="{{$tc->id}}" data-dtcnd="{{$tc->tieuchi}}"><i class="glyphicon glyphicon-remove fa-lg"></i></a> {{$tc->tieuchi}}</li>
						@endif
					@endforeach
					</ul>

					<b><li>Hoạt động giảng dạy của giáo viên:</li></b>
					<ul>
					@foreach($tieuchi as $tc)
						@if($tc->status === 'y' && $tc->type === 'hdgd')
							<li><a class="editTC" id="editTC" data-etcid="{{$tc->id}}" data-etcnd="{{$tc->tieuchi}}" data-etct="{{$tc->type}}"><i class="fa fa-pencil fa-lg"></i></a> <a class="deleteTC" id="deleteTC" data-dtcid="{{$tc->id}}" data-dtcnd="{{$tc->tieuchi}}"><i class="glyphicon glyphicon-remove fa-lg"></i></a> {{$tc->tieuchi}}</li> 
						@endif
					@endforeach
					</ul>
					</ol>
					<!-- End danh sách tiêu chí -->


					<!-- Delete Tiêu chí modal -->
					<div class="modal fade" id="deleteTCModal" role="dialog">
						<div class="modal-dialog modal-sm">
						    <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Bỏ tiêu chí</h4>
						        </div>

						        <div class="modal-body">
						        	<form id='delete-TC-form' method="POST" >
								        <div class="form-group">
											<label for="deletetcid">Xác nhận</label>
											<p>Tiêu chí: <b id ='deletetcnd'></b><b id ='deletetcid' style="display: none;"></b></p>
										</div>
									</form>	
						        </div>

						        <div class="modal-footer">
						        	<button type="submit" id="deleteTCbtn" class="btn btn-primary align-left">Xác nhận</button>
						        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
						        </div>
						    </div>
						</div>
					</div>
					<!-- End Delete tiêu chí modal -->

					


					<!-- Edit tiêu chí modal-->
					<div class="modal fade" id="editTCModal" role="dialog" style="display: none;">
						<div class="modal-dialog modal-sm">
					   		<div class="modal-content">
					        	<div class="modal-header">
					       		   <button type="button" class="close" data-dismiss="modal">&times;	</button>
					        	   <h4 class="modal-title">Sửa tiêu chí</h4>
					        	</div>
					        	<div class="modal-body">
									<form id="edit-TC-form" method="POST" >
										<div class="form-group">
											<b style="display: none;" id="editTCid"></b>
											<label for="editTCdata">Tiêu chí:</label>
											<input type="text" class="form-control" name="editTCdata" id="editTCdata">
											<li id="editTC-editdata-msg" style="display: none; color: red;"></li>
										</div>
										<div class="form-group">
										<select class="form-control" id="editTCtype">
											<option disabled>Chọn 1 loại</option>
											<option value="coso" id='etcoso'>Cơ sở vật chất</option>
											<option value="monhoc" id='etmonhoc'>Môn học</option>
											<option value="hdgd" id='ethdgd'>Hoạt động giảng dạy của giáo viên</option>
										</select>
										<li id="editTC-edittype-msg" style="display: none; color: red;"></li>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="submit" id="editTCbtn" class="btn btn-primary">Sửa</button>
						        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
						        </div>
					    	</div>
						</div>
					</div>
					<!-- End Edit tiêu chí modal-->



					<!-- Add tiêu chí modal-->
					<div class="modal fade" id="addTCModal" role="dialog" style="display: none;">
					    <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Thêm tiêu chí</h4>
						        </div>


						        <div class="modal-body">
						        	<form id="add-TC-form" method="POST" >

										<div class="form-group">
									      	<select class="form-control" id="TClist">
									      		<option disabled selected>Chọn cách thêm</option>
									        	<option value="addnewtc" >Thêm mới</option>
									        	<option value="selecttcl">Chọn từ danh sách</option>
									     	</select>
									     	<li id="addTC-addtype-msg" style="display: none; color:red;"></li>
										</div>

										<!-- Chọn từ danh sách -->
										<div class="form-group" id="selecttcldiv" style="display: none;">
											<p><b>Chọn từ danh sách:</b></p>
											<select class="form-control" id="TCselect">
												<option selected disabled>Chọn 1 tiêu chí</option>
												<option disabled>1. Cơ sở vật chất</option>
												@foreach($tieuchi as $tc)
												@if($tc->status === 'n' && $tc->type ==='coso')
													<option value="{{$tc->id}}">&emsp;{{$tc->tieuchi}}</option>
												@endif
												@endforeach
												<option disabled>2. Môn học</option>
												@foreach($tieuchi as $tc)
												@if($tc->status === 'n' && $tc->type ==='monhoc')
													<option value="{{$tc->id}}">&emsp;{{$tc->tieuchi}}</option>
												@endif
												@endforeach

												<option disabled>3. Hoạt động giảng dạy</option>
												@foreach($tieuchi as $tc)
												@if($tc->status === 'n' && $tc->type ==='hdgd')
													<option value="{{$tc->id}}">&emsp;{{$tc->tieuchi}}</option>
												@endif
												@endforeach
											</select>
											<li id="addTC-adddata-msg1" style="display: none; color:red;"></li>
										</div>
										<!-- End Chọn từ danh sách -->

										<!-- Thêm mới -->
										<div class="form-group" id="addnewtcdiv" style="display: none;">
											<p><b>Nội dung tiêu chí:</b></p>
											<input type="text" class="form-control" name="addnewtcnd" id="addnewtcnd">
											<li id="addTC-adddata-msg2" style="display: none; color:red;"></li>
											<p><b>Loại tiêu chí:</b></p>
											<select class="form-control" id="addTCtype">
												<option selected disabled>Chọn 1 loại</option>
												<option value="coso">Cơ sở vật chất</option>
												<option value="monhoc">Môn học</option>
												<option value="hdgd">Hoạt động giảng dạy của giáo viên</option>
											</select>
											<li id="addTC-addtctype-msg" style="display: none; color:red;"></li>
										</div>
										<!-- End Thêm mới -->
									</form>	
								</div>
								<div class="modal-footer">
							        <button type="submit" id="addTCbtn" class="btn btn-primary">Thêm</button>
							        <button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
							    </div>
										
							</div>
						</div>
					</div>
					<!-- End Add tiêu chí modal-->







				</p></div>
			</div>
		</div>
		<!-- End Quản lý Phiếu khảo sát -->



		<!-- Quản lý lớp môn học -->
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Danh sách lớp khảo sát</h3>
				</div>
				<div class="panel-body"><p>
					<button data-toggle="modal" data-target="#uploadModal" id="upload"><i class="glyphicon glyphicon-upload"></i> Tải lên lớp môn học</button>


					<!-- Upload lớp môn học -->
					<div class="modal fade" id="uploadModal" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
							    <div class="modal-header">
							     	<button type="button" class="close" data-dismiss="modal">&times;</button>
						        	<h4 class="modal-title">Tải lên lớp môn học mới</h4>
						        </div>
							    <form id='upload-form' class="was-validated" method="POST" >
							       	<div class="modal-body">
						       			<div class="form-group">
						       				<label for="inputfile">Chọn file (xls, xlsx):</label>
											<input type="file" class="custom-file-input" name="inputfile" id="inputfile">
											<li id="input-file-msg" style="display: none; color: red;"></li>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" name="uploadList" id="uploadList" class="btn btn-primary ">Tải lên</button>
							        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
							        </div>
							    </form>
							</div>
						</div>
					</div>
					<!-- End Upload lớp môn học -->



					
					<!-- Danh sách lớp môn học -->
					<table class="table table-bordered table-hover" id="lmh-table">
						<thead>
							<td align="center" style="width: 6em;"><b>Mã lớp</b></td>
							<td align="center" style="width: 10em;"><b>Học kỳ</b></td>
							<td align="center"><b>Tên môn học</b></td>
							<td align="center"><b>Giảng viên</b></td>
							<td align="center" style="width: 10em;"><i class="glyphicon glyphicon-cog"></i></td>
						</thead>
						<tbody>
							@foreach($lopmonhoc as $lmh)
							<tr class="data-row odd gradeX" align="center" id='lmhs'>

								<td>{{$lmh->malop}}</td>
								<td>{{$lmh->hocky}}</td>
								<td>{{$lmh->tenmonhoc}}</td>
								<td>{{$lmh->giangvien}}</td>

								<td class="center">
									<button class="editLopMonHoc" id="editLopMonHoc" data-malop='{{$lmh->malop}}' data-hocky='{{$lmh->hocky}}' data-tenmonhoc='{{$lmh->tenmonhoc}}' data-giangvien='{{$lmh->giangvien}}'><i class="fa fa-pencil fa-fw"></i></button>

									<button class="stlist" id="stlist" data-malop='{{$lmh->malop}}' data-listid='{{$lmh->id}}' data-idgv="{{$lmh->giangvien}}"><i class="fa fa-list fa-fw"></i></button>

									<button class='deleteLMH' id="deleteLMH" data-malop='{{$lmh->malop}}' data-hocky='{{$lmh->hocky}}'><i class="fa fa-trash-o fa-fw"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<!-- End Danh sách lớp môn học -->


					<!-- Delete lớp môn học -->
					<div class="modal fade" id="deleteLMHModal" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
							    <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">Xoá lớp môn học</h4>
							    </div>
							    <div class="modal-body">
							        <form id='delete-LopMonHoc-form' method="POST" >
								        <div class="form-group">
											<label for="deletelmhid">Xác nhận xoá</label>
											<p>Mã lớp: <b id ='deletelmhid'></b></p>
											<p>Học kỳ: <b id ='deletelmhhk'></b></p>
										</div>
									</form>
						        </div>
						        <div class="modal-footer">
						        	<button type="submit" id="deleteLop" class="btn btn-primary align-left">Xoá</button>
						        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
						        </div>
						    </div>
					    </div>
					</div>
					<!-- End Delete lớp môn học -->





					<!-- Danh sách sinh viên modal -->
					<div class="modal fade" id="stlistModal" role="dialog" style="display: none;">
					    <div class="modal-dialog">
						    <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Mã lớp: <b id ='stlistmalop'></b></h4>
						          <h4 class="modal-title">Giảng viên: <b id ='stlistgiangvien'></b></h4>
						        </div>


						        <div class="modal-body" id=''>
						        	<table class="table table-bordered table-hover" id="lmh-table">
										<thead>
											<td align="center" style="width: 1em;"><b>STT</b></td>
											<td align="center" style="width: 9em;"><b>Mã sinh viên</b></td>
											<td align="center" style="width: 17em;"><b>Họ tên</b></td>
											<td align="center"><b>Lớp khoá học</b></td>
										</thead>
										<tbody id='ttsv' style="display: none">
										</tbody>
									</table>
						        </div>
						        <div class="modal-footer">
							        <button type="button" class="btn btn-default align-right" data-dismiss="modal">Đóng</button>
							    </div>
						    </div>
						</div>
					</div>
					<!-- End Danh sách sinh viên modal -->





					<!-- Edit lớp môn học -->
					<div class="modal fade" id="editLopMonHocModal" role="dialog" style="display: none;">
					    <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Mã lớp: <b id ='editmalop'></b> <b id ='oldhocky'></b></h4>
						        </div>
						        <div class="modal-body">
						        	<form id="edit-LopMonHoc-form" method="POST" >

										<div class="form-group">
											<label for="edithocky">Học kỳ:</label>
											<input type="text" class="form-control" name="edithocky" id="edithocky">
											<li id="edit-hocky-msg" style="display: none; color: red;"></li>
										</div>

										<div class="form-group">
											<label for="edittenmonhoc">Tên môn học:</label>
											<input type="text" class="form-control" name="edittenmonhoc" id="edittenmonhoc">
											<li id="edit-tenmonhoc-msg" style="display: none; color: red;"></li>
										</div>

										<div class="form-group">
											<label for="editgiangvien">Giảng viên:</label>
											<input type="text" class="form-control" name="editgiangvien" id="editgiangvien">
											<li id="edit-giangvien-msg" style="display: none; color: red;"></li>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="submit" id="editLMH" class="btn btn-primary">Sửa</button>
						        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
						        </div>
						        
							</div>
						</div>
					</div>
					<!-- End Edit lớp môn học -->
				</p></div>
			</div>
		</div>
		<!-- End Quản lý lớp môn học -->
		
	</div>
</div>

<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

</body>



<script>

	// Tạo datatable
	$(document).ready(function() {
	    $('#lmh-table').DataTable();
	} );

	// Delete tiêu chí
	$(function(){
		$('#deleteTCbtn').click(function(e){
 			e.preventDefault();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					deleteid: $('#deletetcid').text()
			};

			$.ajax({
				url : 'survey-manager/deleteTC',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
					}
					else{
						window.location.href = "/survey-manager";
						window.alert('Bỏ tiêu chí thành công');
					}
				}
			})
 		})
	})


	// Mở Delete tiêu chí modal
	$(document).ready(function() {
  		$('.deleteTC').click(function(){
		   	$(this).addClass('deleteTC-item-trigger-clicked');

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#deleteTCModal').modal(options);

  		})
  		
  		// on show modal
  		$('#deleteTCModal').on('show.bs.modal', function() {
		    var el = $(".deleteTC-item-trigger-clicked"); 
		    var row = el.closest(".data-row");

		    var id = el.data('dtcid');
		    var tc = el.data('dtcnd');

		    $("#deletetcid").text(id);
		    $("#deletetcnd").text(tc);
		})

  		// on hide modal
		$('#deleteTCModal').on('hide.bs.modal', function() {
    		$('.deleteTC-item-trigger-clicked').removeClass('deleteTC-item-trigger-clicked');
   		 	$("#delete-TC-form").trigger("reset");
   		})

  	})


	// Edit tiêu chí
	$(function(){
		$('#editTCbtn').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					tcid: $('#editTCid').text(),
					tcnd: $('#editTCdata').val(),
					tct: $('#editTCtype').val()
			};
			$.ajax({
				url : 'survey-manager/editTC',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					$("#editTC-editdata-msg").hide();
					$("#editTC-edittype-msg").hide();
					if(data.error == true){
						
						if(data.message.tcid != undefined){
							//$("#usernamemsg").hide()
							$("#editTC-editdata-msg").show().text(data.message.tcid[0]);
						}
						if(data.message.tcnd != undefined){
							//$("#passwordmsg").hide()
							$("#editTC-editdata-msg").show().text(data.message.tcnd[0]);
						}
						if(data.message.tct != undefined){
							//$("#passwordmsg").hide()
							$("#editTC-edittype-msg").show().text(data.message.tct[0]);
						}
					}
					else{
						window.location.href = "/survey-manager";
						window.alert('Sửa tiêu chí thành công');
					}
				}
			})
		})
	})




	// Mở Edit tiêu chí modal
	$(document).ready(function() {
  		$('.editTC').click(function(){
		   	$(this).addClass('editTC-item-trigger-clicked'); 

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#editTCModal').modal(options);

  		})
  		
  		//on show modal
  		$('#editTCModal').on('show.bs.modal', function() {
		    var el = $(".editTC-item-trigger-clicked"); 
		    var row = el.closest(".data-row");

		    
		    var id = el.data('etcid');
		    var tc = el.data('etcnd');
		    var type = el.data('etct');

		    if(type == 'coso'){
		    	$('#etcoso').prop('selected', true);
		    }else if(type == 'monhoc'){
		    	$('#etmonhoc').prop('selected', true);
		    }else if(type == 'hdgd'){
		    	$('#ethdgd').prop('selected', true);
		    }

		    $("#editTCid").text(id);
		    $("#editTCdata").val(tc);
		   
		})

		//on hide modal
		$('#editTCModal').on('hide.bs.modal', function() {
    		$('.editTC-item-trigger-clicked').removeClass('editTC-item-trigger-clicked');
    		$("#editTC-editdata-msg").hide();
   		 	$("#edit-TC-form").trigger("reset");
   		})

  	})
	



	// Add tiêu chí
	$(function(){
		$('#addTCbtn').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var formData;

			if ($('#TClist').val() === 'addnewtc') {
				formData = {
					addtype : 'addnew',
					adddata : $("#addnewtcnd").val(),
					addtctype : $("#addTCtype").val()
				};
		    }else if($('#TClist').val() === 'selecttcl'){
		    	formData = {
					addtype : 'select',
					adddata : $("#TCselect").val(),
					addtctype : 'no'
				};
		    }else{
		    	formData = {
					addtype : 'no',
					adddata : 'no',
					addtctype : 'no'
				};
		    }

		    $.ajax({
				url : 'survey-manager/addTC',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					$("#addTC-addtype-msg").hide();
					$("#addTC-adddata-msg1").hide();
					$("#addTC-adddata-msg2").hide();
					$("#addTC-addtctype-msg").hide();
					if(data.error == true){
						
						if(data.message.addtype != undefined){
							$("#addTC-addtype-msg").show().text(data.message.addtype[0]);
						}
						if(data.message.addtctype != undefined){
							$("#addTC-addtctype-msg").show().text(data.message.addtctype[0]);
						}
						if(data.message.adddata != undefined){
							$("#addTC-adddata-msg1").show().text(data.message.adddata[0]);
							$("#addTC-adddata-msg2").show().text(data.message.adddata[0]);
						}
					}
					else{
						window.location.href = "/survey-manager";
						window.alert('Thêm tiêu chí thành công');
					}
				}
			})

		})
	})



	//on change tiêu chí list
	$('#TClist').change(function() {
		$('#addTC-addtype-msg').hide();
		$("#addTC-adddata-msg1").hide();
		$("#addTC-adddata-msg2").hide();
	    if ($(this).val() === 'addnewtc') {
	    	$('#selecttcldiv').hide();
	        $('#addnewtcdiv').show();
	    }else if($(this).val() === 'selecttcl'){
	    	$('#addnewtcdiv').hide();
	    	$('#selecttcldiv').show();
	    }else{
	    	$('#addnewtcdiv').hide();
	    	$('#selecttcldiv').hide();
	    }	 
	});


	// on hide Add tiêu chí modal
	$(document).ready(function() {
		$('#addTCModal').on('hide.bs.modal', function() {
    		$('.addTC-item-trigger-clicked').removeClass('addTC-item-trigger-clicked');
    		$('#addnewtcdiv').hide();
	    	$('#selecttcldiv').hide();
	    	$('#addTC-addtype-msg').hide();
   		 	$("#add-TC-form").trigger("reset");
   		})

  	})



  	//Delete lớp môn học
	$(function(){
		$('#deleteLop').click(function(e){
 			e.preventDefault();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					deleteid: $('#deletelmhid').text(),
					deletehk: $('#deletelmhhk').text()
			};

			$.ajax({
				url : 'survey-manager/deleteLMH',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
					}
					else{
						window.location.href = "/survey-manager";
						window.alert('Xoá lớp môn học thành công');
					}
				}
			})
 		})
	})



	// Mở delete lớp môn học modal
	$(document).ready(function() {
  		$('.deleteLMH').click(function(){
		   	$(this).addClass('delete-item-trigger-clicked'); 

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#deleteLMHModal').modal(options);

  		})
  		

  		//on show modal
  		$('#deleteLMHModal').on('show.bs.modal', function() {
		    var el = $(".delete-item-trigger-clicked"); 
		    var row = el.closest(".data-row");

		    var id = el.data('malop');
		    var hk = el.data('hocky');

		    $("#deletelmhid").text(id);
		    $("#deletelmhhk").text(hk);
		})


		//on hide modal
		$('#deleteLMHModal').on('hide.bs.modal', function() {
    		$('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked');
   		 	$("#delete-LopMonHoc-form").trigger("reset");
   		})

  	})


  	// Mở danh sách sinh viên modal
	$(document).ready(function() {
  		$('.stlist').click(function(){
		   	$(this).addClass('stlist-item-trigger-clicked'); 

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#ttsv').hide();
		    $('#stlistModal').modal(options);

  		})


  		// on show modal
  		$('#stlistModal').on('show.bs.modal', function() {
		    var el = $(".stlist-item-trigger-clicked"); 
		    var row = el.closest(".data-row");

		    var id = el.data('malop');

		    $("#stlistmalop").text(id);

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var formData = {
					listid : el.data('listid'),
					idgv : el.data('idgv')
			};

			$.ajax({
				url : 'survey-manager/rqStList',
				data : formData,
				type : 'POST',
				success : function (data){
					$('#stlistgiangvien').text(data.giangvien);
					$('#ttsv').show();
					$count = 0;
					$.each(data.dssv, function(i){
						$('#ttsv').append("<tr class='stlist-data'><td>"+ ++$count + "</td><td>" + data.dssv[i][0] + "</td><td>" + data.dssv[i][1] + "</td><td>" + data.dssv[i][2] + "</td></tr>");
					})
				}
			})


		})


		// on hide modal
		$('#stlistModal').on('hide.bs.modal', function() {
    		$('.stlist-item-trigger-clicked').removeClass('stlist-item-trigger-clicked');
    		$('#ttsv').hide();
   		 	$(".stlist-data").remove();
   		})

  	})



	// Mở edit lớp môn học modal
	$(document).ready(function() {

		$('.editLopMonHoc').click(function(){
	 	  	 $(this).addClass('edit-item-trigger-clicked'); 

	 	   var options = {
		      'backdrop': 'static'
		    };
		    $('#editLopMonHocModal').modal(options);

		 })


	    // on show modal
		$('#editLopMonHocModal').on('show.bs.modal', function() {
		    var el = $(".edit-item-trigger-clicked");  
		    var row = el.closest(".data-row");

		    
		    var malop = el.data('malop');
		    var hocky = el.data('hocky');
		    var tenmonhoc = el.data('tenmonhoc');
		    var giangvien = el.data('giangvien');


		    $("#editmalop").text(malop);
		    $("#edithocky").val(hocky);
		    $("#oldhocky").text(hocky);
		    $("#edittenmonhoc").val(tenmonhoc);
		    $("#editgiangvien").val(giangvien);
		    $("#oldhocky").hide();
		})

	    // on hide modal
	    $('#editLopMonHocModal').on('hide.bs.modal', function() {
		    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked');
		    $("#edit-malop-msg").hide();
			$("#edit-hocky-msg").hide();
			$("#edit-tenmonhoc-msg").hide();
			$("#edit-giangvien-msg").hide();
		    $("#edit-LopMonHoc-form").trigger("reset");
	    })
	})


	//Edit lớp môn học
	$(function(){
		$('#editLMH').click(function(e){
			e.preventDefault();

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var formData = {
					editmalop : $('#editmalop').text(),
					oldhocky : $('#oldhocky').text(),
					edithocky : $('#edithocky').val(),
					edittenmonhoc : $('#edittenmonhoc').val(),
					editgiangvien : $('#editgiangvien').val(),
			};

			$.ajax({
				url : 'survey-manager/editlmh',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					$("#edit-malop-msg").hide();
					$("#edit-hocky-msg").hide();
					$("#edit-tenmonhoc-msg").hide();
					$("#edit-giangvien-msg").hide();
					if(data.error == true){
						
						if(data.message.editmalop != undefined){
							//$("#usernamemsg").hide()
							$("#edit-malop-msg").show().text(data.message.editmalop[0]);
						}
						if(data.message.edithocky != undefined){
							//$("#passwordmsg").hide()
							$("#edit-hocky-msg").show().text(data.message.edithocky[0]);
						}
						if(data.message.edittenmonhoc != undefined){
							//$("#passwordmsg").hide()
							$("#edit-tenmonhoc-msg").show().text(data.message.edittenmonhoc[0]);
						}
						if(data.message.editgiangvien != undefined){
							//$("#passwordmsg").hide()
							$("#edit-giangvien-msg").show().text(data.message.editgiangvien[0]);
						}
					}
					else{
						window.location.href = "/survey-manager";
						window.alert('Thay đổi thông lớp môn học thành công');
					}
				}
			})
		})
	})


	//on hide upload lớp môn học modal
	$(document).ready(function() {
		$('#uploadModal').on('hide.bs.modal', function() {
			$('#input-file-msg').hide();
	    	$("#upload-form").trigger("reset");
	 	})
	})


	//Upload lớp môn học
	$(function(){
		$('#upload-form').submit(function(e){
			e.preventDefault();
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			})
			var dataForm = {
				file : $('#inputfile').val()
			}
        	$.ajax({
				url : 'survey-manager/upload',
				data : new FormData(this),
				type : 'POST',
				dataType: 'JSON',
				contentType: false,
				processData: false,
				success : function (data){
					
					console.log(data);
					if(data.error == true){
						$('#input-file-msg').show().text(data.message);
					}else{
						window.location.href = "/survey-manager";
						window.alert('Thêm lớp môn học thành công');
					}
				}
					
			});
		})
	})
</script>


</html>
