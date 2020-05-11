<?php
/* add_ons_php */

townhub_addons_get_template_part('template-parts/dashboard/headsec');
?>
<!--  section  -->
<section class="gray-bg main-dashboard-sec" id="sec1">
    <div class="container">
        <!--  dashboard-menu-->
        <div class="col-md-3 dashboard-sidebar-col">
            <?php townhub_addons_get_template_part('template-parts/dashboard/sidebar', '', array('is_add_page'=>true));?>

        </div>
        <!-- dashboard-menu  end-->
        <!-- dashboard content-->
        <div class="col-md-9 dashboard-main-col">
            
            <div id="submit-listing-view" class="submit-listing-view">
            <!-- #submit-listing-view -->
                <div id="submit-listing-message"></div>
                
                <div id="ladd-app" class="submit-fields-dflex"></div>
            </div>
            <!-- #submit-listing-view -->
        </div>
        <!-- dashboard content end-->
    </div>
</section>
<!--  section  end-->
<div class="limit-box fl-wrap"></div>

