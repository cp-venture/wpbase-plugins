<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $cols = $space = $title = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
    'azp_element',
    'lresmenu',
    // 'list-single-main-item fl-wrap', 
    'azp-element-' . $azp_mID,
    $el_class,
);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );  

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

$css_classes = array(
    'cthiso-items cthiso-flex',
    'cthiso-'.$space.'-pad',
    'cthiso-'.$cols.'-cols',
);

$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
$resmenus = get_post_meta( get_the_ID(), ESB_META_PREFIX.'resmenus', true );
$menu_pdf = get_post_meta( get_the_ID(), ESB_META_PREFIX.'menu_pdf', true );
// var_dump($resmenus);
if ( !empty($resmenus) || $menu_pdf != '' ) {
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
        <?php if( !empty($resmenus) ): ?>
            <?php 
            $cats = array();
            $child_items = '';
            foreach ((array)$resmenus as $key => $child) {
                $ccats = array();
                if( isset($child['cats']) && !empty($child['cats']) ){
                    $ccats = explode(",", $child['cats']);
                    $cats = array_merge($cats, $ccats);
                }
                $ccats = array_map( 'townhub_addons_escapse_class', $ccats);
                $photos = isset($child['photos']) ? $child['photos'] : '';
                $child_items .=     '<!--restmenu-item-->';
                $child_items .=     '<div class="cthiso-item restmenu-item '. implode(" ", $ccats) .'">';
                if( !empty($photos) && !is_array($photos) ){
                    $photos = explode(',', $photos);
                    $photos_gal = array();
                    foreach ($photos as $iid) {
                        $photos_gal[] = array('src'=> wp_get_attachment_url( $iid ));
                    }
                    $child_items .=     '<div class="restmenu-item-img dynamic-gal" data-dynamicPath=\''.json_encode($photos_gal).'\'> 
                                            '.wp_get_attachment_image( reset($photos), 'thumbnail', false, '' ).'
                                        </div>';
                }
                    
                    $child_items .=     '<div class="restmenu-item-det">
                                            <div class="restmenu-item-det-header fl-wrap">';
                    if( isset($child['url']) && !empty($child['url']) ){
                        $child_items .=             '<h4><a href="'.$child['url'].'">'.$child['name'].'</a></h4>';
                    }else{
                        $child_items .=             '<h4>'.$child['name'].'</h4>';
                    }
                    
                    $child_items .=             '<div class="restmenu-item-det-price">'.townhub_addons_get_price_formated( $child['price'] ).'</div>
                                            </div>
                                            <div class="restmenu-item-desc">'.$child['desc'].'</div>
                                        </div>';
                $child_items .=     '</div><!--restmenu-item end-->';
            }
            ?>
            <div class="cthiso-isotope-wrapper cthiso-resmenu">
            <?php 
            $cats = array_unique($cats);
            if(!empty($cats)):
            ?>
                <div class="cthiso-filters">
                    <a href="#" class="cthiso-filter cthiso-filter-active" data-filter="*"><?php _e( 'All', 'townhub-add-ons' ); ?></a>
                    <?php
                    foreach ($cats as $key => $cat) {
                        echo '<a href="#" class="cthiso-filter" data-filter=".'. townhub_addons_escapse_class($cat) .'">'.$cat.'</a>';
                    } ?>
                </div>
            <?php 
            endif; ?>
                <div class="<?php echo $css_class;?>">
                    <div class="cthiso-sizer"></div>
                    <?php echo $child_items; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if( !empty($menu_pdf) ): ?>
        <a href="<?php echo wp_get_attachment_url( $menu_pdf ); ?>" target="_blank" class="btn color2-bg"><?php _e( 'Download PDF', 'townhub-add-ons' ); ?><i class="fal fa-file-pdf"></i></a>
        <?php endif; ?>   
        </div>
    </div>
    <!-- lsingle-block-box end -->  
</div>
<?php } ?>