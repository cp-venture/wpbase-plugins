<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $items_width = $images_to_show = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'lphotos',
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
    <div class="lsingle-block-box">
        <?php if($title != ''): ?>
        <div class="lsingle-block-title">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="lsingle-block-content">
            <div class="single-carousel-wrap fl-wrap lightgallery">
                <div class="sc-next sc-btn color2-bg"><i class="fas fa-caret-right"></i></div>
                <div class="sc-prev sc-btn color2-bg"><i class="fas fa-caret-left"></i></div>
                <div class="single-carousel fl-wrap full-height">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ($images as $key => $id ) {
                            ?>
                            <!-- swiper-slide-->   
                            <div class="swiper-slide">
                                <div class="box-item">
                                    <?php echo wp_get_attachment_image( $id, 'townhub-lgal' ); ?>
                                    <a href="<?php echo wp_get_attachment_url( $id );?>" class="gal-link popup-image" data-sub-html=".gal-caption-hide">
                                        <i class="fa fa-search"></i>
                                        <?php 
                                        $image = get_post($id);
                                        $image_title = $image->post_title;
                                        $image_caption = $image->post_excerpt;
                                        ?>
                                        <div class="gal-caption-hide">
                                            <h3><?php echo esc_html( $image_title ); ?></h3>
                                            <?php echo $image_caption; ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- swiper-slide end-->   
                            <?php
                            }
                            ?>                                                                
                        </div>
                    </div>
                </div>
            </div>
                            
            
        </div>
    </div>
    <!-- lsingle-block-box end -->  
</div>
<?php  } ?>