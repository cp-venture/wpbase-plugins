<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $cols = $space = $title = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
    'azp_element',
    'lmembers',
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
$lmembers = get_post_meta( get_the_ID(), ESB_META_PREFIX.'lmember', true );
if (!empty($lmembers)) {
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
            
            <div class="<?php echo $css_class;?>">
                <?php 
                    foreach ((array)$lmembers as $key => $member) {
                ?>
                    <!-- team-item -->
                    <div id="<?php echo 'item-'.$key.'' ?>" <?php post_class('cthiso-item team-box'); ?>>

                    

                        <?php townhub_addons_get_template_part('template-parts/member', false, array('member'=>$member)); ?>
                    </div>
                    <!-- team-item end  -->
                <?php } ?>
            </div>

        </div>
    </div>
    <!-- lsingle-block-box end -->  
</div>
<?php } ?>