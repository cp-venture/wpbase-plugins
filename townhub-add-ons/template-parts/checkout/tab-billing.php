<?php
/* add_ons_php */

?>
<div class="ck-tab-title fl-wrap">
    <h3><?php esc_html_e('Billing Address', 'townhub-add-ons');?></h3>
</div>
<div class="row">
    <div class="col-sm-6">
        <label class="has-icon"><?php esc_html_e('First Name ', 'townhub-add-ons');?><i class="far fa-user"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_first_name" placeholder="<?php esc_attr_e('First Name', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_first_name'] ?>" required />
        </div>

    </div>
    <div class="col-sm-6">
        <label class="has-icon"><?php esc_html_e('Last Name', 'townhub-add-ons');?> <i class="far fa-user"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_last_name" placeholder="<?php esc_attr_e('Last Name', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_last_name'] ?>" required />
        </div>

    </div>
    <div class="col-sm-12">
        <label class="has-icon"><?php esc_html_e('Company', 'townhub-add-ons');?> <i class="far fa-building"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_company" placeholder="<?php esc_attr_e('Company', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_company'] ?>" required />
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label class="has-icon"><?php esc_html_e('City', 'townhub-add-ons');?> <i class="far fa-globe-asia"></i></label>
        <div class="ck-validate-field">

            <input type="text" name="billing_city" placeholder="<?php esc_attr_e('Your city', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_city'] ?>" required />
        </div>

    </div>
    <div class="col-sm-6">
        <label><?php esc_html_e('Country', 'townhub-add-ons');?> </label>
        <div class="ck-validate-field">

            <div class="listsearch-input-item ">
                <select data-placeholder="<?php esc_attr_e('Your Country', 'townhub-add-ons');?>" name="billing_country" class="chosen-selects no-search-select">
                    <?php
                    $billing_country = townhub_addons_get_google_contry_codes();
                    foreach ($billing_country as $code => $value) {
                    ?>
                       <option value="<?php echo $code; ?>" <?php selected($user_datas['billing_country'], $code);?>><?php echo $value; ?></option>
                    <?php 
                    } ?>
                </select>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label class="has-icon"><?php esc_html_e('Address Line 1', 'townhub-add-ons');?><i class="far fa-road"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_address_1" placeholder="<?php esc_attr_e('Address Line 1', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_address_1'] ?>" required/>
        </div>

    </div>
    <div class="col-sm-6">
        <label class="has-icon"><?php esc_html_e('Address Line 2 ', 'townhub-add-ons');?><i class="far fa-road"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_address_2" placeholder="<?php esc_attr_e('Address Line 1', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_address_2'] ?>" required />
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <label class="has-icon"><?php esc_html_e('State / County', 'townhub-add-ons');?><i class="far fa-street-view"></i></label>
        <div class="ck-validate-field">

            <input type="text" name="billing_state" placeholder="<?php esc_attr_e('Your State', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_state'] ?>" required />
        </div>

    </div>
    <div class="col-sm-4">
        <label class="has-icon"><?php esc_html_e('Postcode / ZIP', 'townhub-add-ons');?><i class="far fa-barcode"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_postcode" placeholder="<?php esc_attr_e('123456', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_postcode'] ?>"required />
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label class="has-icon"><?php esc_html_e('Phone', 'townhub-add-ons');?> <i class="far fa-phone"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_phone" placeholder="<?php esc_attr_e('+7(123)987654', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_phone'] ?>" required />
        </div>

    </div>
    <div class="col-sm-6">
        <label class="has-icon"><?php esc_html_e('Email Address', 'townhub-add-ons');?> <i class="far fa-envelope"></i> </label>
        <div class="ck-validate-field">

            <input type="text" name="billing_email" placeholder="<?php esc_attr_e('support@info.com', 'townhub-add-ons');?>" value="<?php echo $user_datas['billing_email'] ?>" required />
        </div>

    </div>
</div>
<div class="ck-validate-field">
    <div class="list-single-main-item-title fl-wrap">
        <h3><?php _e('Addtional Notes', 'townhub-add-ons');?></h3>
    </div>
    <div class="ck-validate-field">
        <textarea cols="40" rows="3" placeholder="<?php esc_attr_e('Notes', 'townhub-add-ons');?>" name="notes"></textarea>
    </div>
</div>
