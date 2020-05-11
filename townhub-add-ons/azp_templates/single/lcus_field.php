<?php
/* add_ons_php */

//$azp_attrs,$azp_content,$azp_element
$azp_mID = $el_id = $el_class = $title = $name = $width = $show_opt_lbl =  '';

// var_dump($azp_attrs);
extract($azp_attrs);

$classes = array(
	'azp_element',
    'lcustom_field lcfield-' . $name,
    'azp-element-' . $azp_mID,
    'lcfield-wid-' . $width,
    $el_class,
);
// $animation_data = self::buildAnimation($azp_attrs);
// $classes[] = $animation_data['trigger'];
// $classes[] = self::buildTypography($azp_attrs);//will return custom class for the element without dot
// $azplgallerystyle = self::buildStyle($azp_attrs);

$classes = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $classes ) ) ); 

if($el_id!=''){
    $el_id = 'id="'.$el_id.'"';
}
$value = get_post_meta( get_the_ID(), ESB_META_PREFIX.$name, true );
$fieldOptions = array();
if(!empty($value)):

    if( $show_opt_lbl == 'yes' ){

        $fields = townhub_addons_get_listing_type_fields_obj( get_post_meta( get_the_ID(), ESB_META_PREFIX.'listing_type_id', true ) );
        $fieldObj = null;
        foreach($fields as $fld) {
            if ($name == $fld->fieldName) {
                $fieldObj = $fld;
                break;
            }
        }
        if( $fieldObj && isset($fieldObj->options) && is_array($fieldObj->options) && !empty($fieldObj->options) ){
            foreach ($fieldObj->options as $fopt ) {
                $fieldOptions[$fopt->value] = $fopt->label;
            }
        }
    }
?>
<div class="<?php echo $classes; ?>" <?php echo $el_id;?>>
    <div class="lcfield-inner">
        <?php if( !empty($title) ): ?><span class="lcfield-title"><?php echo esc_html( $title ); ?></span><?php endif; ?>
        <?php 
        if( is_array( $value ) ):
            foreach ( $value as $arval ) {
                if( isset($fieldOptions[$arval]) ) $arval = $fieldOptions[$arval];
                ?>
                <span class="lcfield-value"><?php echo wp_kses_post( $arval ); ?></span>
                <?php
            }
        else: 
            if( isset($fieldOptions[$value]) ) $value = $fieldOptions[$value];
        ?>
        <span class="lcfield-value"><?php echo wp_kses_post( $value ); ?></span>
        <?php endif; ?>
    </div>
</div>
<?php endif;