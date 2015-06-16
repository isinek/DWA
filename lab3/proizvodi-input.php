<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if(!isset($_SESSION['username'])) {
		session_destroy();
		header('Location: login.html');
	}
	
	$dbc = mysqli_connect( 'localhost', 'root', 'root', 'zkd' ) or die('Pogreška kod spajanja na bazu podataka.');
	
	if(isset($_POST['nazivProizvoda'])) {
		
		/*$sql = "INSERT INTO `proizvodi`(`naziv`, `tip`, `opis`, `vegetarijanski`, `halal`, `koser`, `cijena`) VALUES (?,?,?,?,?,?,?);";
		$stmt = mysqli_stmt_init( $dbc );
		if( mysqli_stmt_prepare( $stmt, $sql ) ) {
			mysqli_stmt_bind_param( $stmt, 'sisiiid', (isset($_POST['nazivProizvoda']) ? $_POST['nazivProizvoda'] : ''),
				(isset($_POST['tipProizvoda']) ? $_POST['nazivProizvoda'] : ''),
				(isset($_POST['opisProizvoda']) ? $_POST['nazivProizvoda'] : 0),
				(isset($_POST['vegeProizvoda']) ? $_POST['nazivProizvoda'] : 0),
				(isset($_POST['halalProizvoda']) ? $_POST['nazivProizvoda'] : 0),
				(isset($_POST['cijenaProizvoda']) ? $_POST['nazivProizvoda'] : 0.0));
			mysqli_stmt_execute( $stmt );
		}
		mysqli_stmt_bind_result( $stmt, $user );
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);*/
		
		foreach ($_GET['alergeniProizvoda'] as $alergen)
			print $alergen;
	}
	
	$sql = "SELECT * FROM tip_proizvoda ORDER BY naziv;";
	$tipoviProizvoda = $dbc->query($sql);
	
	$sql = "SELECT * FROM alergeni;";
	$alergeni = $dbc->query($sql);
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Životopis - ZKD j.d.o.o.</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
	<header class="container">
		<div class="row">
			<div class="col-sm-4 col-xs-6">
				<a class="home-button" href="/zivotopis.php">
					<img src="http://placehold.it/350x150" alt="">
				</a>
			</div>
			<div class="col-sm-8 col-xs-6 user-info">
				<span class="username"><?php print $_SESSION['username'] ?></span>
				<a class="simple-button" href="/logout.php">Odjavi se</a>
			</div>
		</div>
	</header>
	<section class="container content">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<nav>
					<a class="nav-link" href="zivotopis.php">Životopis</a>
					<a class="nav-link" href="proizvodi.php">Proizvodi</a>
				</nav>
			</div>
			<div class="col-md-9 col-sm-12">
				<form class="form" action="proizvodi-input.php" method="POST">
					<div class="form-group">
						<label class="sr-only" for="nazivProizvoda">Naziv proizvoda*</label>
						<input type="text" class="form-control" id="nazivProizvoda" name="nazivProizvoda" placeholder="Naziv proizvoda*" required>
					</div>
					<div class="form-group">
						<label class="sr-only" for="tipProizvoda">Tip proizvoda*</label>
						<select class="form-control" id="tipProizvoda" name="tipProizvoda" required>
							<?php
								if($tipoviProizvoda) {
									while ($row = $tipoviProizvoda->fetch_row()) {
										print '<option value="'.$row[0].'">'.$row[1].'</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="sr-only" for="opisProizvoda">Opis proizvoda:</label>
						<textarea class="form-control" rows="3" id="opisProizvoda" name="opisProizvoda" placeholder="Opis proizvoda"></textarea>
					</div>
					<div class="checkbox">
						<label>
						<input type="checkbox" id="vegeProizvod" name="vegeProizvod"> Vegetarijanski
						</label>
					</div>
					<div class="checkbox">
						<label>
						<input type="checkbox" id="halalProizvod" name="halalProizvod"> Halal
						</label>
					</div>
					<div class="checkbox">
						<label>
						<input type="checkbox" id="koserProizvod" name="koserProizvod"> Košer
						</label>
					</div>
					<div class="form-group">
						<label class="sr-only" for="tipProizvoda">Alergeni</label>
						<select multiple class="form-control" id="alergeniProizvoda" name="alergeniProizvoda[]" style="height: 190px;">
							<?php
								if($alergeni) {
									while ($row = $alergeni->fetch_row()) {
										print '<option value="'.$row[0].'">'.$row[1].'</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="sr-only" for="nazivProizvoda">Cijena*</label>
						<input type="decimal" class="form-control" id="cijenaProizvoda" name="cijenaProizvoda" placeholder="Cijena*" required>
					</div>
					<button type="submit" class="btn btn-success" style="float: left;">Potvrdi</button>
					<a href="proizvodi.php" class="btn btn-danger" style="float: right;">Odustani</a>
				</form>
			</div>
		</div>
	</section>
	<footer class="container">
		<span>Copyright ZKD, 2015</span>
	</footer>
</body>
</html>