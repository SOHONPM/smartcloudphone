<?php
/**
* Template to display contact page
*
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @since   1.0.0
* @package themezero
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

?>


<main class="content" id="content" itemscope itemtype="http://schema.org/WebPageElement">
	<?php get_template_part( 'template-parts/loop/content', 'banner' );  ?>

			<!-- Contact Page Section -->
			<section class="contact-page-section">	
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							 <div class="row">
							 	<div class="col-md-6">
							 		<div class="content-box">
							 			 <?php the_field( 'address_1' ); ?>
							 		</div>
							 	</div>
							 	<div class="col-md-6">
							 		<div class="content-box">
							 			<?php the_field( 'address_2' ); ?>
							 		</div>
							 	</div>
							 </div>
						</div>
						<div class="col-md-6">
							<!-- form-extra -->
							 	<?php the_field( 'form' ); ?>
							<!-- .form-extra -->
						</div>
					</div>
				</div>					
			</section>
			<!-- Contact Page Section -->
		
	
			<!-- Contact Map Section -->
			<section class="contact-map-section">
				<div class="container">
					<div class="map-outer">
						<h3>Our Location</h3>
						<div id="map"></div>
						<script>
					      var map;
					      function initMap() {
					        map = new google.maps.Map(document.getElementById('map'), {
					          center: {lat: 10.325176, lng: 123.906494},
					          zoom: 16
					        });
					      }
					    </script>
					    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn4uayw359fjMh4P9i2rKKZYHzXaqTRNs&callback=initMap"
					    async defer></script>
					</div>
				</div>
			</section>
			<!-- Contact Map Section -->	

</main>


<?php get_footer(); ?>
