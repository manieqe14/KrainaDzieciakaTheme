<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
		<style>
			:root{
			--main-accent: #D99414;
			--main-text-kraina: #14213d;
			--main-accent-grey: #A6A6A6;
			--main-col-opt3: #003E8C;
			--main-col-opt2: #F9A23E;
			--main-col-opt1: #4288A6;
			--icons-height: 20px;
			--icons-width: 20px;
			--font-primary: 'Poppins';
			--icon-stroke-width: 20;
			--grey-color: #F2F2F2;
			--grey2-color: #EBECF0;
			--nv-light-bg: #a6a6a6;
			}
			/* featured products */

			ul.featured-products-list{
				display: flex;
				/*flex-wrap: wrap;*/
				list-style-type: none !important;
				justify-content:space-around;
				position: relative;
				padding: 0px !important;
			}

			.featured-main-wrapper{
				display: none;
			}

			div.featured-product{
				padding: 10px;
				position: relative;
				text-align: center;
			}
			li.featured-product-wrapper{
				width: 30%;
				margin: 10px 5px;
				border: solid 1px rgba(0,0,0,0.12);
			}

			li.featured-product-wrapper:hover{
				box-shadow: 0px 1px 20px -6px rgba(0, 0, 0, 0.12);
			}
			
			.wishlist-toggle-wrapper{
				display: none;
			}

			.featured-product-name{
				font-size: 15px;
				margin: 10px 5px 10px 5px !important;
			}

			.featured-product a{
				text-decoration: none !important;
				
			}

			.featured-text{
				color: #14213d !important;			
			}

			.featured-img img{
				transition: transform 0.5s ease-out;
				z-index: 5;
			}

			.tags-container{
				display: none;
			}

			.img-wrap .tags-container{
				top: 10px;
			}

			.img-wrapper{
				overflow: hidden;
				height: auto;
			}

			div.img-wrap img{
				transition: transform 0.5s ease-out;
			}

			.featured-product .tags-container{
				top: 0px;
			}

			span.featured-tag{
				color: white;
				padding: 0px 10px 0px 10px;
				box-shadow: 3px 4px 8px 2px rgba(0, 0, 0, 0.2);
				margin-bottom: 5px;
				text-transform: uppercase;
				font-size: 0.7em;
				line-height: 2;
			}

			.color1-tag{
				background: var(--main-col-opt1);
			}

			.color2-tag{
				background: var(--main-col-opt2);
			}

			span.onsale{
				display: none !important;
			}

			.featured-tag.archive{
				top: 0px;
				left: 0px;
			}

			.price{
				font-size: 1.2em;
			}

			.maniek-subtitle{
				display: none;
			}
			

			.divider-2 {
				border-bottom: 1px solid #FFF;
				background-color: #DADADA;
				height: 1px;
				
			}
			.featured-container .divider-2{
				margin: 0.5em 0px 1.5em;
			}

			ul .divider-2, .footer-block .divider-2{
				margin: 0.5em 0px 0.5em;
			}

			.divider-2 span {
				display: block;
				width: 20%;
				height: 1px;
				background-color: var(--main-col-opt2);
			}

			.featured-img{
				min-height: 460px;
			}

			#more-featured-button{
				display: none;
			}

			.hidden-featured-wrapper, .hidden-promo-wrapper{
				display: none;
			}

			#more-featured-link{
				text-decoration: none;
				border: solid 1px;
				padding: 7px;
				border-radius: 5px;
				transition: transform 0.2s;
				float: right;
			}
			#more-featured-link:hover{
				transform: scale(1.05);
			}

			.social-icon{
				width: auto;
				height: 20px;
				padding: 2px;
				transition: transform 0.2s;
				margin: 10px 0px !important;
			}

			.social-icon:hover{
				transform: scale(1.2);
			}

			.product-link{
				color: #14213d !important;
				display: flex;
				vertical-align: middle;
				align-items: center;
				text-decoration:none;
			}

			.product-link:hover{
				text-decoration: underline !important;
			}
			
			.mail-font{
				font-family: Poppins, Roboto, "Helvetica Neue", Helvetica, Arial, sans-serif;
			}



		</style>
		
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						<div id="template_header_image">
							<?php
							if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
								echo '<p style="margin-top:0;"><img src="' . esc_url( $img ) . '" alt="' . get_bloginfo( 'name', 'display' ) . '" /></p>';
							}
							?>
							
						</div>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" id="template_container">
							<tr>
								<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header" style="">
										<tr>
											<td id="header_wrapper" style="padding: 20px 48px 0px">
												<!--<h1><?php echo $email_heading; ?></h1>-->
												<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/logo_medium.png'; ?>" style="width: 150px; height:auto; display: block; margin: 0 auto;">
											</td>
										</tr>
									</table>
									<!-- End Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
										<tr>
											<td valign="top" id="body_content">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tr>
														<td valign="top" style="padding-top: 30px;">
															<div id="body_content_inner" class="mail-font">
