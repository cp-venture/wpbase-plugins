<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $title = $responsive = $hide_status = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'azp_listings_ad_slider',
    // 'list-single-main-item fl-wrap', 
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

if(townhub_addons_get_option('ads_sidebar_enable') == 'yes'){
     $args = array(
        'post_type'             =>  'listing', 
        'orderby'               => townhub_addons_get_option('ads_sidebar_orderby'),
        'order'                 => townhub_addons_get_option('ads_sidebar_order'),
        'posts_per_page'        => townhub_addons_get_option('ads_sidebar_count'),
        'post__not_in'          => array(get_the_ID()),
        'meta_query'            => array(
            'relation' => 'AND',
            array(
                'key'     => ESB_META_PREFIX.'is_ad',
                'value'   => 'yes',
            ),
            // array(
            //     'key'     => ESB_META_PREFIX.'ad_position',
            //     'value'   => 'sidebar',
            // ),
            array(
                    'key'     => ESB_META_PREFIX.'ad_position_sidebar',
                    'value'   => '1',
                    // 'value'   => array('yes','1'),
                    // 'compare' => 'IN',
            ),
            array(
                'key'     => ESB_META_PREFIX.'ad_expire',
                'value'   => current_time('mysql', 1),
                'compare' => '>=',
                'type'    => 'DATETIME',
            ),
        ),

    );

    // The Query
    $posts_query = new WP_Query( $args );
    if($posts_query->have_posts()) :
?>
<div class="<?php echo $classes;?>" <?php echo $el_id;?>>
    <!-- lsingle-block-box --> 
    <div class="lsingle-block-box">
        <?php if($title != ''): ?>
        <div class="lsingle-block-title">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="lsingle-block-content">
            <?php 
            $slider_args = array();
            $breakpoints = array();
            $slidesPerView = array();
            $responsive = explode( ",", trim($responsive) );
            if( !empty($responsive) ){
                foreach ($responsive as $breakpoint) {
                    $breakpoint = explode( ":", trim($breakpoint) );
                    if( count($breakpoint) === 2 ){
                        $breakpoints[$breakpoint[0]] = array( 'slidesPerView'=>intval($breakpoint[1]) );
                        $slidesPerView[] = intval($breakpoint[1]);
                    }
                }
            }
            if( !empty($breakpoints) ){
                $slider_args['slidesPerView'] = max($slidesPerView);
                $slider_args['breakpoints'] = $breakpoints;
            }

            ?>
            <div class="listings-ad-slider listing-slider-wrap">

                <div class="listing-slider fl-wrap">
                    <div class="swiper-container"  data-options='<?php echo json_encode($slider_args); ?>'>
                        <div class="swiper-wrapper">

                            <?php 
                            while($posts_query->have_posts()) : $posts_query->the_post();
                            ?>
                                <!--slick-slide-item-->
                                
                                <?php 
                                townhub_addons_get_template_part( 'template-parts/listing-slider', false, array( 'for_slider'=>true, 'is_ad'=>true, 'hide_status'=>$hide_status ) );
                                ?>
                                
                                <!--slick-slide-item-->
                            <?php
                            endwhile; 
                            ?>
                                                                 
                        </div>
                    </div>
                    <div class="listing-carousel-button listing-carousel-button-next2"><i class="fas fa-caret-right"></i></div>
                    <div class="listing-carousel-button listing-carousel-button-prev2"><i class="fas fa-caret-left"></i></div>
                </div>
                <div class="tc-pagination_wrap">
                    <div class="tc-pagination2"></div>
                </div>

            </div>
            <!--  listings-ad-slider end-->
        </div><!-- lsingle-block-content end -->  
    </div><!-- lsingle-block-box end -->
</div>
<?php 
    wp_reset_postdata();
    endif;
} ?>
