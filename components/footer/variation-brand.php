<?php
/**
 * Displays the footer content for the "brand" footer variation.
 *
 * Layout: large brand zone left + three navigation columns right,
 * with a full-width disclaimer bar below.
 *
 * @version 7.0
 *
 * @package Memberlite
 */
?>

<?php do_action( 'memberlite_before_footer_widgets' ); ?>

<div class="footer-widgets footer-widgets-brand">
	<div class="row">

		<div class="large-4 medium-12 columns footer-brand-zone">
			<div class="footer-brand-logo"><?php memberlite_the_custom_logo(); ?></div>
			<p><strong><?php bloginfo( 'name' ); ?></strong></p>
			<p>123 Membership Street, Courses Town, PA, 456789</p>
			<p>(444) 555-7777</p>
		</div><!-- .footer-brand-zone -->

		<div class="large-8 medium-12 columns">
			<div class="row">

				<div class="medium-4 columns">
					<h3><?php esc_html_e( 'About', 'memberlite' ); ?></h3>
					<?php wp_nav_menu( array(
						'theme_location' => 'footer',
						'fallback_cb'    => false,
						'depth'          => 1,
					) ); ?>
					<h3><?php esc_html_e( 'Membership', 'memberlite' ); ?></h3>
					<?php wp_nav_menu( array(
						'theme_location' => 'footer',
						'fallback_cb'    => false,
						'depth'          => 1,
					) ); ?>
				</div>

				<div class="medium-4 columns">
					<h3><?php esc_html_e( 'Resources', 'memberlite' ); ?></h3>
					<?php wp_nav_menu( array(
						'theme_location' => 'footer',
						'fallback_cb'    => false,
						'depth'          => 1,
					) ); ?>
					<h3><?php esc_html_e( 'Legal', 'memberlite' ); ?></h3>
					<?php wp_nav_menu( array(
						'theme_location' => 'footer',
						'fallback_cb'    => false,
						'depth'          => 1,
					) ); ?>
				</div>

				<div class="medium-4 columns empty-zone">
					<h3><?php esc_html_e( 'Zone 4', 'memberlite' ); ?></h3>
					<p>Widget recommendations for Donna with a "quick link" to take her
					to the widget management screen. Or dummy content to give her
					a general idea of what this zone is for.</p>
				</div>

			</div><!-- .row -->
		</div>

	</div><!-- .row -->
</div><!-- .footer-widgets -->

<?php do_action( 'memberlite_after_footer_widgets' ); ?>

<?php do_action( 'memberlite_before_site_info' ); ?>

<div class="site-info">

	<p class="fine-print">Pinnace holystone mizzenmast quarter crow's nest nipperkin grog yardarm hempen halter furl. Swab barque interloper chantey doubloon starboard grog black jack gangway rutters.</p>

	<?php get_template_part( 'components/footer/footer', 'site-info' ); ?>

	<?php //get_template_part( 'components/footer/footer', 'back-to-top' ); ?>

</div><!-- .site-info -->

<?php do_action( 'memberlite_after_site_info' ); ?>
