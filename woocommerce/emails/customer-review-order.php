<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p style="font-size: 2em;"><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>

<p>Dziękujemy za zakupy w Krainie Dzieciaka. Mamy nadzieję, że produkty, które do Ciebie dotarły sprawiły Ci duuużo radości. Będzie nam bardzo miło, jeśli podzielisz się opinią na temat Krainy Dzieciaka z innymi kupującymi. Aby to zrobić, kliknij w poniższy link:</p>
<p style="padding: 10px; border: solid 1px rgba(0,0,0,0.24); margin: 20px 15%; text-align: center;"><a href="https://g.page/krainadzieciakapl/review?rc" target="_blank">Kliknij tutaj</a></p>

<div style="margin: 30px; text-align: center; ">Zachęcamy też do obserwowania Krainy Dzieciaka w mediach społecznościowych: 
    <a style="display: block; margin: 0px; padding: 0px;" href="http://facebook.com/krainadzieciakapl" target="_blank"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/icons/facebook.png'; ?>">/krainadzieciakapl</a>
    <a style="display: block; margin: 0px; padding: 0px;" href="http://instagram.com/kraina_dzieciaka" target="_blank"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/icons/instagram.png'; ?>">/kraina_dzieciaka</a>
</div>
<?php


/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
