<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Email validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'sp_validate_email' ) ) {
  function sp_validate_email( $value, $field ) {

    if ( ! sanitize_email( $value ) ) {
      return __( 'Please write a valid email address!', 'sp-framework' );
    }

  }
  add_filter( 'sp_validate_email', 'sp_validate_email', 10, 2 );
}

/**
 *
 * Numeric validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'sp_validate_numeric' ) ) {
  function sp_validate_numeric( $value, $field ) {

    if ( ! is_numeric( $value ) ) {
      return __( 'Please write a numeric data!', 'sp-framework' );
    }

  }
  add_filter( 'sp_validate_numeric', 'sp_validate_numeric', 10, 2 );
}

/**
 *
 * Required validate
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'sp_validate_required' ) ) {
  function sp_validate_required( $value ) {
    if ( empty( $value ) ) {
      return __( 'Fatal Error! This field is required!', 'sp-framework' );
    }
  }
  add_filter( 'sp_validate_required', 'sp_validate_required' );
}
