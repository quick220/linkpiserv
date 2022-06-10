<?php
include( "session.php" );
ini_set( 'default_socket_timeout', 2 );
$result = ( object )array( 'error' => '' );

if ( isset( $_GET[ 'func' ] ) )
	call_user_func( $_GET[ 'func' ] );
else
	exit;

echo json_encode( $result );

function setPasswd() {
	global $result;

	$old = $_POST[ 'old' ];
	$new1 = $_POST[ 'new1' ];
	$new2 = $_POST[ 'new2' ];
	$json_string = file_get_contents( '/link/config/passwd.json' );
	$data = json_decode( $json_string, true );
	if ( $data[ 0 ][ "passwd" ] != md5( $old ) ) {
		$result->error = "<cn>原密码错误</cn><en>Original password wrong</en>";
		return;
	}

	if ( $new1 != $new2 ) {
		$result->error = "<cn>密码不一致</cn><en>Password inconformity</en>";
		return;
	}

	$data[ 0 ][ "passwd" ] = md5( $new1 );

	$json = json_encode( $data );
	file_put_contents( '/link/config/passwd.json', $json );
	$result->result = "<cn>修改密码成功</cn><en>Save password success</en>";
}

function saveConfigFile() {
	global  $result;
	file_put_contents( "/link/".$_POST["path"], $_POST['data'] );
	$result->result = "OK";
}
?>
