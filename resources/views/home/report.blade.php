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
	<style>
		@font-face {
		    font-family: "DejaVu Sans";
		    font-weight: normal;
	        font-style: normal;
	        font-variant: normal;
		}
	</style>
</head>
<body>
	<div class="container">
		<!-- Thanh navbar-->
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
					<!-- Chức năng-->
					<ul class="nav navbar-nav">
						<li><a href="student-manager">Quản lí sinh viên</a></li>
						<li><a href="lecturers-manager">Quản lí giảng viên</a></li>
						<li><a href="survey-manager">Quản lí đánh giá</a></li>
						<li class="active"><a>Kết quả đánh giá</a></li>
					</ul>
					<!-- End chức năng-->
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
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Lớp đang khảo sát</h3>
						</div>
					<div class="panel-body">
						<!-- Danh sách lớp đang khảo sát -->
						<table class="table table-bordered table-hover" id="lmh-no-table">
							<thead>
								<td align="center" style="width: 7em;"><b>Mã lớp</b></td>
								<td align="center"><b>Học kỳ</b></td>
								<td align="center"><b>Tên môn học</b></td>
								<td align="center" style="width: 1em;"><b><i class="glyphicon glyphicon-cog"></i></b></td>
							</thead>
							<tbody>

								@foreach($lopmonhoc as $lmh)
								@if($lmh->status === 'n')
								<tr class="data-row odd gradeX" align="center" id='lmhno'>

									<td>{{$lmh->malop}}</td>
									<td>{{$lmh->hocky}}</td>
									<td>{{$lmh->tenmonhoc}}</td>

									<td class="center"><button class="lmhnoinfo" id="lmhnoinfo" data-malop='{{$lmh->malop}}' data-listid='{{$lmh->id}}' data-idgv="{{$lmh->giangvien}}" data-tenmh="{{$lmh->tenmonhoc}}" data-hk="{{$lmh->hocky}}"><i class="fa fa-list fa-fw"></i></button></td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						<!-- End Danh sách lớp đang khảo sát -->
					</div>
				</div>
			</div>



			<!-- Thông tin khảo sát modal-->
			<div class="modal fade" id="lmhnoModal" role="dialog">
				<div class="modal-dialog modal-lg">
				    
				    <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Thông tin khảo sát</h4>
				        </div>
				        <div class="modal-body">
				        	<form id="lmhnoinfo-form">
					        	<p>Mã lớp: <b id='lmhno-malop'></b></p>
					        	<p>Học kỳ: <b id='lmhno-hk'></b></p>
					        	<p>Tên môn học: <b id='lmhno-tenmh'></b></p>
					        	<p>Giảng viên: <b id='lmhno-giangvien'></b></p>
					        	<p>Tình trạng khảo sát: <b id='lmhno-svchuaks'></b><b> / </b><b id='lmhno-soluongsv'></b></p>
					        	<p>Danh sách sinh viên chưa làm khảo sát</p>

					        	<table class="table table-bordered table-hover" id="lmh-no-dssv-table">
									<thead>
										<td align="center" style="width: 1em;"><b>STT</b></td>
										<td align="center"><b>Mã sinh viên</b></td>
										<td align="center"><b>Họ và tên</b></td>
										<td align="center"><b>Lớp khoá học</b></td>
									</thead>

									<tbody id="lmh-no-dssv-table-body">
									</tbody>

								</table>
								<div class="modal-footer">
						        	<button type="submit" id="surveyfinish" class="btn btn-primary align-left">Kết thúc khảo sát</button>
						        	<button type="button" class="btn btn-default align-right" data-dismiss="modal">Đóng</button>
						        </div>
							</form>	
				        </div>
				    </div> 
				</div>
			</div>
			<!-- End thông tin khảo sát Modal-->

			



			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Lớp đã hoàn thành khảo sát</h3>
						</div>
					<div class="panel-body">
						<!-- Danh sách lớp đã hoàn thành khảo sát -->
						<table class="table table-bordered table-hover" id="lmh-yes-table">
							<thead>
								<td align="center" style="width: 7em;"><b>Mã lớp</b></td>
								<td align="center"><b>Học kỳ</b></td>
								<td align="center"><b>Tên môn học</b></td>
								<td align="center" style="width: 1em;"><b><i class="glyphicon glyphicon-cog"></i></b></td>
							</thead>
							<tbody>

								@foreach($lopmonhoc as $lmh)
								@if($lmh->status === 'y')
								<tr class="data-row odd gradeX" align="center" id='lmhyes'>

									<td>{{$lmh->malop}}</td>
									<td>{{$lmh->hocky}}</td>
									<td>{{$lmh->tenmonhoc}}</td>

									<td class="center"><button class="lmhyesinfo" id="lmhyesinfo" data-malop='{{$lmh->malop}}' data-listid='{{$lmh->id}}' data-idgv="{{$lmh->giangvien}}" data-hk="{{$lmh->hocky}}" data-tenmh='{{$lmh->tenmonhoc}}'><i class="fa fa-list fa-fw"></i></button></td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						<!-- End Danh sách lớp đã hoàn thành khảo sát -->
					</div>
				</div>
			</div>




			<!-- Kết quả đánh giá -->
			<div class="modal fade" id="lmhyesModal" role="dialog">
				<div class="modal-dialog modal-lg">
				    <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Thông tin khảo sát</h4>
				        </div>

						
						<form id="lmhyesinfo-form" action='report/downloadpdf' method="post">
							<div class="modal-body">
				        		@csrf
				        		<input type="hidden" id='lmhyeshtml' style="display: none;" name='lmhyeshtml'>
				        		<div id ="HTMLLMH">
					        	<p>Mã lớp: <b id='lmhyes-malop'></b></p>
					        	<p>Học kỳ: <b id='lmhyes-hk' name='lmhyes-hk'></b></p>
					        	<p>Tên môn học: <b id='lmhyes-tenmh'></b></p>
					        	<p>Giảng viên: <b id='lmhyes-giangvien'></b></p>
					        	<p>Tình trạng khảo sát: <b id='lmhyes-svdaks'></b><b> / </b><b id='lmhyes-soluongsv'></b></p>
					        	<p style="font-weight: bold;">Kết quả:</p>

					        	<table class="table table-bordered table-hover" id="lmh-yes-dssv-table">
									<thead>
										<td align="center" style="width: 1em;"><b>STT</b></td>
										<td align="center" style="width: 30em;"><b>Tiêu chí</b></td>
										<td align="center" style="width: 1em;"><b>M</b></td>
										<td align="center" style="width: 1em;"><b>STD</b></td>
										<td align="center" style="width: 1em;"><b>M1</b></td>
										<td align="center" style="width: 1em;"><b>STD1</b></td>
										<td align="center" style="width: 1em;"><b>M2</b></td>
										<td align="center" style="width: 1em;"><b>STD2</b></td>
									</thead>
									<tbody id="lmh-yes-dssv-table-body">
									</tbody>
								</table>
								<p><b>Ghi chú:</b></p>
								<ul>
								    <li><b>M:</b> Giá trị trung bình của các tiêu chí theo lớp học phần</li>
								    <li><b>STD:</b> Độ lệch chuẩn của các tiêu chí theo lớp học phần</li>
								    <li><b>M1:</b> Giá trị trung bình của các tiêu chí dựa trên dữ liệu phản hồi của sinh viên cho các giảng viên dạy cùng môn học với thầy cô</li>
								    <li><b>STD1:</b> Độ lệch chuẩn của các tiêu chí dựa trên dữ liệu phản hồi của sinh viên cho các giảng viên dạy cùng môn học với thầy cô</li>
								    <li><b>M2:</b> Giá trị trung bình của các tiêu chí dựa trên dữ liệu phản hồi của sinh viên về các môn học mà thầy cô đã thực hiện giảng dạy</li>
								    <li><b>STD2:</b> Độ lệch chuẩn của các tiêu chí dựa trên dữ liệu phản hồi của sinh viên về các môn học mà thầy cô đã thực hiện giảng dạy</li>
								</ul>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" id="downloadpdf" class="btn btn-primary">Tải xuống</button>
								<button type="button" class="btn btn-default align-right" data-dismiss="modal">Đóng</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--End Kết quả đánh giá -->
		</div>
		<!-- Nội dung -->
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
		    $("#lmh-yes-table").DataTable();
		    $("#lmh-no-table").DataTable();
		} );

	// onclick Kết thúc khảo sát
	$(document).ready(function() {
		$("#surveyfinish").click(function(){
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					lmhid: $('#lmhno-malop').text(),
					lmhhk: $('#lmhno-hk').text()
			};
			$.ajax({
				url : 'report/surveyfinish',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
					}
					else{
						window.location.href = "report";
						window.alert('Đã kết thúc khảo sát');
					}
				}
			})
		})
	})

	// Mở modal thông tin lớp môn học đã hoàn thành khảo sát
	$(document).ready(function() {
  		$('.lmhyesinfo').click(function(){
		   	$(this).addClass('lmhyes-item-trigger-clicked'); 

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#lmhyesModal').modal(options);

  		})
  		
  		// on show modal
  		$('#lmhyesModal').on('show.bs.modal', function() {
		    var el = $(".lmhyes-item-trigger-clicked"); 
		    var row = el.closest(".data-row");

		    var malop = el.data('malop');
		    var hk = el.data('hk');
		    var tenmh = el.data('tenmh');
		    var gv = el.data('idgv');
		    var id = el.data('listid');
		    

		    $("#lmhyes-malop").text(malop);
		    $("#lmhyes-hk").text(hk);
		    $("#lmhyes-tenmh").text(tenmh);
		    

			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					lmhid: id,
					malop : malop,
					giangvien : gv
			};
			$.ajax({
				url : 'report/lmhyesdata',
				data : formData,
				type : 'POST',
				success : function (data){
					$("#lmhyes-giangvien").text(data.giangvien);
					$("#lmhyes-soluongsv").text(data.sv);
					$("#lmhyes-svdaks").show().text(data.svyes);
					$('#lmh-yes-dssv-table-body').children().remove();
					$count = 0;
					$.each(data.dstc, function(i){
						$('#lmh-yes-dssv-table-body').append("<tr class='stlist-data'><td>"+ ++$count + "</td><td>" + data.dstc[i][1] + "</td><td>" + data.dstc[i][2] + "</td><td>" + data.dstc[i][3] + "</td><td>" + data.dstc[i][4] + "</td><td>" + data.dstc[i][5] + "</td><td>" + data.dstc[i][6] + "</td><td>" + data.dstc[i][7] + "</td></tr>");
					})
					var html = $("#HTMLLMH").html();
					$("#lmhyeshtml").val(html);
				}
			})
			
			


		})


		// on hide modal
		$('#lmhyesModal').on('hide.bs.modal', function() {
    		$('.lmhyes-item-trigger-clicked').removeClass('lmhyes-item-trigger-clicked');
   		 	$("#lmhnoinfo-form").trigger("reset");
   		})

  	})
	

	// Mở modal thông tin lớp môn học đang khảo sát
	$(document).ready(function() {
  		$('.lmhnoinfo').click(function(){
		   	$(this).addClass('lmhno-item-trigger-clicked'); 

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#lmhnoModal').modal(options);

  		})
  		

  		//on show modal
  		$('#lmhnoModal').on('show.bs.modal', function() {
		    var el = $(".lmhno-item-trigger-clicked"); 
		    var row = el.closest(".data-row");


		    var malop = el.data('malop');
		    var hk = el.data('hk');
		    var tenmh = el.data('tenmh');
		    var gv = el.data('idgv');
		    var id = el.data('listid');


		    $("#lmhno-malop").text(malop);
		    $("#lmhno-hk").text(hk);
		    $("#lmhno-tenmh").text(tenmh);


			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					lmhid: id,
					giangvien: gv
			};
			$.ajax({
				url : 'report/lmhnodata',
				data : formData,
				type : 'POST',
				success : function (data){
					$("#lmhno-giangvien").text(data.giangvien);
					$("#lmhno-soluongsv").text(data.sv);
					$("#lmhno-svchuaks").show().text(data.svyes);
					$('#lmh-no-dssv-table-body').children().remove();
					$count = 0;
					$.each(data.dssv, function(i){
						$('#lmh-no-dssv-table-body').append("<tr class='stlist-data'><td>"+ ++$count + "</td><td>" + data.dssv[i][0] + "</td><td>" + data.dssv[i][1] + "</td><td>" + data.dssv[i][2] + "</td></tr>");
					})
				}
			})


		})

  		// on hide modal
		$('#lmhnoModal').on('hide.bs.modal', function() {
    		$('.lmhno-item-trigger-clicked').removeClass('lmhno-item-trigger-clicked');
   		 	$("#lmhnoinfo-form").trigger("reset");
   		})

  	})
	

</script>


</html>