<?php
/* add_ons_php */
?>
<!-- price-opt-->
<div class="grid-opt">
    <ul class="no-list-style">
        <li class="grid-opt_act"><span class="lgrid tolt<?php if(townhub_addons_get_option('listings_grid_layout')=='grid') echo ' act-grid-opt';?>" data-microtip-position="bottom" data-tooltip="<?php esc_attr_e( 'Grid View', 'townhub-add-ons' ); ?>"><i class="fal fa-th"></i></span></li>
        <li class="grid-opt_act"><span class="llist tolt<?php if(townhub_addons_get_option('listings_grid_layout')=='list') echo ' act-grid-opt';?>" data-microtip-position="bottom" data-tooltip="<?php esc_attr_e( 'List View', 'townhub-add-ons' ); ?>"><i class="fal fa-list"></i></span></li>
        
    </ul>
</div>
<!-- price-opt end-->