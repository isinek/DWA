<?php
/*
 * više primjera i informacija, te dodatnih providera potražite na
 * http://silex.sensiolabs.org/
 * http://maran-emil.de/nodes/80-github-open-source-projects-based-on-silex-php-framework
 *
 * Dodatni service providers
 * https://github.com/silexphp/Silex/wiki/Third-Party-ServiceProviders
 *
 * Kako napiati svoj provider:
 * http://srcmvn.com/blog/2013/02/22/writing-silex-service-providers/
 *
 *
 */



require_once 'vendor/autoload.php';
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



try {
    // stvorimo novu Silex aplikaciju
    $app = new Silex\Application();
	
	$app['debug'] = true;
	
    // registriramo dodatne komponente
    // Silex je u osnovi framework na koji se dodaju komponente, a router je najvažniji dio.
    // registriramo podršku za TWIG
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));
    // registriramo podršku za IDIORM kroz PARIS
    $app->register(new FranMoreno\Silex\Provider\ParisServiceProvider());
	
	// podrška za sesije u Silexu! 
    $app->register(new Silex\Provider\SessionServiceProvider());


	// Funkcija koja provjerava u sesiji radi li se o ulogiranom korisniku.
	// Ova funkcija se poziva kao "before" funkcija prije glavne funkcije rute
	// te se izvršava prije glavne funkcije rute. Ako netko nije ulogiran, 
	// preusmjerit će se na login stranicu.
	$authorize = function (Request $request,  Silex\Application $app){ 
		 $request->getSession()->start();
		 
		 // provjera podataka o ulogiranosti kroz sesiju
		 if ($request->hasPreviousSession() && $request->getSession()->has('user')){
			 return;
        }
        return $app->redirect('login');
      
};
	
	
	
	
	
	// postavi GET rutu za upit /hello/Marko  ( npr. http://localhost:8001/lab6/hello/Marko)
    $app->get('/hello/{name}' , function($name) use ($app) {
		return $app['twig']->render('hello.twig', array(
			'title' => 'HELLO', 
			'ProjectName' => 'Laboratorijska vježba 6 - '.$name,
			'MenuOption1' => 'Početna',
			'MenuOption2' => 'Druga',
			'MenuOption3' => 'Treća',
			'text' => array ('title' => 'Naslov', 'text' => 'Primjer rada cijelog sustava pripremljen za '.$name)
		));
	});
	
	
	
	
	
	// GET ruta za sve vijesti
	// prikazi sve vijesti i ostale zanimljivosti o stranicama
	// Napomena: neke su vijesti hardkodirane, neke dolaze iz baze.
	$app->get('/news',  function () use ($app) {
		
		include_once('logic/idiormUse.php');

		// podaci iz baze
        // ovo se moglo napisati i drugačije, pogledati dokumentaciji Idiorma
		$allDataFromDatabase = ORM::for_table('vijesti')
			->select('vijesti.*')
			->find_array();
		
		// hardkodirane vrijednosti		
		$allDataHardcoded=[
			['id' => 1, 'title' => 'Ovo je naslov', 'author' => 'Stipe', 'date' => '2015-05-06', 'text' => "Tekst vijesti Vivamus fermentum semper porta. Nunc diam velit, adipiscing ut tristique vitae, sagittis vel odio. Maecenas convallis ullamcorper ultricies. Curabitur ornare, ligula semper consectetur sagittis, nisi diam iaculis velit, id fringilla sem nunc vel mi. Nam dictum, odio nec pretium volutpat, arcu ante placerat erat, non tristique elit urna et turpis. Quisque mi metus, ornare sit amet fermentum et, tincidunt et orci. Fusce eget orci a orci congue vestibulum. Ut dolor diam, elementum et vestibulum eu, porttitor vel elit. Curabitur venenatis pulvinar tellus gravida ornare. Sed et erat "],
			['id' => 2, 'title' => 'Ovo je drugi naslov', 'author' => 'Opet Stipe', 'date' => '2015-05-03', 'text' => "Tekst druge vijesti"],
		    ['id' => 3, 'title' => 'Ovo je naslov', 'author' => 'Stipe', 'date' => '2015-04-27', 'text' => "Tekst vijesti Vivamus fermentum semper porta. Nunc diam velit, adipiscing ut tristique vitae, sagittis vel odio. Maecenas convallis ullamcorper ultricies. Curabitur ornare, ligula semper consectetur sagittis, nisi diam iaculis velit, id fringilla sem nunc vel mi. Nam dictum, odio nec pretium volutpat, arcu ante placerat erat, non tristique elit urna et turpis. Quisque mi metus, ornare sit amet fermentum et, tincidunt et orci. Fusce eget orci a orci congue vestibulum. Ut dolor diam, elementum et vestibulum eu, porttitor vel elit. Curabitur venenatis pulvinar tellus gravida ornare. Sed et erat "],
			['id' => 4, 'title' => 'Ovo je drugi naslov', 'author' => 'Opet Stipe', 'date' => '2015-04-22', 'text' => "Tekst druge vijesti"],
		
		];
		
		// spoji dva niza podataka
		$allData=array_merge($allDataFromDatabase, $allDataHardcoded);
	
		// prikaži odgovarajući template
		return $app['twig']->render('allPosts.twig', array("allnews"=>$allData,'title' => "Sve vijesti",'basicDir'=>''));
	})->before($authorize);  // before funkcija koja se izvršava prije glavne funkcije rute.
	
	
	
	
	 // GET ruta za login
	 // prikazi login ekran
	 $app->get('/login',  function () use ($app) {
		return $app['twig']->render('loginForm.twig');
	});
	
	
	
	// GET ruta za jednu vijest
	// prikazi vijest
	$app->get('/news/{id}',  function ($id) use ($app) {
		
		include_once('logic/idiormUse.php');

		// podatak iz baze
        // ovo se moglo napisati i drugačije, pogledati dokumentaciji Idiorma
		$news = ORM::for_table('vijesti')
			->select('vijesti.*')
			->where(id,$id)
			->find_array();
		
		
		// prikaži odgovarajući template
		return $app['twig']->render('onePost.twig', array("news"=>$news[0],'title' => "Vijest ".$id, 'basicDir'=>'../'));
	})->before($authorize);  // before funkcija koja se izvršava prije glavne funkcije rute.
	
	
	
	
	 // GET ruta za login
	 // prikazi login ekran
	 $app->get('/login',  function () use ($app) {
		return $app['twig']->render('loginForm.twig');
	});
	
	
	
	
	// POST ruta za login
	// obradi login podatke i postavi sesiju
	 $app->post('/login', function (Request $request) use ($app) {
	    $parameters = $request->request->all();
    
		// provjera za ulogiranost - postavi sesiju i redirektaj na osnovnu stranicu
		if ($parameters['inputUsername']=='stipe' and $parameters['inputPassword']=='123') {
			 $app['session']->set('user', array('username' => $inputUsername));
			
			return $app->redirect('news');
		}
		else return $app->redirect('login');
    });
	
	
	
	
	// GET ruta za logout
	 // izlogira (brise podatke iz sesije) i vraća na login ekran
	 $app->get('/logout',  function () use ($app) {
		 $app['session']->remove('user'); 
		return $app->redirect('login');
	});


    $app->run();
}
catch (Exception $ex) {
    echo $ex->getMessage();
}
