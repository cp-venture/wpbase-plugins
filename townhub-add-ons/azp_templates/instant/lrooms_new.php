<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $title =  $hide_widget_on = '';  

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'lrooms_new',
    'azp-element-' . $azp_mID, 
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);  
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot 
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
if(( $hide_widget_on_check = townhub_addons_is_hide_on_plans($hide_widget_on) ) !== 'true') :
    $min_nights = get_post_meta( get_the_ID(), ESB_META_PREFIX.'min_nights', true );
    if( empty($min_nights) ) $min_nights = 2;
?>
<div class="<?php echo $classes; ?> authplan-hide-<?php echo $hide_widget_on_check;?>" <?php echo $el_id;?>>
    <div class="for-hide-on-author"></div>
    <!--box-widget-item -->
    <div class="box-widget-item fl-wrap block_box" id="widget-rooms_new-booking">
        <?php if($title != ''): ?>
        <div class="box-widget-item-header">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="box-widget rooms-booking-wrap">
            <div class="box-widget-content">
                
                <div id="bookingrooms-app" class="rooms-booking-app" data-format="<?php _ex( 'DD/MM/YYYY', 'rooms booking date format', 'townhub-add-ons' ); ?>" price_based="night_person" min_nights="<?php echo esc_attr( $min_nights ); ?>"></div>

            </div>
        </div>
    </div>
    <!--box-widget-item end --> 
</div>
<?php endif;
