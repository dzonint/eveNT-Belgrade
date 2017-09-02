<style>body { background: url("img/beograd.jpg") no-repeat center center scroll; }</style>
<div id="wrap">
    <div class="container clear-top">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Prijava</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Registracija</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="admin/controller.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Korisničko ime" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Lozinka" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Prijava">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="pwrecover.php" tabindex="5" class="forgot-password">Zaboravili ste lozinku?</a>
												</div>
											</div>
										</div>
									</div>
                                    <input type="hidden" name="task" value="login">
								</form>
								<form id="register-form" action="admin/controller.php" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="reg-username" tabindex="1" class="form-control" placeholder="Korisničko ime" value="" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="reg-email" tabindex="1" class="form-control" placeholder="Email adresa" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="reg-password" tabindex="2" class="form-control pwd"  placeholder="Lozinka" required>
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control pwd" placeholder="Potvrda lozinke" required>
									</div>
									<div class="form-group">
                                        <div class="row">
											<div class="col-sm-6 col-sm-offset-3" id="message" style="text-align:center;color:red;">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="button" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registracija">
											</div>
										</div>
									</div>
                                    <input type="hidden" name="task" value="register">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
$(function() {
    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
    
function checkUsername() {    
    var username = $('#reg-username').val();
    if(username.length == 0){
       $('#reg-username').removeClass('ok').addClass('error');
       $("#message").html('<small>Unesite korisničko ime.</small><br>');
       return;
    }
    $.ajax({
        url: "admin/controller.php",
        data: {username : username, task : 'checkUser'},
        success: function(response) { // Response is mysqli_affected_rows.
            if(response != 0) {
                $('#reg-username').removeClass('ok').addClass('error');
                $("#message").html('<small>Korisničko ime je zauzeto.</small><br>');
            } else {
                $('#reg-username').removeClass('error').addClass('ok');
                $("#message").html('');
            }
        }
    });
}
    
function checkEmail() {    
    var email = $('#reg-email').val();
    if(email.length == 0){
       $('#reg-email').removeClass('ok').addClass('error');
       $("#message").html('<small>Unesite email adresu.</small><br>');
       return;
    }
    $.ajax({
        url: "admin/controller.php",
        data: {email : email, task : 'checkEmail'},
        success: function(response) {
            if(response != 0) {
                $('#reg-email').removeClass('ok').addClass('error');
                $("#message").html('<small>Email adresa je u upotrebi</small><br>');
            } else {
                $('#reg-email').removeClass('error').addClass('ok');
                $("#message").html('');
            }
        }
    });
}    

function checkPasswords() {
    var pass = $('#reg-password').val();
    var repass = $('#confirm-password').val();
    if(pass.length == 0){
       $('#reg-password').removeClass('ok').addClass('error');
       $("#message").html('<small>Unesite lozinku.</small><br>');
       return;
    }
    else if(repass.length == 0){
       $('#confirm-password').removeClass('ok').addClass('error');
       $("#message").html('<small>Potvrdite lozinku.</small><br>');
       return;
    }
    else if (pass != repass) {
        $('#reg-password').removeClass('ok').addClass('error');
        $('#confirm-password').removeClass('ok').addClass('error');
        $("#message").html('<small>Lozinke nisu iste.</small><br>');
    }
    else {
        $('#reg-password').removeClass('error').addClass('ok');
        $('#confirm-password').removeClass('error').addClass('ok');
        $("#message").html('');
    }
}
    
function formValidation(){
    checkUsername;
    checkEmail;
    checkPasswords;
    if($('#reg-username').hasClass('ok') && $('#reg-email').hasClass('ok') && $('.pwd').hasClass('ok'))
        $("#register-form").submit();
    else
        $("#message").html('<small>Popunite sva polja.</small><br>');
}       
    
$('#reg-username').blur(checkUsername);
$('#reg-email').blur(checkEmail);    
$('.pwd').blur(checkPasswords);
$('#register-submit').click(formValidation);
$("#message").html('<small>Popunite sva polja.</small><br>');
});
</script>