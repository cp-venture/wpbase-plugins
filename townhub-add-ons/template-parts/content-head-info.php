<?php
/* add_ons_php */

?>
<!-- list-single-header -->
<div class="list-single-header list-single-header-inside fl-wrap">
    <div class="container">
        <div class="list-single-header-item">
            <div class="row">
                <div class="col-md-8">
                    <div class="list-single-header-item-opt fl-wrap">
                        <?php

                        $cats = get_the_terms(get_the_ID(), 'listing_cat');
                        if ( $cats && ! is_wp_error( $cats ) ){
                            echo '<div class="list-single-header-cat fl-wrap">';
                            foreach( $cats as $key => $cat){

                                echo sprintf( '<a href="%1$s" class="listing-cat">%2$s</a> ',
                                    esc_url( get_term_link( $cat->term_id, 'listing_cat' ) ),
                                    esc_html( $cat->name )
                                );
                            }
                            echo '</div>';
                        }
                        // end check cat

                        ?>
                    </div>
                    <h2>
                        <?php the_title( ) ;?>
                        <?php if( get_post_meta( get_the_ID(), ESB_META_PREFIX.'verified', true ) ) echo '<span class="listing-verified tooltipwrap tooltip-center"><i class="fa fa-check"></i><span class="tooltiptext">'.__('Verified','townhub-add-ons').'</span></span>'; ?>
                        
                        <span class="hosted-by-text"><?php esc_html_e( ' - Hosted By ', 'townhub-add-ons' );?></span><?php the_author_posts_link( );?> 
                        <?php // endif; ?>
                        <?php townhub_addons_edit_listing_link(get_the_ID());?>
                    </h2>
                    <?php 
                    if(townhub_addons_get_option('listing_event_date') == 'yes'): 
                    $levent_date = get_post_meta( get_the_ID(), ESB_META_PREFIX.'levent_date', true );
                    $levent_time = get_post_meta( get_the_ID(), ESB_META_PREFIX.'levent_time', true );
                    if($levent_date != ''): ?>
                    <div class="single-event-date"><?php echo sprintf( __( 'Will begin on <span>%s</span> at <span>%s</span>', 'townhub-add-ons' ), date_i18n( get_option( 'date_format' ), strtotime( $levent_date.' '.$levent_time ) ), date_i18n( get_option( 'time_format' ), strtotime( $levent_date.' '.$levent_time ) ) ); ?></div>
                    <?php 
                        endif;
                    endif; ?>

                    <span class="section-separator"></span>
                    <?php townhub_addons_get_template_part( 'templates-inner/listing-rating');?>
                    <div class="list-post-counter single-list-post-counter"><?php echo townhub_addons_get_likes_button(get_the_ID());?></div>
                    <div class="clearfix"></div>

                    <?php //townhub_addons_get_template_part( 'templates-inner/listing-contacts');?>

                </div>
                <div class="col-md-4">
                    <?php townhub_addons_get_template_part( 'templates-inner/listing-share');?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- list-single-header end -->