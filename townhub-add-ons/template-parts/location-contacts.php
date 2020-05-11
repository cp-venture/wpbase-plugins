<?php
/* add_ons_php */
if(!isset($location)) $location = '';
if(!isset($contact_infos)) $contact_infos = array(
												'address' => '',												
												'latitude' => '',												
												'longitude' => '',												
												'phone' => '',												
												'email' => '',												
												'website' => '',												
											);
// new arg for hide location from back-end
if(!isset($hide_location)) $hide_location = false;
?>
<?php if($hide_location != true): ?>
<label><?php _e( 'Location<i class="fa fa-map-marker"></i>', 'townhub-add-ons' );?></label>
<input class="has-icon" id="location" type="text" name="locations" placeholder="<?php esc_attr_e( 'Region of your business', 'townhub-add-ons' );?>" value="<?php echo esc_attr( $location );?>"/>
<?php endif; ?>
<div class="contact-infos-wrap">
    <div class="row listing-submit-contacts-row">
        <div class="col-md-6 listing-submit-address-col">
            <label for="address"><?php esc_html_e( 'Address', 'townhub-add-ons' );?></label>
            <input type="text" id="address" name="address" placeholder="<?php esc_attr_e( 'Address of your business', 'townhub-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['address'] );?>"/>

            <div class="row submit-latlng listing-submit-latlng-row">
                <div class="col-md-6">
                    <label for="latitude"><?php esc_html_e( 'Latitude', 'townhub-add-ons' );?></label>
                    <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr( $contact_infos['latitude'] );?>"/>
                </div>
                <div class="col-md-6">
                    <label for="longitude"><?php esc_html_e( 'Longitude', 'townhub-add-ons' );?></label>
                    <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr( $contact_infos['longitude'] );?>"/>
                </div>
            </div>
        </div>
        <!-- col-md-6 -->
        <div class="col-md-6 listing-submit-map-col">
            <div class="map-container">
                <?php if(townhub_addons_get_option('use_osm_map')): ?>
                <div id="<?php echo uniqid('submitMapOSM'); ?>" class="submitMapOSM" data-lat="<?php echo esc_attr( $contact_infos['latitude'] );?>" data-lng="<?php echo esc_attr( $contact_infos['longitude'] );?>"></div>
                <?php else: ?>
                <div class="submitMap" data-lat="<?php echo esc_attr( $contact_infos['latitude'] );?>" data-lng="<?php echo esc_attr( $contact_infos['longitude'] );?>"></div>
                <?php endif; ?>
                    
                
            </div>
        </div>
    </div>
        	

    <label><?php esc_html_e( 'Phone', 'townhub-add-ons' );?><i class="fa fa-phone"></i></label>
    <input class="has-icon" type="text" name="phone" placeholder="<?php esc_attr_e( 'Your Phone', 'townhub-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['phone'] );?>"/>
    <label><?php esc_html_e( 'Email', 'townhub-add-ons' );?><i class="fa fa-envelope-o"></i></label>
    <input class="has-icon" type="text" name="email" placeholder="<?php esc_attr_e( 'Your Email', 'townhub-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['email'] );?>"/>
    <label><?php esc_html_e( 'Website', 'townhub-add-ons' );?><i class="fa fa-globe"></i></label>
    <input class="has-icon" type="text" name="website" placeholder="<?php esc_attr_e( 'Your Website', 'townhub-add-ons' );?>" value="<?php echo esc_attr( $contact_infos['website'] );?>"/>
</div>