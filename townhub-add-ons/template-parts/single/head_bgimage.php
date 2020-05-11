<?php
/* add_ons_php */
if(!isset($photos)) $photos = array();
if(!isset($azp_attrs)) $azp_attrs = array();

$bgimg = '';
if(!empty($photos)){
    $bgimg = townhub_addons_get_attachment_thumb_link( reset($photos), 'full' );
} 
?>
<section class="listing-hero-section hidden-section" data-scrollax-parent="true" id="lhead_sec">
    <div class="bg-parallax-wrap">
        <div class="bg par-elem "  data-bg="<?php echo esc_url( $bgimg ); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
        <div class="overlay"></div>
    </div>
    <div class="container">

        <?php townhub_addons_get_template_part( 'template-parts/single/head_infos', '', array('azp_attrs'=>$azp_attrs) ); ?>
        
    </div>
</section>