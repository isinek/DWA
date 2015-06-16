<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if(!isset($_SESSION['username'])) {
		session_destroy();
		header('Location: login.html');
	}
	$orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : 2;
	$desc = isset($_GET['desc']) ? 'DESC' : 'ASC';
	
	$dbc = mysqli_connect( 'localhost', 'root', '123', 'zkd' ) or die('Pogreška kod spajanja na bazu podataka.');
	$sql = "SELECT tip_proizvoda.naziv, count(proizvodi.id) FROM proizvodi JOIN tip_proizvoda ON proizvodi.tip = tip_proizvoda.id GROUP BY 1;";
	
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
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/highcharts-3d.js"></script>
	<script src="js/custom.js"></script>
	<script>
		function printToPdf(obj) {
			var path = 'print-to-pdf.php?html='+jQuery('#tableProizvodi')[0];
			jQuery.ajax({
				url: path,
				success: function (data) {
					obj.attr({target: '_blank', href: 'http://localhost/directory/file.pdf'});
				}
			});
		}
	</script>
    <script type="text/javascript">
        $(function () {
            // Set up the chart
            var chart = new Highcharts.Chart({
                    chart: {
                    renderTo: 'chart-container',
                    type: 'column',
                    margin: 75,
                    options3d: {
                        enabled: true,
                        alpha: 15,
                        beta: 15,
                        depth: 50,
                        viewDistance: 25
                    }
                },
                title: {
                    text: 'Neke slastice'
                },
                subtitle: {
                    text: ''
                },
                plotOptions: {
                    column: {
                        depth: 25
                    }
                },
                series: [{
                    data: [
                        <?php 
                        if($result = $dbc->query($sql)) {
                            $flag = false;
                            while ($row = $result->fetch_row()) {
                                if($flag)
                                    print ', ';
                                else
                                    $flag = true;
                                print $row[1];
                            }
                        }
                        ?>
                    ]
                }]
            });

        });
            
        $(function () {

    // Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });

    // Build the chart
    $('#pie-container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Neke slastice'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Slastice',
            data: [
                <?php 
                if($result = $dbc->query($sql)) {
                    $flag = false;
                    while ($row = $result->fetch_row()) {
                        if($flag)
                            print ', ';
                        else
                            $flag = true;
                        print '["'.$row[0].'", '.$row[1].']';
                    }
                }
                ?>
            ]
        }]
    });
});
    </script>
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
	<section id="chart-container" class="container content">
	</section>
    <section id="pie-container" class="container content">
	</section>
	<footer class="container">
		<span>Copyright ZKD, 2015</span>
	</footer>
</body>
</html>