<?php

/**
 * Class CF_VC_Module
 *
 * Creates The Caldera Forms Module
 *
 * @package   cf-vc
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 CalderaWP LLC
*/
class CF_VC_Module {


	/**
	 * Create the module
	 *
	 * @since 0.1.0
	 *
	 * @uses "admin_init" actio
	 */
	public static function map(){
		vc_map( array(
			'name'        => __( 'Caldera Forms', 'caldera-forms-vc' ),
			'base'        => CF_VC_Base::BASE,
			'icon'        => plugins_url( 'icon.png', dirname( __FILE__ ) ),
			'category'    => __( 'Content', 'caldera-forms-vc' ),
			'description' => __( 'Add a Caldera Form', 'caldera-forms-vc' ),
			'params'      => self::get_params()
		) );
	}

	/**
	 * Create params for the module
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	public static function get_params(){

		return array( self::form_params(), self::modal_params(), self::button_text_param() );
	}



	/**
	 * Create form chooser params
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	protected static function form_params() {
		return array(
			'type'        => 'dropdown',
			'heading'     => __( 'Choose Form', 'caldera-forms-vc' ),
			'param_name'  => 'form_id',
			'value'       => self::get_forms(),
			'description' => __( 'Choose a Form', 'caldera-forms-vc' )
		);


	}

	/**
	 * Format dropdown options for Forms
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	protected static function get_forms(){
		$forms = Caldera_Forms_Forms::get_forms( true );
		$formatted = array();
		if( ! empty( $forms ) ){
			foreach( $forms as $id => $form ){
				$formatted[ $form[ 'name' ] ] = $id;
			}
		}

		return $formatted;

	}

	/**
	 * Open in modal params
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	protected static function modal_params(){
		return array(
			'type'        => 'checkbox',
			'heading'     => __( 'Load In Modal', 'caldera-forms-vc' ),
			'param_name'  => 'modal',
			'value'       => array(
				__( 'Yes', 'cf-vc' ) => 'yes',
			),
			'description' => __( 'Open Form In Modal', 'caldera-forms-vc' )
		);
	}


	/**
	 * Create modal button params
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	protected static function button_text_param(){
		return array(
			'type'        => 'textfield',
			'heading'     => __( 'Text Form Button To Open Modal', 'caldera-forms-vc' ),
			'param_name'  => 'modal_text',
			'value'       => __( 'Open Form', 'cf-vc'),
			'description' => __( 'Text for modal button', 'caldera-forms-vc' )
		);
	}






}