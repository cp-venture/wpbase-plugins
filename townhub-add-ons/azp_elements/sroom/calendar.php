<?php
/* add_ons_php */
azp_add_element(
    'azp_sroom_calendar',
    array(
        'name'                    => __('Calendar', 'townhub-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','townhub-add-ons'),
        'category'                => __("Single Room", 'townhub-add-ons'),
        'icon'                    => ESB_DIR_URL . 'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create' => true,
        'showStyleTab'            => true,
        'showTypographyTab'       => true,
        'showAnimationTab'        => true,
        'template_folder'         => 'sroom/',
        'attrs'                   => array(
            array(
                'type'          => 'text',
                'param_name'    => 'title',
                'show_in_admin' => true,
                'label'         => __('Title', 'townhub-add-ons'),
                'default'       => 'Available Dates',
            ),
            
            

            array(
                'type'       => 'text',
                'param_name' => 'showing',
                'label'      => __('Months to show', 'townhub-add-ons'),
                // 'desc'                  => '',
                'default'    => '1',
            ),

            array(
                'type'       => 'text',
                'param_name' => 'max',
                'label'      => __('Max Months', 'townhub-add-ons'),
                // 'desc'                  => '',
                'default'    => '12',
            ),
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
