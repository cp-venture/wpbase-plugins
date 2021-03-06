<?php
/* add_ons_php */
if(!isset($photos)) $photos = array();
if(!isset($azp_attrs)) $azp_attrs = array();
?>
<section class="listing-hero-section hidden-section" data-scrollax-parent="true" id="lhead_sec">
	<div class="bg-parallax-wrap">
		<?php 
		if(!empty($photos)){ ?>
		<!--ms-container-->
        <div class="slideshow-container" data-scrollax="properties: { translateY: '300px' }" >
            <div class="swiper-container">
                <div class="swiper-wrapper">
					<?php
		            foreach ($photos as $id ) {
		            ?>
		            	<!--ms_item-->
	                    <div class="swiper-slide">
	                        <div class="ms-item_fs fl-wrap full-height">
	                            <div class="bg" data-bg="<?php echo wp_get_attachment_url( $id );?>"></div>
	                            <div class="overlay"></div>
	                        </div>
	                    </div>
	                    <!--ms_item end-->
		            <?php
		            }
		        	?>
                </div>
            </div>
        </div>
        <!--ms-container end-->
		<?php 
		} ?>
        <div class="overlay"></div>
    </div>
    <div class="slide-progress-wrap">
        <div class="slide-progress"></div>
    </div>
    <div class="container">
        <?php townhub_addons_get_template_part( 'template-parts/single/head_infos', '', array('azp_attrs'=>$azp_attrs) ); ?>
    </div>
</section>