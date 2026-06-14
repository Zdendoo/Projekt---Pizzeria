<?php
require_once 'classes/Database.php';
require_once 'classes/Pizza.php';

$database = new Database();
$db = $database->getConnection();
$pizzaManager = new Pizza($db);


$pizzas = $pizzaManager->getAll();
?>

<?php include 'parts/head.php'; ?>

<body id="home" data-spy="scroll" data-target=".navbar-collapse">

<?php include 'parts/header.php'; ?>

	
	<div class="flexslider">
        <ul class="slides">
            <li>
                <img src="images/slider-img1.jpg" alt="Pizza Image 1">
                <div class="flex-caption">
                    <h2 class="slider-title">Pečieme s láskou</h2>
                    <h3 class="slider-subtitle">Vždy čerstvá, chrumkavá a voňavá.</h3>
                    <p class="slider-description">Zabudni na polotovary. U nás v LaZdenda robíme pizzu od základu z poctivého cesta a čerstvých surovín. Čil je ten správny čas hodiť hlad za hlavu a dať si poriadny kus Talianska.</p>
                </div>
            </li>
            <li>
                <img src="images/slider-img2.jpg" alt="Pizza Image 2">
                <div class="flex-caption">
                    <h2 class="slider-title">Čerstvo vytiahnutá z pece</h2>
                    <h3 class="slider-subtitle">Prémiová kvalita, tie najlepšie ingrediencie</h3>
                    <p class="slider-description">Nestrácaj čas pri šporáku. Vyber si svoju obľúbenú klasiku alebo pikantný špeciál čil hneď teraz. Naša blesková donáška ti ju dovezie domov ešte horúcu, priamo z rozohriatej pece!</p>
                </div>
            </li>
        </ul>
    </div>
	

	
	<section id="about" class="templatemo-section templatemo-top-130">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 class="text-uppercase">Vaša Pizzeria</h1>
				</div>
				<div class="col-md-6 col-sm-6">					
					<h3 class="text-uppercase padding-bottom-10">Len další pekár..</h3>
					<p>Vitajte v našej pizzerii, kde sa vášeň pre jedlo spája s tradičnou talianskou pohostinnosťou. Už roky pre vás pečieme pizzu podľa tajných rodinných receptov, ktoré zaručujú tú najlepšiu chuť v meste.</p>
					<p>Základom každej našej pizze je domáce cesto, ktoré nechávame poctivo kysnúť, a tie najčerstvejšie suroviny. Od chrumkavých okrajov až po bohatú oblohu – na kvalite si dávame skutočne záležať.</p>
					<p>Príďte k nám posedieť s rodinou a priateľmi, alebo si vychutnajte kúsok Talianska v pohodlí domova. Sme tu pre vás každý deň, pripravení splniť všetky vaše gurmánske priania.</p>
				</div>
				<div class="col-md-6 col-sm-6">
					<img src="images/about-img1.jpg" class="img-responsive img-bordered img-about" alt="about img">
				</div>
			</div>
		</div>
	</section>
	

	
<section id="gallery" class="templatemo-section templatemo-light-gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-uppercase">Naša ponuka pízz</h2>
                <hr>
            </div>
            
            <?php if (empty($pizzas)): ?>
                <div class="col-md-12 text-center">
                    <p>V ponuke nie su žiadne pizze.</p>
                </div>
            <?php else: ?>
                <?php foreach ($pizzas as $pizza): ?>
                    <div class="col-md-4 col-sm-6" style="margin-bottom: 30px;">
                        <div class="gallery-wrapper">
                            <img src="images/<?= htmlspecialchars($pizza['obrazok']) ?>" class="img-responsive gallery-img" alt="<?= htmlspecialchars($pizza['nazov']) ?>">
                            <div class="gallery-des">
                                <h3><?= htmlspecialchars($pizza['nazov']) ?></h3>
                                <h5><?= htmlspecialchars($pizza['popis']) ?></h5>
                                <strong style="color: #d9534f; font-size: 1.3em; display: block; margin-top: 10px;">
                                    <?= number_format((float)$pizza['cena'], 2, ',', ' ') ?> €
                                </strong>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
                             
        </div>
    </div>
</section>
	

	
	<section id="contact" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-uppercase text-center">Kontaktuje Nás</h2>
					<hr>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form action="functions.php" method="post" role="form">
    					<div class="col-md-6 col-sm-6">
        					<input name="name" type="text" class="form-control" id="name" placeholder="Meno">
        					<input name="email" type="email" class="form-control" id="email" placeholder="Email">
       						<input name="subject" type="text" class="form-control" id="subject" placeholder="Predmet">
   						</div>
    					<div class="col-md-6 col-sm-6">
        					<textarea name="message" class="form-control" rows="5" placeholder="Správa"></textarea>
    					</div>
    					<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
        					<input name="submit" type="submit" class="form-control" id="submit" value="Odoslať">
    					</div>
					</form>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4 col-sm-4">
					<h3 class="padding-bottom-10 text-uppercase">Navštívte náš podnik</h3>
					<p><i class="fa fa-map-marker contact-fa"></i> Župná 314/8, 953 01 Zlaté Moravce, Slovensko</p>
					<p>
						<i class="fa fa-phone contact-fa"></i> 
						<a href="tel:010-020-0340" class="contact-link">010-020-0340</a>, 
						<a href="tel:080-090-0660" class="contact-link">080-090-0660</a>
					</p>			
					<p><i class="fa fa-envelope-o contact-fa"></i> 
                    	<a href="mailto:hello@company.com" class="contact-link">lazdenda@pizzeria.com</a></p>
				</div>
				<div class="col-md-4 col-sm-4">
					<h3 class="text-uppercase">Otváracie Hodiny</h3>
					<p><i class="fa fa-clock-o contact-fa"></i> 8:00 - 22:00 </p>
					<p><i class="fa fa-bell-o contact-fa"></i> Ponedol až Piatok a Nedeľa</p>
			  	</div>
				<div class="col-md-4 col-sm-4">
					<div class="google_map">
						<div id="map-canvas" class="map"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php include 'parts/footer.php'; ?>
<?php include 'parts/script.php'; ?>

</body>
</html>