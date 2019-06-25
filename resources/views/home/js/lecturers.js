
    $(document).ready(function() {
		    $('#l-table').DataTable();
		} );


	$(function(){
		$('#resetLecturers').click(function(e){
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
				url : 'lecturers-manager/reset',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
					}
					else{
						window.location.href = "/lecturers-manager";
						window.alert('Đặt lại mật khẩu thành công');
					}
				}
			})
 		})
	})


	$(document).ready(function() {
  		$('.resetpassword').click(function(){
		   	$(this).addClass('reset-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#resetModal').modal(options);

  		})
  		

  		$('#resetModal').on('show.bs.modal', function() {
		    var el = $(".reset-item-trigger-clicked"); // See how its usefull right here? 
		    var row = el.closest(".data-row");

		    // get the data
		    var id = el.data('resetid');

		    // fill the data in the input fields
		    $("#resetuid").text(id);
		})
		$('#resetModal').on('hide.bs.modal', function() {
    		$('.reset-item-trigger-clicked').removeClass('reset-item-trigger-clicked');
   		 	$("#reset-form").trigger("reset");
   		})

  	})

	$(document).ready(function() {
		$('#uploadModal').on('hide.bs.modal', function() {
			$('#input-file-msg').hide();
	    	$("#upload-form").trigger("reset");
	 	})
	})



	$(function(){
		$('#upload-form').submit(function(e){
			e.preventDefault();
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			})
        	$.ajax({
				url : 'lecturers-manager/upload',
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
						window.location.href = "/lecturers-manager";
						window.alert('Thêm danh sách giảng viên thành công');
					}
				}
					
			});
		})
	})


	$(document).ready(function() {
  		$('.delete').click(function(){
		   	$(this).addClass('delete-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

		    var options = {
		      'backdrop': 'static'
		    };
		    $('#deleteModal').modal(options);

  		})
  		

  		$('#deleteModal').on('show.bs.modal', function() {
		    var el = $(".delete-item-trigger-clicked"); // See how its usefull right here? 
		    var row = el.closest(".data-row");

		    // get the data
		    var id = el.data('deleteid');

		    // fill the data in the input fields
		    $("#deleteuid").text(id);
		})
		$('#deleteModal').on('hide.bs.modal', function() {
    		$('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked');
   		 	$("#delete-form").trigger("reset");
   		})

  	})


	$(function(){
		$('#deleteLecturers').click(function(e){
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
				url : 'lecturers-manager/delete',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					if(data.error == true){
					}
					else{
						window.location.href = "/lecturers-manager";
						window.alert('Xoá giảng viên thành công');
					}
				}
			})
 		})
	})


	$(document).ready(function() {
	   /**
	   * for showing edit item popup
	   */

	   $('.edit').click(function(){
	   	 $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

	    var options = {
	      'backdrop': 'static'
	    };
	    $('#editModal').modal(options);

	   })


	  // on modal show
	    $('#editModal').on('show.bs.modal', function() {
	    	var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
	    	var row = el.closest(".data-row");

	    // get the data
	    	var id = el.data('lecturersid');
	    	var name = el.data('name');
	    	var email = el.data('email');


	    // fill the data in the input fields
	    	$("#editid").text(id);
	   	 	$("#editname").val(name);
	    	$("#editemail").val(email);
	    })

	  // on modal hide
	    $('#editModal').on('hide.bs.modal', function() {
	    	$('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked');
	   		$("#edit-id-msg").hide();
			$("#edit-name-msg").hide();
			$("#edit-email-msg").hide();
	   	 	$("#edit-form").trigger("reset");
	    })
	})

	$(document).ready(function() {
		$('#addModal').on('hide.bs.modal', function() {
			$("#add-id-msg").hide();
			$("#add-name-msg").hide();
			$("#add-email-msg").hide();
	    	$("#add-form").trigger("reset");
	 	})
	})


	$(function(){
		$('#editLecturers').click(function(e){
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
			};

			$.ajax({
				url : 'lecturers-manager/edit',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					$("#edit-id-msg").hide();
					$("#edit-name-msg").hide();
					$("#edit-email-msg").hide();
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
					}
					else{
						window.location.href = "/lecturers-manager";
						window.alert('Thay đổi thông giảng viên thành công');
					}
				}
			})
		})
	})



	$(function(){
		$('#addLecturers').click(function(e){
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
			}

			$.ajax({
				url : 'lecturers-manager/add',
				data : formData,
				type : 'POST',
				success : function (data){
					console.log(data);
					$("#add-id-msg").hide();
					$("#add-name-msg").hide();
					$("#add-email-msg").hide();
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
					}
					else{
						window.location.href = "/lecturers-manager";
						window.alert('Thêm giảng viên thành công');
					}
				}
			})
		})
	})