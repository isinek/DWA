<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if(!isset($_SESSION['username'])) {
		session_destroy();
		header('Location: login.html');
	}
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
					<a class="nav-link active" href="zivotopis.php">Životopis</a>
					<a class="nav-link" href="proizvodi.php">Proizvodi</a>
				</nav>
			</div>
			<div class="col-md-9 col-sm-12">
				<article class="row">
					<h2>Osobni podaci</h2>
					<table>
						<tbody>
							<tr>
								<td>Ime i prezime: </td>
								<td>Ivan Sinek</td>
							</tr>
							<tr>
								<td>Datum rođenja: </td>
								<td>01.05.1993.</td>
							</tr>
							<tr>
								<td>Mjesto rođenja: </td>
								<td>Bjelovar</td>
							</tr>
							<tr>
								<td>Email: </td>
								<td>isinek@tvz.hr</td>
							</tr>
							<tr>
								<td>Društvena mreža: </td>
								<td>hr.linkedin.com/in/ivansinek</td>
							</tr>
						</tbody>
					</table>
				</article>
				<article class="row">
					<h2>Podaci o školovanju</h2>
					<div class="col-sm-6 col-xs-12">
						<h3>Srednja škola</h3>
						<ul>
							<li>od 2008. do 2012. godine</li>
							<li>Tehnička škola Bjelovar</li>
							<li>Smjer računalni tehničar</li>
						</ul>
					</div>
					<div class="col-sm-6 col-xs-12">
						<h3>Fakultet</h3>
						<ul>
							<li>od 2012. do sada</li>
							<li>Tehničko veleučilište u Zagrebu</li>
							<li>Stručni prvostupnik inženjer računarstva</li>
						</ul>
					</div>
				</article>
				<article class="row">
					<h2>Podaci o radnom iskustvu</h2>
					<div class="col-md-6 col-sm-12">
						<h3>Stručna praksa u sklopu srednjoškolskog obrazovanja</h3>
						<ul>
							<li>19 srpnja 2010. – 25. svibnja 2012.</li>
							<li>Business computer systems, Bjelovar (Hrvatska)</li>
							<li>Održavanje i servis računala i računalne opreme</li>
						</ul>
					</div>
					<div class="col-md-6 col-sm-12">
						<h3>Održavaje i izrada web aplikacija</h3>
						<ul>
							<li>12. prosinca 2013. – 3. lipnja 2014.</li>
							<li>Cesar informatika d.o.o., Zagreb (Hrvatska)</li>
							<li>Dodavanje novih mogućnosti u postojeće aplikacije i izmjene već postojećih
							<li>Izmjene dizajna web stranice</li>
							<li>Rad na projektima Educator za Srednja.hr i Grader za Tehničko veleučilište u Zagrebu</li>
						</ul>
					</div>
					<div class="col-md-6 col-sm-12">
						<h3>Web Developer</h3>
						<ul>
							<li>5. svibnja 2014. – danas</li>
							<li>BoatBooker, Zagreb (Hrvatska)</li>
							<li>Programiranje i oblikovanje web stranica u Drupal frameworku
							<li>Izrada HTML emailova (newslettera)</li>
							<li>Održavanje SugarCRM-a</li>
						</ul>
					</div>
				</article>
				<article class="row">
					<h2>Znanja i vještine</h2>
					<div class="col-md-6 col-sm-12">
						<h3>Računalne vještine</h3>
						<ul>
							<li>HTML5, CSS3, JavaScript, jQuery, PHP</li>
							<li>Drupal</li>
							<li>C, C++, C#</li>
							<li>Java</li>
							<li>Symfony, Umbraco</li>
							<li>ASP.NET MVC</li>
							<li>Adobe Photoshop, Illustrator</li>
							<li>Android, Microsoft XNA</li>
							<li>Microsoft Office</li>
						</ul>
					</div>
					<div class="col-md-6 col-sm-12">
						<h3>Certifikati</h3>
						<ul>
							<li>98-349: MTA: Windows® Operating System Fundamentals</li>
							<li>98-375: MTA: HTML5 Application Development Fundamentals</li>
						</ul>
					</div>
				</article>
			</div>
		</div>
	</section>
	<footer class="container">
		<span>Copyright ZKD, 2015</span>
	</footer>
</body>
</html>