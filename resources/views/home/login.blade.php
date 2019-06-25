<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title> Class Survey </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

			</div>
		</nav>
		<!-- End thanh navbar -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Đăng nhập</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-4 col-md-offset-4">
							<div class="alert alert-danger" id="errormsg" style="display: none;">
								<li id="loginmsg" style="display: none; color: red;"></li>
								<li id="passwordmsg" style="display: none; color: red;"></li>
								<li id="usernamemsg" style="display: none; color: red;"></li>
							</div>
							<!-- Form đăng nhập -->
							<form action="#" method="POST" >
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{old('username')}}">
									
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" name="password" id="password" placeholder="Password">
								</div>
							
								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="remember" checked>
											Ghi nhớ đăng nhập
										</label>
									</div>
								</div>
								<button type="submit" id="dangnhap" class="btn btn-default pull-right">Đăng nhập</button>
							</form>
							<!-- End form đăng nhập -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

<script>
	// gửi yêu cầu đăng nhập
	$(function(){
		$('#dangnhap').click(function(e){
			e.preventDefault();
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
			    	username : $('#username').val(),
					password : $('#password').val(),
			};
			$.ajax({
				url : 'login',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
						$("#errormsg").show();
						$("#usernamemsg").hide();
						$("#passwordmsg").hide();
						$("#loginmsg").hide();
						if(data.message.username != undefined){
							//$("#usernamemsg").hide()
							$("#usernamemsg").show().text(data.message.username[0]);
						}
						if(data.message.password != undefined){
							//$("#passwordmsg").hide()
							$("#passwordmsg").show().text(data.message.password[0]);
						}
						if(data.message.errorlogin != undefined){
							//$("#passwordmsg").hide()
							$("#loginmsg").show().text(data.message.errorlogin[0]);
						}
					}
					else{
						window.location.href = "/";
					}
				}
			})
		})
	})
</script>

</html>