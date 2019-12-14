<?php
/**
 * Plugin Name: Primary Domain Redirect ( for WPMU DEV Hosting )
 * Description: Automatically redirects to home url on single WordPress installations.
 * Author:      Konstantinos Xenos
 * Version:     1.0
 * Author URI:  https://xkon.gr
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * WordPress Core understands multiple Domains
 * while in a Multisite setup and redirects accordingly
 * but it doesn't take into account multiple domains
 * while on a Single setup.
 *
 * This will help on efficiently redirect all domains
 * to whatever is set as a home url in WordPress.
 */

// Hook into muplugins_loaded as it's the earliest possible.
add_action(
	'muplugins_loaded',
	function() {
		// Find out on which environment we are.
		$env = $_SERVER['WPMUDEV_HOSTING_ENV'];

		// Only run if environment is production.
		if ( 'production' === $env ) {

			// Only run if not a multisite.
			if ( ! is_multisite() ) {

				// Find the primary domain.
				$primary_domain = parse_url( home_url(), PHP_URL_HOST );

				// Find the domain the request was made from.
				$request_domain = $_SERVER['HTTP_HOST'];

				// Find the URI of the request.
				$request_uri = $_SERVER['REQUEST_URI'];

				// If our primary domain is not a wpmudev.host domain
				if ( ! preg_match( "/\bwpmudev.host\b/i", $primary_domain ) ) {

					// If the request domain is a wpmudev.host domain or if it's not the same as the primary then redirect
					if ( preg_match( "/\bwpmudev.host\b/i", $request_domain ) || $primary_domain !== $request_domain ) {

						// Pass the Redirect by WP header.
						header( 'X-Redirect-By: WordPress' );

						// Pass the Redirect header.
						header( "Location: https://$primary_domain$request_uri", true, 301 );

						// Exit always follows a redirect header.
						exit;
					}
				}
			}
		}
	},
	-9999999
);
