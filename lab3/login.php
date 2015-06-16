<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if( isset( $_POST['username'] ) && isset( $_POST['password'] ) )
	{
		$user = $_POST['username'];
		$pass = md5( $_POST['password'] );
		
		$dbc = mysqli_connect( 'localhost', 'root', 'root', 'zkd' ) or die('Pogreška kod spajanja na bazu podataka.');
		$sql="SELECT username FROM users WHERE username = ? AND password = ?";
		$stmt = mysqli_stmt_init( $dbc );
		if( mysqli_stmt_prepare( $stmt, $sql ) ) {
			mysqli_stmt_bind_param( $stmt, 'ss', $user, $pass );
			mysqli_stmt_execute( $stmt );
		}
		mysqli_stmt_bind_result( $stmt, $user );
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($dbc);
		
		if( isset($user) ) {
			$_SESSION['username'] = $user;
			header('Location: /zivotopis.php');
		} else {
			header('Location: /login.html');
		}
	} else {
		header('Location: /login.html');
	}
?>