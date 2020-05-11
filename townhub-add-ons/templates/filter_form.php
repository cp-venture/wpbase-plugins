<?php
/* add_ons_php */
?>
<!-- listsearch-input-wrap-->
<div class="listsearch-input-wrap lws_mobile fl-wrap tabs-act tabs-wrapper" id="lisfw">
    <div class="listsearch-input-wrap_contrl fl-wrap">
        <div class="container">
            <ul class="tabs-menu fl-wrap no-list-style">
                <li class="current"><a href="#filters-search"><?php _e( '<i class="fal fa-sliders-h"></i>Filters</a>', 'townhub-add-ons' ); ?></li>
                <li><a href="#category-search"><?php _e( '<i class="fal fa-image"></i>Categories', 'townhub-add-ons' ); ?></a></li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="container">
        <!--tabs -->
        <div class="tabs-container fl-wrap">
            <!--tab -->
            <div class="tab tab-from-tab">
                <div id="filters-search" class="tab-content first-tab">
                    <?php townhub_addons_get_template_part('template-parts/filter/form'); ?>
                </div>
            </div>
            <!--tab end-->
            <!--tab -->
            <div class="tab tab-cats-tab">
                <div id="category-search" class="tab-content">
                    <?php townhub_addons_get_template_part('template-parts/filter/categories'); ?>
                    
                </div>
            </div>
            <!--tab end-->
        </div>
        <!--tabs end-->
    </div>
</div>
<!-- listsearch-input-wrap end-->
