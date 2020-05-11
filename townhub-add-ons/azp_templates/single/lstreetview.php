<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $title = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
    'azp_element',
	'lstreetview',
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
$latitude = get_post_meta( get_the_ID(), ESB_META_PREFIX.'latitude', true );
$longitude = get_post_meta( get_the_ID(), ESB_META_PREFIX.'longitude', true );
if ( !empty($latitude) && !empty($longitude) ) {
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <!-- lsingle-block-box --> 
    <div class="lsingle-block-box">
        <?php if($title != ''): ?>
        <div class="lsingle-block-title">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="lsingle-block-content">
            <div class="lsingle-streetview">
                <div class="lstreet-view" id="<?php echo uniqid('street-view'); ?>" data-lat="<?php echo esc_attr( $latitude );?>" data-lng="<?php echo esc_attr( $longitude );?>"></div>
            </div>
        </div>
    </div>
    <!-- lsingle-block-box end -->  
</div>
<?php } ?>