<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $show_reviews = ''; 

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'lcomments',
    'azp-element-' . $azp_mID,
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) );

if($el_id != ''){
    $el_id = 'id="'.$el_id.'"';
}
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    ?> 
</div>