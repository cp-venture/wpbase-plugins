<?php
/* add_ons_php */
if(!isset($is_ad)) $is_ad = false;
if(!isset($hide_status)) $hide_status = 'no';
$GLOBALS['is_lad'] = $is_ad;
?>
<!--  swiper-slide  -->
<div class="swiper-slide">
    <div class="listing-slider-item fl-wrap">
        <!-- listing-item  -->
        <div class="listing-item listing_carditem">
            <article class="geodir-category-listing fl-wrap">
                <div class="geodir-category-img">
                    <div class="geodir-js-favorite_btn">
                        <?php if(!is_user_logged_in()): ?>
                            <a href="#" class="save-btn logreg-modal-open" data-message="<?php esc_attr_e( 'Logging in first to save this listing.', 'townhub-add-ons' ); ?>"><i class="fal fa-heart"></i><span><?php _e( 'Save', 'townhub-add-ons' ); ?></span></a>
                        <?php elseif( townhub_addons_already_bookmarked(get_the_ID()) ): ?>
                            <a href="javascript:void(0);" class="save-btn" data-id="<?php the_ID(); ?>"><i class="fas fa-heart"></i><span><?php _e( 'Saved', 'townhub-add-ons' ); ?></span></a>
                        <?php else: ?>
                            <a href="#" class="save-btn bookmark-listing-btn" data-id="<?php the_ID(); ?>" ><i class="fal fa-heart"></i><span><?php _e( 'Save', 'townhub-add-ons' ); ?></span></a>
                        <?php endif; ?>
                    </div>
                    <a href="<?php the_permalink();?>" class="listing-thumb-link geodir-category-img-wrap fl-wrap">
                        
                        <?php 
                        echo wp_get_attachment_image( townhub_addons_get_listing_thumbnail( get_the_ID() ) , 'townhub-listing-grid', false, array('class'=>'respimg swiper-lazy') );
                        ?>
                    </a>
                    
                    <?php 
                    $saleoff = get_post_meta( get_the_ID(), ESB_META_PREFIX.'sale_off', true );
                    if( !empty($saleoff) ): ?>
                        <div class="lcard-saleoff">
                            <div class="saleoff-inner"><?php echo sprintf( esc_html__( "Sale %s%%", 'townhub-add-ons' ) , $saleoff ); ?></div>
                        </div>
                    <?php
                    endif; ?> 
                    
                    <?php townhub_addons_get_template_part( 'templates-inner/status', '', array( 'hide_status'=> $hide_status ) ); ?>
                    
                     
                    <div class="geodir-category-opt dis-flex flw-wrap">
                        <div class="geodir-category-opt_title">
                            <h4>
                                <?php if( $GLOBALS['is_lad'] ) echo '<span class="litem-ad">'.__( 'AD', 'townhub-add-ons' ).'</span>'; ?>
                                <a href="<?php the_permalink(  ); ?>"><?php the_title(); ?></a>
                                <?php if( get_post_meta( get_the_ID(), ESB_META_PREFIX.'verified', true ) == '1' ): ?>
                                    <span class="verified-badge"><i class="fal fa-check"></i></span>
                                <?php endif; ?>
                            </h4>
                            <div class="geodir-category-location"><a href="#"><i class="fas fa-map-marker-alt"></i><?php echo get_post_meta( get_the_ID(), ESB_META_PREFIX.'address', true ); ?></a></div>

                        </div>
                        

                        <?php 
                        $rating = townhub_addons_get_average_ratings(get_the_ID());    ?>
                        <?php if( $rating != false ): ?>
                            <div class="listing-rating-count-wrap flex-items-center">
                                <div class="review-score"><?php echo $rating['sum']; ?></div>
                                <div class="review-details">
                                    <div class="listing-rating card-popup-rainingvis" data-rating="<?php echo $rating['sum']; ?>"></div>
                                    <div class="reviews-count"><?php echo sprintf( _nx( '%s comment', '%s comments', (int)$rating['count'], 'comments count', 'townhub-add-ons' ), (int)$rating['count'] ); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>  

                        <div class="listing_carditem_footer fl-wrap dis-flex">
                            <?php 
                            $cats = get_the_terms(get_the_ID(), 'listing_cat');
                            if ( $cats && ! is_wp_error( $cats ) ){ ?>
                                <div class="listing-cats-wrap dis-flex">
                                    <?php 
                                    foreach( $cats as $key => $cat){
                                        $term_metas = townhub_addons_custom_tax_metas($cat->term_id); 
                                        echo sprintf( '<a href="%1$s" class="listing-item-category-wrap flex-items-center">%3$s<span>%2$s</span></a> ',
                                            esc_url( get_term_link( $cat->term_id, 'listing_cat' ) ),
                                            esc_html( $cat->name ),
                                            ($term_metas['icon'] != '' ? '<div class="listing-item-category '.$term_metas['color'].'"><i class="'.$term_metas['icon'].'"></i></div>' : ''),
                                            $term_metas['color']
                                        );
                                    }
                                    ?>
                                </div>
                            <?php }  ?>
                            <?php $price_range = get_post_meta( get_the_ID(), ESB_META_PREFIX.'price_range', true ); ?>
                            <div class="price-level geodir-category_price flex-items-center">
                                <span class="price-level-item" data-pricerating="<?php echo esc_attr( townhub_addons_get_price_range_rate($price_range) ); ?>"></span>
                                <span class="price-name-tooltip"><?php echo townhub_addons_get_listing_price_range($price_range, true); ?></span>
                            </div>
                            <div class="post-author flex-items-center">
                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php
                                echo get_avatar(get_the_author_meta('user_email'), '80', 'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=80', get_the_author_meta('display_name'));
                                ?>
                                    <span class="avatar-info"><?php echo sprintf(__('By , %s', 'townhub-add-ons'), get_the_author()); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <!-- listing-item end -->
    </div>
</div>
<!--  swiper-slide end  -->
