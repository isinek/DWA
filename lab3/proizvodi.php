<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if(!isset($_SESSION['username'])) {
		session_destroy();
		header('Location: login.html');
	}
	$orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 2;
	$desc = isset($_GET['desc']) ? 'DESC' : 'ASC';
	
	$dbc = mysqli_connect( 'localhost', 'root', 'root', 'zkd' ) or die('Pogreška kod spajanja na bazu podataka.');
	$sql = "SELECT proizvodi.id, proizvodi.naziv, tip_proizvoda.naziv, proizvodi.opis, proizvodi.vegetarijanski, proizvodi.halal, proizvodi.koser, proizvodi.cijena FROM proizvodi JOIN tip_proizvoda ON proizvodi.tip = tip_proizvoda.id ORDER BY ".$orderBy." ".$desc.";";
	
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
	<script src="js/custom.js"></script>
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
					<a class="nav-link active" href="proizvodi.php">Proizvodi</a>
				</nav>
			</div>
			<div class="col-md-9 col-sm-12">
				<input type="text" class="form-control" id="filterProizvoda" placeholder="Filter" style="float: left; width: 45%;">
				<a href="proizvodi-input.php" class="btn btn-primary" style="float: right;">Ubaci novi proizvod</a>
				<table id="tableProizvodi" class="table table-hover">
					<thead>
						<tr>
							<th><a href="proizvodi.php?orderby=2<?php print ($orderBy == 2 && $desc == 'ASC' ? '&desc' : '') ?>">Naziv</a></th>
							<th><a href="proizvodi.php?orderby=3<?php print ($orderBy == 3 && $desc == 'ASC' ? '&desc' : '') ?>">Tip</a></th>
							<th><a href="proizvodi.php?orderby=4<?php print ($orderBy == 4 && $desc == 'ASC' ? '&desc' : '') ?>">Opis</a></th>
							<th><a href="proizvodi.php?orderby=5<?php print ($orderBy == 5 && $desc == 'ASC' ? '&desc' : '') ?>">Vegetarijanski</a></th>
							<th><a href="proizvodi.php?orderby=6<?php print ($orderBy == 6 && $desc == 'ASC' ? '&desc' : '') ?>">Halal</a></th>
							<th><a href="proizvodi.php?orderby=7<?php print ($orderBy == 7 && $desc == 'ASC' ? '&desc' : '') ?>">Košer</a></th>
							<th>Alergeni</th>
							<th><a href="proizvodi.php?orderby=8<?php print ($orderBy == 8 && $desc == 'ASC' ? '&desc' : '') ?>">Cijena</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($result = $dbc->query($sql)) {
								while ($row = $result->fetch_row()) {
									print '<tr>';
										for($i = 1; $i < 8; ++$i) {
											print '<td>'.($i >= 4 && $i < 7 ? ($row[$i] ? 'DA' : 'NE') : $row[$i]).($i == 7 ? ' kn' : '').'</td>';
											
											if($i == 6) {
												$alergenisql = "SELECT id_proizvoda, GROUP_CONCAT( alergeni.naziv SEPARATOR ', ') FROM alergeni_u_proizvodu JOIN alergeni ON alergeni.id = alergeni_u_proizvodu.id_alergena WHERE id_proizvoda = ".$row[0]." GROUP BY id_proizvoda;";
												if($alergeni = $dbc->query($alergenisql)) {
													$alergenirow = $alergeni->fetch_row();
													print '<td>'.$alergenirow[1].'</td>';
												} else {
													print '<td>'.$alergenisql.'</td>';
												}
											}
										}
									print '</tr>';
								}
								$result->close();
							}
							$dbc->close();
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<footer class="container">
		<span>Copyright ZKD, 2015</span>
	</footer>
</body>
</html>