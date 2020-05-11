<?php
/* add_ons_php */
azp_add_element(
    'lheader_sec',
    array(
        'name'                    => __('Header Section', 'townhub-add-ons'),
        'category'                => __("Header", 'townhub-add-ons'),
        'icon'                    => ESB_DIR_URL . 'assets/azp-eles-icon/cththemes-logo.png',
        'open_settings_on_create' => true,
        'showStyleTab'            => true,
        'showTypographyTab'       => true,
        'showAnimationTab'        => true,
        'is_section'              => true,
        'attrs'                   => array(
            array(
                'type'          => 'select',
                'param_name'    => 'hstyle',
                'show_in_admin' => true,
                'label'         => __('Style', 'townhub-add-ons'),
                'default'       => 'bgimage',
                'value'         => array(
                    'bgimage'     => __('Image Background', 'townhub-add-ons'),
                    'bgvideo'     => __('Video Background', 'townhub-add-ons'),
                    'bgslider'    => __('Images Slider', 'townhub-add-ons'),
                    'bgslideshow' => __('Slideshow', 'townhub-add-ons'),
                    'map'           => __('Map', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_address',
                'show_in_admin' => true,
                'label'         => __('Hide Address', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no'    => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_phone',
                'show_in_admin' => true,
                'label'         => __('Hide Phone', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no'    => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_email',
                'show_in_admin' => true,
                'label'         => __('Hide Email', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no'    => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_rating',
                'show_in_admin' => true,
                'label'         => __('Hide Rating', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no'    => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_cats',
                'show_in_admin' => true,
                'label'         => __('Hide Category', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no' => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_author',
                'show_in_admin' => true,
                'label'         => __('Hide Author', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no' => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_status',
                'show_in_admin' => true,
                'label'         => __('Hide Open/Closed status', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),
            array(
                'type'          => 'switch',
                'param_name'    => 'show_counter',
                'show_in_admin' => true,
                'label'         => __('Show Event Counter', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'yes',
                'value'         => array(
                    'yes' => __('Yes', 'townhub-add-ons'),
                    'no'  => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_bookmarks',
                'show_in_admin' => true,
                'label'         => __('Hide Bookmarks', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no'    => __('No', 'townhub-add-ons'),
                ),
            ),

            array(
                'type'          => 'switch',
                'param_name'    => 'hide_views',
                'show_in_admin' => true,
                'label'         => __('Hide Views', 'townhub-add-ons'),
                'desc'          => '',
                'default'       => 'no',
                'value'         => array(
                    'yes'   => __('Yes', 'townhub-add-ons'),
                    'no'    => __('No', 'townhub-add-ons'),
                ),
            ),
            
            
            // array(
            //     'type'          => 'switch',
            //     'param_name'    => 'share',
            //     'show_in_admin' => true,
            //     'label'         => __('Listing Share', 'townhub-add-ons'),
            //     'desc'          => 'Show or Hide Listing Share in the posts.',
            //     'default'       => 'show',
            //     'value'         => array(
            //         'show'   => __('Show', 'townhub-add-ons'),
            //         'hidden' => __('Hide', 'townhub-add-ons'),
            //     ),
            // ),
            // array(
            //     'type'          => 'switch',
            //     'param_name'    => 'price',
            //     'show_in_admin' => true,
            //     'label'         => __('Listing Price', 'townhub-add-ons'),
            //     'desc'          => 'Show or Hide Listing Price in the posts.',
            //     'default'       => 'show',
            //     'value'         => array(
            //         'show'   => __('Show', 'townhub-add-ons'),
            //         'hidden' => __('Hide', 'townhub-add-ons'),
            //     ),
            // ),
            // array(
            //     'type'          => 'switch',
            //     'param_name'    => 'breadcrumb',
            //     'show_in_admin' => true,
            //     'label'         => __('Breadcrumb', 'townhub-add-ons'),
            //     'desc'          => 'Show or Hide breadcrumb in the posts.',
            //     'default'       => 'show',
            //     'value'         => array(
            //         'show'   => __('Show', 'townhub-add-ons'),
            //         'hidden' => __('Hide', 'townhub-add-ons'),
            //     ),
            // ),
            // array(
            //     'type'        => 'checkbox',
            //     'param_name'  => 'hide_contacts_on',
            //     // 'show_in_admin'         => true,
            //     'label'       => __('Hide contacts on', 'townhub-add-ons'),
            //     'desc'        => __('Hide on logout user or based author plan?', 'townhub-add-ons'),
            //     'default'     => '',
            //     'value'       => townhub_addons_loggedin_plans_options(),
            //     'multiple'    => true,
            //     'show_toggle' => true,
            // ),

            // array(
            //     'type'          => 'switch',
            //     'param_name'    => 'show_event_date',
            //     'show_in_admin' => true,
            //     'label'         => __('Show next event date?', 'townhub-add-ons'),
            //     // 'desc'                  => '',
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
                'desc'       => '',
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
