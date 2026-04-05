<?php include 'parts/head.php'; ?>
<?php include 'parts/header.php'; ?>

	<section id="contact" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-uppercase text-center">Kontaktujte nás</h2>
					<hr>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form action="#" method="post" role="form">
						<div class="col-md-6 col-sm-6">
							<input name="name" type="text" class="form-control" id="name" maxlength="60" placeholder="Name">
					    	<input name="email" type="email" class="form-control" id="email" placeholder="Email">
							<input name="message" type="text" class="form-control" id="message" placeholder="Subject">
						</div>
						<div class="col-md-6 col-sm-6">
							<textarea class="form-control" rows="5" placeholder="Message"></textarea>
						</div>
						<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
							<input name="submit" type="submit" class="form-control" id="submit" value="Send">
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4 col-sm-4">
					<h3 class="padding-bottom-10 text-uppercase">Visit our shop</h3>
					<p><i class="fa fa-map-marker contact-fa"></i> 63 Another Walking Street, BKK 18080</p>
					<p>
						<i class="fa fa-phone contact-fa"></i> 
						<a href="tel:010-020-0340" class="contact-link">010-020-0340</a>, 
						<a href="tel:080-090-0660" class="contact-link">080-090-0660</a>
					</p>			
					<p><i class="fa fa-envelope-o contact-fa"></i> 
                    	<a href="mailto:hello@company.com" class="contact-link">hello@company.com</a></p>
				</div>
				<div class="col-md-4 col-sm-4">
					<h3 class="text-uppercase">Opening hours</h3>
					<p><i class="fa fa-clock-o contact-fa"></i> 7:00 AM - 11:00 PM</p>
					<p><i class="fa fa-bell-o contact-fa"></i> Monday to Friday and Sunday</p>
                    <p><i class="fa fa-download contact-fa"></i> 
                    	<a class="contact-link" rel="nofollow" 
                        	href="http://fontawesome.io/icons/" target="_blank">Change Icons</a></p>
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