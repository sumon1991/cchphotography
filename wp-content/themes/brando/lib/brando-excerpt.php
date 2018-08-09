<?php
/**
 * Excerpt Class.
 *
 * @package brando
 */
?>
<?php
/**
 * Exerpt length
 * 
 * @package framework
 * @since framework 1.0
 */
if(!class_exists('brando_Excerpt')){
  class brando_Excerpt {
    /**
     * Sets the length for the excerpt 
     *
     * @param string $brando_new_length 
     * @return void
     */
    public static function brando_get_by_length($brando_new_length = 55) {
      return brando_Excerpt::brando_get($brando_new_length);
    }

    public static function brando_get($brando_new_length) {
      $brando_output_data = '';
      $brando_output_data = apply_filters( 'the_content', get_the_content() );
      if( $brando_new_length > 0 ){
        $brando_output_data = wp_trim_words( $brando_output_data, $brando_new_length, '...' );
      }else{
        $brando_output_data = wp_trim_words( $brando_output_data, $brando_new_length, '' );
      }
      return $brando_output_data;
    }
  }
}