<?php
/* add_ons_php */
$address = get_post_meta( get_the_ID(), ESB_META_PREFIX.'address', true );
$latitude = get_post_meta( get_the_ID(), ESB_META_PREFIX.'latitude', true );
$longitude = get_post_meta( get_the_ID(), ESB_META_PREFIX.'longitude', true );
if($latitude != '' && $longitude != '' ) :
?>
<section class="listing-hero-section hmap-section" id="lhead_sec">
    <div class="map-container">
        <?php if(townhub_addons_get_option('use_osm_map') == 'yes'): ?>
        <div id="<?php echo uniqid('singleMapOSM'); ?>" class="singleMapOSM" data-lat="<?php echo esc_attr( $latitude );?>" data-lng="<?php echo esc_attr( $longitude );?>" data-loc="<?php echo esc_attr( $address );?>" data-zoom="<?php echo townhub_addons_get_option('gmap_single_zoom');?>"></div>
        <?php else: ?>
        <div class="singleMap" data-lat="<?php echo esc_attr( $latitude );?>" data-lng="<?php echo esc_attr( $longitude );?>" data-loc="<?php echo esc_attr( $address );?>" data-zoom="<?php echo townhub_addons_get_option('gmap_single_zoom');?>"></div>
        <?php endif; ?>

        
    </div>
</section>
<?php endif; 


