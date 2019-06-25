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
				<!-- Danh sách chức năng -->
				<ul class="nav navbar-nav">
					@if(Auth::user()->type == 'admin')
					<li><a href="student-manager">Quản lí sinh viên</a></li>
					<li><a href="lecturers-manager">Quản lí giảng viên</a></li>
					<li><a href="survey-manager">Quản lí đánh giá</a></li>
					<li><a href="report">Thống kê</a></li>
					@elseif(Auth::user()->type == 'student')
					<li><a href="class-survey">Đánh giá môn học</a></li>
					@elseif(Auth::user()->type == 'lecturers')
					<li><a href="lecturers-report">Kết quả đánh giá</a></li>
					@endif
				</ul>
				<!-- End danh sách chức năng -->

				<!-- Menu Dropdown -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><p id='username' style="display: none;" value='{{Auth::user()->username}}'></p>{{Auth::user()->username}} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="active"><a>Đổi mật khẩu</a></li>
							<li><a href="logout">Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
				<!-- End Menu Dropdown -->
			</div>
		</div>
	</nav>
	<!-- End Thanh navbar -->

	<!-- Nội dung -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Đổi mật khẩu</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-4 col-md-offset-4">
						<div class="alert alert-danger" id="errormsg" style="display: none;">
							<li id="loginmsg" style="display: none; color: red;"></li>
							<li id="passwordmsg" style="display: none; color: red;"></li>
							<li id="usernamemsg" style="display: none; color: red;"></li>
						</div>
						<!-- Form đổi mật khẩu -->
						<form method="post">
							<div class="form-group">
								<label for="oldpassword">Mật khẩu cũ: </label>
								<input type="password" class="form-control" id="oldpassword">
								<li id="oldpassmsg" style="display: none; color: red;"></li>
							</div>

							<div class="form-group">
								<label for="newpassword">Mật khẩu mới:</label>
								<input type="password" class="form-control"  id="newpassword">
								<li id="newpassmsg" style="display: none; color: red;"></li>
							</div>

							<div class="form-group">
								<label for="renewpassword">Nhập lại mật khẩu:</label>
								<input type="password" class="form-control" id="renewpassword">
								<li id="renewpassmsg" style="display: none; color: red;"></li>
							</div>
							<button type="submit" id="changePassword" class="btn btn-default pull-right">Đổi mật khẩu</button>
						</form>
						<!-- End Form đổi mật khẩu -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End nội dung -->

</div>

<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
<script>

	// Hàm xử lí thao tác click nút đổi mật khẩu
	$(function(){
		$('#changePassword').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var formData = {
					oldpassword : $("#oldpassword").val(),
					newpassword : $("#newpassword").val(),
					renewpassword : $("#renewpassword").val(),
			};

			$.ajax({
				url : 'change-password/post',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
						$("#oldpassmsg").hide();
						$("#newpassmsg").hide();
						$("#renewpassmsg").hide();

						if(data.message.oldpassword != undefined){
							//$("#usernamemsg").hide()
							$("#oldpassmsg").show().text(data.message.oldpassword[0]);
						}
						if(data.message.newpassword != undefined){
							//$("#usernamemsg").hide()
							$("#newpassmsg").show().text(data.message.newpassword[0]);
						}
						if(data.message.renewpassword != undefined){
							//$("#usernamemsg").hide()
							$("#renewpassmsg").show().text(data.message.renewpassword[0]);
						}
						if(data.message.bothnew != undefined){
							//$("#usernamemsg").hide()
							$("#newpassmsg").show().text(data.message.bothnew[0]);
							$("#renewpassmsg").show().text(data.message.bothnew[0]);
						}

					}
					else{
						window.location.href = "/";
						window.alert('Đổi mật khẩu thành công');
					}
				}
			})
		})
	})
</script>
</html>



