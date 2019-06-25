@extends('layout.master')
@section('chucnang')
		@if(Auth::user()->type == 'admin')
		<li><a href="student-manager">Quản lí sinh viên</a></li>
		<li><a href="lecturers-manager">Quản lí giảng viên</a></li>
		<li><a href="survey-manager">Quản lí đánh giá</a></li>
		<li><a href="report">Kết quả đánh giá</a></li>
		@elseif(Auth::user()->type == 'student')
		<li><a href="class-survey">Đánh giá môn học</a></li>
		@elseif(Auth::user()->type == 'lecturers')
		<li><a href="lecturers-report">Kết quả đánh giá</a></li>
		@endif
@endsection

@section('noidung')
	<div class="panel panel-default">
		<!--div class="panel-heading">
			<h3 class="panel-title">Trang chủ</h3>
			</div-->
		<div class="panel-body"><h1 style="text-align: center; color: red;"><img src="https://i1.wp.com/fimo.edu.vn/wp-content/uploads/2017/02/UET-logo-txt.png" style="width: 500px; border: none;" alt=""></h1></div>
	</div>
@endsection

@section('dropdown')
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->username}} <b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li><a href="change-password">Đổi mật khẩu</a></li>
		<li><a href="logout">Đăng xuất</a></li>
	</ul>
	</li>
@endsection