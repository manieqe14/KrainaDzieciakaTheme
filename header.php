<?php
/**
 * The template for displaying the header
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<title><?php 
                $uri = urldecode($_SERVER['REQUEST_URI']);
                
                if(is_product()){
                    the_title();
                    echo  ' - ';
                }
                
                else{
                   
                    if(is_product_category()){
                        echo single_cat_title() . ' - ';
                    }
                    
                     if (strpos($uri, "kolekcja") !== false){
                        
                        echo 'Kolekcja ';
                        if( $uri[strpos($uri, 'kolekcja') + 9] == '5'){
                            $digit = strpos($uri, 'kolekcja') + 11;
                        }
                        else{
                            $digit = strpos($uri, 'kolekcja') + 9;
                        }
                        
                        while(!(($uri[$digit] == ']') || ($uri[$digit] == '%'))){
                            echo strtoupper($uri[$digit]);
                            $digit++;
                        }
                         echo ' - ';
                    }
                    
                    if (strpos($uri, "?s=") !== false){
                        
                        echo 'Wyniki wyszukiwania: ';
                        $digit4 = strpos($uri, "?s=") + 3;
                        
                        while(!($uri[$digit4] == '&')){
                            echo $uri[$digit4];
                            $digit4++;
                        }
                         echo ' - ';
                    }

                    if (strpos($uri, "producent") !== false){
                        if( $uri[strpos($uri, 'producent') + 10] == '5'){
                            $digit = strpos($uri, 'producent') + 12;
                        }
                        else{
                            $digit = strpos($uri, 'producent') + 10;
                        }
                        
                        while(!(($uri[$digit] == ']') || ($uri[$digit] == '%'))){
                            echo strtoupper($uri[$digit]);
                            $digit++;
                        }
                         echo ' - ';
                    }
                    
                    if (strpos($uri, "plec") !== false){
                        if(strpos($uri, 'dziewczynka') !== false){
                            echo 'Dziewczynka ';
                        }
                        else{
                            echo 'Chłopiec ';
                        }
                        echo ' - ';
                    }
                    
                    if (strpos($uri, "rozmiar") !== false){
                        if( $uri[strpos($uri, 'rozmiar') + 8] == '5'){
                            $digit5 = strpos($uri, 'rozmiar') + 10;
                        }
                        else{
                            $digit5 = strpos($uri, 'rozmiar') + 8;
                        }
                        
                        echo 'rozmiar ';
                        
                        while(!(($uri[$digit5] == ']') || ($uri[$digit5] == '%'))){
                            echo $uri[$digit5];
                            $digit5++;
                        }
                         echo ' - ';
                    }
                    
                    
                    if (strpos($uri, "page") !== false){
                        
                        $digit2 = strpos($uri, 'page') + 5;
                        
                        echo 'strona ';
                                               
                        while(($uri[$digit2] !== '/') && ($digit2 < strlen($uri))){
                            echo strtoupper($uri[$digit2]);
                            $digit2++;
                        }
                         echo ' - ';
                    }
                    
                    if(!is_woocommerce()){
                        echo single_post_title() . ' - ';
                    }
                }
                echo 'Kraina Dzieciaka - sklep z ubrankami dla najmłodszych';
                ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">

	<script type='text/javascript' src="<?php echo get_template_directory_uri();?>/assets/js/jquery-3.5.1.min.js"></script>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<script rel="preload" src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
	<!-- <script async src="<?php echo get_template_directory_uri();?>/assets/js/maniek_functions.js"></script> -->
	
	<!-- inpost map -->
	<?php if(is_checkout()){?>
	<script src="https://geowidget.easypack24.net/js/sdk-for-javascript.js"></script>
	<link rel="stylesheet" href="https://geowidget.easypack24.net/css/easypack.css"/>
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?> >
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
<div id="loader-wrapper">
	<div id="loader"></div>
</div>

<?php wp_body_open(); ?>

<div id="mobile-menu">
	<div class="kraina-header-menu-mobile">
		<div class="menu-category-mobile expanded-menu">
			<div class="mobile-category-wrapper">
				<a class="menu-link" href=""><span>Produkty</span></a>
			</div>
			<div class="menu-sub-categories-mobile">
				<?php
			$cat_args = array(
				'hide_empty' => false,
			);
				
			$product_categories = get_terms( 'product_cat', $cat_args );							 
			echo '<ul class="sub-categories-list-mobile">';
				foreach ($product_categories as $key => $category) {
					if($category->parent == 0){
						echo '<li>';
						echo '<a href="'. get_term_link($category).'" >';
						echo $category->name;
						echo '</a></li>';
					}
				}
			echo '</ul>';
			?>
			</div>
		</div>
		<div class="menu-category-mobile expanded-menu">
			<div class="mobile-category-wrapper">
				<a class="menu-link" href=""><span>Dziewczynka</span></a>
			</div>
			<div class="menu-sub-categories-mobile">
				<?php
				$cat_args = array(
					'hide_empty' => false,
				);
				
				$product_categories = get_terms( 'product_cat', $cat_args );							 
				echo '<ul class="sub-categories-list-mobile">';
					foreach ($product_categories as $key => $category) {
						if($category->parent == 0){
							echo '<li>';
							echo '<a href="'. get_term_link($category).'/?filters=plec[dziewczynka]" >';
							echo $category->name;
							echo '</a></li>';
						}
					}
				echo '</ul>';
				?>
			</div>
		</div>
		<div class="menu-category-mobile expanded-menu">
			<div class="mobile-category-wrapper">
				<a class="menu-link" href=""><span>Chłopiec</span></a>
			</div>
			<div class="menu-sub-categories-mobile">
				<?php
				$cat_args = array(
					'hide_empty' => false,
				);
				
				$product_categories = get_terms( 'product_cat', $cat_args );							 
				echo '<ul class="sub-categories-list-mobile">';
					foreach ($product_categories as $key => $category) {
						if(($category->parent == 0) && ($category->name != 'Sukienki')){
							echo '<li>';
							echo '<a href="'. get_term_link($category).'/?filters=plec[chlopiec]" >';
							echo $category->name;
							echo '</a></li>';
						}
					}
				echo '</ul>';
				?>
			</div>
		</div>
		<!-- <div class="menu-category-mobile">
			<a class="menu-link polecane-link" href="<?php echo get_home_url(); ?>/home/promocje">Promocje</a>
		</div> -->
		<!-- <div class="menu-category">
			<a class="menu-link" href="<?php echo get_home_url(); ?>/home/?filters=product_tag%5B69%5D">Polecane</a>
		</div> -->
		<!-- <div class="menu-category">
			<a class="menu-link" href="<?php echo site_url('/blog');?>">Blog</a>
		</div -->
	</div>
	<div class="socials">
		<?php do_shortcode('[maniek_social_short]'); ?>
	</div>
</div>

<div class="wrapper">
	<header id="header-kraina-desktop" class="kraina-fixed">
		<div id="maniek-header-wrapper-desktop">
            <div class="komunikaty <? if(get_option( 'map_urlop_checkbox' ) == 0) echo 'hidden';?>">
                <?php echo get_option('map_urlop_text');?>
            </div>
			<div class="columns">
				<div class="first-col-header-desktop desktop-column">
					<div class="first-col-1st-row-header-desktop">
						<?php do_shortcode('[maniek_social_short]'); ?>
					</div>
					<div class="first-col-2nd-row-header-desktop">
						<div class="kraina-header-menu">
							<div class="menu-category expanded-menu">
								<span class="menu-link">Produkty</span>
								<div class="menu-sub-categories">
									<?php
								$cat_args = array(
								    'hide_empty' => false,
								);
								 
								$product_categories = get_terms( 'product_cat', $cat_args );							 
								echo '<ul class="sub-categories-list">';
								    foreach ($product_categories as $key => $category) {
										if($category->parent == 0){
											echo '<li>';
											echo '<a href="'. get_term_link($category).'" >';
											echo $category->name;
											echo '</a></li>';
										}
								    }
								echo '</ul>';
								?>
								</div>
							</div>
							<div class="menu-category expanded-menu">
								<span class="menu-link">Dziewczynka</span>
								<div class="menu-sub-categories">
									<?php
									$cat_args = array(
										'hide_empty' => false,
									);
									
									$product_categories = get_terms( 'product_cat', $cat_args );							 
									echo '<ul class="sub-categories-list">';
										foreach ($product_categories as $key => $category) {
											if($category->parent == 0){
												echo '<li>';
												echo '<a href="'. get_term_link($category).'/?filters=plec[dziewczynka]" >';
												echo $category->name;
												echo '</a></li>';
											}
										}
									echo '</ul>';
									?>
								</div>
							</div>
							<div class="menu-category expanded-menu">
								<span class="menu-link">Chłopiec</span>
								<div class="menu-sub-categories">
									<?php
									$cat_args = array(
										'hide_empty' => false,
									);
									
									$product_categories = get_terms( 'product_cat', $cat_args );							 
									echo '<ul class="sub-categories-list">';
										foreach ($product_categories as $key => $category) {
											if(($category->parent == 0) && ($category->name != 'Sukienki')){
												echo '<li>';
												echo '<a href="'. get_term_link($category).'/?filters=plec[chlopiec]" >';
												echo $category->name;
												echo '</a></li>';
											}
										}
									echo '</ul>';
									?>
								</div>
							</div>
							<!-- <div class="menu-category">
								<a class="menu-link polecane-link" href="<?php echo get_home_url(); ?>/home/promocje">Promocje</a>
							</div> -->
							<!-- <div class="menu-category">
								<a class="menu-link" href="<?php echo get_home_url(); ?>/home/?filters=product_tag%5B69%5D">Polecane</a>
							</div> -->
							<!-- <div class="menu-category">
								<a class="menu-link" href="<?php echo site_url('/blog');?>">Blog</a>
							</div -->
						</div>
					</div>
				</div>
				<div class="second-col-header-desktop desktop-column">
					<a href="<?php echo get_home_url(); ?>">
						<div id="logo-desktop">
							<?php echo do_shortcode('[logo_full_svg]');?>
							<?php echo do_shortcode('[logo_text_svg]');?>
<!-- 							<img id="logo-desktop" class="kraina-not-lazy" src="/wp-content/uploads/2020/header/logo_mini.png">
 -->						</div>
					</a>
				</div>
				<div class="third-col-header-desktop desktop-column">
					<div class="third-col-1st-row-header-desktop">
						<?php echo do_shortcode('[wcas-search-form]'); ?>
					</div>
					<div class="third-col-2nd-row-header-desktop socials">
						<?php echo do_shortcode('[wishlist_mini_cart]');
								echo do_shortcode('[kraina_my_account]');
								echo do_shortcode('[woo_cart_but_kraina]');?>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<header id="header-kraina-mobile" class="kraina-sticky">
		<div id="maniek-header-wrapper-mobile">
            <div class="komunikaty <? if(get_option( 'map_urlop_checkbox' ) == 0) echo 'hidden';?>">
                <?php echo get_option('map_urlop_text');?>
            </div>
			<div id="mobile-first-row">
				<a href="<?php echo get_home_url(); ?>">
						<img id="logo-mobile" class="kraina-not-lazy" src="/wp-content/uploads/2021/01/cropped-logo_mini.png">
				</a>
			</div>
			<div id="mobile-second-row" class="socials">
				<a id='menu-mobile-toggle-link'></a>
				<?php echo do_shortcode('[wcas-search-form]'); ?>
				<?php echo do_shortcode('[wishlist_mini_cart]');
						echo do_shortcode('[kraina_my_account]');
						echo do_shortcode('[woo_cart_but_kraina]');?>
			</div>
		</div>
	</header>
	<main id="kraina-content">
	

<?php





	

