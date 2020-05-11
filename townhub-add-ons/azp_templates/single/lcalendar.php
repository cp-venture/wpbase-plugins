<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $title = $showing = $max = $dates_source = $single_select =  '';  

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'lcalendar',
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
$min_nights = get_post_meta( get_the_ID(), ESB_META_PREFIX.'min_nights', true );
if( empty($min_nights) ) $min_nights = 2;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <!-- lsingle-block-box --> 
    <div class="lsingle-block-box">
        <?php if($title != ''): ?>
        <div class="lsingle-block-title">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="lsingle-block-content lsingle-block-calendar-content">
            <div class="cth-availability-calendar"
                data-show="<?php echo $showing; ?>" 
                data-max="<?php echo $max; ?>" 
                data-name="checkin" 
                data-format="<?php _ex( 'YYYY-MM-DD', 'tour booking date format', 'townhub-add-ons' ); ?>" 
                data-default=""
                data-action="<?php echo $dates_source; ?>" 
                data-postid="<?php the_ID();?>" 
                data-selected="availability_dates"
                data-single="<?php echo esc_attr( $single_select ); ?>"
                min_nights="<?php echo esc_attr( $min_nights ); ?>"
            ></div>
            <?php if( $single_select != 'yes' ) echo '<p class="avaical-min-nights">'.sprintf(_nx( 'Requires a minimum stay of %d night', 'Requires a minimum stay of %d nights', $min_nights, 'minimum nights to book', 'townhub-add-ons' ), $min_nights ).'</p>'; ?>
        </div>
    </div>
    <!-- lsingle-block-box end -->  
</div> 

