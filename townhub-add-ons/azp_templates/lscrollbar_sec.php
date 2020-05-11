<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
// var_dump($azp_attrs);
$azp_mID = $el_id = $el_class = $hstyle = $menus = $show_mobile = $hide_report = $hide_review = $hide_share = $hide_bookmark = '';
extract($azp_attrs);

$classes = array(
	'azp_element',
    'lscrollbar_sec',
    'azp-element-' . $azp_mID, 
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );    
if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
$menus = json_decode(urldecode($menus) , true) ;
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
	<!-- scroll-nav-wrapper--> 
    <div class="scroll-nav-wrapper fl-wrap <?php echo 'lscroll-mobile-'.$show_mobile; ?>">
        <div class="container">
        	<div class="flex-items-center scroll-nav-inner">
        		<nav class="scroll-nav scroll-init">
	                <ul class="no-list-style">
	                    
	                    <?php if (!empty($menus) && $menus != '') {
	                        foreach ($menus as $menu) { 
	                            $icon = '';
	                            $nv_cls = 'sclnav-item';
	                            if(isset($menu['show_mobile'])) $nv_cls .= ' sclnav-item-mobile-'.$menu['show_mobile'];
	                            if(!empty($menu['icon'])) $icon = '<i class="'.$menu['icon'].'"></i>';
	                        ?>
	                            <li  class="<?php echo esc_attr( $nv_cls ); ?>"><a href="<?php echo $menu['sec_id']; ?>"><?php echo $icon . $menu['title']; ?></a></li>                  
	                    <?php   } 
	                        }
	                    if ( comments_open() || get_comments_number() )  echo '<li class="sclnav-item sclnav-lreview"><a href="#lreviews_sec">'.__( '<i class="fal fa-comments-alt"></i> Reviews', 'townhub-add-ons' ).'</a></li>';
	                    ?>
	                </ul>
	            </nav>
	            <?php if( $hide_bookmark != 'yes' || $hide_share != 'yes' || $hide_review != 'yes' || $hide_report != 'yes' ): ?>
	            <div class="scroll-nav-wrapper-opt flex-items-center">
	            	<?php if( $hide_bookmark != 'yes' ): ?>
		            	<?php if(!is_user_logged_in()): ?>
			            <a href="#" class="scroll-nav-wrapper-opt-btn scroll-nav-bookmark-btn logreg-modal-open" data-message="<?php esc_attr_e( 'Logging in first to bookmark this listing.', 'townhub-add-ons' ); ?>"><i class="fal fa-heart"></i><?php esc_html_e( ' Save ', 'townhub-add-ons' ); ?></a>
			            <?php elseif( townhub_addons_already_bookmarked( get_the_ID() ) ): ?>
			            <a href="javascript:void(0);" class="scroll-nav-wrapper-opt-btn scroll-nav-bookmark-btn" data-id="<?php the_ID(); ?>"><i class="fas fa-heart"></i><?php esc_html_e( ' Saved ', 'townhub-add-ons' ); ?></a>
			            <?php else: ?>
			            <a href="#" class="scroll-nav-wrapper-opt-btn scroll-nav-bookmark-btn bookmark-listing-btn" data-id="<?php the_ID(); ?>"><i class="fal fa-heart"></i><?php esc_html_e( ' Save ', 'townhub-add-ons' ); ?></a>
			            <?php endif; ?>
	                <?php endif; ?>

	                <?php
	                if($hide_share !='yes'):
		                $share_names = townhub_addons_get_option('widgets_share_names','facebook, pinterest, googleplus, twitter, linkedin');
					    if($share_names !=''):
				    ?>
				    <div class="lhead-share-wrap">
	                	<a href="#" class="scroll-nav-wrapper-opt-btn showshare"><i class="fas fa-share"></i><?php _e( 'Share', 'townhub-add-ons' ); ?></a>
					    <div class="share-holder hid-share">
					        <div class="share-container isShare" data-share="<?php echo esc_attr( trim($share_names, ", \t\n\r\0\x0B") ); ?>"></div>
					    </div>
					</div>
				    <?php
				    	endif;
				    endif; ?>
				    <?php if( $hide_review != 'yes' || $hide_report != 'yes' ): ?>
		            <div class="lhead-more-wrap">
		            	<div class="show-more-snopt"><i class="fal fa-ellipsis-h"></i></div>
		                <div class="show-more-snopt-tooltip">
		                	<?php if( $hide_review != 'yes' || $hide_report != 'yes' ): ?>
		                    <?php if ( comments_open() || get_comments_number() ): ?><a class="custom-scroll-link" href="#lreviews_sec"> <i class="fas fa-comment-alt"></i><?php _e( 'Write a review', 'townhub-add-ons' ); ?></a><?php endif; ?>
		                    <?php endif; ?>
		                    <?php if( $hide_report != 'yes' ): ?>
			                    <?php if(!is_user_logged_in()): ?>
			                    <a href="#" class="report-listing-btn logreg-modal-open" data-message="<?php esc_attr_e( 'Logging in first to report this listing.', 'townhub-add-ons' ); ?>"> <i class="fas fa-flag-alt"></i><?php _e( 'Report', 'townhub-add-ons' ); ?></a>
			                    <?php else: ?>
					            <a href="#" class="report-listing-btn report-listing-opener" data-id="<?php the_ID(); ?>"><i class="fas fa-flag-alt"></i><?php _e( 'Report', 'townhub-add-ons' ); ?></a>
					            <?php endif; ?>
				            <?php endif; ?>
		                </div>
		            </div>
		            <?php endif; ?>
		                
	            </div>
	            <?php endif; ?>
        	</div>
	            
        </div>
    </div>
    <!-- scroll-nav-wrapper end--> 
</div>