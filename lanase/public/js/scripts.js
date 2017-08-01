$(document).ready(function(){

	$(".dropdown-button").dropdown();

	$('select').material_select();

	$("#form").submit(function(){
		// alert('submit');
		$.ajax({
			url: 'ajax.php?opcion=1',
			type: 'POST',
			data: $("#form").serialize(),
			success: function(response){
				if(response == "admin"){
					window.location.href='admin/dashboard.php';
				}else if(response == "user"){
					window.location.href='user/dashboard.php';
				}else{
					$("#response").fadeIn(500).html(response).delay(3000).fadeOut(500);
				}
			},
			error: function(response){
				alert(response);
			}
		})
		return false;

	});

	$("#form_register").submit(function(){

		if($("#password").val() == $("#password_confirm").val()){
			
			$.ajax({
				url: '../ajax.php?opcion=3',
				type: 'POST',
				data: $("#form_register").serialize(),
				success: function(response){
				// 	if(response == true){
				// 		window.location.href='panel.php';
				// 	}else{
				// 		$("#response").fadeIn(500).html(response).delay(3000).fadeOut(500);
				// 	}
					alert(response);
					if(response == "Alta exitosa"){
						$("#form_register")[0].reset();
					}
				},
				error: function(response){
					alert(response);
				}
			})
		}else{
			// $("#password_confirm").focus();
			// $("#response").fadeIn(500).html("La confirmación de contraseña no coincide").delay(3000).fadeOut(500);
			alert("Las contraseñas no coinciden");
		}

		return false;
	});

	$("#logout").click(function(e){

		e.preventDefault();
		$.ajax({
			url: '../ajax.php?opcion=2',
			success: function(response){

				if(response == true){
					window.location.href='../index.html';
				}else{
					alert(response);
				}
			},
			error: function(response){
				alert(response);
			}
		})
	});

	$("button[id^='btn-admin-users-']").click(function(){
		var btn;
		if($(this).attr('id') == "btn-admin-users-all"){
			btn = "all";
		}else if($(this).attr('id') == "btn-admin-users-admin"){
			btn = "admin";
		}else{
			btn = "users";
		}

		$.ajax({

			url: '../ajax.php?opcion=4&type=' + btn,
			success:function(response){
				$("#table-users-body").html(response);
			},
			error:function(response){
				alert(response);
			}

		});
	});

	$(".user-delete").click(function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$.ajax({
			url: '../ajax.php?opcion=5',
			data: 'id='+id,
			type: 'POST',
			success: function(response){
				if(response == "Usuario inhabilitado con éxito"){
					alert(response);
					window.location.reload();					
				}else{
					alert(response);
				}
			},
			error: function(response){
				alert(response);
			}
		})

	});

});