<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $sec_id = $title = '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'ltags',
    'azp-element-' . $azp_mID,
    $el_class,
);
$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}

$terms = get_the_terms(get_the_ID(), 'listing_tag');
if ( $terms && ! is_wp_error( $terms ) ){ 
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <!--box-widget-item -->
    <div class="box-widget-item fl-wrap block_box">
        <?php if($title != ''): ?>
        <div class="box-widget-item-header">
            <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <div class="tagcloud">
            <?php 
            foreach( $terms as $key => $term){
                echo sprintf( '<a href="%1$s" class="tag-cloud-link listing-tag">%2$s</a>',
                    esc_url( get_term_link( $term->term_id, 'listing_tag' ) ),
                    esc_html( $term->name )
                );
            }
            ?>                                                                              
        </div>
    </div><!--box-widget-item end --> 
</div>
<?php }