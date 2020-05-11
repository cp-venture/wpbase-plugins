<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $items_width = $images_to_show = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'lslider',
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
$images = get_post_meta( get_the_ID(), ESB_META_PREFIX.'images', true );
if( !empty($images) && !is_array($images) ) { 
    $images = explode(",", $images);
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <!-- lsingle-block-box --> 
    <div class="lsingle-block-box no-border over-hide">
        <?php if($title != ''): ?>
        <div class="lsingle-block-title">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="lsingle-block-content no-padding">

            <div class="single-slider-wrap fl-wrap">
                <div class="single-slider fl-wrap">
                    <div class="swiper-container">
                        <div class="swiper-wrapper lightgallery">
                            <?php
                            foreach ($images as $key => $id ) {
                            ?>
                            <!-- swiper-slide--> 
                            <div class="swiper-slide hov_zoom">
                                <?php echo wp_get_attachment_image( $id, 'townhub-slider' , '', array('class'=>'respimg no-lazy') ); ?>
                                <a href="<?php echo wp_get_attachment_url( $id );?>" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a>
                            </div>
                            <!-- swiper-slide end-->   
                            <?php
                            }
                            ?>   
                        </div>
                    </div>
                </div>
                <div class="listing-carousel_pagination">
                    <div class="listing-carousel_pagination-wrap">
                        <div class="ss-slider-pagination"></div>
                    </div>
                </div>
                <div class="ss-slider-cont ss-slider-cont-prev color2-bg"><i class="fal fa-long-arrow-left"></i></div>
                <div class="ss-slider-cont ss-slider-cont-next color2-bg"><i class="fal fa-long-arrow-right"></i></div>
            </div>        
            
        </div>
    </div>
    <!-- lsingle-block-box end -->  
</div>
<?php  } ?>