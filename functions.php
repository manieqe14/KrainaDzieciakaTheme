<?php 

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $ver = 1.59;
    wp_enqueue_style( 'theme-styles', get_stylesheet_directory_uri()  . '/style.css', array(), $ver);
    wp_register_script('maniek_script', get_stylesheet_directory_uri()  . '/assets/js/maniek_functions.js', array('jquery'),$ver);
    wp_enqueue_script('maniek_script');
}

add_action('after_setup_theme', 'kraina_setup');
function kraina_setup(){
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}



add_shortcode ('woo_cart_but_kraina', 'woo_cart_but_kraina' );

add_action('widgets_init', 'kraina_sidebar');

function kraina_sidebar(){
  register_sidebar(array(
    'name' => 'Kraina Widgets',
    'id'   => 'kraina_widgets',
  ));

  register_sidebar(array(
    'name' => 'Kraina Widgets Upper Loop',
    'id'   => 'kraina_widgets_upper_loop',
  ));

}

//own yoast shortcode

// define the custom replacement callback
function short_description_for_yoast() {
    global $product;
    $uri = strtolower(urldecode($_SERVER['REQUEST_URI']));
    
    $term_obj  = get_term_by('slug', $product->get_attribute( 'pa_producent' ), 'pa_producent');
    
    
    if(strpos($uri, strtolower($term_obj->name)) !== false){
        return $term_obj->description;
    }
        
        
    return 'Producent: ' . $product->get_attribute('pa_producent') . ', ' . substr($product->get_short_description(), 0, -27);
}

// define the action for register yoast_variable replacments
function register_custom_yoast_variables() {
    wpseo_register_var_replacement( '%%product_shortcode%%', 'short_description_for_yoast', 'advanced', 'some help text' );
}

// Add action
add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');

//disable emojis

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


//mini cart update

function woo_cart_but_kraina() {
	    ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <div id="cart-hover-me">
            <div id="custom-cart-div">
                <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
                <?php
                if ( $cart_count > 0 ) {
                ?>
                    <span class="cart-contents-count"><?php echo $cart_count; ?></span>
                <?php
                }
                ?>
                </a>
            <?php echo custom_mini_cart(); ?>
            </div>
        </div>
        <?php
	        
    return ob_get_clean();
 
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
/**
 * Add AJAX Shortcode when cart contents update
 */


function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
        <div id="custom-cart-div">
            <a  class="cart-contents header-bottom-subtitle" href="<?php echo $cart_url; ?>" title="<?php _e( 'Zobacz koszyk' ); ?>">
                <svg class="header-bottom-icon" viewBox="-35 0 512 512.00102" xmlns="http://www.w3.org/2000/svg"><path d="M50.2,502c-1.5,0-2.9-0.6-3.9-1.7c-1-1.1-1.5-2.6-1.3-4.1l38.9-370.6c0.3-2.7,2.5-4.7,5.2-4.7h83.1V94.3
                    c0-46.5,37.8-84.3,84.3-84.3c46.5,0,84.3,37.8,84.3,84.3v26.7H424c2.7,0,4.9,2,5.2,4.7l38.9,370.6c0.2,1.5-0.3,2.9-1.3,4
                    c-1,1.1-2.4,1.7-3.9,1.7H50.2z M56.1,491.5h401l-37.8-360.1h-78.4V175c0,2.9-2.3,5.2-5.2,5.2s-5.2-2.4-5.2-5.2v-43.6H182.8V175
                    c0,2.9-2.4,5.2-5.2,5.2c-2.9,0-5.2-2.4-5.2-5.2v-43.6H93.9L56.1,491.5z M256.6,20.5c-40.7,0-73.8,33.1-73.8,73.8v26.7h147.6V94.3
                    C330.4,53.6,297.3,20.5,256.6,20.5z"/></svg>
                <span class="icon-subtitle">Koszyk</span>
            <?php
            if ( $cart_count > 0 ) {
            ?>
                <span class="cart-contents-count"><?php echo $cart_count; ?></span>
            <?php            
            }
            ?></a>
        </div>
        <?php echo custom_mini_cart(); ?>
    <?php
 
    $fragments['div#custom-cart-div'] = ob_get_clean();
     
    return $fragments;
}


function custom_mini_cart(){
    ob_start();
    ?>
    <div id="maniek-mini-cart" class="kraina-mini-cart">
    <?php
    echo woocommerce_mini_cart();
    ?>
    </div>
    <?php
    return ob_get_clean();
}

//add_filter( 'woocommerce_is_purchasable', '__return_false');


add_shortcode('maniek_social_short', 'before_header_kraina');

add_shortcode('product_meta_description', 'product_meta_description');
function product_meta_description(){
    ob_start();
    echo "opis meta";
    return ob_get_clean();
}

function before_header_kraina() {
    ?>
    <div class="kraina-social-icons">
        <a class="kraina-social-icon" href="https://www.facebook.com/krainadzieciakapl/" title="Facebook">
            <svg id="kraina-facebook-icon" class="social-icon" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path d="M53.68,38.26v15.1H37.11V72H53.68v42H73.29V72H90l2-18.63H73.29V38.26c0-2.67,2.11-4,3-4.82,1.57-1.34,9.15-1.55,9.15-1.55h7.43V15a93.26,93.26,0,0,0-11.68-1C53.11,14,53.68,38.26,53.68,38.26Z"/></svg>
        </a>
        <a class="kraina-social-icon" href="https://www.instagram.com/kraina_dzieciaka/" title="Instagram">
            <svg id="kraina-instagram-icon" class="social-icon"  viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path d="M83,23a22,22,0,0,1,22,22V83a22,22,0,0,1-22,22H45A22,22,0,0,1,23,83V45A22,22,0,0,1,45,23H83m0-8H45A30.09,30.09,0,0,0,15,45V83a30.09,30.09,0,0,0,30,30H83a30.09,30.09,0,0,0,30-30V45A30.09,30.09,0,0,0,83,15Z"/><path d="M90.14,32a5.73,5.73,0,1,0,5.73,5.73A5.73,5.73,0,0,0,90.14,32Z"/><path d="M64.27,46.47A17.68,17.68,0,1,1,46.6,64.14,17.7,17.7,0,0,1,64.27,46.47m0-8A25.68,25.68,0,1,0,90,64.14,25.68,25.68,0,0,0,64.27,38.47Z"/></svg>
        </a>
    </div>
    <?php
} 

/*my account*/

add_shortcode ('kraina_my_account', 'kraina_my_account' );

function kraina_my_account(){
    ?>
    
    <div class="my-account">
        <a class="header-bottom-subtitle" href="<?php echo 
                    get_permalink( get_option('woocommerce_myaccount_page_id'));?>" title="Moje konto">
            <svg id="account-icon" class="header-bottom-icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M68.169,447.023C71.835,449.023,159.075,496,256,496c105.008,0,184.772-47.134,188.116-49.14A8,8,0,0,0,448,440c0-64.593-19.807-123.7-55.771-166.442-25.158-29.9-56.724-50.28-91.539-59.662a104,104,0,1,0-89.38,0c-34.815,9.382-66.381,29.765-91.539,59.662C83.807,316.3,64,375.407,64,440A8,8,0,0,0,68.169,447.023ZM168,120a88,88,0,1,1,88,88A88.1,88.1,0,0,1,168,120ZM132.013,283.859C164.5,245.258,208.528,224,256,224s91.5,21.258,123.987,59.859c32.681,38.838,51.056,92.48,51.977,151.474C414.845,444.6,343.708,480,256,480c-81.11,0-157.5-35.609-175.96-44.856C81,376.223,99.367,322.656,132.013,283.859Z"/>
            </svg>
            <?php if(is_user_logged_in()){
                ?>
                <!-- <span class="icon-subtitle"><?php echo wp_get_current_user()->user_login?></span> -->
                <span class="icon-subtitle">Moje konto</span>
                <?php
            }
            else{
                ?>
                <span class="icon-subtitle">Zaloguj</span>
                <?php
            }
            ?>
                
        </a>
    </div>

    <?php
}

//formy płatności
add_shortcode('payment_full_page', 'payment_full_page');

function payment_full_page(){
    ob_start();
    ?>
    <div class="full-payment-methods">
        <img src="<?php echo get_template_directory_uri();?>/assets/img/payment-bar-full.png">
    </div>

    <?php

    return ob_get_clean();
}

//footer contact info
add_shortcode('kraina_contact_info', 'kraina_contact_info');

function kraina_contact_info(){
    ob_start();
    ?>
        <ul>
            <p class="footer-title title">Kontakt</p>
			<div class="divider-2"><span></span></div>
            <li>
                <a class="footer-contact-link" rel="nofollow" href="http://krainadzieciaka.pl">
                    <svg id="footer-phone-icon" class="footer-contact-icons" enable-background="new 0 0 512.021 512.021" viewBox="0 0 512.021 512.021" xmlns="http://www.w3.org/2000/svg"><g><path d="m367.988 512.021c-16.528 0-32.916-2.922-48.941-8.744-70.598-25.646-136.128-67.416-189.508-120.795s-95.15-118.91-120.795-189.508c-8.241-22.688-10.673-46.108-7.226-69.612 3.229-22.016 11.757-43.389 24.663-61.809 12.963-18.501 30.245-33.889 49.977-44.5 21.042-11.315 44.009-17.053 68.265-17.053 7.544 0 14.064 5.271 15.645 12.647l25.114 117.199c1.137 5.307-.494 10.829-4.331 14.667l-42.913 42.912c40.482 80.486 106.17 146.174 186.656 186.656l42.912-42.913c3.838-3.837 9.361-5.466 14.667-4.331l117.199 25.114c7.377 1.581 12.647 8.101 12.647 15.645 0 24.256-5.738 47.224-17.054 68.266-10.611 19.732-25.999 37.014-44.5 49.977-18.419 12.906-39.792 21.434-61.809 24.663-6.899 1.013-13.797 1.518-20.668 1.519zm-236.349-479.321c-31.995 3.532-60.393 20.302-79.251 47.217-21.206 30.265-26.151 67.49-13.567 102.132 49.304 135.726 155.425 241.847 291.151 291.151 34.641 12.584 71.866 7.64 102.132-13.567 26.915-18.858 43.685-47.256 47.217-79.251l-95.341-20.43-44.816 44.816c-4.769 4.769-12.015 6.036-18.117 3.168-95.19-44.72-172.242-121.772-216.962-216.962-2.867-6.103-1.601-13.349 3.168-18.117l44.816-44.816z"/></svg></i>
                <span class="footer-text-normal text-hover">+48 505 947 675</span>   
                </a>
            </li>
            <li>
                <a class="footer-contact-link" rel="nofollow" href="mailto:sklep@krainadzieciaka.pl">
                    <svg id="footer-mail-icon" class="footer-contact-icons"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;">
                        <path d="M467,61H45C20.218,61,0,81.196,0,106v300c0,24.72,20.128,45,45,45h422c24.72,0,45-20.128,45-45V106
                        C512,81.28,491.872,61,467,61z M460.786,91L256.954,294.833L51.359,91H460.786z M30,399.788V112.069l144.479,143.24L30,399.788z
                        M51.213,421l144.57-144.57l50.657,50.222c5.864,5.814,15.327,5.795,21.167-0.046L317,277.213L460.787,421H51.213z M482,399.787
                        L338.213,256L482,112.212V399.787z"/>
                    </svg>
                    <span class="footer-text-normal text-hover">sklep@krainadzieciaka.pl</span>
                </a>
            </li>
            <li>
                <a href="http://facebook.com/krainadzieciakapl" rel="nofollow" target="_blank"><span class="face-link">krainadzieciakapl</span></a>
            </li>
            <li>
                <a href="http://instagram.com/kraina_dzieciaka" rel="nofollow" target="_blank"><span class="insta-link">kraina_dzieciaka</span></a>
            </li>
        </ul>
    <?php

    return ob_get_clean();
}


add_shortcode( 'wishlist_mini_cart', 'wishlist_mini_cart');

function wishlist_mini_cart(){
    ?>
    <div id="wishlist-hover">
        <div id="wishlist-icon">
            <a class="header-bottom-subtitle" href="/wishlist">
                <svg class="header-bottom-icon" viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg"><path d="M256,473.5c-4.9,0-9.6-1.8-13.2-5c-20.9-18.3-40.8-35.2-58.3-50.2l0,0c-51.3-43.7-95.5-81.4-126-118.1
                    C25.4,260.3,10,222.7,10,181.9c0-39.5,13.5-76,38-102.5C72.6,52.7,106.3,38,143,38c27.3,0,52.3,8.6,74.3,25.7
                    c11.2,8.7,21.5,19.4,30.5,31.9c1.9,2.6,4.9,4.1,8.1,4.1c0,0,0,0,0,0c3.2,0,6.2-1.5,8.1-4.1c9-12.5,19.3-23.2,30.5-31.9
                    c22-17,47-25.7,74.3-25.7c36.7,0,70.5,14.7,95.1,41.4c24.5,26.6,38,63,38,102.5c0,40.8-15.4,78.5-48.5,118.4
                    c-30.4,36.7-74.7,74.4-125.9,118.1c-16.6,14.2-37.3,31.8-58.4,50.3C265.6,471.8,260.9,473.5,256,473.5z M191,410.8
                    c17.6,15,37.6,32,58.4,50.2c1.9,1.6,4.2,2.5,6.6,2.5c2.3,0,4.7-0.8,6.6-2.5c21.4-18.6,42-36.2,58.6-50.3l0.1-0.1
                    c50.8-43.3,94.7-80.7,124.5-116.7c31.9-38.5,46.2-73.1,46.2-112c0-37-12.5-71-35.3-95.7C434,61.5,402.9,48,369,48
                    c-25,0-48,7.9-68.2,23.6c-17.7,13.7-29.9,30.8-37.1,42.8c-1.7,2.8-4.5,4.4-7.7,4.4c-3.2,0-6-1.6-7.7-4.4
                    c-7.2-12-19.4-29.2-37.1-42.8C191,55.9,168.1,48,143,48c-33.9,0-65,13.5-87.7,38.1C32.5,110.8,20,144.8,20,181.9
                    c0,38.9,14.2,73.4,46.2,112c29.9,36.1,73.8,73.5,124.7,116.8C190.9,410.7,191,410.8,191,410.8z"/></svg>
                    <span id="wishlist-counter" class="cart-contents-count"></span>
                <span class="icon-subtitle">Ulubione</span>
            </a>
        </div>
        <div id="wishlist-mini-cart" class="kraina-mini-cart">
            <?php
            echo do_shortcode('[wishlist]');
            ?>
        </div>
    </div>
    <?php
}

/*products featured loop */

add_shortcode ('woo_featured_products', 'woo_featured_products' );

function woo_featured_products() {
ob_start();

    $post_main_view = 4;

    $args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ),
        ),
        'order'               => 'ASC',
        'orderby'             => 'menu_order',
    );
    $loop = new WP_Query( $args );

    $counter = 0;
    ?>
    <div class="featured-container">
        <h2 class="maniek-subtitle">Polecane</h2>
        <div class="divider-2"><span></span></div>
        <ul class="featured-products-list">
            <?php
            while ( $loop->have_posts() ) : $loop->the_post();
             
            $product = wc_get_product(get_the_ID());
            if($counter < $post_main_view){
                ?>
                <li class="featured-product-wrapper">
                    <div class="featured-product"> 
                        <?php echo maniek_add_featured_tag(); ?>
                        <div class="wishlist-toggle-wrapper">
                        <?php echo do_shortcode('[wishlist_toggle]'); ?>
                        </div>
                        <a class="featured-img" href="<?php echo get_permalink( $loop->post->ID ) ?>">
                            <div class="img-wrapper"><?php the_post_thumbnail('medium'); ?></div>
                            <h3><p class="featured-product-name featured-text"><?php echo $product->get_title();?></p></h3>
                            <div class="featured-main-wrapper">
                                <?php echo do_shortcode('[maniek_rozmiar]'); ?>
                            </div>
                            <span class="featured-text price"><?php echo $product->get_price_html();?></span>
                        </a>
                    </div>
                </li>
                <?php
                $counter++;
            } else{
                ?>
                <li class="featured-product-wrapper hidden-featured-wrapper">
                    <div class="featured-product"> 
                        <?php echo maniek_add_featured_tag(); ?>
                        <div class="wishlist-toggle-wrapper">
                        <?php echo do_shortcode('[wishlist_toggle]'); ?>
                        </div>
                        <a class="featured-img" href="<?php echo get_permalink( $loop->post->ID ) ?>">
                            <div class="img-wrapper"><?php the_post_thumbnail('medium'); ?></div>
                            <h3><p class="featured-product-name featured-text"><?php echo $product->get_title();?></p></h3>
                            <div class="featured-main-wrapper">
                                <?php echo do_shortcode('[maniek_rozmiar]'); ?>
                            </div>
                            <?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
                            <span class="featured-text price"><?php echo $product->get_price_html();?></span>
                        </a>
                    </div>
                </li>
                <?php
            }
            endwhile; 
            ?>
        </ul>
        <a id="more-featured-button" class="featured-button button">Pokaż więcej</a>
    </div>
    <?php

    wp_reset_query();     

return ob_get_clean();
}

//products in promo loop

add_shortcode ('woo_promo_products', 'woo_promo_products' );

function woo_promo_products() {
    ob_start();

    $post_main_view = 4;
    $products_on_sale_ids = wc_get_product_ids_on_sale();
    $args = array(
        'post__in'       => $products_on_sale_ids,
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        'order'               => 'ASC',
        'orderby'             => 'menu_order',
    );

    

    $loop = new WP_Query( $args );
    $counter = 0;
    ?>
    <div class="featured-container">
        <h2 class="maniek-subtitle">Promocje</h2>
        <div class="divider-2"><span></span></div>
        <ul class="featured-products-list">
            <?php
            while ( $loop->have_posts() ) : $loop->the_post(); 
            $product = wc_get_product(get_the_ID());
            if($counter < $post_main_view){
                ?>
                <li class="featured-product-wrapper">
                    <div class="featured-product"> 
                        <?php echo maniek_add_featured_tag(); ?>
                        <div class="wishlist-toggle-wrapper">
                        <?php echo do_shortcode('[wishlist_toggle]'); ?>
                        </div>
                        <a class="featured-img" href="<?php echo get_permalink( $loop->post->ID ) ?>">
                        <div class="img-wrapper"><?php the_post_thumbnail('medium'); ?></div>
                            <h3><p class="featured-product-name featured-text"><?php echo $product->get_title();?></p></h3>
                            <div class="featured-main-wrapper">
                                <?php echo do_shortcode('[maniek_rozmiar]'); ?>
                            </div>
                            <?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
                            <span class="featured-text price"><?php echo $product->get_price_html();?></span>
                        </a>
                    </div>
                </li>
                <?php
                $counter++;
            } else{
                ?>
                <li class="featured-product-wrapper hidden-promo-wrapper">
                    <div class="featured-product"> 
                        <?php echo maniek_add_featured_tag(); ?>
                        <div class="wishlist-toggle-wrapper">
                        <?php echo do_shortcode('[wishlist_toggle]'); ?>
                        </div>
                        <a class="featured-img" href="<?php echo get_permalink( $loop->post->ID ) ?>">
                        <div class="img-wrapper"><?php the_post_thumbnail('medium'); ?></div>
                            <h3><p class="featured-product-name featured-text"><?php echo $product->get_title();?></p></h3>
                            <div class="featured-main-wrapper">
                                <?php echo do_shortcode('[maniek_rozmiar]'); ?>
                            </div>
                            <span class="featured-text price"><?php echo $product->get_price_html();?></span>
                        </a>
                    </div>
                </li>
                <?php
            }
            endwhile; 
            ?>
        </ul>
        <a id="more-promo-button" class="featured-button button">Pokaż więcej</a>
    </div>
    <?php

    wp_reset_query();     

return ob_get_clean();
}


//hide stock info

function my_wc_hide_in_stock_message( $html, $product ) {
	$availability = $product->get_availability();

	if ( isset( $availability['class'] ) && 'in-stock' === $availability['class'] ) {
		return '';
	}

	return $html;
}
add_filter( 'woocommerce_get_stock_html', 'my_wc_hide_in_stock_message', 10, 3 );

//crossed regular price in cart

add_filter( 'woocommerce_cart_item_price', 'bbloomer_change_cart_table_price_display', 30, 3 );
  
function bbloomer_change_cart_table_price_display( $price, $values, $cart_item_key ) {
   $slashed_price = $values['data']->get_price_html();
   $is_on_sale = $values['data']->is_on_sale();
   if ( $is_on_sale ) {
      $price = $slashed_price;
   }
   return $price;
}

//slashed regular subtotal if coupon
add_filter( 'woocommerce_cart_subtotal', 'bbloomer_slash_cart_subtotal_if_discount', 99, 3 );
 
function bbloomer_slash_cart_subtotal_if_discount( $cart_subtotal, $compound, $obj ){
    global $woocommerce;
    if ( $woocommerce->cart->get_cart_discount_total() <> 0 ) {
        $new_cart_subtotal = wc_price( WC()->cart->subtotal - $woocommerce->cart->get_cart_discount_tax_total() - $woocommerce->cart->get_cart_discount_total() );
        $cart_subtotal = sprintf( '<del>%s</del> <b>%s</b>', $cart_subtotal , $new_cart_subtotal );
    }
    return $cart_subtotal;
}


add_action( 'wp_footer', 'hide_var_atc_block' );

function hide_var_atc_block() {
    global $product;
    if( ! ( is_product() && $product->is_type('variable') ) )
    return;
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_add_cart_button_single_product' );
function woocommerce_custom_add_cart_button_single_product( $label ) {
   foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
      $product = $values['data'];
      if( get_the_ID() == $product->get_id() ) {
         $label = __('Już w koszyku. Dodać jeszcze raz?', 'woocommerce');
      }
   }
   return $label;
}
// Edit Loop Pages Add to Cart
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_add_cart_button_loop', 99, 2 );
function woocommerce_custom_add_cart_button_loop( $label, $product ) {
   if ( $product->is_purchasable() && $product->is_in_stock() ) {
      foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
         $_product = $values['data'];
         if( get_the_ID() == $_product->get_id() ) {
            $label = __('Już w koszyku. Dodać jeszcze raz?', 'woocommerce');
         }
      }
   }
   return $label;
}



/* link do tabeli rozmiarów */

add_action('woocommerce_before_add_to_cart_form', 'sizes_table', 20);

function sizes_table(){
    global $product;
    
    $name = $product->get_name();
    $collection = $product->get_attribute('pa_kolekcja');
    
    $img_address = '/wp-content/uploads/Tabele_rozmiarow/';
    $img_adressess = array();
    
    
    //EEVI
    if($product->get_attribute('pa_producent') == 'EEVI'){
        $img_address .=  'eevi';
        
        if((has_term( 'bluzy-i-bluzeczki', 'product_cat')) && $product->get_attribute('pa_kolekcja') == 'Adventure'){
            if(strpos($product->get_name(), 'różowa') !== false){
                $img_address .= '_bluzy_adventure_roz.jpg';
            }
            else if(strpos($product->get_name(), 'stalowa') !== false){
                $img_address .= '_bluzy_adventure_stal.jpg';
            }
            else if(strpos($product->get_name(), 'szara') !== false){
                $img_address .= '_bluzy_adventure_szar.jpg';
            }
        }
        
        else if(has_term( 't-shirty', 'product_cat')){
            $img_address .= '_tshirty.jpg';
        }
        
        else if(has_term( 'kaftaniki-i-koszulki-niemowlece', 'product_cat')){
            if(strpos($product->get_name(), 'aftan') !== false){
                $img_address .= '_kaftany.jpg';
            }
            else if(strpos($product->get_name(), 'oszulka') !== false){
                $img_address .= '_koszulki.jpg';
            }
        }
        
        else if(has_term( 'spodnie-i-legginsy', 'product_cat')){
	        
	        if(strpos(strtolower($product->get_name()), 'legginsy') !== false){
                
                $img_address .= '_legginsy';
                
                if($product->get_attribute('pa_kolekcja') == 'Swan'){
                    $img_address .= '_swan.jpg';
                }
                else{
                    $img_address .= '.jpg';
                }
            }
            else if(strpos(strtolower($product->get_name()), 'szorty') !== false){
                $img_address .= '_szorty.jpg';
            }
            else{
	            if($product->get_attribute('pa_kolekcja') == 'Adventure'){
		            $img_address .= '_spodnie_adventure.jpg';
	            }
	            else if($product->get_attribute('pa_kolekcja') == 'Baby Love'){
		            $img_address .= '_spodnie_babylove.jpg';
	            }
	            else if($product->get_attribute('pa_kolekcja') == 'Ceremony'){
		            $img_address .= '_spodnie_ceremony.jpg';
	            }
            }
        }
        
        else if(has_term( 'pajace-i-rampersy', 'product_cat')){
            
            if(strpos(strtolower($name), 'rampers') !== false){
                if($collection == 'Swan'){
                    $img_address .= '_rampers_swan.jpg';
                    
                }
                else if($collection == 'Lazy Days'){
                    $img_address .= '_rampers_lazydays.jpg';
                }
            }
	        
	        else if(strpos($name, 'bez stópek') !== false){
                
                if($collection == 'Swan'){
                    $img_address .= '_pajace_swan.jpg';
                }
                else{
                   $img_address .= '_pajace_bs.jpg';
                }
            }
                
            else{
                
                $img_address .= '_pajace';
                
                if($collection == 'Lazy Days'){
                    $img_address .= '_lazydays.jpg';
                }
                else if($collection == 'Swan'){
                    $img_address .= '_swan.jpg';
                }
                else{
                    $img_address .= '.jpg';
                }
            }
        }
        
        
        else if(has_term( 'body', 'product_cat')){
	        
	        if(strpos($name, 'koszulobody') !== false){
                $img_address .= '_koszulobody.jpg';
            }
            
            else if(($collection == 'Lazy Days') || ($collection == 'Swan')){
                $img_address .= '_body_lazydays_swan.jpg';
            }
            
            else{
            	$img_address .= '_body.jpg';
            }
        }
        else if(has_term( 'polspiochy', 'product_cat')){
            $img_address .= '_polspiochy.jpg';
        }
        else if(has_term( 'spiochy', 'product_cat')){
            $img_address .= '_spiochy.jpg';
        }
        else if(has_term( 'sukienki', 'product_cat')){
            
            if(strpos(strtolower($product->get_name()), 'ogrodniczka') !== false){
                $img_address .= '_ogrodniczka.jpg';
            }
            else{
                $img_address .= '_sukienki.jpg';
            }
        }
    }
    //Mamatti
    if($product->get_attribute('pa_producent') == 'Mamatti'){
        $img_address .=  'mamatti';
        
        if((has_term( 'komplety', 'product_cat')) && (strpos(strtolower($product->get_name()), 'wyprawka') !== false)){
            $img_adressess[0] = $img_address . '_kaftany.jpg';
            $img_adressess[1] = $img_address . '_spiochy.jpg';
            if(strpos(strtolower($product->get_name()), 'tokyo') !== false){
                $img_adressess[2] = $img_address . '_body_krolik_tokyo.jpg';
            }
            else{
                $img_adressess[2] = $img_address . '_body_maki_latarnia.jpg';
            }
        }
        
        
        else if(has_term( 'spodnie-i-legginsy', 'product_cat')){
            $img_address .= '_spodnie';
            
            if(strpos($product->get_name(), 'ysoki') !== false){
                $img_address .= '_wysokistan.jpg';
            }
            else if(strpos($product->get_name(), 'grodniczki') !== false){
                $img_address .= '_ogrodniczki.jpg';
            }
	        
            else{
                $img_address .= '.jpg';
            }
        }
        
        else if(has_term( 'pajace-i-rampersy', 'product_cat')){
            
            if (strpos(strtolower($product->get_name()),'rampers') !== false){
                $img_address .= '_rampers.jpg';
            }
            
            else{
            	        
                if(strpos($product->get_name(), 'bez stópek') !== false){
                    $img_address .= '_pajace_bs';
                }
                else{
                    $img_address .= '_pajace';
                }
                
                if($product->get_attribute('pa_kolekcja') == 'Maki'){
                        $img_address .= '_maki.jpg';
                }
                else if($product->get_attribute('pa_kolekcja') == 'Królik'){
                        $img_address .= '_krolik.jpg';
                }
            }
        }
        
        
        else if(has_term( 'body', 'product_cat')){
            $img_address .= '_body';
	        
	        if(strpos($product->get_name(), 'kieszonką') !== false){
                $img_address .= '_zkieszonka.jpg';
            }
            else{
                
                if(($product->get_attribute('pa_kolekcja') == 'Maki') || (strpos(strtolower($product->get_name()), 'latarnia') !== false)){
                        $img_address .= '_maki_latarnia.jpg';
                }
                else if(($product->get_attribute('pa_kolekcja') == 'Królik') || (strpos(    strtolower($product->get_name()), 'tokyo') !== false)){
                        $img_address .= '_krolik_tokyo.jpg';
                }
            }
        }
        
        else if(has_term( 'polspiochy', 'product_cat')){
            $img_address .= '_polspiochy.jpg';
        }
        else if(has_term( 'spiochy', 'product_cat')){
            $img_address .= '_spiochy.jpg';
        }
    }
    //makoma
    else if($product->get_attribute('pa_producent') == 'Makoma'){
        $img_address .=  'makoma';
        
        if(has_term( 'komplety', 'product_cat')){
            if(strpos(strtolower($product->get_name()), 'śpiochy i kaftan') !== false){
                $img_adressess[0] = $img_address . '_spiochy.jpg';
                $img_adressess[1] = $img_address . '_kaftan.jpg';
            }
        }
        
        else if(has_term( 'kaftaniki-i-koszulki-niemowlece', 'product_cat')){
            if(strpos($product->get_name(), 'aftan') !== false){
                $img_address .= '_kaftany.jpg';
            }
            else if(strpos($product->get_name(), 'oszulka') !== false){
                $img_address .= '_koszulki.jpg';
            }
        }
        
        else if(has_term( 'spodnie-i-legginsy', 'product_cat')){
            $img_address .= '_spodnie.jpg';
        }
        
        else if(has_term( 'pajace-i-rampersy', 'product_cat')){
	        
	        if(strpos($product->get_name(), 'bez stópek') !== false){
                $img_address .= '_pajace_bs.jpg';
            }
            else{
            	$img_address .= '_pajace.jpg';
            }
        }
        
        
        else if(has_term( 'body', 'product_cat')){
            
            $img_address .= '_body.jpg';
        }
        else if(has_term( 'polspiochy', 'product_cat')){
            $img_address .= '_polspiochy.jpg';
        }
        else if(has_term( 'spiochy', 'product_cat')){
            $img_address .= '_spiochy.jpg';
        }
        else if(has_term( 'sukienki', 'product_cat')){
            $img_address .= '_sukienki.jpg';
        }
    }
    $categories = array('body','polspiochy', 'spiochy', 'polspiochy', 'pajace-i-rampersy', 'kaftaniki-i-koszulki-niemowlece', 'bluzy-i-bluzy-i-bluzeczki', 'spodnie-i-legginsy', 'sukienki', 'komplety', 't-shirty');
    if(has_term( $categories, 'product_cat')){
    ?>
    <div class="table-container">
        <a id="show-table-button"><object id="tape-icon" class="header-bottom-icon" data="<?php echo get_home_url(); ?>/wp-content/themes/neve-child/assets/icons/tape-measure.svg" type="image/svg+xml"></object><div class="tape-button"><span class="tape-text-row">Dobierz</span><span class="tape-text-row">rozmiar</span></div></a>
        <div id="size-table-img">
            <?php if(sizeof($img_adressess) > 1){
                echo '<div class="size-images">';
                foreach($img_adressess as $address){
                    echo '<img height="100%" src="' . $address . '">';
                }
                echo '</div>';
            } else{?>
            <img height="100%" src="<?php echo $img_address; ?>">
            <?php } ?>
        </div>
    </div>

    <?php
    }
}

//nowosci
/* latest posts from blog */

add_shortcode('kraina_latest_posts','kraina_latest_posts');

function kraina_latest_posts(){
    ob_start();

    $args = array(
        'post_type'           => 'post',
    );
    $loop = new WP_Query( $args );

    ?>
    <div class="latest-blog-wrapper">
        <h2 class="maniek-subtitle">Blog</h2>
        <div class="divider-2"><span></span></div>
        <div id="latest-posts-from-blog">
            <?php

            while ( $loop->have_posts() ) : $loop->the_post();
                ?>
                <div class="post-container">
                    <div class="blog-thumbnail"><? the_post_thumbnail(); ?></div>
                    <div class="post-date">
                        <span class="post-day"><?php echo get_the_date('j'); ?></span>
                        <span class="post-month"><?php echo get_the_date('M'); ?></span>
                    </div>
                    <div class="post-content-wrapper">
                        <div class="post-header">
                            <span class="post-title"><?php the_title(); ?></span>
                        </div>
                        <div class="post-content">
                            <div class="post-text"><?php echo substr(strip_tags(get_the_content()), 0, 150) . "..."; ?></div>
                            <a href="<?php the_permalink(); ?>" class="more-post-blog button">Zobacz więcej</a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;

            ?>
        </div>
    </div>
    
    <?php 
      

    return ob_get_clean();
}

//delete woocommerce css

add_filter( 'woocommerce_enqueue_styles', '__return_false' );


//remove checout fields

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
  
function custom_override_checkout_fields( $fields ) {
    //unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);

    //unset($fields['shipping']['shipping_country']);
    unset($fields['shipping']['shipping_state']);

    return $fields;
}

//numbers on order

add_action( 'woocommerce_before_checkout_form', 'paging_on_order', 5 );
add_action( 'woocommerce_before_cart', 'paging_on_order', 5 );



function paging_on_order(){

    $obj_id = get_queried_object_id();
    $current_url = get_permalink( $obj_id );
    echo woocommerce_breadcrumb();
    ?>
    <div class="order-paging-wrapper">
        <div class="order-paging">
            <div class="order-page">
                <span class="order-page-number <?php if(strpos($current_url, 'cart')){echo 'current-order-page';} ?>">1</span>
                <span class="<?php if(strpos($current_url, 'cart')){echo 'current-order-page-name';} ?>">Koszyk</span>
            </div>
            <div class="order-page">
                <span class="order-page-number <?php if(strpos($current_url, 'checkout')){echo 'current-order-page';} ?>">2</span>
                <span class="<?php if(strpos($current_url, 'checkout')){echo 'current-order-page-name';} ?>">Zamówienie</span>
            </div>
            <div class="order-page">
                <span class="order-page-number <?php if(strpos($current_url, 'xx')){echo 'current-order-page';} ?>">3</span>
                <span class="<?php if(strpos($current_url, 'xx')){echo 'current-order-page-name';} ?>">Podsumowanie</span>
            </div>
        </div>
    </div>

    <?php
}

//breadcumb on login page

add_action( 'woocommerce_before_customer_login_form', 'login_breadcumb');

function login_breadcumb(){
    echo woocommerce_breadcrumb();
}

//title on my account page

add_action('woocommerce_before_account_navigation', 'my_account_title');

function my_account_title(){
    echo woocommerce_breadcrumb();
    ?>

    <h2 class="my-account-title-mobile" onclick="my_account_mobile_menu_show()">Moje konto</h2>
    <script>


        function my_account_mobile_menu_show(){
            if($('nav.woocommerce-MyAccount-navigation').height() == '0'){
                $('nav.woocommerce-MyAccount-navigation').animate({'height':'280px'},200);
            }
            else{
                $('nav.woocommerce-MyAccount-navigation').animate({'height':'0px'},200);
            }
        }   
    </script>

    <?php
}

//payment header

add_action( 'woocommerce_checkout_order_review', 'payment_adds', 15 );
function payment_adds() {
  print '<h2 class="order-payment-heading">Sposób płatności</h2>';
}


// companies carousel

add_shortcode('companies_main','companies_main');

function companies_main(){
    ?>
    <div class="companies-carousel-wrapper">
	    <h2 class="maniek-subtitle">Nasze marki</h2>
	    <div class="divider-2"><span></span></div>
	    
	    <div class="companies-slider">
	        <div class="company-logo">
                <a href="/home/?filters=producent[eevi]">
	                <img class="kraina-not-lazy" src="<?php echo wp_upload_dir()['baseurl'];?>/logo/EEVI.png" alt="logo_EEVI">
                </a>
	        </div>
	        <div class="company-logo">
                <a href="/home/?filters=producent[weber]">
	                <img src="<?php echo wp_upload_dir()['baseurl'];?>/logo/Weber.png" alt="logo_Weber">
                </a>
	        </div>
	        <div class="company-logo">
                <a href="/home/?filters=producent[mamatti]">
	                <img src="<?php echo wp_upload_dir()['baseurl'];?>/logo/Mamatti.png" alt="logo_Mamatti">
                </a>
	        </div>
            <div class="company-logo">
                <a href="/home/?filters=producent[makoma]">
	                <img src="<?php echo wp_upload_dir()['baseurl'];?>/logo/Makoma.png" alt="logo_Makoma">
                </a>
	        </div>
	    </div>
    </div>
    <script>
        var width;
    //slider for companies logo
    if(window.innerWidth > 1200){
        width = 380;
    }
    else if(window.innerWidth > 780){
        width = window.innerWidth/3 - 60;
    }
    else{
        width = window.innerWidth;
    }

    $('.companies-slider').bxSlider({
        slideWidth: width,
        minSlides: 1,
        maxSlides: 5,
        moveSlides: 1,
        slideMargin: 0,
        infiniteLoop: true,
        pager: false,
        responsive: true,
        touchEnabled: false
    }); 
    </script>
    <?php
}


//add free shipping info

add_action('woocommerce_single_product_summary','free_shipping_info_product_page',30);
add_shortcode( 'free_shipping_info_product_page', 'free_shipping_info_product_page' );

function free_shipping_info_product_page(){
    ?>
    <div class="additional-shipping-block">
        <div class="additional-shipping-block-wrapper">
            <div class="free-shipping-info"><span class="free-shipping-icon info-icon"></span>Darmowa dostawa już od <strong>200zł!</strong></div>
        </div>
        <div class="additional-shipping-block-wrapper">
            <div class="free-shipping-info"><span class="fast-shipping-icon info-icon"></span>Wysyłka w <strong>24H!</strong></div>
        </div>
        <div class="additional-shipping-block-wrapper">
            <div class="free-shipping-info"><span class="refund-icon info-icon"></span><strong>14 dni </strong>na zwrot</div>
        </div>

    </div>

    <?php
}

//add shipping table

add_action('woocommerce_after_variations_form','shipping_cost_info_button', 20);

function shipping_cost_info_button(){
    ?>
    <div style="margin-top: 10px">
        <a id="show-shipping-cost-button">Zobacz koszty wysyłki</a>
    </div>
    <div id="shipping-cost-window"><img src="/wp-content/uploads/shipping_cost_table.jpg" height="100%"></div>

    <?php
}

//default unchecked shipping address

add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

//see additional featured in cart page

add_action('woocommerce_after_cart', 'print_featured_products');

function print_featured_products() {

    $post_main_view = 4;

    /* $args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        'product_tag'         => 'Polecane-Koszyk',
        'orderby'             => 'date',
        'order'               => 'ASC',
    ); */
    $args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ),
        ),
        'orderby'             => 'date',
        'order'               => 'ASC',
    );
    $loop = new WP_Query( $args );
    ?>
    <div class="featured-container-cart">
        <h2 class="maniek-subtitle">Zobacz również</h2>
        <div class="divider-2"><span></span></div>
        <div class="featured-products-list-cart">
            <?php
            while ( $loop->have_posts() ) : $loop->the_post(); 
            $product = wc_get_product(get_the_ID());
                ?>
                <div class="featured-product-wrapper">
                    <div class="featured-product"> 
                        <?php echo maniek_add_featured_tag(); ?>
                        <div class="wishlist-toggle-wrapper">
                        <?php echo do_shortcode('[wishlist_toggle]'); ?>
                        </div>
                        <a class="featured-img" href="<?php echo get_permalink( $loop->post->ID ) ?>">
                        <div class="img-wrapper"><?php the_post_thumbnail('medium'); ?></div>
                            <p class="featured-product-name featured-text"><?php echo $product->get_title();?></p>
                            <?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
                            <span class="featured-text price"><?php echo wc_price( $price ); ?></p>
                            <div class="featured-main-wrapper">
                                <?php echo do_shortcode('[maniek_rozmiar]'); ?>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            endwhile; 
            ?>
        </div>
    </div>

    <!-- slider for featured in cart -->
    <script>
    var width = $('#kraina-content').width();

    $('.featured-products-list-cart').bxSlider({
        slideWidth: width/4-80,
        minSlides: 3,
        maxSlides: 6,
        moveSlides: 1,
        slideMargin: 20,
        infiniteLoop: true,
        pager: false,
        responsive: true,
        touchEnabled: false
    }); 
    </script>

    <?php

    wp_reset_query();     
}

//free shipping rate

// Extra discount on shipping for orders of values of above 150 or 100.
function free_shipping_rate( $rates ) {

    $cart_subtotal = WC()->cart->subtotal;
    // Check if the subtotal is greater than value specifie
    if ( $cart_subtotal >= 200 ) {

            // Loop through each shipping rate
            foreach ( $rates as $rate ) {

                    $rate->cost = 0;
            }
    }
    return $rates;
}

add_filter( 'woocommerce_package_rates', 'free_shipping_rate', 10 );


//free shipping info on cart page

add_action( 'woocommerce_before_cart', 'free_shipping_info_cart', 10 );

function free_shipping_info_cart(){
    
    $cart_subtotal = WC()->cart->subtotal;

    if($cart_subtotal > 200){
        echo '<div class="shipping-cost-info">Gratulacje! Masz darmową wysyłkę!</div>';
    }

    else{
        echo '<div class="shipping-cost-info">Dodaj produkty za <span id="cart-total-free-shipping-info">'. (200 - $cart_subtotal) . '</span> zł i ciesz się darmową wysyłką!</div>';
    }

    ?>
    <script>
        var timeout;
 
        jQuery( function( $ ) {
            $('.woocommerce').on('change', 'input.qty', function(){
        
                if ( timeout !== undefined ) {
                    clearTimeout( timeout );
                }
        
                timeout = setTimeout(function() {
                    $("[name='update_cart']").trigger("click");
                }, 500 ); // 1 second delay, half a second (500) seems comfortable too
        
            });
        } );
    </script>
    <script>
        jQuery( document.body ).on( 'updated_cart_totals', function(){
            var value = $('.cart-subtotal .woocommerce-Price-amount bdi').html().match(/\d+/)[0];
            if(value < 200 ){
                $('.shipping-cost-info').html('Dodaj produkty za <span id="cart-total-free-shipping-info">' + (200 - value) + '</span> zł i ciesz się darmową wysyłką!');
            }
            else{
                $('.shipping-cost-info').html("Gratulacje! Masz darmową wysyłkę!");
            }
        });
    </script>

        <?php

}


//trigger to update checkout

add_action( 'woocommerce_before_checkout_form', 'checkout_update_trigger', 10 );

function checkout_update_trigger(){
    ?>
    <script type="text/javascript">
    (function($){
        $(document.body).on('change', 'input[name="payment_method"]', function(){
            $(document.body).trigger('update_checkout').trigger('wc_fragment_refresh');
        });
    })(jQuery);
    </script>
    <?php
}

add_action( 'woocommerce_cart_calculate_fees', 'add_cod_fee', 20, 1 );
function add_cod_fee( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    ## ------ Your Settings (below) ------ ##
    $your_payment_id      = 'cod'; // The payment method
    $fee_amount           = 5; // The fee amount
    ## ----------------------------------- ##

    $chosen_payment_method_id  = WC()->session->get( 'chosen_payment_method' );

    if ($chosen_payment_method_id == $your_payment_id ) {
        $fee_text = __( "Pobranie", "woocommerce" );
        $cart->add_fee( $fee_text, $fee_amount, false );
    }
}



/**
 * Add the field to the checkout
 */
add_action( 'woocommerce_after_order_notes', 'easypack_fields' );

function easypack_fields( $checkout ) {

    woocommerce_form_field( 'inpost-easypack-code', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Symbol punktu'),
        'placeholder'   => __(''),
        ), $checkout->get_value( 'inpost-easypack-code' ));

    woocommerce_form_field( 'inpost-easypack-first-line', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('easypack_first_line'),
        'placeholder'   => __(''),
    ), $checkout->get_value( 'inpost-easypack-first-line' ));
    
    woocommerce_form_field( 'inpost-easypack-second-line', array(
    'type'          => 'text',
    'class'         => array('my-field-class form-row-wide'),
    'label'         => __('easypack_second_line'),
    'placeholder'   => __(''),
	), $checkout->get_value( 'inpost-easypack-second-line' ));


}


/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['inpost-easypack-code'] ) ) {
        update_post_meta( $order_id, 'Symbol punktu', sanitize_text_field( $_POST['inpost-easypack-code'] ) );
        //update_user_meta( $order_id->get_user_id(), 'Symbol punktu', sanitize_text_field( $_POST['inpost-easypack-code'] ));
    }

    if ( ! empty( $_POST['inpost-easypack-first-line'] ) ) {
        update_post_meta( $order_id, 'easypack_first_line', sanitize_text_field( $_POST['inpost-easypack-first-line'] ) );
        //update_user_meta( $order_id->get_user_id(), 'Opis punktu', sanitize_text_field( $_POST['inpost-easypack-description'] ));
    }
    
    if ( ! empty( $_POST['inpost-easypack-first-line'] ) ) {
        update_post_meta( $order_id, 'easypack_second_line', sanitize_text_field( $_POST['inpost-easypack-second-line'] ) );
        //update_user_meta( $order_id->get_user_id(), 'Opis punktu', sanitize_text_field( $_POST['inpost-easypack-description'] ));
    }
}



// display the extra data in the order admin panel
//do poprawy opis punktu
function kia_display_order_data_in_admin( $order ){  ?>
    <div class="order_data_column">

        <h4><?php _e( 'Extra Details', 'woocommerce' ); ?><a href="#" class="edit_address"><?php _e( 'Edit', 'woocommerce' ); ?></a></h4>
        <div class="address">
        <?php 
            echo '<p><strong>' . __( 'Opis punktu' ) . ':</strong>' . $order->get_meta( 'easypack_first_line') . '<br />' . $order->get_meta( 'easypack_second_line') . '</p>';
            echo '<p><strong>' . __( 'Symbol punktu' ) . ':</strong>' . $order->get_meta( 'Symbol punktu' ) . '</p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_opis_punktu', 'label' => __( 'Opis punktu' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
            <?php woocommerce_wp_text_input( array( 'id' => '_symbol_punktu', 'label' => __( 'Symbol punktu' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
    </div>
<?php }


//do poprawy opis punktu
add_action( 'woocommerce_admin_order_data_after_order_details', 'kia_display_order_data_in_admin' );

function kia_save_extra_details( $order_id, $post ){
    $order = wc_get_order( $order_id );
    $order->update_meta_data( '_symbol_punktu', wc_clean( $_POST[ '_symbol_punktu' ] ) );
    $order->update_meta_data( '_opis_punktu', wc_clean( $_POST[ '_opis_punktu' ] ) );
    $order->save_meta_data();
}

add_action( 'woocommerce_process_shop_order_meta', 'kia_save_extra_details', 45, 2 );


//inpost map shipping method
add_action( 'woocommerce_after_shipping_rate', 'carrier_custom_fields', 20, 2 );
function carrier_custom_fields( $method, $index ) {

    if( ! is_checkout()) return; // Only on checkout page
    $cart_subtotal = WC()->cart->subtotal;
    $customer_carrier_method = 'flat_rate:3';
    
    error_log($method->id);
    if( $method->id != $customer_carrier_method ) return; // Only display for "local_pickup"

    $chosen_method_id = WC()->session->chosen_shipping_methods[ $index ];

    if($chosen_method_id == $customer_carrier_method ):
        echo '<button id="choose-easypack-button" onclick="showInpostMap(); return false;">Wybierz punkt</button>';
        echo '<div id="easypack-address"></div>';
        ?>
        <script type="text/javascript">

        var address = '<div id="easypack-address"></div>';

        window.easyPackAsyncInit = function () {
            easyPack.init({
                mapType: 'osm',
                searchType: 'osm',
                defaultLocale: 'pl',
                points: {
                    types: ['parcel_locker']
                },
            });

            var map = easyPack.mapWidget('easypack-map', function(point){
                document.getElementsByName('inpost-easypack-code')[0].value=point.name;
                
                address = point.address['line1'] +  '  <br />' 
                    + point.address['line2'] + '  <br />';
                
                document.getElementsByName('inpost-easypack-first-line')[0].value = point.address['line1'];
                document.getElementsByName('inpost-easypack-second-line')[0].value = point.address['line2'];
                $('#easypack-address').html('<span><strong>Wybrany punkt:  </strong></span><br />\n' + point.name + '<br />' + address);
                $('#choose-easypack-button').html('Zmień punkt');

                $('#easypack-map.easypack-widget').removeClass('easypack-height');			
            });
        
        };


        function showInpostMap(){
            $('#easypack-map').toggleClass('easypack-height');
        }
        </script>
        <?php
    endif;

    echo "<script>document.getElementById('inpost-easypack-code').value = '';</script>";
}

add_action('woocommerce_checkout_process', 'customised_checkout_field_process');

function customised_checkout_field_process(){

    // Show an error message if the field is not set.
    $chosen_methods = WC()->session->get('chosen_shipping_methods');
    $chosen_shipping = $chosen_methods[0];

    if (!$_POST['inpost-easypack-code'] && $chosen_shipping == 'flat_rate:3') wc_add_notice('Wybierz paczkomat!' , 'error');

}


//add logos before shipping methods
add_filter( 'woocommerce_cart_shipping_method_full_label', 'modify_shipping_methods', 9999, 2 );
   
function modify_shipping_methods( $label, $method ) {
    if($method->id == 'flat_rate:3'){
        $inpost_paczkomat_label = '<img src="/wp-content/uploads/logo/inpost_paczkomat.png" class="shipping-logo">' . $label;
        return $inpost_paczkomat_label;
    }
    if($method->id == 'flat_rate:2')
    {
        $inpost_kurier_label = '<img src="/wp-content/uploads/logo/inpost_kurier.png" class="shipping-logo">' . $label;
        return $inpost_kurier_label;
    }

    if($method->id == 'flat_rate:1')
    {
        $dpd_label = '<img src="/wp-content/uploads/logo/dpd.png" class="shipping-logo">' . $label;
        return $dpd_label;
    }

    return $label;
}

  //company description in archive

  add_action('woocommerce_archive_description', 'product_description_item', 5);

//product description

add_shortcode('product_description','product_description_item');

function product_description_item(){
    global $product;
    $current_url = home_url($_SERVER['REQUEST_URI']);
    
    if($product != null){

        if ((($product->get_attribute('pa_producent')) == 'EEVI') && (is_single()) || (strpos($current_url, '?filters=producent[eevi]'))){
            ?>
            <div class="product-description">
            Już od ponad 20 lat marka Eevi dokłada wszelkich starań, aby dawać swoim klientom produkty, 
            które będą wartościowe nie tylko ze względu na ich wygląd, ale i jakość. 
            Wszystko zaczęło się w 1998 roku, kiedy to marka Eevi rozpoczęła swoją działalność, 
            wtedy jeszcze pod nazwą Ewa Klucze. Od tego czasu niezmiennie bada ona potrzeby swoich najmłodszych klientów 
            oraz ich rodziców i tworzy niebanalne produkty, które są nie tylko niezwykle urocze, ale i bezpieczne dla dzieci.

            <ul>Na co stawia marka Eevi?

            <li>Doświadczenie – bez tego ani rusz! Piękne wzory, bezpieczne materiały, wysoka jakość produktów – to efekt wieloletnich obserwacji klientów, a także odpowiedź na ich potrzeby.</li>
            <li>Wysokogatunkowa bawełna – najpierw wybierana jest przędza, którą marka Eevi przekształca w wysokiej jakości bawełnę. A to wszystko dzieje się w ich dziewiarni!</li>
            <li>Bezpieczne nadruki i hafty – widzicie na ubrankach Eevi piękny nadruk? Bądźcie pewni, że do jego wykonania użyto farb ekologicznych, które są bezpieczne dla skóry dzieci i niemowląt. Co z haftami? Są one zabezpieczane od wewnątrz po to, aby nie podrażniały skóry najmłodszych. </li>
            <li>Bezpieczne napy i zatrzaski – marka Eevi dba o to, aby nie zawierały one niklu. </li>
            <li>Bezpieczeństwo potwierdzone certyfikatami – dbałość o produkty już od samego początku ich powstawania to nie wszystko. Produkty posiadają również odpowiednie certyfikaty potwierdzające ich dostosowanie do potrzeb nawet najmłodszych klientów. </li>
            <li>Polskie produkty – wygodne i bezpieczne ubranka, na które stawiają kolejne pokolenia rodziców są w dodatku polskim produktem. Czy można chcieć czegoś więcej? :) </li>
            </ul>
            <p class="center-text">W Krainie Dzieciaka nie mogło zabraknąć tej marki!</p>

            </div>

            <?php
        }
        else if ((($product->get_attribute('pa_producent')) == 'Mamatti') && (is_single()) || (strpos($current_url, '?filters=producent[mamatti]'))){
            ?>
            <div class="product-description">
            Twórcy marki Mamatti doskonale wiedzą, że aby osiągnąć sukces trzeba wsłuchiwać się zarówno 
            w potrzeby najmłodszych, jak i oczekiwania ich rodziców. Dzięki temu od lat z powodzeniem dają 
            swoim klientom odzież oraz bieliznę dla dzieci i niemowląt, którą wyróżnia wysoka jakość i rozsądna cena. 
            Ale to nie wszystko! Kolejnym ważnym elementem ich produktów jest miłość - do swojej pracy, do dzieci i do pięknych 
            ubranek!

            <ul>Na co stawia marka Mamatti?
                <li>Wysokogatunkowe dzianiny – jakość ubranek to podstawa, szczególnie jeśli głównymi użytkownikami tych produktów są ci, dla których wygoda ma niebagatelne znaczenie. Nie zapominajmy też, że skóra najmłodszych bywa bardzo delikatna, dlatego produkty wykonane z wysokogatunkowych dzianin o składzie surowcowym bawełna 100% są dla nich idealne. </li>
                <li>Innowacyjne wzory – tworząc produkty dla najmłodszych trzeba mieć… refleks. Bez niego niemożliwe jest szycie ubranek, które będą odpowiadały aktualnym trendom oraz oczekiwaniom klientów. Zasada jest prosta – chcesz dać najmłodszym piękne i bezpieczne ubranka? Bądź bacznym obserwatorem świata! Choć w przypadku Mamatti innowacyjność to nie tylko piękne wzory, to też sposób bycia i sposób tworzenia. </li>
                <li>Bezpieczeństwo najmłodszych – wysoką jakość produktów potwierdzają odpowiednie certyfikaty: Bezpieczny dla Dziecka, Tekstylia Godne Zaufania, a także Certyfikat Unii Celnej - Białoruś, Kazachstan, Rosja. </li>
                <li>Polskie produkty – na zakończenie dodamy tylko, że te niezwykle starannie wykonane produkty powstają w Polsce.</li>
            </ul>
            <p class="center-text">Nie wyobrażamy sobie Krainy Dzieciaka bez Mamatti!</p>

            </div>

            <?php
        }

        else if ((($product->get_attribute('pa_producent')) == 'Makoma') && (is_single()) || (strpos($current_url, '?filters=producent[makoma]'))){
            ?>
            <div class="product-description">
            Makoma to firma z długoletnim stażem i masą doświadczeń. Jej historia sięga 1996 r. – to właśnie wtedy narodziła się inicjatywa, która od lat procentuje, dając najmłodszym piękne ubranka. Cały zespół Makomy doskonale wie, że aby dać Klientowi perfekcyjny produkt potrzeba najpierw ogromu zaangażowania i pracy. Bez tego nie byłoby niezwodnych dostawców, profesjonalnych narzędzi, wyszkolonej załogi, pięknych wzorów i dobrych relacji z klientami. 

            <ul>Co wyróżnia markę Makoma?
                <li>Lata doświadczeń – produkty, które otrzymują mali Klienci to efekt wieloletniej pracy całego zespołu – tego nie da się niczym zastąpić!</li>
                <li>Jakość potwierdzona certyfikatami – celem Makomy od samego początku było tworzenie produktów, które będą dobre jakościowo. Czy się udaje? Oczywiście, że tak!</li>
                <li>Zadowolenie klientów – bez tego cała reszta nie ma żadnego znaczenia! Makoma wywołuje radość na twarzach Klientów – nie tylko w Polsce, ale i w takich krajach jak: Czechy, Hiszpania, Litwa, Łotwa, Rosja czy Wielka Brytania. </li>
                <li>Dobrze dobrane dzianiny – przy produkcji ubranek wykorzystywane są najlepsze polskie dzianiny – to właśnie z nich powstają kolekcje ubranek Makomy</li>
                <li>Bezpieczeństwo – ubranka, które trafiają do najmłodszych posiadają atesty i certyfikaty, m.in. „Bezpieczny dla Dziecka” czy „Tekstylia godne zaufania”</li>
                <li>Polskie produkty – wszystkie ubranka Makomy to w pełni polski produkt. </li>
            </ul>

            <p class="center-text">Cieszymy się, że są z nami w Krainie Dzieciaka!</p>

            </div>

            <?php
        }

        else if ((($product->get_attribute('pa_producent')) == 'Weber') && (is_single()) || (strpos($current_url, '?filters=producent[weber]'))){
            ?>
            <div class="product-description">
            Są takie produkty, bez których trudno sobie wyobrazić codzienną pielęgnację niemowlaków, zwłaszcza na początku ich drogi. Produkty te towarzyszą rodzicom od lat i zapewne jeszcze na długo pozostaną stałą częścią wyprawek niemowlęcych. Mowa oczywiście o pieluchach, które do Krainy Dzieciaka dostarcza firma WEBER. Dlaczego akurat Weber? Moglibyśmy odpowiedzieć krótko – JAKOŚĆ, ale na ich sukces składa się też wiele innych czynników, o których po prostu trzeba powiedzieć :)

            <ul>Na co stawia marka Weber?

                <li>Lata doświadczeń – nic tak nie wpływa na ogólną jakość produktów, jak doświadczenie, a także ciągła analiza rynku, procesu produkcji i oczekiwań klientów. Produkcja klasycznych pieluch bawełnianych w firmie WEBER rozpoczęła się w 1989 r. Każdy rok to nowe doświadczenia, nowe wzory pieluch i nowe wyzwania. A to jeszcze nie koniec!</li>
                <li>Jakość produktów – zasada jest prosta – marka Weber stawia na jakość. A my? My stawiamy na nich! To pieluchy, którym ufamy całkowicie!</li>
                <li>Dobre materiały – stuprocentowa, przyjemna w dotyku bawełna.</li>
                <li>Piękne wzory – na kolorowych pieluchach znajdziemy ciekawe wzory, które z pewnością spodobają się nie tylko najmłodszym, ale i ich rodzicom. </li>
                <li>Bezpieczeństwo najmłodszych – pieluchy stanowią jeden z podstawowych produktów w otoczeniu dziecka. Dlatego też posiadają one certyfikat „Bezpieczny dla dziecka”.</li>
                <li>Polskie produkty – to właśnie w Polsce powstają wszystkie pieluszki marki Weber, które trafiają w ręce naszych Klientów.</li>
            </ul>

            <p class="center-text">Wiedzieliśmy, że ich produkty muszą zagościć w Krainie Dzieciaka!</p>

            </div>

            <?php
        }
    }
}

add_shortcode('product_link_collection','product_link_collection');

function product_link_collection(){
    global $product;
    ob_start();
    
    if($product != null){

        $collection = $product->get_attribute('pa_kolekcja');
        if($collection != ''){
            echo '<a href="' . get_site_url() . '/home/?filters=kolekcja[' . str_replace(' ', '-', $collection) . ']"><span class="collection-link">Zobacz też inne produkty z kolekcji ' . strtoupper($collection) . '.</span></a>';
         }

        else if (has_term( 'pieluchy', 'product_cat')){

            ?>
            <a href="<?php echo get_site_url(); ?>/kategoria-produktu/pieluchy/"><span class="collection-link">Zobacz też inne produkty z kategorii PIELUCHY.</span></a>
            <?php
        }

        else if (has_term( 'kocyki', 'product_cat')){

            ?>
            <a href="<?php echo get_site_url(); ?>/kategoria-produktu/kocyki/"><span class="collection-link">Zobacz też inne produkty z kategorii KOCYKI.</span></a>
            <?php
        }

        else if (has_term( 'akcesoria', 'product_cat')){

            ?>
            <a href="<?php echo get_site_url(); ?>/kategoria-produktu/akcesoria/"><span class="collection-link">Zobacz też inne produkty z kategorii AKCESORIA.</span></a>
            <?php
        }
    }

    return ob_get_clean();
    
}



//woocommerce shop loop

add_action('woocommerce_after_shop_loop_item_title', 'maniek_attributes',10);
add_shortcode ('maniek_rozmiar', 'maniek_attributes');

function maniek_attributes(){
    global $product;
    $attributes = explode(',', $product->get_attribute('pa_rozmiar'));
    $stock = array();
    $counter = 0;

    ?><div class="maniek-product-attributes"><?php

    if($product->is_type('variable')){
        $variations = $product->get_children();

        foreach($variations as $variation){
                $variation_obj = wc_get_product($variation);
                $item_quantity = $variation_obj->get_stock_quantity();
                array_push($stock, $item_quantity);
        }
                
        if(count($attributes) && $attributes[0] != ""){?>
                <div>
                    <?php 
                    for($i = 0; $i < count($attributes); $i++){

                        if($stock[$i] != 0){
                                echo '<span class="variation-size">' . str_replace(" ", "", $attributes[$i]) . '</span>';
                        }
                        else{
                                echo '<span class="variation-size out-of-stock">' . str_replace(" ", "", $attributes[$i]) . '</span>';
                        }
                    }
                    ?>
                </div>
            <?php 
        }
    }
    ?></div><?php
}

add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );

add_action('woocommerce_before_shop_loop_item_title', 'maniek_add_featured_tag', 10);

function maniek_add_featured_tag(){
    global $product;
    ?>
    <div class="tags-container"><?php
    
        if(has_term( 'Nowość', 'product_tag')){
                ?>
                    <span class="featured-tag color3-tag">Nowość</span>
                <?php
            }
    
        if($product->is_on_sale()){
            ?>
                <span class="featured-tag color2-tag">Promocja</span>
            <?php
        }
        if($product->is_featured()){
            ?>
                <span class="featured-tag color1-tag">Polecane</span>
            <?php
        }
    ?>
    </div>
    <?php
    
}

/* producent i kolekcja na górze widoku pojedynczego produktu */

add_action( 'woocommerce_single_product_summary', 'before_product_title', 5 );

function before_product_title(){
    global $product;
    ?>

    <div class="product-view-attributes">
            <?php 

            if(array_key_exists('pa_producent', $product->get_attributes())){
                $company = $product->get_attribute('pa_producent');
                echo '<a href="' . get_home_url() . '/home?filters=producent[' . $company . ']">';
                echo '<span id="producent">' . 'Producent: ' . ($product->get_attribute('pa_producent')) . '</span>'; 
                echo '<img class="single-product-company-logo" src="' . get_site_url() . '/wp-content/uploads/logo/' . $company . '.png" alt="' . $company . '-logo">';
                echo '</a>';
            }

            /* if(array_key_exists('pa_kolekcja', $product->get_attributes())){
                $collection = '72';

                echo '<span><a href="' . get_home_url() . '/home?filters=kolekcja[' . $collection . ']">' . 'Kolekcja: ' . ($product->get_attribute('pa_kolekcja')) . '</a></span>'; 
            } */
            
    ?>
    </div>
    <?php
}

//number of products woocommerce page
add_filter( 'loop_shop_per_page', 'products_number_loop', 30 );

function products_number_loop( $products ) {
 $products = 21;
 return $products;
}

//bezpieczny dla dziecka

//add_action( 'woocommerce_single_product_summary', 'bezpieczny_dla_dziecka', 21);

function bezpieczny_dla_dziecka(){
    global $product;

    if(has_term('bezpieczny-dla-dziecka', 'product_tag', $product->get_ID())){
        echo '<div class="bezpieczny-dla-dziecka-img">'; 
        echo '<img src="' . get_site_url() . '/wp-content/uploads/logo/bezpieczny_dla_dziecka.jpg">';
        echo '</div>';

    }

}

//main page shortcode

add_shortcode('main_page_shortcode', 'main_page_shortcode');

function main_page_shortcode(){
    echo '<h1 class="hidden">Strona Główna</h1>';
    echo do_shortcode( '[main_top_slider]');
    
	?>
    <div class="order-info-container">
        <div class="o-nas-description-wrapper">
            <p class="info-o-nas">KRAINA każdego DZIECIAKA powinna być zbudowana z miłości. Bez niej cała reszta nie ma żadnego znaczenia. <br />Będziemy szczęśliwi, jeśli Wasze małe miłości będą nosić ubranka z Krainy Dzieciaka. 
            </p>
            <p class="info-o-nas"> 
            Znajdziecie tu wysokiej jakości ubranka oraz dodatki dla dzieci i niemowląt, sprawdzone marki,<br /> atrakcyjne ceny i <strong>wyłącznie polskie produkty</strong>, które pokochali najmłodsi!
            </p>
            <p class="info-o-nas o-nas-title">
                Witajcie w Krainie Dzieciaka!
            </p>
        </div>
        <div class="hidden">
            <p class="justify-text">
            Jak wygląda Kraina Dzieciaka? To proste! Jest pełna kolorów, śmiechu dziecka i błogiej beztroski. To miejsce, w którym cały świat jest niezwykle intrygujący, a wygoda pożądana! Dlatego nie wyobrażamy sobie tego wszystkiego bez wygodnych ubranek, które sprawiają, że to poznawanie świata staje się znacznie przyjemniejsze.</p>
            <p class="justify-text">
            Jest jeszcze coś, co powinno tworzyć KRAINĘ każdego DZIECIAKA. To miłość! Bez niej cała reszta nie ma żadnego znaczenia. Będziemy szczęśliwi, jeśli dopełnieniem Waszej miłości względem najmłodszych będą ubranka z KRAINY DZIECIAKA. Jednego jesteśmy pewni - zapewnią mu one wygodę w odkrywaniu tych małych i wielkich rzeczy.</p>
            <p class="justify-text">
            Co skłoniło nas do stworzenia tego miejsca? Dusza testera! Przemykając między półkami sklepów kupowaliśmy kolejne ubranka dla swojej pociechy i sprawdzaliśmy, które z nich będą dla niej najlepsze. W końcu wybraliśmy te ulubione. Ciągle sprawdzamy jednak nowe produkty, aby móc dawać Wam to co najlepsze.</p>
            <p class="justify-text">
            Kraina Dzieciaka to wysokiej jakości ubranka oraz dodatki dla dzieci i niemowląt, sprawdzone marki, atrakcyjne ceny i <strong>wyłącznie polskie produkty</strong>, które pokochali najmłodsi!</p>
            <p class="justify-text">
            Doskonale wiemy, że najszczersze opinie wystawiają mali klienci. To oni tak naprawdę weryfikują jakość wszystkich produktów, a miarą tych ocen jest ich radość. My z kolei sprawdzamy, czy stosunek jakości do ceny wywołuje uśmiech - tym razem na twarzy mamy, taty, babci, dziadka, cioci, wujka i każdego, kto postanowi obdarować jakiegoś małego człowieka pięknymi i milusińskimi ubrankami.</p>
            <p class="justify-text">
            Kraina Dzieciaka jest miejscem dla Was. Sprawdźcie, jakie produkty przygotowaliśmy dla Waszych pociech. Dzielcie się z nami swoimi spostrzeżeniami, dawajcie znać, czego potrzebujecie. Nie czujcie się tutaj gośćmi, czujcie się mieszkańcami KRAINY DZIECIAKA!</p>
        </div>
	</div>
    <?php
    echo do_shortcode( '[category_grid]');
	echo do_shortcode('[woo_featured_products]');
	echo do_shortcode('[woo_promo_products]');
	echo do_shortcode('[kraina_latest_posts]');
    echo do_shortcode('[instagram-feed]');
	echo do_shortcode('[companies_main]'); 
}


//inpost map hook

add_action('woocommerce_checkout_before_order_review', 'inpost_easypack_map');

function inpost_easypack_map(){
    echo '<div id="easypack-map"></div>';
}

//disable woocommerce styles

/**
 * Disable WooCommerce block styles (front-end).
 */
function slug_disable_woocommerce_block_styles() {
    wp_dequeue_style( 'wc-block-style' );
  }
 add_action( 'wp_enqueue_scripts', 'slug_disable_woocommerce_block_styles' );

  /**
 * Disable WooCommerce block styles (back-end).
 */
function slug_disable_woocommerce_block_editor_styles() {
    wp_deregister_style( 'wc-block-editor' );
    wp_deregister_style( 'wc-block-style' );
  }
  add_action( 'enqueue_block_assets', 'slug_disable_woocommerce_block_editor_styles', 1, 1 );


  //category grid main page

  add_shortcode( 'category_grid', 'category_grid');

  function category_grid(){
    ?>
    <div class="category-grid-wrapper">
        <h2 class="maniek-subtitle">Zobacz nasze produkty</h2>
        <div class="divider-2 category-title"><span></span></div>
        <div class="category-grid">
           
            <div class="category-element"><div class="category-img-wrapper"><a href="/home/"><img src="/wp-content/uploads/banery/all.jpg"alt="produkty_wszystkie"></a></div></div>
            <div class="category-element"><div class="category-img-wrapper"><a href="/home/?filters=plec[chlopiec]"><img src="/wp-content/uploads/banery/boy.jpg" alt="produkty_chłopiec"></a></div></div>
            <div class="category-element"><div class="category-img-wrapper"><a href="/home/?filters=plec[dziewczynka]"><img src="/wp-content/uploads/banery/girl.jpg" alt="produkty_dziewczynka"></a></div></div>
            <div class="category-element"><div class="category-img-wrapper"><a href="/kategoria-produktu/body"><img src="/wp-content/uploads/banery/body.jpg" alt="produkty_bodziaki"></a></div></div>
            <div class="category-element"><div class="category-img-wrapper"><a href="/kategoria-produktu/pajace-i-rampersy"><img src="/wp-content/uploads/banery/pajace.jpg" alt="produkty_pajace"></a></div></div>
            <div class="category-element"><div class="category-img-wrapper"><a href="/kategoria-produktu/pieluchy"><img src="/wp-content/uploads/banery/pieluchy.jpg" alt="produkty_pieluchy"></a></div></div> 
        </div>
    </div>
    <?php
  }

  add_shortcode( 'main_top_slider', 'main_top_slider');

  function main_top_slider(){
      ?>

    <div class="main-page-slider-wrapper">
        <ul class="main-page-slider">
            <li><a href="/kategoria-produktu/akcesoria/"><img class="kraina-not-lazy" src="/wp-content/uploads/banery/baner_dodatki.jpg" alt="produkty_dodatki_dla_niemowląt"></a></li>
            <li><a href="/home/?filters=kolekcja[lisc]"><img class="kraina-not-lazy" src="/wp-content/uploads/banery/lisc_mamatti.jpg" alt="kolekcja_lisc_by_mamatti"></a></li>
            <li><a href="/home/?filters=kolekcja[hero]"><img class="kraina-not-lazy" src="/wp-content/uploads/banery/super_hero.jpg" alt="kolekcja_hero_by_mamatti"></a></li>
            <li><a href="/home/?filters=kolekcja[simply-comfy]"><img class="kraina-not-lazy" src="/wp-content/uploads/banery/simply_comfy.jpg" alt="kolekcja_simply_comfy_by_eevi"></a></li>
            
            <!--<li><a href="/home/?filters=kolekcja[adventure]"><img class="kraina-not-lazy" src="/wp-content/uploads/banery/baner_adventure.jpg" alt="kolekcja_adventure_eevi_dla_niemowląt"></a></li>-->
            <li><a href="/home/?filters=kolekcja[krolik]"><img class="kraina-not-lazy" src="/wp-content/uploads/banery/baner_krolik.jpg" alt="kolekcja_krolik_mamatti_dla_niemowląt"></a></li>
            <!--<li><a href="/home/?filters=kolekcja[roses]" alt="kolekcja_roses_makoma_dla_niemowląt"><img class="kraina-not-lazy" src="/wp-content/uploads/banery/baner_roses.jpg"></a></li>-->
        </ul>
    </div>

    <script>
    //slider main page slider
    $('.main-page-slider').bxSlider({
        mode: 'horizontal',
        easing: 'ease-in-out',
        infiniteLoop: true,
        auto: true,
        autoStart: true,
        autoDirection: 'next',
        startText: 'play',
        stopText: 'stop',
        pause: 4000,
        autoControls: true,
        pager: true,
        pagerType: 'full',
        controls: true,
        captions: true,
        touchEnabled: false,
        speed: 500
    }); 
    </script>

    <?php
  }

//seperate login and registration 

add_shortcode( 'wc_reg_form', 'separate_registration_form' );
    
function separate_registration_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
   ob_start();
 
   // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
   // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
 
   do_action( 'woocommerce_before_customer_login_form' );
 
   ?>
      <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
 
         <?php do_action( 'woocommerce_register_form_start' ); ?>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
               <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>
 
         <?php endif; ?>
 
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
         </p>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
               <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
            </p>
 
         <?php else : ?>
 
            <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
 
         <?php endif; ?>
 
         <?php do_action( 'woocommerce_register_form' ); ?>
 
         <p class="woocommerce-FormRow form-row">
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
         </p>
 
         <?php do_action( 'woocommerce_register_form_end' ); ?>
 
      </form>
 
   <?php
     
   return ob_get_clean();
}


//additional name and last name on registration page

add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );
  
function bbloomer_add_name_woo_account_registration() {
    ?>
  
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
  
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
  
    <div class="clear"></div>
  
    <?php
}
  
///////////////////////////////
// 2. VALIDATE FIELDS
  
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
  
function bbloomer_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}
  
///////////////////////////////
// 3. SAVE FIELDS
  
add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );
  
function bbloomer_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }
  
}

/**
 * Rename WooCommerce MyAccount menu items
 */
add_filter( 'woocommerce_account_menu_items', 'rename_menu_items' );
function rename_menu_items( $items ) {

    $items['dashboard']    = 'start';

    return $items;
}

/* password confirmation */

// ----- validate password match on the registration page
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Hasła nie pasujądo siebie.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);

// ----- add a confirm password fields match on the registration page
function wc_register_form_password_repeat() {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Powtórz hasło', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );

// ----- Validate confirm password field match to the checkout page
function lit_woocommerce_confirm_password_validation( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_confirm_password'] ) !== 0 ) {
            wc_add_notice( __( 'Wpisane hasła są różne.', 'woocommerce' ), 'error' ); 
        }
    }
}
add_action( 'woocommerce_after_checkout_validation', 'lit_woocommerce_confirm_password_validation', 10, 2 );

// ----- Add a confirm password field to the checkout page
function lit_woocommerce_confirm_password_checkout( $checkout ) {
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {

        $fields = $checkout->get_checkout_fields();

        $fields['account']['account_confirm_password'] = array(
            'type'              => 'password',
            'label'             => __( 'Potwierdź hasło', 'woocommerce' ),
            'required'          => true,
            'placeholder'       => _x( 'Potwierdź hasło', 'placeholder', 'woocommerce' )
        );

        $checkout->__set( 'checkout_fields', $fields );
    }
}
add_action( 'woocommerce_checkout_init', 'lit_woocommerce_confirm_password_checkout', 10, 1 );


//mail after chosing przelewy24
add_action('woocommerce_checkout_order_processed', 'przelewy24_mail', 10, 1);
function przelewy24_mail( $order_id ) {
    if ( ! $order_id )
        return;

    // Getting an instance of the order object
    $order = wc_get_order( $order_id );

    $items = $order->get_items();
    error_log($items);

    //custom email
    function get_custom_email_html( $order, $heading = false, $mailer ) {

        $template = 'emails/customer-new-order-p24.php';
    
        return wc_get_template_html( $template, array(
            'order'         => $order,
            'email_heading' => $heading,
            'sent_to_admin' => false,
            'plain_text'    => false,
            'email'         => $mailer
        ) );
    
    }

    if($order->get_payment_method() == 'przelewy24'){
        // load the mailer class
        $mailer = WC()->mailer();
        
        //format the email
        $recipient = $order->get_billing_email();
        $subject = __("Do Krainy Dzieciaka właśnie dotarło Twoje zamówienie!", 'theme_name');
        $content = get_custom_email_html( $order, $subject, $mailer );
        $headers = "Content-Type: text/html\r\n";
        
        //send the email through wordpress
        $mailer->send( $recipient, $subject, $content, $headers );
    }

}

//removing add to cart button on variable

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');


//invoice in completed order email

add_filter( 'woocommerce_email_attachments', 'order_completed_invoice_pdf', 10, 4 );
 
function order_completed_invoice_pdf( $attachments, $email_id, $order, $email ) {
    $email_ids = array( 'customer_completed_order' );
    if ( in_array ( $email_id, $email_ids ) ) {
        $upload_dir = wp_upload_dir();
        $invoice_id = $order->get_meta('_invoice_id');
        $attachments[] = $upload_dir['basedir'] . '/invoices/' . $invoice_id . '.pdf';
    }
    return $attachments;
}


/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 12;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 12; // 4 related products
	$args['columns'] = 1; // arranged in 2 columns
	return $args;
}

//custom related products
add_filter( 'woocommerce_related_products', 'kraina_related_products_by_same_title', 9999, 3 ); 
 
function kraina_related_products_by_same_title( $related_posts, $product_id, $args ) {
   $product = wc_get_product( $product_id );
   $title = $product->get_name();
   $related_posts = get_posts( array(
      'post_type' => 'product',
      'post_status' => 'publish',
      'product_tag' => 'zobacz-takze',
      'fields' => 'ids',
      'posts_per_page' => 12,
      'order' => 'ASC',
       'orderby' => 'menu_order',
      'exclude' => array( $product_id ),
   ));
   return $related_posts;
}

//full logo svg

add_shortcode('logo_full_svg', 'logo_full_svg');

function logo_full_svg(){
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" id="logo-full-desktop" viewBox="0 0 1628.85 1683.47">
    <path d="M1484.81,1258.61a828,828,0,0,0,53-104.44c25.31-59.47,43.08-121.18,55.06-184.67a765.14,765.14,0,0,0,13.3-141.5q.12-198.54-94.55-373.34c-73.7-135.72-180.2-238.42-314.93-312.77C1127.14,103.53,1053.77,76,975.87,60.22,925.32,50,874.3,46.08,822.88,47.08c-103.33,2-202.76,23.28-298.58,61.7-39.4,15.8-76,37-111.88,59.48-24.67,15.49-48.7,32-72.82,48.35a108,108,0,0,0-16.11,13.65c-12.87,13.06-27.87,23.66-41.06,36.28q-21.53,20.59-41.72,42.6c-30.9,33.61-57.72,70.3-81.3,109.43q-28.57,47.4-52.3,97.33c-4,8.37-7.36,17-10.68,25.72-17.88,46.74-32.52,94.44-41.56,143.74-9.18,50-12.06,100.51-11.55,151.28.91,90.67,19.61,178,48.74,263.47,20.28,59.47,48.3,115,81.67,168.12,22.52,35.84,9,14.84,32.74,50.49.42,2.25.11,4.47-2.14,4-11.6-8.65-47.3-35.85-57.12-48.63,0,0,1.22,5.25-23.71-33.51C81.12,1174.71,48,1104.59,27,1029,15.7,988.16,8.81,946.45,4.53,904.31A813.75,813.75,0,0,1,.52,791c1.75-46.59,8.23-92.53,17-138.22C27.39,601,43.62,551.25,63.15,502.3,88.39,439,122,380.76,163.24,326.7c17.52-23,35.48-45.56,54.72-67.05,13.47-15,28.37-28.75,42.32-43.35C273.86,202.08,290,191,305,178.51c12.78-10.65,25.24-21.63,38.68-31.52a610.12,610.12,0,0,1,92.6-56.52C490.13,64,545.4,41.11,603.45,25.37,646.88,13.59,691.09,6.61,735.89,2.73c18.23-1.57,36.5-2.4,54.75-2.66A852.3,852.3,0,0,1,905.75,6.68c50.69,6.16,100.53,16.12,149.41,30.92,166.59,50.45,301.32,146.34,406.52,284.59a820.44,820.44,0,0,1,120.82,223,797.42,797.42,0,0,1,36.78,147,830.29,830.29,0,0,1,7.7,181.31c-7.07,105.95-34.79,206.26-84.74,300.15a752.68,752.68,0,0,1-55.58,88.71c-.51.77-1.49,1.2-1.62,2.24l0,0c-1.93.22-3-.42-2.4-2.54a1.7,1.7,0,0,1,.79-1.55A4.25,4.25,0,0,1,1484.81,1258.61Z" transform="translate(0 0)" style="fill-rule:evenodd"/>
    <path d="M371.39,1442.28a12.14,12.14,0,0,1,.65-3.15q.66-2.1,1.32-10.77t1.05-20.88q.39-12.23.79-26.8t.78-29.81q.4-15.24.92-29.82t1.58-26.66q2.37-26.27,6.31-31.26,2.1-6,14.18-6.05h3.68q0,10-2.23,42t-2.5,38.09q17.07-8.67,33-18.79t29.68-18.65q13.8-8.54,25.09-14.18t16.81-5.65q9.19,0,9.2,7.09,0,5.52-8.41,12.22a169.9,169.9,0,0,1-21,13.92q-12.62,7.23-27.46,14.58t-27.45,14.32a211.91,211.91,0,0,0-21,13q-8.41,6-8.41,10.51a149.43,149.43,0,0,0,15.63,7.75q10.9,4.86,24.43,11t28.11,13.13q14.58,7,26.66,14.06,27.33,15.5,27.32,25.74,0,3.42-4.46,4.73a13.42,13.42,0,0,1-3.68.53H509.3a48.46,48.46,0,0,1-23.64-6q-11-6-23.51-14.45t-28.24-17.47q-15.77-9.06-38.09-15.11V1442q-.52,1.05-4.73,2.37a44.19,44.19,0,0,1-12.87,1.84C373.66,1446.23,371.39,1444.91,371.39,1442.28Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M554,1290.18q14.44-13.92,52.28-13.92,23.64,0,39.66,4.73t24,10q8,5.27,8,11.56,0,14.45-33.62,28.63-5,2.37-26.14,9.59t-28.5,9.85q-16,6-21.28,9.46a2.85,2.85,0,0,0,1.05,2.23,36.38,36.38,0,0,0,5,3.16q3.94,2.23,11.82,6.3t21.81,11.69q41.51,22.59,85.37,48.34,2.1,1.58,5.52,4.33c2.27,1.84,3.41,3.86,3.41,6s-.7,3.73-2.1,4.6a16.21,16.21,0,0,1-5,2,27.07,27.07,0,0,1-6,.66H684q-5.26,0-21.94-11.3t-28.9-19.7q-12.21-8.4-24.82-16.29-29.69-19.17-47-24.95v60.15q0,5.26-8.94,5.26H549.5q-5.52,0-8.15-5.52-3.68-8.4-3.68-31l.79-52.8q0-38.88-3.41-68.3,6.3-10.77,15.5.79C552,1287.47,553.08,1289,554,1290.18Zm88.79,3.16-17.07-.27q-59.37,0-68.3,13.66a15.64,15.64,0,0,0-2.63,9.33,80.6,80.6,0,0,0,.52,9.85q1.32,10.77,6.05,15.5a9.64,9.64,0,0,0,2.75.26,46.78,46.78,0,0,0,7.36-1.05q5.39-1,14.45-3.81t19.31-6.7q10.24-3.93,19.7-8.14,29.68-13.4,29.68-21.8Q654.57,1295.43,642.75,1293.34Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M859,1350.08h7.36a44.43,44.43,0,0,1,8.53.79c2.72.52,4.07,2.45,4.07,5.78q1.85,10.5-12.34,10.24c-2.63-.17-5-.35-7.23-.52a39.88,39.88,0,0,0-5.38-.14c-1.4.09-2,.58-1.84,1.45q2.63,7.62,5.65,17.07t6.7,18.92q9.45,23.38,17.86,33.62a41.47,41.47,0,0,1-10.38,9.2,54.4,54.4,0,0,1-6.3,3.68.88.88,0,0,1-.66-.27l-37-78-71.71,17.6-2.63,11q-7.62,30.21-17.08,42c-1,1.75-3.24,1.93-6.56.52q-8.41-3.15-8.41-5.25,0-.52,5.52-15.24l11.16-29.81q5.65-15.11,11.82-31.66t11.69-31.52q5.52-15,10-26.93t6.3-17.34a59.64,59.64,0,0,0,2.5-9.45,26.8,26.8,0,0,1,2-7q2.61-6,13.13-6.05a46.61,46.61,0,0,1,17.47,16.42A128.12,128.12,0,0,1,823.62,1301q4.33,11.57,8.53,23.38a83.92,83.92,0,0,0,11.3,21.55,8.49,8.49,0,0,0,7.09,3.94Q855.28,1350.08,859,1350.08Zm-65.67-56.74a121.71,121.71,0,0,1-9.46,32.83Q776.46,1343,772,1352.31t-7.62,17.21q17.86,0,43.87-10.51c4.38-1.92,8.58-3.68,12.61-5.25Q808.52,1301,793.28,1293.34Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M914.64,1442q0,4.47-6.3,4.47-4.74,0-11.3-4.47-3.15-7.1-3.15-33.89t.52-44.26q.52-17.46,1.06-32.18,1.57-32,1.57-33.89,7.62-4.46,12.61-4.46t5,4.46Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M1087.49,1353.49q0,79.86-6.56,93.52l-19.18-1.57q-14.45-25-48.6-70.14-13.39-17.86-26.66-35.47t-24.3-34.93q-5.27,23.37-5.25,93.51,0,26.8-1.05,45.19a15.61,15.61,0,0,1-10.91,4.73c-3.94,0-6.7-.4-8.27-1.18a4.09,4.09,0,0,1-2.37-4q0-2.75.66-8.66c.44-4,1-10.55,1.58-19.84s1.18-19.09,1.7-29.42q2.1-40.46,2.11-69.75t-.53-48.2q5.77-5.25,8.93-7.62t7.1.13q3.93,2.51,10.11,10.77t17.47,24.57q38.61,54.9,75.92,103l5-130.82q2.88-5.25,5.78-7.22a13.21,13.21,0,0,1,7.62-2q9.18,0,9.19,16.81l-.26,9.72Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M1240.65,1350.08H1248a44.53,44.53,0,0,1,8.54.79q4.07.78,4.07,5.78,1.83,10.5-12.35,10.24c-2.62-.17-5-.35-7.22-.52a40,40,0,0,0-5.39-.14c-1.4.09-2,.58-1.83,1.45q2.61,7.62,5.64,17.07t6.7,18.92q9.46,23.38,17.87,33.62a41.47,41.47,0,0,1-10.38,9.2,54.4,54.4,0,0,1-6.3,3.68.87.87,0,0,1-.66-.27l-37-78-71.72,17.6-2.62,11q-7.63,30.21-17.08,42c-1,1.75-3.24,1.93-6.57.52q-8.4-3.15-8.4-5.25,0-.52,5.51-15.24t11.17-29.81l11.82-31.66q6.16-16.54,11.69-31.52t10-26.93q4.47-12,6.31-17.34a59.49,59.49,0,0,0,2.49-9.45,27.2,27.2,0,0,1,2-7q2.63-6,13.14-6.05a46.68,46.68,0,0,1,17.47,16.42,128.09,128.09,0,0,1,10.5,21.67q4.34,11.57,8.54,23.38a83.92,83.92,0,0,0,11.3,21.55,8.48,8.48,0,0,0,7.09,3.94Q1237,1350.08,1240.65,1350.08ZM1175,1293.34a121.31,121.31,0,0,1-9.45,32.83q-7.37,16.82-11.83,26.14t-7.61,17.21q17.85,0,43.87-10.51c4.37-1.92,8.57-3.68,12.61-5.25Q1190.2,1301,1175,1293.34Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M180,1518.23q19.44-6.82,51.49-6.83,58.58,0,80.12,28.9,8.42,11,8.41,28.11a44,44,0,0,1,.26,4.73q0,26.27-30.73,53.32-28.11,25.49-69.35,41Q192.88,1678,175,1678a34,34,0,0,1-12.61-2.1V1511.93h3.68a20.51,20.51,0,0,1,9.72,2C178.26,1515.21,179.66,1516.66,180,1518.23Zm122.42,52.28q-2.37-23.38-26-34.68-17.6-8.4-44.13-8.4l-4.73.26q-25,.52-43.08,7.88v125.31q18.39,0,46-13.4,47.81-23.64,65.68-54.91A44.14,44.14,0,0,0,302.43,1570.51Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M529.14,1675.32q-64.89,5-119.27,5-75.64,0-75.65-9.71,0-2.1,2.62-4.21l113.49-126.62q-10.51-.52-17.21-.52t-15.1.13q-8.41.13-21.54,1.18-38.62,3.15-53.33,3.94-3.94,0-4.86-2.36t-1.45-11q58.57-6.3,133.72-8.93a24,24,0,0,1,7.09,1c2.27.71,3.41,2.54,3.41,5.52q-7.35,20.49-50.7,66.72-51,54.12-59.1,64.89a174.28,174.28,0,0,0,33.88,2.89q19.44,0,39.41-1.18t41.5-3q21.54-1.85,41-3.16Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M565.39,1675.32q0,4.47-6.31,4.47-4.73,0-11.29-4.47-3.15-7.08-3.15-33.88t.52-44.27q.52-17.46,1.05-32.18,1.57-32,1.58-33.89,7.62-4.45,12.61-4.46c3.32,0,5,1.49,5,4.46Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M671.25,1512.72q26.26,0,34.94,3.41V1529a151.13,151.13,0,0,1-19.44,1.19q-12.35.12-26.27.39-38.88.78-53.06,3.94-4.47,21-4.2,28.63t.52,11.82a241,241,0,0,1,1,24.17,304.66,304.66,0,0,0,40.85-3.15q23-3.15,35.6-4.6a229,229,0,0,1,26-1.44v14.45L606.63,1617l1.58,43.08q26,0,53.19-2.5t41.25-3.68q14-1.17,29.81-1.18a17.68,17.68,0,0,1-3.15,10q-6.3,8.41-11.3,5-46.23,5-82.61,7.88t-49,3.94l1.05-167.6q6.84,2.1,25.22,2.1Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M874.84,1533.73q-17.07-16.82-37.82-16.81-19.71,0-37.83,15-22.86,18.91-31.53,48.86-3.15,10.79-3.15,17.87a86.62,86.62,0,0,0,.53,11q0,26,17.6,39.93,16.54,12.87,42.29,12.87,35.21-2.88,67.51-27.06,8.94-6.83,18.92-13.13a28.06,28.06,0,0,1,7.48,1c2.54.7,3.81,2.72,3.81,6q-26,22.61-43.87,32.58-33.09,17.86-59.89,17.86h-3.42q-29.16,0-49.91-18.13-22.06-19.17-22.06-47.81a111.56,111.56,0,0,1,7.75-41.24,114.48,114.48,0,0,1,21.27-34.81,102.14,102.14,0,0,1,32.05-24,90.39,90.39,0,0,1,39.8-8.94q18.12,0,23.64,5Q874.83,1515.88,874.84,1533.73Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M955.75,1675.32q0,4.47-6.3,4.47-4.73,0-11.3-4.47-3.15-7.08-3.15-33.88t.53-44.27q.53-17.46,1.05-32.18,1.57-32,1.57-33.89,7.62-4.45,12.61-4.46t5,4.46Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M1113.11,1583.38h7.35a44.53,44.53,0,0,1,8.54.79q4.07.78,4.07,5.78,1.85,10.5-12.34,10.24c-2.63-.17-5-.35-7.23-.52a38.06,38.06,0,0,0-5.38-.13c-1.41.09-2,.57-1.84,1.44q2.63,7.62,5.65,17.08t6.69,18.91q9.47,23.38,17.87,33.63a41.63,41.63,0,0,1-10.38,9.19,54.4,54.4,0,0,1-6.3,3.68.87.87,0,0,1-.66-.27l-37-78-71.72,17.6-2.62,11q-7.62,30.21-17.08,42c-1.05,1.75-3.24,1.93-6.57.52q-8.4-3.15-8.4-5.25,0-.52,5.51-15.24t11.17-29.81l11.82-31.66q6.16-16.54,11.69-31.52t10-26.93q4.47-11.94,6.31-17.33a59.58,59.58,0,0,0,2.49-9.46,27.85,27.85,0,0,1,2-7q2.63-6,13.14-6a46.51,46.51,0,0,1,17.47,16.41,127.86,127.86,0,0,1,10.51,21.68q4.32,11.55,8.53,23.38a84,84,0,0,0,11.3,21.54,8.49,8.49,0,0,0,7.09,3.94Q1109.42,1583.38,1113.11,1583.38Zm-65.68-56.74a121.48,121.48,0,0,1-9.45,32.84q-7.37,16.82-11.82,26.13t-7.62,17.21q17.87,0,43.87-10.51c4.37-1.92,8.58-3.68,12.61-5.25Q1062.66,1534.26,1047.43,1526.64Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M1152.51,1675.59a11.82,11.82,0,0,1,.66-3.16q.64-2.1,1.31-10.77t1-20.88q.4-12.21.79-26.8t.79-29.81q.39-15.24.92-29.82t1.57-26.66q2.37-26.26,6.31-31.26,2.1-6,14.19-6h3.67q0,10-2.23,42t-2.5,38.09q17.09-8.67,33-18.78t29.69-18.66q13.79-8.52,25.08-14.18t16.82-5.65q9.2,0,9.19,7.09,0,5.52-8.4,12.22a167.11,167.11,0,0,1-21,13.92q-12.61,7.23-27.45,14.58t-27.45,14.32a212.89,212.89,0,0,0-21,13q-8.42,6-8.41,10.51a151.52,151.52,0,0,0,15.63,7.75q10.9,4.86,24.44,11t28.1,13.14q14.58,7,26.67,14,27.31,15.51,27.32,25.75c0,2.27-1.49,3.85-4.47,4.72a13,13,0,0,1-3.68.53h-2.62a48.47,48.47,0,0,1-23.65-6q-11-6-23.51-14.45T1215,1637.89q-15.75-9.06-38.09-15.11v52.54c-.35.71-1.93,1.49-4.73,2.37a43.81,43.81,0,0,1-12.87,1.84C1154.79,1679.53,1152.51,1678.21,1152.51,1675.59Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M1448.31,1583.38h7.35a44.53,44.53,0,0,1,8.54.79q4.07.78,4.07,5.78,1.83,10.5-12.34,10.24c-2.63-.17-5-.35-7.23-.52a38.06,38.06,0,0,0-5.38-.13c-1.41.09-2,.57-1.84,1.44q2.63,7.62,5.65,17.08t6.69,18.91q9.47,23.38,17.87,33.63a41.63,41.63,0,0,1-10.38,9.19,54.4,54.4,0,0,1-6.3,3.68.87.87,0,0,1-.66-.27l-37-78-71.72,17.6-2.62,11q-7.62,30.21-17.08,42c-1.05,1.75-3.24,1.93-6.57.52q-8.4-3.15-8.4-5.25,0-.52,5.51-15.24t11.17-29.81l11.82-31.66q6.16-16.54,11.69-31.52t10-26.93q4.47-11.94,6.31-17.33a59.58,59.58,0,0,0,2.49-9.46,27.43,27.43,0,0,1,2-7q2.63-6,13.14-6a46.51,46.51,0,0,1,17.47,16.41,128.62,128.62,0,0,1,10.51,21.68q4.32,11.55,8.53,23.38a84,84,0,0,0,11.3,21.54,8.48,8.48,0,0,0,7.09,3.94Q1444.63,1583.38,1448.31,1583.38Zm-65.68-56.74a121.48,121.48,0,0,1-9.45,32.84q-7.37,16.82-11.83,26.13t-7.61,17.21q17.87,0,43.87-10.51c4.37-1.92,8.58-3.68,12.61-5.25Q1397.86,1534.26,1382.63,1526.64Z" transform="translate(0 0)" style="fill:#000100"/>
    <path d="M734.32,604.53s14.54,22.11,33.8,31.32c20.26,9.68,45.3,5.8,45.3-23.19v-36" transform="translate(0 0)" style="fill:none;stroke:#000100;stroke-miterlimit:10;stroke-width:15px"/>
    <path d="M894.43,604.53s-14.54,22.11-33.81,31.32c-20.25,9.68-45.29,5.8-45.29-23.19v-36" transform="translate(0 0)" style="fill:none;stroke:#000100;stroke-miterlimit:10;stroke-width:15px"/>
    <path d="M818.22,583.54c46.84-12.26,63.16-57,63.16-57-77.37-48.94-132.62,0-132.62,0S789.28,591.11,818.22,583.54Z" transform="translate(0 0)" style="fill-rule:evenodd"/>
    <path d="M716.07,475.78c9.61,0,17.4-14.79,17.4-33s-7.79-33-17.4-33-17.4,14.79-17.4,33S706.46,475.78,716.07,475.78Z" transform="translate(0 0)" style="fill-rule:evenodd"/><path d="M907,475.78c9.62,0,17.41-14.79,17.41-33s-7.79-33-17.41-33-17.39,14.79-17.39,33S897.44,475.78,907,475.78Z" transform="translate(0 0)" style="fill-rule:evenodd"/><path d="M811.56,1061.59l-1.77,0C810.37,1061.6,811,1061.58,811.56,1061.59Z" transform="translate(0 0)" style="fill-rule:evenodd"/><path d="M1136.45,670.61s-84.22-17.53-103.51-21.29c37.68-81.53,35.24-144.53,21.14-219.13-2-10.85-1.38-26.29,4.27-35.44,32.07-52,22-83.22-20.65-120.57-41-35.91-86.35-46-123.62-3.74-14,15.92-26.33,14.56-43.88,13.75-15.18-.71-35.75-1.13-57.05-1.5v.66c-20.38.36-39.93.77-54.5,1.45-17.56.81-29.86,2.17-43.89-13.75-37.27-42.29-77.9-32.11-118.89,3.8-42.61,37.35-57.44,68.51-25.37,120.51a40.82,40.82,0,0,1,5,14.32c1.21,7.25,0,14.81-.73,21.12-8.12,74-14.12,145.84,21.15,219.13-19.3,3.75-104,22.25-104,22.25l48.82,211.57,36.1-6.3c16.62-2.77,33.35-6.84,51.51-10.41-2.31,7-3.87,12.68-6,18.11-18.48,45.81-37.19,91.52-55.6,137.36a147.92,147.92,0,0,0-4.89,14.09h0l-16.87,43.45,214.78,66.7,14.4-32.13A317.7,317.7,0,0,0,787.31,1085h30v-.61h24.2A316.17,316.17,0,0,0,854.77,1114l16.12,36L1085,1082l-17.87-46a148.89,148.89,0,0,0-4.89-14.09c-18.41-45.83-37.12-91.55-55.6-137.35-2.19-5.43-3.74-11.14-6.05-18.12,17.83,3.51,88,13.09,88,13.09ZM604.15,443.66c7.79-26.78,9.55-46-10.85-69.14-27.25-30.87-11.06-56.4,21.9-83,30.75-24.81,56.15-31.36,77.29,2.57,17.74,28.5,226.12,27.89,243.87-.61,21.13-33.93,52.77-26.1,83.51-1.3,33,26.6,42.92,50.85,15.68,81.73-20.41,23.13-18.64,42.36-10.86,69.14,31.33,107.76,34.11,197-61.63,237.86-.37.16-.46.27-.33.35-7.3,7.76-140.57,145-300.53-2.75.08-.09,0-.2-.38-.35C566.08,637.29,572.83,551.42,604.15,443.66ZM546.48,824.19q-11.94-46.22-21.76-93c-5.08-24.38-12.71-31.82,10-40.81,14.89-5.89,33.38-9,51.62-10.62L617.24,840c-13.39,1.79-26.76,3.78-40.14,5.6C560.92,847.79,550.49,839.68,546.48,824.19Zm491.23,214.71c8.23,19.44,2.27,30-16.69,35.39-30.22,8.53-60.46,17.15-90.25,27.15-18.78,6.28-37.25,6.7-47.58-11.32-5.52-9.64-14.84-20.59-14.84-40.92-19.24,8.06-34.73,11.63-49.29,12.29l-1.77.08c-1.92,0-3.83.07-5.73,0v.58c-15.09-.43-31-4-51.06-12.35,0,20.32-9.33,31.27-14.84,40.91-10.33,18-28.8,17.6-47.58,11.32-29.8-10-60-18.62-90.25-27.14-19-5.35-24.92-16-16.69-35.39,18.14-42.86,32.79-87.53,54.63-131.09L986,913.8C1006.26,955.46,1020.4,998,1037.71,1038.9Zm14-193.91c-16.62-2.27-33.23-4.79-49.87-6.85l32.6-158.59c21,.85,42.87,3.58,59.65,10.22,22.71,9,15.09,16.43,10,40.81q-9.75,46.77-21.77,93C1078.36,839.07,1067.92,847.18,1051.74,845Z" transform="translate(0 0)" style="fill-rule:evenodd"/></svg>
    <?php
}

add_shortcode('logo_text_svg', 'logo_text_svg');

function logo_text_svg(){
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" id="logo-text-desktop" viewBox="0 0 1309.27 426.38">
    <path d="M371.39,1442.28a12.14,12.14,0,0,1,.65-3.15q.66-2.1,1.32-10.77t1.05-20.88q.39-12.23.79-26.8t.78-29.81q.4-15.24.92-29.82t1.58-26.66q2.37-26.27,6.31-31.26,2.1-6,14.18-6.05h3.68q0,10-2.23,42t-2.5,38.09q17.07-8.67,33-18.79t29.68-18.65q13.8-8.54,25.09-14.18t16.81-5.65q9.19,0,9.2,7.09,0,5.52-8.41,12.22a169.9,169.9,0,0,1-21,13.92q-12.62,7.23-27.46,14.58t-27.45,14.32a211.91,211.91,0,0,0-21,13q-8.41,6-8.41,10.51a149.43,149.43,0,0,0,15.63,7.75q10.9,4.86,24.43,11t28.11,13.13q14.58,7,26.66,14.06,27.33,15.5,27.32,25.74,0,3.42-4.46,4.73a13.42,13.42,0,0,1-3.68.53H509.3a48.46,48.46,0,0,1-23.64-6q-11-6-23.51-14.45t-28.24-17.47q-15.77-9.06-38.09-15.11V1442q-.52,1.05-4.73,2.37a44.19,44.19,0,0,1-12.87,1.84C373.66,1446.23,371.39,1444.91,371.39,1442.28Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M554,1290.18q14.44-13.92,52.28-13.92,23.64,0,39.66,4.73t24,10q8,5.27,8,11.56,0,14.45-33.62,28.63-5,2.37-26.14,9.59t-28.5,9.85q-16,6-21.28,9.46a2.85,2.85,0,0,0,1.05,2.23,36.38,36.38,0,0,0,5,3.16q3.94,2.23,11.82,6.3t21.81,11.69q41.51,22.59,85.37,48.34,2.1,1.58,5.52,4.33c2.27,1.84,3.41,3.86,3.41,6s-.7,3.73-2.1,4.6a16.21,16.21,0,0,1-5,2,27.07,27.07,0,0,1-6,.66H684q-5.26,0-21.94-11.3t-28.9-19.7q-12.21-8.4-24.82-16.29-29.69-19.17-47-24.95v60.15q0,5.26-8.94,5.26H549.5q-5.52,0-8.15-5.52-3.68-8.4-3.68-31l.79-52.8q0-38.88-3.41-68.3,6.3-10.77,15.5.79C552,1287.47,553.08,1289,554,1290.18Zm88.79,3.16-17.07-.27q-59.37,0-68.3,13.66a15.64,15.64,0,0,0-2.63,9.33,80.6,80.6,0,0,0,.52,9.85q1.32,10.77,6.05,15.5a9.64,9.64,0,0,0,2.75.26,46.78,46.78,0,0,0,7.36-1.05q5.39-1,14.45-3.81t19.31-6.7q10.24-3.93,19.7-8.14,29.68-13.4,29.68-21.8Q654.57,1295.43,642.75,1293.34Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M859,1350.08h7.36a44.43,44.43,0,0,1,8.53.79c2.72.52,4.07,2.45,4.07,5.78q1.85,10.5-12.34,10.24c-2.63-.17-5-.35-7.23-.52a39.88,39.88,0,0,0-5.38-.14c-1.4.09-2,.58-1.84,1.45q2.63,7.62,5.65,17.07t6.7,18.92q9.45,23.38,17.86,33.62a41.47,41.47,0,0,1-10.38,9.2,54.4,54.4,0,0,1-6.3,3.68.88.88,0,0,1-.66-.27l-37-78-71.71,17.6-2.63,11q-7.62,30.21-17.08,42c-1,1.75-3.24,1.93-6.56.52q-8.41-3.15-8.41-5.25,0-.52,5.52-15.24l11.16-29.81q5.65-15.11,11.82-31.66t11.69-31.52q5.52-15,10-26.93t6.3-17.34a59.64,59.64,0,0,0,2.5-9.45,26.8,26.8,0,0,1,2-7q2.61-6,13.13-6.05a46.61,46.61,0,0,1,17.47,16.42A128.12,128.12,0,0,1,823.62,1301q4.33,11.57,8.53,23.38a83.92,83.92,0,0,0,11.3,21.55,8.49,8.49,0,0,0,7.09,3.94Q855.28,1350.08,859,1350.08Zm-65.67-56.74a121.71,121.71,0,0,1-9.46,32.83Q776.46,1343,772,1352.31t-7.62,17.21q17.86,0,43.87-10.51c4.38-1.92,8.58-3.68,12.61-5.25Q808.52,1301,793.28,1293.34Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M914.64,1442q0,4.47-6.3,4.47-4.74,0-11.3-4.47-3.15-7.1-3.15-33.89t.52-44.26q.52-17.46,1.06-32.18,1.57-32,1.57-33.89,7.62-4.46,12.61-4.46t5,4.46Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M1087.49,1353.49q0,79.86-6.56,93.52l-19.18-1.57q-14.45-25-48.6-70.14-13.39-17.86-26.66-35.47t-24.3-34.93q-5.27,23.37-5.25,93.51,0,26.8-1.05,45.19a15.61,15.61,0,0,1-10.91,4.73c-3.94,0-6.7-.4-8.27-1.18a4.09,4.09,0,0,1-2.37-4q0-2.75.66-8.66c.44-4,1-10.55,1.58-19.84s1.18-19.09,1.7-29.42q2.1-40.46,2.11-69.75t-.53-48.2q5.77-5.25,8.93-7.62t7.1.13q3.93,2.51,10.11,10.77t17.47,24.57q38.61,54.9,75.92,103l5-130.82q2.88-5.25,5.78-7.22a13.21,13.21,0,0,1,7.62-2q9.18,0,9.19,16.81l-.26,9.72Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M1240.65,1350.08H1248a44.53,44.53,0,0,1,8.54.79q4.07.78,4.07,5.78,1.83,10.5-12.35,10.24c-2.62-.17-5-.35-7.22-.52a40,40,0,0,0-5.39-.14c-1.4.09-2,.58-1.83,1.45q2.61,7.62,5.64,17.07t6.7,18.92q9.46,23.38,17.87,33.62a41.47,41.47,0,0,1-10.38,9.2,54.4,54.4,0,0,1-6.3,3.68.87.87,0,0,1-.66-.27l-37-78-71.72,17.6-2.62,11q-7.63,30.21-17.08,42c-1,1.75-3.24,1.93-6.57.52q-8.4-3.15-8.4-5.25,0-.52,5.51-15.24t11.17-29.81l11.82-31.66q6.16-16.54,11.69-31.52t10-26.93q4.47-12,6.31-17.34a59.49,59.49,0,0,0,2.49-9.45,27.2,27.2,0,0,1,2-7q2.63-6,13.14-6.05a46.68,46.68,0,0,1,17.47,16.42,128.09,128.09,0,0,1,10.5,21.67q4.34,11.57,8.54,23.38a83.92,83.92,0,0,0,11.3,21.55,8.48,8.48,0,0,0,7.09,3.94Q1237,1350.08,1240.65,1350.08ZM1175,1293.34a121.31,121.31,0,0,1-9.45,32.83q-7.37,16.82-11.83,26.14t-7.61,17.21q17.85,0,43.87-10.51c4.37-1.92,8.57-3.68,12.61-5.25Q1190.2,1301,1175,1293.34Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M180,1518.23q19.44-6.82,51.49-6.83,58.58,0,80.12,28.9,8.42,11,8.41,28.11a44,44,0,0,1,.26,4.73q0,26.27-30.73,53.32-28.11,25.49-69.35,41Q192.88,1678,175,1678a34,34,0,0,1-12.61-2.1V1511.93h3.68a20.51,20.51,0,0,1,9.72,2C178.26,1515.21,179.66,1516.66,180,1518.23Zm122.42,52.28q-2.37-23.38-26-34.68-17.6-8.4-44.13-8.4l-4.73.26q-25,.52-43.08,7.88v125.31q18.39,0,46-13.4,47.81-23.64,65.68-54.91A44.14,44.14,0,0,0,302.43,1570.51Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M529.14,1675.32q-64.89,5-119.27,5-75.64,0-75.65-9.71,0-2.1,2.62-4.21l113.49-126.62q-10.51-.52-17.21-.52t-15.1.13q-8.41.13-21.54,1.18-38.62,3.15-53.33,3.94-3.94,0-4.86-2.36t-1.45-11q58.57-6.3,133.72-8.93a24,24,0,0,1,7.09,1c2.27.71,3.41,2.54,3.41,5.52q-7.35,20.49-50.7,66.72-51,54.12-59.1,64.89a174.28,174.28,0,0,0,33.88,2.89q19.44,0,39.41-1.18t41.5-3q21.54-1.85,41-3.16Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M565.39,1675.32q0,4.47-6.31,4.47-4.73,0-11.29-4.47-3.15-7.08-3.15-33.88t.52-44.27q.52-17.46,1.05-32.18,1.57-32,1.58-33.89,7.62-4.45,12.61-4.46c3.32,0,5,1.49,5,4.46Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M671.25,1512.72q26.26,0,34.94,3.41V1529a151.13,151.13,0,0,1-19.44,1.19q-12.35.12-26.27.39-38.88.78-53.06,3.94-4.47,21-4.2,28.63t.52,11.82a241,241,0,0,1,1,24.17,304.66,304.66,0,0,0,40.85-3.15q23-3.15,35.6-4.6a229,229,0,0,1,26-1.44v14.45L606.63,1617l1.58,43.08q26,0,53.19-2.5t41.25-3.68q14-1.17,29.81-1.18a17.68,17.68,0,0,1-3.15,10q-6.3,8.41-11.3,5-46.23,5-82.61,7.88t-49,3.94l1.05-167.6q6.84,2.1,25.22,2.1Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M874.84,1533.73q-17.07-16.82-37.82-16.81-19.71,0-37.83,15-22.86,18.91-31.53,48.86-3.15,10.79-3.15,17.87a86.62,86.62,0,0,0,.53,11q0,26,17.6,39.93,16.54,12.87,42.29,12.87,35.21-2.88,67.51-27.06,8.94-6.83,18.92-13.13a28.06,28.06,0,0,1,7.48,1c2.54.7,3.81,2.72,3.81,6q-26,22.61-43.87,32.58-33.09,17.86-59.89,17.86h-3.42q-29.16,0-49.91-18.13-22.06-19.17-22.06-47.81a111.56,111.56,0,0,1,7.75-41.24,114.48,114.48,0,0,1,21.27-34.81,102.14,102.14,0,0,1,32.05-24,90.39,90.39,0,0,1,39.8-8.94q18.12,0,23.64,5Q874.83,1515.88,874.84,1533.73Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M955.75,1675.32q0,4.47-6.3,4.47-4.73,0-11.3-4.47-3.15-7.08-3.15-33.88t.53-44.27q.53-17.46,1.05-32.18,1.57-32,1.57-33.89,7.62-4.45,12.61-4.46t5,4.46Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M1113.11,1583.38h7.35a44.53,44.53,0,0,1,8.54.79q4.07.78,4.07,5.78,1.85,10.5-12.34,10.24c-2.63-.17-5-.35-7.23-.52a38.06,38.06,0,0,0-5.38-.13c-1.41.09-2,.57-1.84,1.44q2.63,7.62,5.65,17.08t6.69,18.91q9.47,23.38,17.87,33.63a41.63,41.63,0,0,1-10.38,9.19,54.4,54.4,0,0,1-6.3,3.68.87.87,0,0,1-.66-.27l-37-78-71.72,17.6-2.62,11q-7.62,30.21-17.08,42c-1.05,1.75-3.24,1.93-6.57.52q-8.4-3.15-8.4-5.25,0-.52,5.51-15.24t11.17-29.81l11.82-31.66q6.16-16.54,11.69-31.52t10-26.93q4.47-11.94,6.31-17.33a59.58,59.58,0,0,0,2.49-9.46,27.85,27.85,0,0,1,2-7q2.63-6,13.14-6a46.51,46.51,0,0,1,17.47,16.41,127.86,127.86,0,0,1,10.51,21.68q4.32,11.55,8.53,23.38a84,84,0,0,0,11.3,21.54,8.49,8.49,0,0,0,7.09,3.94Q1109.42,1583.38,1113.11,1583.38Zm-65.68-56.74a121.48,121.48,0,0,1-9.45,32.84q-7.37,16.82-11.82,26.13t-7.62,17.21q17.87,0,43.87-10.51c4.37-1.92,8.58-3.68,12.61-5.25Q1062.66,1534.26,1047.43,1526.64Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M1152.51,1675.59a11.82,11.82,0,0,1,.66-3.16q.64-2.1,1.31-10.77t1-20.88q.4-12.21.79-26.8t.79-29.81q.39-15.24.92-29.82t1.57-26.66q2.37-26.26,6.31-31.26,2.1-6,14.19-6h3.67q0,10-2.23,42t-2.5,38.09q17.09-8.67,33-18.78t29.69-18.66q13.79-8.52,25.08-14.18t16.82-5.65q9.2,0,9.19,7.09,0,5.52-8.4,12.22a167.11,167.11,0,0,1-21,13.92q-12.61,7.23-27.45,14.58t-27.45,14.32a212.89,212.89,0,0,0-21,13q-8.42,6-8.41,10.51a151.52,151.52,0,0,0,15.63,7.75q10.9,4.86,24.44,11t28.1,13.14q14.58,7,26.67,14,27.31,15.51,27.32,25.75c0,2.27-1.49,3.85-4.47,4.72a13,13,0,0,1-3.68.53h-2.62a48.47,48.47,0,0,1-23.65-6q-11-6-23.51-14.45T1215,1637.89q-15.75-9.06-38.09-15.11v52.54c-.35.71-1.93,1.49-4.73,2.37a43.81,43.81,0,0,1-12.87,1.84C1154.79,1679.53,1152.51,1678.21,1152.51,1675.59Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/>
    <path d="M1448.31,1583.38h7.35a44.53,44.53,0,0,1,8.54.79q4.07.78,4.07,5.78,1.83,10.5-12.34,10.24c-2.63-.17-5-.35-7.23-.52a38.06,38.06,0,0,0-5.38-.13c-1.41.09-2,.57-1.84,1.44q2.63,7.62,5.65,17.08t6.69,18.91q9.47,23.38,17.87,33.63a41.63,41.63,0,0,1-10.38,9.19,54.4,54.4,0,0,1-6.3,3.68.87.87,0,0,1-.66-.27l-37-78-71.72,17.6-2.62,11q-7.62,30.21-17.08,42c-1.05,1.75-3.24,1.93-6.57.52q-8.4-3.15-8.4-5.25,0-.52,5.51-15.24t11.17-29.81l11.82-31.66q6.16-16.54,11.69-31.52t10-26.93q4.47-11.94,6.31-17.33a59.58,59.58,0,0,0,2.49-9.46,27.43,27.43,0,0,1,2-7q2.63-6,13.14-6a46.51,46.51,0,0,1,17.47,16.41,128.62,128.62,0,0,1,10.51,21.68q4.32,11.55,8.53,23.38a84,84,0,0,0,11.3,21.54,8.48,8.48,0,0,0,7.09,3.94Q1444.63,1583.38,1448.31,1583.38Zm-65.68-56.74a121.48,121.48,0,0,1-9.45,32.84q-7.37,16.82-11.83,26.13t-7.61,17.21q17.87,0,43.87-10.51c4.37-1.92,8.58-3.68,12.61-5.25Q1397.86,1534.26,1382.63,1526.64Z" transform="translate(-162.41 -1257.08)" style="fill:#000100"/></svg>
    <?php
}