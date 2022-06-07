<?php
session_start();
if ( isset( $_GET[ 'logout' ] ) )
	$_SESSION[ 'login' ] = "";

$errStr = "";

if ( isset( $_POST[ 'name' ] ) && isset( $_POST[ 'passwd' ] ) ) {
	$name = $_POST[ 'name' ];
	$passwd = $_POST[ 'passwd' ];
	$json_string = file_get_contents( '/link/config/passwd.json' );
	$data = json_decode( $json_string, true );
	for ( $i = 0; $i < count( $data ); $i++ ) {
		if ( $data[ $i ][ "name" ] == $name && $data[ $i ][ "passwd" ] == md5( $passwd ) )
			$_SESSION[ 'login' ] = $name;
		else
			$errStr = "账号或密码错误";
	}
}


if ( isset( $_SESSION[ 'login' ] ) && ( $_SESSION[ 'login' ] == "admin" || $_SESSION[ 'login' ] == "superadmin" ) ) {
	header( "Location:index.php" );
	exit();
}

include( "head.php" );
?>
<div style="display: flex; justify-content:center; align-items:Center; height: 80%; padding-top: 15%;">
	<div class="card text-white bg-dark" style="border-radius: 8px; box-shadow: 5px 5px 10px #CCC;">
		<div class="card-body">
			<div class="text-center" style="margin-bottom: 20px;">
				<img src="img/logo.png"/>
			</div>
			<form class="form-signin" action="login.php" method="post">
				<div class="form-group">
					<div class="input-group input-group-lg">
						<div class="input-group-prepend">
							<i class="fa fa-user input-group-text" style="width: 50px;"></i>
						</div>
						<input type="text" class="form-control" onkeydown="keyLogin();" name="name" placeholder="name">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group input-group-lg">
						<div class="input-group-prepend">
							<i class="fa fa-key input-group-text" style="width: 50px;"></i>
						</div>
						<input type="password" class="form-control" onkeydown="keyLogin();" name="passwd" placeholder="passwd">
					</div>
				</div>

				<div class="form-group ">
					<button class="btn btn-lg btn-warning btn-block text-white" id="login" style="font-size: 24px; line-height: 24px; "><i class="fa fa-sign-in" ></i></button>
				</div>
			</form>
			<div id="alert">
				<?php
				if ( $errStr != "" ) {
					echo '<div class="alert alert-danger fade in"> <button class="close close-sm" type="button" data-dismiss="alert"> 
                                    <i class="fa fa-times"></i> 
                                </button> 
                                <strong>' . $errStr . '</strong> 
                            </div>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<script>
	$( "#name" ).focus();

	function keyLogin() {

		if ( event.keyCode == 13 )
			$( "#login" ).click();
	}
</script> 
</body>
</html>