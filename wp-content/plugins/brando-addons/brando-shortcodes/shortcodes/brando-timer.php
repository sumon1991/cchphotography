<?php
/**
 * Shortcode For Timer
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Timer */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_timer' ) ) {
    function brando_timer( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'brando_timer_date' => '',
            'brando_timer_color' => '',
        ), $atts ) );
        
        $output = '';
        $id = ($id) ? ' id='.$id : '';
        $class = ($class) ? $class : 'counter-event'; 
        $brando_timer_date = ( $brando_timer_date ) ? $brando_timer_date : '';
        $brando_timer_color = ( $brando_timer_color ) ? ' style="color:'.$brando_timer_color.' !important;"' : '';
        
        $output .='<div'.$id.' data-enddate="'.$brando_timer_date.'" class="'.$class.' countdown-timer white-text alt-font center-col margin-five-top sm-margin-eight-top"'.$brando_timer_color.'></div>';

        ob_start();
            ?>
            <script type="text/javascript">jQuery(document).ready(function () { $("<?php echo '.'.$class ?>").countdown($("<?php echo '.'.$class ?>").attr("data-enddate")).on('update.countdown', function (event) {
                var $this = $(this).html(event.strftime('' + '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div><span>Day%!d</span></div>' + '<div class="counter-box"><div class="number">%H</div><span>Hours</span></div>' + '<div class="counter-box"><div class="number">%M</div><span>Minutes</span></div>' + '<div class="counter-box last"><div class="number">%S</div><span>Seconds</span></div></div>'))
            }); });</script>
            <?php 
        $script = ob_get_contents();
        ob_end_clean();
        $output .= $script;
        
        return $output;
    }
}
add_shortcode( 'brando_timer', 'brando_timer' );
?>