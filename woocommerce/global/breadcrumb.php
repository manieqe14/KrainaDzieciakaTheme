<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {
    
	echo $wrap_before;
    global $product;
    $counter = 1;
    
    if(is_product()){
    
        $taxonomy = 'product_cat'; 
        $primary_cat_id = get_post_meta($product->id,'_yoast_wpseo_primary_' . $taxonomy, true);
        
        if($primary_cat_id){
           $primary_cat = get_term($primary_cat_id, $taxonomy);
        }    
        $children = get_term_children($primary_cat_id, $taxonomy);
        
       if(count($breadcrumb) > 3 && count($children) == 0){
           for($i = 2; $i < count($breadcrumb); $i++){
              unset($breadcrumb[$i]);
           }
       }
       
       $breadcrumb = array_values($breadcrumb);
    }
       

	foreach ( $breadcrumb as $key => $crumb ) {
        
        
        if(is_product()) {
            
            echo $before;
            
            if($counter != 2){

                if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
                    echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
                } else {
                    echo esc_html( $crumb[0] );
                }
            }
            else{
                echo '<a href="' . get_category_link($primary_cat_id) . '">' . $primary_cat->name . '</a>';
            }

            echo $after;

            if ( sizeof( $breadcrumb ) !== $key + 1 ) {
                echo $delimiter;
            }
        }
        
        else{

            echo $before;

            if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
                echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
            } else {
                echo esc_html( $crumb[0] );
            }

            echo $after;

            if ( sizeof( $breadcrumb ) !== $key + 1 ) {
                echo $delimiter;
            }
        }
        
        $counter++;
	}

	echo $wrap_after;

}
