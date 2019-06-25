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
						<li class="active"><a>Quản lí sinh viên</a></li>
						<li><a href="lecturers-manager">Quản lí giảng viên</a></li>
						<li><a href="survey-manager">Quản lí đánh giá</a></li>
						<li><a href="report">Kết quả đánh giá</a></li>
					</ul>
					<!-- End chức năng -->
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
		<!-- End Thanh navbar -->
		

		<!-- Nội dung -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Quản lí sinh viên</h3>
					</div>
					<div class="panel-body"><p>
						<button id="add" data-toggle="modal" data-target="#addModal"><i class="glyphicon glyphicon-plus"></i> Thêm sinh viên</button>
	
						<!-- Thêm sinh viên modal -->
						<div class="modal fade" id="addModal" role="dialog">
						    <div class="modal-dialog modal-sm">
							    <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Thêm sinh viên</h4>
							        </div>


							        <div class="modal-body">
							        	<!-- Thêm sinh viên form -->
							        	<form id='add-form' method="POST" >
									         <div class="form-group">
												<label for="addid">Mã sinh viên:</label>
												<input type="text" class="form-control" name="addid" id="addid">
												<li id="add-id-msg" style="display: none; color: red;"></li>
											</div>

											<div class="form-group">
												<label for="addname">Họ và tên:</label>
												<input type="text" class="form-control" name="addname" id="addname">
												<li id="add-name-msg" style="display: none; color: red;"></li>
											</div>

											<div class="form-group">
												<label for="addemail">Email:</label>
												<input type="email" class="form-control" name="addemail" id="addemail">
												<li id="add-email-msg" style="display: none; color: red;"></li>
											</div>

											<div class="form-group">
												<label for="addclass">Lớp:</label>
												<input type="text" class="form-control" name="addclass" id="addclass">
												<li id="add-class-msg" style="display: none; color: red;"></li>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="submit" id="addStudent" class="btn btn-primary ">Thêm</button>
										<button type="button" class="btn btn-default align-right" data-dismiss="modal">Đóng</button>
									</div>		
							
							        

							    </div>
						      
						    </div>
						</div>

						<!-- End Thêm sinh viên modal -->






						<button id="stlistupload"  data-toggle="modal" data-target="#uploadModal"><i class="glyphicon glyphicon-upload"></i> Tải lên danh sách sinh viên</button>


						<!-- Upload ds sinh viên Modal -->
						<div class="modal fade" id="uploadModal" role="dialog">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
								    <div class="modal-header">
								     	<button type="button" class="close" data-dismiss="modal">&times;</button>
							        	<h4 class="modal-title">Tải lên danh sách sinh viên</h4>
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
											<button type="button" class="btn btn-default align-right" data-dismiss="modal">Đóng</button>
										</div>
								    </form>
								</div>
							</div>
						</div>
						<!-- End Upload ds sinh viên Modal -->


						
						<h3 align="center"> Danh sách sinh viên</h3><br>

						<!-- Danh sách sinh viên -->
						<table class="table table-bordered table-hover" id="sv-table">
							<thead>
								<td align="center" style="width: 8em;"><b>Mã sinh viên</b></td>
								<td align="center"><b>Họ và tên</b></td>
								<td align="center" style="width: 18em"><b>Email</b></td>
								<td align="center" style="width: 15em"><b>Lớp</b></td>
								<td align="center" style="width: 10em"><b><i class="glyphicon glyphicon-cog"></i></b></td>
							</thead>
							<tbody>
								@foreach($sinhvien as $tl)

								<tr class="data-row odd gradeX" align="center" id='students'>
									<td>{{$tl->svid}}</td>
									<td>{{$tl->name}}</td>
									<td>{{$tl->email}}</td>
									<td>{{$tl->class}}</td>
									<td class="center">
										<button class="edit" id="edit" data-studentid='{{$tl->svid}}' data-email="{{$tl->email}}" data-name="{{$tl->name}}" data-class="{{$tl->class}}"><i class="fa fa-pencil fa-fw"></i></button>

										<button class='delete' id="delete" data-deleteid='{{$tl->svid}}'><i class="fa fa-trash-o fa-fw"></i></button>

										<button class='resetpassword' id="resetpassword" data-resetid='{{$tl->svid}}'><i class="fa fa-refresh fa-fw"></i></button> <!--fa-spin-->
									</td>
								</tr>

								@endforeach
							</tbody>
						</table>
						<!-- End Danh sách sinh viên -->


						<!-- Edit sinh viên modal -->
						<div class="modal fade" id="editModal" role="dialog" style="display: none;">
						    <div class="modal-dialog modal-sm">
							    <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Mã số sinh viên: <b id ='editid'></b></h4>
							        </div>

									<!-- Edit sinh viên form -->
							        <div class="modal-body">
							        	<form id="edit-form" method="POST" >

											<div class="form-group">
												<label for="editname">Họ và tên:</label>
												<input type="text" class="form-control" name="editname" id="editname">
												<li id="edit-name-msg" style="display: none; color: red;"></li>
											</div>

											<div class="form-group">
												<label for="editemail">Email:</label>
												<input type="email" class="form-control" name="editemail" id="editemail">
												<li id="edit-email-msg" style="display: none; color: red;"></li>
											</div>

											<div class="form-group">
												<label for="editclass">Lớp:</label>
												<input type="text" class="form-control" name="editclass" id="editclass">
												<li id="edit-class-msg" style="display: none; color: red;"></li>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="submit" id="editStudent" class="btn btn-primary">Lưu</button>
										<button type="button" class="btn btn-default align-right" data-dismiss="modal">Đóng</button>
									</div>
									<!-- Edit sinh viên form -->
								</div>
							</div>
						</div>
						<!-- End Edit sinh viên modal -->
								

						<!-- Delete sinh viên modal -->
						<div class="modal fade" id="deleteModal" role="dialog">
						    <div class="modal-dialog modal-sm">
							    <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Xoá sinh viên</h4>
							        </div>

							        <div class="modal-body">
							        	<form id='delete-form' method="POST" >
									        <div class="form-group">
												<label for="deleteuid">Xác nhận xoá</label>
												<p id ='deleteuid'></p>
											</div>
										</form>
							        </div>
							        <div class="modal-footer">
							        	<button type="submit" id="deleteStudent" class="btn btn-primary align-left">Xoá</button>
							        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
							        </div>
							    </div> 
						    </div>
						</div>
						<!-- End Delete sinh viên modal -->



						<!-- Reset password sinh viên modal -->
						<div class="modal fade" id="resetModal" role="dialog">
						    <div class="modal-dialog modal-sm">
							    <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Đặt lại mật khẩu</h4>
							        </div>


							        <div class="modal-body">
							        	<form id='reset-form' method="POST" >
									        <div class="form-group">
												<p for="resetuid">Mã sinh viên: 
												<b id ='resetuid'></b></p>
											</div>
										</form>
												
							        </div>
							        <div class="modal-footer">
							        	<button type="submit" id="resetStudent" class="btn btn-primary align-left">Xác nhận</button>
							        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Huỷ</button>
							        </div>
							    </div>
						    </div>
						</div>
						<!-- End Reset password sinh viên modal -->
					</p></div>
				</div>
			</div>
		</div>
		<!-- End Nội dung -->
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
		    $('#sv-table').dataTable( {
			  "pageLength": 100
			} );
		} );

	// Reset password
	$(function(){
		$('#resetStudent').click(function(e){
 			e.preventDefault();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var formData = {
					resetid: $('#resetuid').text()
			};

			$.ajax({
				url : 'student-manager/reset',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
					}
					else{
						window.location.href = "/student-manager";
						window.alert('Đặt lại mật khẩu thành công');
					}
				}
			})
 		})
	})


	// Mở Reset password modal
	$(document).ready(function() {
  		$('.resetpassword').click(function(){
		   	$(this).addClass('reset-item-trigger-clicked');

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#resetModal').modal(options);

  		})
  		
  		//on show modal
  		$('#resetModal').on('show.bs.modal', function() {
		    var el = $(".reset-item-trigger-clicked"); 
		    var row = el.closest(".data-row");


		    var id = el.data('resetid');


		    $("#resetuid").text(id);
		})

		//on hide modal
		$('#resetModal').on('hide.bs.modal', function() {
    		$('.reset-item-trigger-clicked').removeClass('reset-item-trigger-clicked');
   		 	$("#reset-form").trigger("reset");
   		})

  	})

	// on hide upload modal
	$(document).ready(function() {
		$('#uploadModal').on('hide.bs.modal', function() {
			$('#input-file-msg').hide();
	    	$("#upload-form").trigger("reset");
	 	})
	})

	// Upload ds sinh viên
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
				url : 'student-manager/upload',
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
						window.location.href = "/student-manager";
						window.alert('Thêm danh sách sinh viên thành công');
					}
				}
					
			});
		})
	})



	// Mở delete modal
	$(document).ready(function() {
  		$('.delete').click(function(){
		   	$(this).addClass('delete-item-trigger-clicked');

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#deleteModal').modal(options);

  		})
  		
  		// on show modal
  		$('#deleteModal').on('show.bs.modal', function() {
		    var el = $(".delete-item-trigger-clicked"); // See how its usefull right here? 
		    var row = el.closest(".data-row");

		    var id = el.data('deleteid');

		    $("#deleteuid").text(id);
		})

		// on hide modal
		$('#deleteModal').on('hide.bs.modal', function() {
    		$('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked');
   		 	$("#edit-form").trigger("reset");
   		})

  	})

	// delete sinh viên
	$(function(){
		$('#deleteStudent').click(function(e){
 			e.preventDefault();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					deleteid: $('#deleteuid').text()
			};

			$.ajax({
				url : 'student-manager/delete',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
					}
					else{
						window.location.href = "/student-manager";
						window.alert('Xoá sinh viên thành công');
					}
				}
			})
 		})
	})



	// Mở edit modal
	$(document).ready(function() {

	   	$('.edit').click(function(){
	   	$(this).addClass('edit-item-trigger-clicked');

	    var options = {
	      'backdrop': 'static'
	    };
	    $('#editModal').modal(options);

	    })


	  // on show modal
	    $('#editModal').on('show.bs.modal', function() {
	    	var el = $(".edit-item-trigger-clicked");
	    	var row = el.closest(".data-row");

	    	var id = el.data('studentid');
	    	var name = el.data('name');
	    	var email = el.data('email');
	   		var classs = el.data('class');


	    	$("#editid").text(id);
	   	 	$("#editname").val(name);
	    	$("#editemail").val(email);
	    	$("#editclass").val(classs);
	    })

	  // on hide modal
	    $('#editModal').on('hide.bs.modal', function() {
	    	$('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked');
	   		$("#edit-id-msg").hide();
			$("#edit-name-msg").hide();
			$("#edit-email-msg").hide();
			$("#edit-class-msg").hide();
	   	 	$("#edit-form").trigger("reset");
	    })
	})


	// on show add modal
	$(document).ready(function() {
		$('#addModal').on('hide.bs.modal', function() {
			$("#add-id-msg").hide();
			$("#add-name-msg").hide();
			$("#add-email-msg").hide();
			$("#add-class-msg").hide();
	    	$("#add-form").trigger("reset");
	 	})
	})



	// Edit sinh viên
	$(function(){
		$('#editStudent').click(function(e){
			e.preventDefault();

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var formData = {
					editid : $('#editid').text(),
					editname : $('#editname').val(),
					editemail : $('#editemail').val(),
					editclass : $('#editclass').val(),
			};

			$.ajax({
				url : 'student-manager/edit',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					$("#edit-id-msg").hide();
					$("#edit-name-msg").hide();
					$("#edit-email-msg").hide();
					$("#edit-class-msg").hide();
					if(data.error == true){
						
						if(data.message.editid != undefined){
							//$("#usernamemsg").hide()
							$("#edit-id-msg").show().text(data.message.editid[0]);
						}
						if(data.message.editname != undefined){
							//$("#passwordmsg").hide()
							$("#edit-name-msg").show().text(data.message.editname[0]);
						}
						if(data.message.editemail != undefined){
							//$("#passwordmsg").hide()
							$("#edit-email-msg").show().text(data.message.editemail[0]);
						}
						if(data.message.editclass != undefined){
							//$("#passwordmsg").hide()
							$("#edit-class-msg").show().text(data.message.editclass[0]);
						}
					}
					else{
						window.location.href = "/student-manager";
						window.alert('Thay đổi thông sinh viên thành công');
					}
				}
			})
		})
	})




	// Add sinh viên
	$(function(){
		$('#addStudent').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var formData = {
					addid : $('#addid').val(),
					addname : $('#addname').val(),
					addemail : $('#addemail').val(),
					addclass : $('#addclass').val(),
			}

			$.ajax({
				url : 'student-manager/add',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					$("#add-id-msg").hide();
					$("#add-name-msg").hide();
					$("#add-email-msg").hide();
					$("#add-class-msg").hide();
					if(data.error == true){
						
						if(data.message.addid != undefined){
							//$("#usernamemsg").hide()
							$("#add-id-msg").show().text(data.message.addid[0]);
						}
						if(data.message.addname != undefined){
							//$("#passwordmsg").hide()
							$("#add-name-msg").show().text(data.message.addname[0]);
						}
						if(data.message.addemail != undefined){
							//$("#passwordmsg").hide()
							$("#add-email-msg").show().text(data.message.addemail[0]);
						}
						if(data.message.addclass != undefined){
							//$("#passwordmsg").hide()
							$("#add-class-msg").show().text(data.message.addclass[0]);
						}
					}
					else{
						window.location.href = "/student-manager";
						window.alert('Thêm sinh viên thành công');
					}
				}
			})
		})
	})
</script>



</html>








										