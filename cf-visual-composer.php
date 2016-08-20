<?php

/**
 * Plugin Name: Caldera Forms Visual Composer
 * Plugin URI:  https://calderawp.com
 * Description: Adds a module for Caldera Forms to Visual Composer
 * Version: 0.1.0
 * Author:      Josh Pollock for CalderaWP LLC
 * Author URI:  https://CalderaWP.com
 * License:     GPLv2+
 * Text Domain: cf-visual-compose
 * Domain Path: /languages
 */

/**
 *  * Copyright (c) 2016 CalderaWP LLC
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


add_action( 'plugins_loaded', 'cf_visual_composer' );


/**
 * Make Caldera Forms Visual Composer add-on go
 *
 * @since 0.1.0
 */
function cf_visual_composer(){
	if( class_exists( 'Caldera_Forms_Autoloader' ) ){
		Caldera_Forms_Autoloader::add_root( 'CF_VC', dirname( __FILE__ ) . '/classes' );
		add_action( 'admin_init', array( 'CF_VC_Module', 'map' ) );
		add_filter( 'vc_grid_item_shortcodes', array( 'CF_VC_Shortcode', 'add_grid_shortcode' ) );
		add_action( 'init', array( 'CF_VC_Shortcode', 'create_shortcode' ) );
	}

}


