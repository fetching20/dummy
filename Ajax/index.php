<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PHP and Ajax CRUD</title>
	<link rel="stylesheet"  href="css/style.css">
</head>

<body>
<table id="main" border="0" cellspacing="0">
	<tr>
		<td id=""header>
			<h1>Add records with PHP and Ajax</h1>
		</td>
	</tr>
	<tr>
		<td id="table-form">
			<form id="addForm">
			First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;
			Last Name : <input type="text" id="lname">
			<input type="submit" id="save-button" value="save">
			</form>
		</td>
	</tr>
		<tr>
        <td id="table-data">
       	</td>
      	</tr>
	</table>
	<div id="error-message"></div>
	<div id="success-message"></div>
	<div id="modal">
		<div id="modal-form">
			<h2>Edit Form</h2>
			<table cellpadding="10px" width="100%">
			</table>
			<div id="close-btn">X</div>
		</div>
	</div>


<script type="text/javascript" src="JS/jquery.js"></script>
<script>
	$(document).ready(function(){

		//Load Tabel Record
		function loadTabel(){
			$.ajax({
            url : "ajax-load.php",
            type : "POST",
            success : function(data){
              $("#table-data").html(data);
            }
          });
		}

	loadTabel();   //load tabel record on page load


	//Insert New Records
	$("#save-button").on("click",function(e){
		e.preventDefault();
		var fname = $("#fname").val();
		var lname = $("#lname").val();
		if(fname == "" || lname == ""){
		$("#error-message").html("All Fields are require").slideDown();
		$("#success-message").slideUp();
		}else{
				$.ajax({
			url : "ajax-insert.php",
			type : "POST",
			data : {firstname:fname, lastname:lname},  //key
			success : function(data){
				if(data == 1){
					loadTabel();
					$("#addForm").trigger("reset");
					$("#success-message").html("Data inserted succesfully").slideDown();
					$("#error-message").slideUp();
				}else{
					$("#error-message").html("Can't save records").slideDown();
					$("#success-message").slideUp();
				}
				
			}
		});
		}
	
	})
	//Delete Records
	$(document).on("click",".delete-btn", function(){
		if(confirm("Do You Realy Want To delete This Record ?")){
		var studentId = $(this).data("id");
		var element = this;
	
			$.ajax({
			url : "ajax-delete.php",
			type : "POST",
			data : {id : studentId},
			success : function(data){
				if(data == 1){
					$(element).closest("tr").fadeOut();

				}else{
					$("#error-message").html("Can't Delete Records ").slideDown();
					$("#success-message").slideUp();
				}
			}
		});
		}
	})

	//show Model Box
	$(document).on("click",".edit-btn", function(){
		$("#modal").show();
		var studentId = $(this).data("eid");
		
		$.ajax({
			url:"load-update-form.php",
			type: "POST",
			data : {id : studentId},
			success: function(data){
			$("#modal-form table").html(data);

			}
		})

	});
	//Hide Model Box
	$("#close-btn").on("click",function(){
		$("#modal").hide();
	});

	// Save Updated form

	$(document).on("click","#edit-submit", function(){
		var studentId = $("#edit-id").val();
		var fname = $("#edit-fname").val();
		var lname = $("#edit-lname").val();


		$.ajax({
			url: "ajax-update-form.php",
			type: "POST",
			data: {id: studentId, first_name: fname, last_name: lname},
			success: function(data) {
				if(data == 1){
				$("#modal").hide();
				loadTabel(); 
			}

			}
		})
	});

	});
</script>
</body>
</html>



