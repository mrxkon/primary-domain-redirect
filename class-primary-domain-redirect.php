<?php // phpcs:ignore -- \r\n notice.

/**
 * Plugin Name: Primary Domain Redirect
 * Description: Automatically redirects to home_url on single WordPress installations.
 * Author:      Konstantinos Xenos
 * Version:     1.0
 * Author URI:  https://xkon.gr
 * Repo URI:    https://github.com/mrxkon/primary-domain-redirect
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
 * to whatever is set as a home_url in WordPress.
 */

/**
 * Copyright (C) 2019 Konstantinos Xenos (https://xkon.gr).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see https://www.gnu.org/licenses/.
 */

if ( ! class_exists( 'Primary_Domain_Redirect' ) ) {
	class Primary_Domain_Redirect {
		private static $_instance = null;

		public static function get_instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new Primary_Domain_Redirect();
			}
			return self::$_instance;
		}

		public function __construct() {
			$this->redirect();
		}

		public static function redirect() {
			// No need to do anything if the request is via WP-CLI.
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				return;
			}

			// Set temporary domain to avoid redirect.
			$temp_domain = "/\bwpmudev.host\b/i";

			// Set production environment by default.
			$env = 'production';

			// Set $env to staging if we're on staging.
			if ( strpos( ABSPATH, '/staging/public_html/' ) !== false ) {
				$env = 'staging';
			}

			// Only run if environment is production and not a multisite.
			if ( 'production' === $env && ! is_multisite() ) {
				// Find the primary domain.
				$primary_domain = parse_url( home_url(), PHP_URL_HOST );

				// Find the domain the request was made from.
				$request_domain = $_SERVER['HTTP_HOST'];

				// Find the URI of the request.
				$request_uri = $_SERVER['REQUEST_URI'];

				// If our primary domain is not a temporary domain.
				if ( ! preg_match( $temp_domain, $primary_domain ) ) {

					// If the request domain is a temporary domain or if it's not the same as the primary then redirect.
					if ( preg_match( $temp_domain, $request_domain ) || $primary_domain !== $request_domain ) {
						wp_safe_redirect( 'https://' . $primary_domain . $request_uri, 301, 'WordPress' );
						exit;
					}
				}
			}
		}
	}

	if ( ! function_exists( 'primary_domain_redirect' ) ) {
		function primary_domain_redirect() {
			return Primary_Domain_Redirect::get_instance();
		}
		add_action( 'plugins_loaded', 'primary_domain_redirect', 10 );
	}
}
