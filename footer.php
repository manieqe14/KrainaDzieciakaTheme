</main>

<footer>
	<div id="footer-first-row" class="footer-row">
		<div id="footer-first-row-container" class="footer-row-container">
			<div class="footer-block-wrapper">
				<div id="footer-pomoc-block" class="footer-block">
					<ul>
						<p class="footer-title title">
						Informacje
						</p>
						<div class="divider-2"><span></span></div>
						<!-- <li>Tabela rozmiarów</li> -->
						<li><a href="/o-nas">O nas</a></li>
						<li><a href="/my-account">Twoje konto</a></li>
						<li><a href="/regulamin">Regulamin</a></li>
						<li><a href="/polityka-prywatnosci">Polityka prywatności</a></li>
					</ul>
				</div>
			</div>
			<div class="footer-block-wrapper">
				<div id="footer-contact-block" class="footer-block">
					<ul>
						<p class="footer-title title">
						Zakupy
						</p>
						<div class="divider-2"><span></span></div>
						<li><a href="<?php get_site_url(); ?>/polityka-zwrotow">Polityka zwrotów</a></li>
						<li><a href="<?php echo get_site_url();?>/koszty-dostawy/">Koszty dostawy</a></li>
						<li class="footer-non-link">Formy płatności</li>
						<li class="footer-non-link"><img src="<?php echo get_template_directory_uri();?>/assets/img/przelewy24-vector-logo.png" width="100%"></li>		
					</ul>
				</div>
			</div>
			<div class="footer-block-wrapper">
				<div id="footer-wazne-block" class="footer-block">
					<?php echo do_shortcode("[kraina_contact_info]"); ?>
					
				</div>
			</div>
		</div>
	</div>
	<div id="footer-second-row" class="footer-row">
		<div id="footer-second-row-container" class="footer-row-container">
			<span>2020 © Krainadzieciaka.pl</span>
		</div>
	</div>
</footer>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">

	
</div><!--/.wrapper-->
<?php wp_footer(); ?>

</body>

</html>
