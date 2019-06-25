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
					<li class="active"><a>Đánh giá môn học</a></li>
				</ul>
				<!-- End danh sách chức năng -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Dropdown -->
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><t id="userid">{{Auth::user()->username}}</t></a>
					<ul class="dropdown-menu">
						<li><a href="change-password">Đổi mật khẩu</a></li>
						<li><a href="logout">Đăng xuất</a></li>
					</ul>
					</li>
					<!-- End Dropdown -->
				</ul>
			</div>
		</div>
	</nav>
	<!-- End navbar -->

	<!-- Nội dung -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Danh sách lớp đang khảo sát</h3>
				</div>

				
				<div class="panel-body"><p>
					<p id="noclasslist" style="display: none;"></p>
					<!-- Bảng danh sách lớp khảo sát -->
					<table class="table table-bordered table-hover" id="LMH-table" style="display: none;">
						<thead>
							<td align="center" style="width: 7em;"><b>Mã lớp</b></td>
							<td align="center"><b>Học kỳ</b></td>
							<td align="center"><b>Tên môn học</b></td>
							<td align="center"><b>Giảng viên</b></td>
							<td align="center" style="width: 1em;"><b></b></td>
						</thead>
						<tbody id="LMH-table-body">
						</tbody>
					</table>
					<!-- End bảng danh sách lớp khảo sát -->

					
					<!-- Modal phiếu khảo sát -->
					<div class="modal fade" id="phieuksModal" role="dialog">
						<div class="modal-dialog modal-lg">
						    <div class="modal-content">
						        <div class="modal-header">
						          	<button type="button" class="close" data-dismiss="modal">&times;</button>
						          	<h4 class="modal-title">Phiếu khảo sát: <b id ='idlmh' style="display: none;"></b></h4>
						        </div>


						        <div class="modal-body">
						        	<form id="phieuks-form" class="was-validated" method="POST">
						        		<ol>
										<b><li>Cơ sở vật chất:</li></b>
										<ul id='coso'>
										</ul>

										<b><li>Môn học:</li></b>
										<ul id='monhoc'>
										</ul>

										<b><li>Hoạt động giảng dạy của giáo viên:</li></b>
										<ul id='hdgd'>
										</ul>
										</ol>
						        	</form>
						        </div>
						        <div class="modal-footer">
							        <button type="submit" name="phieuksSend" id="phieuksSend" class="btn btn-primary ">Gửi</button>
							        <button type="button" class="btn btn-default align-right" data-dismiss="modal">Đóng</button>
							    </div>
						    </div> 
						</div>
					</div>
					<!-- End modal phiếu khảo sát -->


				</p></div>
			</div>
		</div>
	</div>
	<!-- End nội dung -->
</div>


	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>


</body>







<script>
	// Hàm xử lí thao tác click nút gửi
	$(function(){
		$('#phieuksSend').click(function(e){
			$('.phieukstb').remove();
			$.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var tc = [];
			var gt = [];
			var dem = 0;
			$.each($(".tieuchisl option:selected"), function(){ 
				if($(this).data('point') == '0'){
					$(this).parent().after('<li class="phieukstb" style="color:red; float:right; padding-right: 1em;" >Chọn một giá trị</li>');
					dem++;
				}else{
					tc.push($(this).parent().data("id"));
	            	gt.push($(this).data('point'));
				}
	        });
			if(dem == 0){
				var formData = {
						svid : $("#userid").text(),
						lmhid : $("#idlmh").text(),
						tclist : tc,
						diemlist : gt
				};

				$.ajax({
					url : 'class-survey/addsurvey',
					data : formData,
					type : 'POST',
					success : function (data){
						console.log(data);
						if(data.error == true){
							/*window.location.href = "/class-survey";
							window.alert('Đánh giá môn học thất bại');*/
						}
						else{
							window.location.href = "/class-survey";
							window.alert('Đánh giá môn học thành công');
						}
					}
				})
			}else{

			}
			
		})

	})
</script>





<script>
	$(document).ready(function() {

    	$.ajaxSetup({
			headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		var formData = {
				userid: $('#userid').text()
		};

		$.ajax({
			url : 'class-survey/classlist',
			data : formData,
			type : 'POST',
			success : function (data){
				if(data.dslmh == null){
					$("#noclasslist").show().text("Không có lớp nào đang khảo sát!")
					$("#LMH-table").hide();
				}else{
					$("#noclasslist").hide();
					$("#LMH-table").show();
					$('#LMH-table-body').children().remove();
					$.each(data.dslmh, function(i){
						$('#LMH-table-body').append("<tr class='stlist-data'><td>"+ data.dslmh[i][0] + "</td><td>" + data.dslmh[i][1] + "</td><td>" + data.dslmh[i][2] + "</td><td>" + data.dslmh[i][3] + "</td><td><a class='khaosat' data-lmhid='" + data.dslmh[i][4] +  "'><i class='fa fa-list fa-fw'></i></a></td></tr>");
						//$("#LMH-table-body").find('a').data('lmhid', data.dslmh[i][4]);
					})
					$("#LMH-table").DataTable();

					$('.khaosat').click(function(){
				   		$(this).addClass('khaosat-item-trigger-clicked'); 
					    var options = {
					      'backdrop': 'static'
					    };

					    $('#phieuksModal').modal(options);

		  			})
				}
			}
		})
	});
</script>


<script>

	$(document).ready(function() {

  		$('#phieuksModal').on('show.bs.modal', function() {
		    var el = $(".khaosat-item-trigger-clicked"); // See how its usefull right here? 
		    var row = el.closest(".data-row");

		    // get the data
		    var id = el.data('lmhid');

		    // fill the data in the input fields
		    $("#idlmh").text(id);

		    $.ajaxSetup({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var formData = {
					lmhid: id
			};
			$.ajax({
				url : 'class-survey/tclist',
				data : formData,
				type : 'POST',
				success : function (data){
					$.each(data.tclist, function(i){
						if(data.tclist[i][2] == 'coso'){
							$('#coso').append('<li style="padding-right: 1em;">' + data.tclist[i][1] +
												'<select style="float: right;" data-id="' + data.tclist[i][0] + '" class="tieuchisl"> <option data-point="0" selected disabled>...</option><option data-point="1">1</option><option data-point="2">2</option><option data-point="3">3</option><option data-point="4">4</option><option data-point="5">5</option></select></li>');
						}else if(data.tclist[i][2] == 'monhoc'){
							$('#monhoc').append('<li style="padding-right: 1em;">' + data.tclist[i][1] +
												'<select style="float: right;" data-id="' + data.tclist[i][0] + '" class="tieuchisl"> <option data-point="0" selected disabled>...</option><option data-point="1">1</option><option data-point="2">2</option><option data-point="3">3</option><option data-point="4">4</option><option data-point="5">5</option></select></li>');
						}else if(data.tclist[i][2] == 'hdgd'){
							$('#hdgd').append('<li style="padding-right: 1em;">' + data.tclist[i][1] +
												'<select style="float: right;" data-id="' + data.tclist[i][0] + '" class="tieuchisl"> <option data-point="0" selected disabled>...</option><option data-point="1">1</option><option data-point="2">2</option><option data-point="3">3</option><option data-point="4">4</option><option data-point="5">5</option></select></li>');
						}
					})
				}
			})


		})
		$('#phieuksModal').on('hide.bs.modal', function() {
    		$('.khaosat-item-trigger-clicked').removeClass('khaosat-item-trigger-clicked');
    		$('#coso').children().remove();
    		$('#monhoc').children().remove();
    		$('#hdgd').children().remove();
   		 	$("#phieuks-form").trigger("reset");
   		})

  	})

</script>


</html>