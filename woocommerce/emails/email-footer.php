<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
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

defined( 'ABSPATH' ) || exit;
?>	
																<p style="font-size: 1.2em; margin-bottom: 30px;">Zespół Krainy Dzieciaka<br>
																<a href=<?php get_home_url(); ?>>www.krainadzieciaka.pl</a><br>
																<a href="http://facebook.com/krainadzieciakapl" target="_blank"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/icons/facebook.png'; ?>"></a>
																<a href="http://instagram.com/kraina_dzieciaka" target="_blank"><img class="social-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/icons/instagram.png'; ?>"></a>
																<p style="font-size: 8px; font-style: italic; text-align: justify; line-height: 10px;">Informujemy, iż administratorem danych osobowych jest Mariusz Pacyga wykonujący działalność gospodarczą pod firmą Good Sound Mariusz Pacyga pod adresem Skawica 592, 34-221 Skawica, NIP: 5521686646, REGON: 382478151. Dane osobowe przetwarzane są w celu świadczenia usług oraz w celach kontaktowych. Dane osobowe przez czas nie dłuższy niż termin przedawnienia zgodnie z przepisami Kodeksu cywilnego. Każda osoba, której dane osobowe są przetwarzane przez administratora ma prawo dostępu do treści swoich danych, prawo do ich sprostowania, usunięcia („prawo do bycia zapomnianym”), ograniczenia przetwarzania, prawo do przenoszenia danych, prawo sprzeciwu oraz prawo do cofnięcia zgody na przetwarzanie danych w dowolnym momencie. Szczegółowe informacje na temat przetwarzania danych osobowych znajdują się w naszej w klauzuli informacyjnej RODO dostępnej pod adresem link do polityki prywatności.<p>
																</p>
																<?php
																echo do_shortcode('[woo_featured_products]');
																echo '<a id="more-featured-link" href="'. get_home_url() .'/home/?filters=product_tag%5B69%5D">Zobacz więcej polecanych</a>';?>
															</div>
														</td>
													</tr>
												</table>
													
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" valign="top">
						<!-- Footer -->
						<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
							<tr>
								<td valign="top">
									<table border="0" cellpadding="10" cellspacing="0" width="100%">
										<tr>
											<td colspan="2" valign="middle" id="credit">
												<!-- <?php echo wp_kses_post( wpautop( wptexturize( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) ) ) ); ?> -->
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<!-- End Footer -->
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
