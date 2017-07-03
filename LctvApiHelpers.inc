<?php
/**
 * LiveEdu.tv API helper methods.
 *
 * @package LctvApi\Credentials
 * @since 0.0.3
 * @version 0.0.9
 */


class LctvApiHelpers {

	/**
	 * Throw execption if these constants are undefined.
	 *
	 * @since 0.0.8
	 * @storage static
	 * @access public
	 *
	 * @throws Exception - If constant undefined.
	 */
	public static function ValidateConstants( $constants ) {

		foreach ($constants as $constant) {
			if ( ! defined( $constant ) ) {
				throw new Exception(CONSTANT_UNDEFINED_MSG . $constant, 1);
			}
		}

	}

	/**
	 * Filter named get param or return a supplied default value.
	 *
	 * @since 0.0.8
	 * @storage static
	 * @access public
	 */
	public static function SanitizeGetParam( $param_name, $default_value ) {

	  return ( ! empty( $param_name ) &&
	             isset( $_GET[$param_name] ) &&
	           ! empty( $_GET[$param_name] ) ) ?
	         strtolower( htmlspecialchars( $_GET[$param_name] ) ) :
	         $default_value;

	}

}

?>
