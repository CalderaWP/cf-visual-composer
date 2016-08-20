<?php

/**
 * Class CF_VC_Shortcode
 *
 * Creates a special shortcode for the Visual Composer to use
 *
 * @package   cf-vc
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 CalderaWP LLC
 */
class CF_VC_Shortcode {

	/**
	 * Add shortcode to Visual Composer's known shortcodes
	 *
	 * @since 0.1.0
	 *
	 * @uses "vc_grid_item_shortcodes" filger
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	public static function add_grid_shortcode( $shortcodes ){
		$shortcodes[ CF_VC_BASE::BASE ] = array(
			'name' => __( 'Caldera Forms', 'caldera-forms-vc' ),
			'base' => self::$base,
			'category' => __( 'Content', 'caldera-forms-vc' ),
			'description' => __( 'Add a Caldera Form to the grid', 'caldera-forms-vc' ),

		);

		return $shortcodes;
	}

	/**
	 * Create the special shortcode
	 *
	 * @since 0.1.0
	 *
	 * @uses "init" action
	 */
	public static function create_shortcode(){

		add_shortcode( CF_VC_BASE::BASE , array( __CLASS__, 'callback'));
	}

	/**
	 * Callback for the special shortcode
	 *
	 * @since 0.1.0
	 *
	 * @param array $atts Shortcode atts
	 *
	 * @return string|void
	 */
	public static function callback( $atts ){
		$atts = shortcode_atts( array(
			'form_id' => '',
			'modal' => false,
			'modal_text' => __( 'Open Form', 'cf-vc'),
		), $atts, CF_VC_BASE::BASE);

		if( $atts[ 'modal' ] ){
			$type = 'caldera_forms_modal';
			$modal = true;
		}else{
			$type = 'caldera_forms';
			$modal = false;
		}

		if( empty( $atts[ 'form_id' ] ) ){
			return;
		}else{
			$id = $atts[ 'form_id' ];
		}

		return Caldera_Forms::shortcode_handler( self::cf_shortcode_atts( $id, $modal ), $atts[ 'modal_text' ], $type );
	}

	/**
	 * Prepare atts for Caldera_Forms::shortcode_handler()
	 *
	 * @since 0.1.0
	 *
	 * @param string $id Form ID
	 * @param bool $modal Optional. Use a modal form? Default is false.
	 * @param string $modal_type Type of modal to use. Either 'button' or anything else is regular right now.
	 *
	 * @return array
	 */
	protected static function cf_shortcode_atts( $id, $modal = false, $modal_type = 'button' ) {

		$atts =  array(
			'id'    => $id,
			'modal' => $modal,
		);

		if( $modal ){
			$atts[ 'type' ] = $modal_type;
		}

		/**
		 * Filter the attributes sent to Caldera_Forms::shortcode_handler()
		 *
		 * @since 0.1.0
		 *
		 * @param array $atts The attributes
		 */
		return apply_filters( 'cf_visual_composer_shortcode_handler_atts', $atts );
	}

}