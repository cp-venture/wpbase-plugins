<?php
/* add_ons_php */
azp_add_element(
    'lcontacts',
    array(
        'name'                    => __('Contacts', 'townhub-add-ons'),
        // 'desc'                  => __('Custom element for adding third party shortcode','townhub-add-ons'),
        'category'                => "Widget",
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
                'default'       => 'Location / Contacts',
            ),
            array(
                'type'        => 'checkbox',
                'param_name'  => 'hide_widget_on',
                'label'       => __('Hide this widget on', 'townhub-add-ons'),
                'desc'        => __('Hide on logout user or based author plan?', 'townhub-add-ons'),
                'default'     => '',
                'value'       => townhub_addons_loggedin_plans_options(),
                'multiple'    => true,
                'show_toggle' => true,
            ),

            array(
                'type'        => 'checkbox',
                'param_name'  => 'hide_contacts_on',
                'label'       => __('Hide contacts on', 'townhub-add-ons'),
                'desc'        => __('Hide on logout user or based author plan?', 'townhub-add-ons'),
                'default'     => '',
                'value'       => townhub_addons_loggedin_plans_options(),
                'multiple'    => true,
                'show_toggle' => true,
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_map',
                'show_in_admin' => true,
                'label'         => __('Hide map', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),


            array(
                'type'          => 'switch',
                'param_name'    => 'hide_address',
                'show_in_admin' => true,
                'label'         => __('Hide address', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),
            array(
                'type'          => 'switch',
                'param_name'    => 'hide_email',
                'show_in_admin' => true,
                'label'         => __('Hide email', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),
            array(
                'type'          => 'switch',
                'param_name'    => 'hide_phone',
                'show_in_admin' => true,
                'label'         => __('Hide phone', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),
            array(
                'type'          => 'switch',
                'param_name'    => 'hide_web',
                'show_in_admin' => true,
                'label'         => __('Hide Web', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),
            array(
                'type'          => 'switch',
                'param_name'    => 'hide_whatsapp',
                'show_in_admin' => true,
                'label'         => __('Hide Whatsapp', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_au_message',
                'show_in_admin' => true,
                'label'         => __('Hide author message', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'       => 'text',
                'param_name' => 'el_id',
                'label'      => __('Element ID', 'townhub-add-ons'),
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
