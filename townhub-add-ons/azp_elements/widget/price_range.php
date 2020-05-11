<?php
/* add_ons_php */
azp_add_element(
    'price_range',
    array(
        'name'                    => __('Price Range', 'townhub-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','townhub-add-ons'),
        'category'                => __("Widget", 'townhub-add-ons'),
        'icon'                    => ESB_DIR_URL . 'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create' => true,
        'showStyleTab'            => true,
        'showTypographyTab'       => true,
        'showAnimationTab'        => true,
        'template_folder'         => 'widget/',
        'attrs'                   => array(
            array(
                'type'          => 'text',
                'param_name'    => 'title',
                'show_in_admin' => true,
                'label'         => __('Title', 'townhub-add-ons'),
                'default'       => 'Price Range',
            ),
            array(
                'type'        => 'checkbox',
                'param_name'  => 'hide_widget_on',
                // 'show_in_admin'         => true,
                'label'       => __('Hide this widget on', 'townhub-add-ons'),
                'desc'        => __('Hide on logout user or based author plan?', 'townhub-add-ons'),
                'default'     => '',
                'value'       => townhub_addons_loggedin_plans_options(),
                'multiple'    => true,
                'show_toggle' => true,
            ),
            array(
                'type'          => 'switch',
                'param_name'    => 'hide_claim',
                'show_in_admin' => true,
                'label'         => __('Hide claim listing', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'yes',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),
            // array(
            //     'type'          => 'switch',
            //     'param_name'    => 'hide_claimed',
            //     'show_in_admin' => true,
            //     'label'         => __('Hide Claim on Claimed Listing?', 'townhub-add-ons'),
            //     'desc'          => __( 'Hide Claim Listing on price range widget for already claimed listing', 'townhub-add-ons' ),
            //     'default'       => 'yes',
            //     'value'         => array(
            //         'yes' => __('Yes', 'townhub-add-ons'),
            //         'no'  => __('No', 'townhub-add-ons'),
            //     ),
            // ),
            array(
                'type'       => 'text',
                'param_name' => 'el_id',
                'label'      => __('Element ID', 'townhub-add-ons'),
                // 'desc'                  => '',
                'default'    => '',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'el_class',
                'label'      => __('Extra Class', 'townhub-add-ons'),
                'desc'       => __("Use this field to add a class name and then refer to it in your CSS.", 'townhub-add-ons'),
                'default'    => '',
            ),

        ),
    )
);
