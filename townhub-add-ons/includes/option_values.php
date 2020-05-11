<?php 
/* add_ons_php */

require_once ESB_ABSPATH . 'includes/options/general.php';
require_once ESB_ABSPATH . 'includes/options/membership.php';
require_once ESB_ABSPATH . 'includes/options/woo.php';
require_once ESB_ABSPATH . 'includes/options/emails.php';

function townhub_addons_get_plugin_options(){ 
    return array(
         'advanced' => array(
            array(
                "type" => "section",
                'id' => 'advanced_sec_1',
                "title" => __( 'AZP Builder', 'townhub-add-ons' ),     
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'azp_cache',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Enable AZP builder cache', 'townhub-add-ons'),   
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'azp_css_external',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('AZP External CSS', 'townhub-add-ons'),  
                'desc'  => __( 'Builder style will be loaded from external css file instead of adding inline to page.', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'lazy_load',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable Lazy Load Images', 'townhub-add-ons'),   
                'desc'  => __( 'For page speed improvement.', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'lazy_placeholder',
                "title" => __('Lazy Placeholder', 'townhub-add-ons'),
                'desc'  => __( 'Select placeholder image for lazy load. Leave empty for hide images before load (recommended)', 'townhub-add-ons' ),
            ),
        ),
        'general' => townhub_addons_options_get_general(),
        // end tab array
        'register'      => array(

            array(
                "type" => "section",
                'id' => 'register_general_sec',
                "title" => __( 'User Registration', 'townhub-add-ons' ),
                
            ),

            // array(
            //     "type" => "info",
            //     'id' => 'register_note_info',
            //     "title" => __( 'Info note', 'townhub-add-ons' ),
            //     'desc'  => 'Please make sure that user registration is enabled: https://prnt.sc/s7vo4j'
            // ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'new_user_email',
                "title" => __('Send new user registration email to', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'both',
                    'options'=> array(
                        'user' => __( 'User only', 'townhub-add-ons' ),
                        'admin' => __( 'Admin only', 'townhub-add-ons' ),
                        'both' => __( 'Admin and user', 'townhub-add-ons' ),
                        'none' => __( 'None', 'townhub-add-ons' ),
                        
                    ),
                ),
                'desc'  => 'Please make sure that user registration is enabled on Settings -> General screen: <a href="https://prnt.sc/s7vo4j" target="_blank">https://prnt.sc/s7vo4j</a>'
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_password',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Show Password field', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_auto_login',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Login user after registered?', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_no_redirect',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Disable redirect after registered?', 'townhub-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_role',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Allow register as author?', 'townhub-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'register_as_author',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Register as author (NEW)', 'townhub-add-ons'),
                'desc'  => __('Check this option if you want registered users is author by default', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'forget_pwd_email',
                "title" => __('Forget Password Email', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => 'Someone has requested a password reset for the following account:
Site Name: {site_name}
Site Username: {username}
If this was a mistake, just ignore this email and nothing will happen.
To reset your password, visit the following address: <{reset_url}>',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'logreg_form_before',
                "title" => __('Log/Reg Top Content', 'townhub-add-ons'),
                'desc'  => __( 'Content showing up above user login - register form. You can add shortcode for social login.', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'logreg_form_after',
                "title" => __('Log/Reg Bottom Content', 'townhub-add-ons'),
                'desc'  => __( 'Content showing up above user login - register form. You can add shortcode for social login.', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '<p>For faster login or register use your social account.</p>
[fbl_login_button redirect="" hide_if_logged="" size="large" type="continue_with" show_face="true"]',
                )
            ),

            

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'register_term_text',
                "title" => __('Terms Text', 'townhub-add-ons'),
                'desc'  => __( 'Accept terms text on user register form.', 'townhub-add-ons' ),
                'args' => array(
                    'default' => 'By using the website, you accept the terms and conditions',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'register_consent_data_text',
                "title" => __('Consent Personal Data Text', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => 'Consent to processing of personal data',
                )
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'admin_bar_front',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Show Front-end Admin Bar', 'townhub-add-ons'),
            //     'desc'  => '',
            // ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'admin_bar_hide_roles',
                "title" => __('Hide Admin Bar for', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> array('l_customer','listing_author','subscriber','contributor','author'),
                    'options'=> townhub_addons_get_author_roles(),
                    'multiple' => true,
                    'use-select2' => true
                ),
                // 'desc' => esc_html__("The page redirect to after submit/edit listing", 'townhub-add-ons'), 
            ),


            array(
                "type" => "section",
                'id' => 'register_login_sec',
                "title" => __( 'User Login', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'login_redirect_page',
                "title" => __('After Login Redirect', 'townhub-add-ons'),
                'desc'  => __('The page user redirect to after login.', 'townhub-add-ons'),
                'args' => array(
                    'default'   => 'cth_current_page',
                    // 'default_title' => "Pricing Tables",
                    'options' => array(
                        array(
                            'cth_current_page',
                            __( 'Current Page', 'townhub-add-ons' ),
                        ),
                    )
                )
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'login_delay',
                "title" => __('Login Redirect Timeout', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '5000',
                    'min'  => '0',
                    'max'  => '500000',
                    'step'  => '1000',
                ),
                'desc'  => __('The number of milliseconds to wait before logged in redirect', 'townhub-add-ons') . __( '<br>And larger than <strong>300000</strong> for disabled.', 'townhub-add-ons' ),
            ),


            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'log_reg_dis_nonce',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Disable verify nonce?', 'townhub-add-ons'),
                'desc'  => __( 'Use this option if you receive "Security checked!, Cheatn huh?" error when using cache plugin.', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'off_avatar',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Disable Gravatar', 'townhub-add-ons'),
                'desc'  => '',
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "image",
            //     'id' => 'df_avatar',
            //     "title" => __('Default Avatar', 'townhub-add-ons'),
            //     'desc' => '',
            // ),
            

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'delete_user',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Allow delete user?', 'townhub-add-ons'),  
                'desc'  => __( 'Allow user delete account. All realated data will be deleted too.', 'townhub-add-ons' ),
            ),

        ),
        // end tab array
        'membership' => townhub_addons_options_get_membership(),
        // end tab array
        'checkout'      => array(
            array(
                "type" => "section",
                'id' => 'membership_checkout_sec',
                "title" => __( 'Checkout Page', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_hide_tabs',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Tabs', 'townhub-add-ons'),
                'desc'  => __( 'Check this if you want to use single page checkout instead of tabs.', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_hide_information',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Hide Information Tab', 'townhub-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_hide_billing',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Billing Tab', 'townhub-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_hide_payments',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Payments Tab', 'townhub-add-ons'),
                'desc'  => '',
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'ck_show_title',
            //     'args'=> array(
            //         'default' => 'yes',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Show Checkout Title', 'townhub-add-ons'),
            //     'desc'  => '',
            // ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ck_agree_terms',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Agree to Terms', 'townhub-add-ons'),
                'desc'  => __('User must agree to terms before puchasing', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'ck_terms',
                "title" => __('Checkout Terms', 'townhub-add-ons'),
                // 'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'townhub-add-ons' ),
                'args' => array(
                    'default' => 'I have read and accept the <a target="_blank" href="#"> terms, conditions</a> and <a href="#" target="_blank">Privacy Policy</a>',
                )
            ),


            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'checkout_success',
                "title" => __('Checkout Success Page', 'townhub-add-ons'),
                'desc'  => __('The page display after user complete checkout.', 'townhub-add-ons'),
                'args' => array(
                    'default'   => 'default',
                    'default_title' => "Checkout Success",
                    
                )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'checkout_success_redirect',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Checkout Success Redirect', 'townhub-add-ons'),
                'desc'  => __('User will redirect to success page instead of showing in tab.', 'townhub-add-ons'),
            ),


            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'invoice_from',
                "title" => __('Invoice From text', 'townhub-add-ons'),
                // 'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'townhub-add-ons' ),
                'args' => array(
                    'default' => 'TownHub , Inc.<br>
USA 27TH Brooklyn NY<br>
<a href="#" style="color:#666; text-decoration:none">JessieManrty@domain.com</a>
<br>
<a href="#" style="color:#666; text-decoration:none">+4(333)123456</a>',
                )
            ),

        ),
        // end tab array
        'submit_listing' => array(
            array(
                "type" => "section",
                'id' => 'submit_sec_1',
                "title" => __( 'General', 'townhub-add-ons' ),
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "select",
            //     'id' => 'submit_redirect',
            //     "title" => __('Submit Redirect', 'townhub-add-ons'),
            //     'args'=> array(
            //         'default'=> 'single',
            //         'options'=> array(
            //             'single' => esc_html__('Single Listing', 'townhub-add-ons'), 
            //             'home' => esc_html__('Home', 'townhub-add-ons'), 
            //             'dashboard' => esc_html__('Dashboard', 'townhub-add-ons'), 
                        
            //         ),
            //     ),
            //     'desc' => esc_html__("The page redirect to after submit/edit listing", 'townhub-add-ons'), 
            // ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'default_listing_type',
                "title" => __('Listing Default Type', 'townhub-add-ons'),
                'args'=> array(
                    'options'=> townhub_addons_get_listing_types(),
                )
            ),
            array(
                "type" => "field",
                "field_type" => "page_select",
                'id' => 'submit_redirect',
                "title" => __('Submit Redirect', 'townhub-add-ons'),
                'desc'  => __('The page redirect to after submit/edit listing', 'townhub-add-ons'),
                'args' => array(
                    'default'   => 'single',
                    // 'default_title' => "Pricing Tables",
                    'options' => array(
                        array(
                            'single',
                            __( 'Single Listing', 'townhub-add-ons' ),
                        ),
                    )
                )
            ),


            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'multiple_cat',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Listing can have multiple categories', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'submit_timezone_hide',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Timezone', 'townhub-add-ons'),
            ),

            

            // array(
            //     "type" => "section",
            //     'id' => 'submit_hidefields',
            //     "title" => __( 'Hide Fields. These options is for default free account only and be overrided by current author plan options.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_tags',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Hide Tags', 'townhub-add-ons'),
            //     'desc'  => __('Check this to hide <strong>Tags</strong> field on submit page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_head_background',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Hide Header Background Image type', 'townhub-add-ons'),
            //     'desc'  => __('Check this to hide header <strong>Background Image</strong> type on submit page.', 'townhub-add-ons' ),
            // ),
            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_head_carousel',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Hide Header Carousel type', 'townhub-add-ons'),
            //     'desc'  => __('Check this to hide header <strong>Carousel</strong> type on submit page.', 'townhub-add-ons' ),
            // ),
            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_head_video',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Hide Header Video Background type', 'townhub-add-ons'),
            //     'desc'  => __('Check this to hide header <strong>Video Background</strong> type on submit page.', 'townhub-add-ons' ),
            // ),


            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_content_video',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Hide Promo Video', 'townhub-add-ons'),
            //     'desc'  => __('Check this to hide <strong>Promo Video</strong> option on submit page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_content_gallery',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Hide Thumbnails Gallery', 'townhub-add-ons'),
            //     'desc'  => __('Check this to hide <strong>Thumbnails Gallery</strong> option on submit page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_content_slider',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Hide Slider', 'townhub-add-ons'),
            //     'desc'  => __('Check this to hide <strong>Slider</strong> option on submit page.', 'townhub-add-ons' ),
            // ),




            

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_price_opt',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Price Options', 'townhub-add-ons' ),
            //     'desc'  => __('Check this to hide <strong>Price Options</strong> option on submit/listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_faqs_opt',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide FAQs', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Frequently Asked Questions</strong> option on submit/listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_counter_opt',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Event Counter', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Event Counter</strong> option on submit/listing page.', 'townhub-add-ons' ),
            // ),


            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_workinghours_opt',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Working Hours', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Working Hours</strong> option on submit/listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'submit_hide_socials_opt',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Socials', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Socials</strong> option on submit/listing page.', 'townhub-add-ons' ),
            // ),


            array(
                "type" => "section",
                'id' => 'submit_media_upload',
                "title" => __( 'Media Upload', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'submit_media_limit',
                "title" => __('Media Limit', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '3',
                    'min'  => '1',
                    'max'  => '200',
                    'step'  => '1',
                ),
                'desc'  => __('The maximum number of upload images per field.', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'submit_media_limit_size',
                "title" => __('File Size Limit', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '2',
                    'min'  => '0',
                    'max'  => '100',
                    'step'  => '0.5',
                ),
                'desc'  => __('The maximum upload file size in MB (Megabyte).', 'townhub-add-ons'),
            ),


            // array(
            //     "type" => "section",
            //     'id' => 'submit_content_addfields',
            //     "title" => __( 'Additional Fields', 'townhub-add-ons' ),
            // ),

            // // array(
            // //     "type" => "field",
            // //     "field_type" => "repeat_content",
            // //     'id' => 'content_addfields',
            // //     'args' => array(
            // //         'default'  => '',
            // //     ),
            // //     "title" => __('Content Field', 'townhub-add-ons'),
            // //     // 'desc'  => __('General', 'townhub-add-ons'),
            // // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "repeat_widget",
            //     'id' => 'content_addwidgets',
            //     'args' => array(
            //         'default'  => '',
            //         'load_tmpl' => true
            //     ),
            //     "title" => __('Content Fields', 'townhub-add-ons'),
            //     'desc'  => __('Your fields will be display in single listing content area.', 'townhub-add-ons'),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "repeat_widget",
            //     'id' => 'widget_addwidgets',
            //     'args' => array(
            //         'default'  => '',

            //     ),
            //     "title" => __('Widget Fields', 'townhub-add-ons'),
            //     'desc'  => __('Your fields will be display in single listing widget area.', 'townhub-add-ons'),
            // ),

            array(
                "type" => "section",
                'id' => 'submit_captcha_sec',
                "title" => __( 'Google reCAPTCHA', 'townhub-add-ons' ),
                'callback' => function(){
                    echo sprintf(__( '<p>Get <a href="%s" target="_blank">reCAPTCHA Keys</a></p>', 'townhub-add-ons' ), esc_url('https://www.google.com/recaptcha'));
                    
                }

                

            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'enable_g_recaptcah',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Enable reCAPTCHA', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'g_recaptcha_site_key',
                "title" => __('Site Key', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'g_recaptcha_secret_key',
                "title" => __('Secret key', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),

            array(
                "type" => "section",
                'id' => 'submit_loc_sec',
                "title" => __( 'Listing Location', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'default_country',
                "title" => __('Default Country', 'townhub-add-ons'),
                'args'=> array(
                    'default'       => 'US',
                    'options'       => townhub_addons_get_google_contry_codes(),
                    'use-select2'   => true
                ),
                'desc' => __( 'Default country for listing location.', 'townhub-add-ons' )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'location_show_state',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show Listing Location State', 'townhub-add-ons'),  
                'desc'  => '',
            ),
                

        ),
        // end tab array
        'search' => array(

            array(
                "type" => "section",
                'id' => 'search_category_opts',
                "title" => __( 'Category Options', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'search_cat_level',
                "title" => __('Category Level', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> '0',
                    'options'=> array(
                        '0' => esc_html__('1 Level', 'townhub-add-ons'), 
                        '1' => esc_html__('2 Level', 'townhub-add-ons'), 
                        '2' => esc_html__('3 Level', 'townhub-add-ons'), 
                        '3' => esc_html__('4 Level', 'townhub-add-ons'), 
                        '4' => esc_html__('5 Level', 'townhub-add-ons'), 
                    ),
                ),
                'desc' => esc_html__("Max category level display on search form.", 'townhub-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'search_load_subcat',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Load Sub-Cat', 'townhub-add-ons'),
                'desc' => esc_html__("Load sub categories for filter.", 'townhub-add-ons'), 

            ),

            

            array(
                "type" => "section",
                'id' => 'search_taxonomy_opts',
                "title" => __( 'Taxonomy Options', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'search_include_tag',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Include Tag', 'townhub-add-ons'),
                'desc' => esc_html__("Include listing tag for search value", 'townhub-add-ons'), 

            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'search_tax_relation',
                "title" => __('Taxonomy Relation', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'AND',
                    'options'=> array(
                        'AND' => esc_html__('AND', 'townhub-add-ons'), 
                        'OR' => esc_html__('OR', 'townhub-add-ons'), 
                        
                    ),
                ),
                'desc' => esc_html__("The logical relationship between each inner taxonomy.", 'townhub-add-ons'), 
            ),

            array(
                "type" => "section",
                'id' => 'search_distance_opts',
                "title" => __( 'Distance Options', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'distance_min',
                "title" => __('Distance Search Min (kilometer)', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '2',
                    'min'  => '0',
                    'max'  => '40000',
                    'step'  => '1',
                ),
                // 'desc'  => __('Timezone offset value from UTC', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'distance_max',
                "title" => __('Distance Search Max (kilometer)', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '20',
                    'min'  => '1',
                    'max'  => '40000',
                    'step'  => '1',
                ),
                // 'desc'  => __('Timezone offset value from UTC', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'distance_df',
                "title" => __('Distance Search Default (kilometer)', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '10',
                    'min'  => '1',
                    'max'  => '40000',
                    'step'  => '1',
                ),
                // 'desc'  => __('Timezone offset value from UTC', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'distance_miles',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Use miles instead', 'townhub-add-ons'),  
                'desc'  => __( 'You also need translate km text to miles', 'townhub-add-ons' ),
            ),



            array(
                "type" => "section",
                'id' => 'search_filter_opts',
                "title" => __( 'Filter Options', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_string',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Filter String', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_loc',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Location', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_cat',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Category', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_address',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Address', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_event_date',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Event Date', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_event_time',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Event Time', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_open_now',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Open Now', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_price_range',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Price Range', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'filter_hide_sortby',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Sort By', 'townhub-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "lfeatures",
                'id' => 'filter_features',
                'args'=> array(
                    'default' => array(),
                    // 'hide_empty'    => true, // default is true
                ),
                "title" => __('Features', 'townhub-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "cth_tags",
                'id' => 'filter_ltags',
                'args'=> array(
                    'default' => array(),
                    'hide_empty'    => true,
                ),
                "title" => __('Tags Filter', 'townhub-add-ons'),
                'desc' => '', 

            ),
            

        ),
        // end tab array
        'listings' => array(



            

            array(
                "type" => "section",
                'id' => 'listings_archive_sec',
                "title" => __( 'Archive Layout', 'townhub-add-ons' ),
                'desc' => __("For listing search, category, location, feature pages.", 'townhub-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'llayout',
                "title" => __('Layout', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'column-map',
                    'options'=> array(
                        'column-map' => esc_html__('Column Map', 'townhub-add-ons'), 
                        'column-map-filter' => esc_html__('Column Map/Side-Filter', 'townhub-add-ons'), 
                        'full-map' => esc_html__('Fullwidth Map', 'townhub-add-ons'), 
                        'full-map-filter' => esc_html__('Fullwidth Map/Side-Filter', 'townhub-add-ons'), 
                        'no-map' => esc_html__('Without Map', 'townhub-add-ons'), 
                        'no-map-filter' => esc_html__('Without Map/Side-Filter', 'townhub-add-ons'), 
                    ),
                ),
                'desc' => esc_html__("Select listings page layout", 'townhub-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'show_lheader',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Header', 'townhub-add-ons'),
                'desc' => __('For <strong>Without Map</strong> layouts only', 'townhub-add-ons'),

            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'lheader_title',
                "title" => __('Listings head title', 'townhub-add-ons'),
                'desc' => __('For <strong>Without Map</strong> layouts only', 'townhub-add-ons'),
                'args' => array(
                    'default' => 'Our Listings',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'lheader_intro',
                "title" => __('Listings head info', 'townhub-add-ons'),
                'desc' => __('For <strong>Without Map</strong> layouts only', 'townhub-add-ons'),
                'args' => array(
                    'default' => '<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>',
                )
            ),
            
            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'lheader_bg',
                "title" => __('Header Background', 'townhub-add-ons'),
                'desc' => __('For <strong>Without Map</strong> layouts only', 'townhub-add-ons'),
            ),


            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'map_pos',
                "title" => __('Map Position', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'right',
                    'options'=> array(
                        'top' => esc_html__('Top', 'townhub-add-ons'), 
                        'left' => esc_html__('Left', 'townhub-add-ons'), 
                        'right' => esc_html__('Right', 'townhub-add-ons'), 
                        'hide' => esc_html__('Hide', 'townhub-add-ons'), 
                    ),
                ),
                'desc' => esc_html__("Select Google Map position", 'townhub-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'filter_pos',
                "title" => __('Filter Position', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'top',
                    'options'=> array(
                        'top' => esc_html__('Top', 'townhub-add-ons'), 
                        'left' => esc_html__('Left', 'townhub-add-ons'), 
                        'right' => esc_html__('Right', 'townhub-add-ons'), 
                        'left_col' => esc_html__('Column Left', 'townhub-add-ons'), 
                    ),
                ),
                'desc' => esc_html__("Select Listing Filter position", 'townhub-add-ons'), 
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'columns_grid',
                "title" => __('Columns Grid', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'two',
                    'options'=> array(
                        'one' => esc_html__('One Column', 'townhub-add-ons'), 
                        'two' => esc_html__('Two Columns', 'townhub-add-ons'), 
                        'three' => esc_html__('Three Columns', 'townhub-add-ons'), 
                        'four' => esc_html__('Four Columns', 'townhub-add-ons'), 
                        'five' => esc_html__('Five Columns', 'townhub-add-ons'), 
                        'six' => esc_html__('Six Columns', 'townhub-add-ons'), 
                    ),
                ),
                'desc' => '', 
            ),


            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listings_grid_layout',
                "title" => __('Default Layout', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'grid',
                    'options'=> array(
                        'grid' => esc_html__('Grid View', 'townhub-add-ons'), 
                        'list' => esc_html__('List View', 'townhub-add-ons'), 
                        
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listings_orderby',
                "title" => __('Order Listings by', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> townhub_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listings_order',
                "title" => __('Sort Order', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'townhub-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'townhub-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'listings_count',
                "title" => __('Listings per page', 'townhub-add-ons'),
                'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '6',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'excerpt_length',
                "title" => __('Excerpt Characters Length', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '55',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'listing_event_date',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Event Date', 'townhub-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'grid_wkhour',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Status', 'townhub-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'grid_price',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Price', 'townhub-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'grid_price_range',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Price Range', 'townhub-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'grid_viewed_count',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Viewed Count', 'townhub-add-ons'),
                'desc' => '', 

            ),

            

            

            array(
                "type" => "section",
                'id' => 'listings_search_sec',
                "title" => __( 'Listing Search Page', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'search_infor_before',
                "title" => __('Information Before', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'search_infor_after',
                "title" => __('Information After', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'default' => '',
                )
            ),

        ),
        // end tab array
        'ads' => array(
            // sidebar
            // archive
            // category
            // search
            // home
            // custom_grid

            array(
                "type" => "section",
                'id' => 'ads_sec_archive',
                "title" => __( 'Listings Archive Page AD', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_archive_enable',
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __( 'ADs on the page', 'townhub-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_archive_count',
                "title" => __('Count', 'townhub-add-ons'),
                'desc'  => __( 'Number of ads to show', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_archive_orderby',
                "title" => __('Order AD by', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> townhub_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_archive_order',
                "title" => __('Sort Order', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'townhub-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'townhub-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "section",
                'id' => 'ads_sec_category',
                "title" => __( 'Listings Category Page AD', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_category_enable',
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __( 'ADs on the page', 'townhub-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_category_count',
                "title" => __('Count', 'townhub-add-ons'),
                'desc'  => __( 'Number of ads to show', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_category_orderby',
                "title" => __('Order AD by', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> townhub_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_category_order',
                "title" => __('Sort Order', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'townhub-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'townhub-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "section",
                'id' => 'ads_sec_search',
                "title" => __( 'Listings Search Page AD', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_search_enable',
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __( 'ADs on the page', 'townhub-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_search_count',
                "title" => __('Count', 'townhub-add-ons'),
                'desc'  => __( 'Number of ads to show', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_search_orderby',
                "title" => __('Order AD by', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> townhub_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_search_order',
                "title" => __('Sort Order', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'townhub-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'townhub-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),


            array(
                "type" => "section",
                'id' => 'ads_sec_sidebar',
                "title" => __( 'Listing Sidebar Page AD', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_sidebar_enable',
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __( 'ADs on the page', 'townhub-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_sidebar_count',
                "title" => __('Count', 'townhub-add-ons'),
                'desc'  => __( 'Number of ads to show', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_sidebar_orderby',
                "title" => __('Order AD by', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> townhub_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_sidebar_order',
                "title" => __('Sort Order', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'townhub-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'townhub-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "section",
                'id' => 'ads_sec_home',
                "title" => __( 'Elementor Listings Slider AD', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_home_enable',
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __( 'ADs on Listings Slider', 'townhub-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_home_count',
                "title" => __('Count', 'townhub-add-ons'),
                'desc'  => __( 'Number of ads to show', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_home_orderby',
                "title" => __('Order AD by', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> townhub_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_home_order',
                "title" => __('Sort Order', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'townhub-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'townhub-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

            




            array(
                "type" => "section",
                'id' => 'ads_sec_custom_grid',
                "title" => __( 'Elementor Listings Grid AD', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'ads_custom_grid_enable',
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __( 'ADs on Listings Grid', 'townhub-add-ons' ),
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'ads_custom_grid_count',
                "title" => __('Count', 'townhub-add-ons'),
                'desc'  => __( 'Number of ads to show', 'townhub-add-ons' ),
                'args' => array(
                    'default' => '2',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_custom_grid_orderby',
                "title" => __('Order AD by', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'date',
                    'options'=> townhub_addons_get_post_orderby(),
                ),
                'desc' => '', 
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'ads_custom_grid_order',
                "title" => __('Sort Order', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'DESC',
                    'options'=> array(
                        'ASC' => __( 'Ascending order - (1, 2, 3; a, b, c)', 'townhub-add-ons' ),
                        'DESC' => __( 'Descending order - (3, 2, 1; c, b, a)', 'townhub-add-ons' ),
                    ),
                ),
                'desc' => '', 
            ),

        ),
        // end tab array
        'single' => array(
            array(
                "type" => "section",
                'id' => 'single_thumbnail',
                "title" => __( 'Thumbnail', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'enable_img_click',
                "title" => __('Enable Thumbnail Click', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => 'yes',
                    'default' => 'no',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'default_thumbnail',
                "title" => __('Default Thumbnail', 'townhub-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "section",
                'id' => 'single_section_1',
                "title" => __( 'Rating', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_show_rating',
                "title" => __('Show Rating', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => '1',
                    'default' => '1',
                )
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'show_score_rating',
                "title" => __('Show Review Score total', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => '1',
                    'default' => '1',
                )
            ),



            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'rating_base',
                "title" => __('Rating System', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> '5',
                    'options'=> array(
                        '5' => esc_html__('Five Stars', 'townhub-add-ons'), 
                        '10' => esc_html__('Ten Stars', 'townhub-add-ons'), 
                        
                    ),
                ),
                'desc' => '', 
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'allow_rating_imgs',
                "title" => __('Rating Allow Images', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => 'yes',
                    'default' => 'yes',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'approve_booked_comment',
                "title" => __('Approve comment from users booked listing?', 'townhub-add-ons'),
                'desc'  => '',
                'args' => array(
                    'value' => 'yes',
                    'default' => 'no',
                )
            ),

            array(
                "type" => "section",
                'id' => 'single_feature',
                "title" => __( 'Features', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'feature_parent_group',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Group by parent', 'townhub-add-ons'),
                'desc' => '', 

            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_post_nav',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Show Next/Prev post Nav', 'townhub-add-ons'),
                'desc' => '', 

            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'single_same_term',
                'args'=> array(
                    'default' => '0',
                    'value' => '1',
                ),
                "title" => esc_html__('Next/Prev posts should be in same category', 'townhub-add-ons'),
                'desc' => '', 

            ),

            // array(
            //     "type" => "section",
            //     'id' => 'single_view_options',
            //     "title" => __( 'Show/Hide Content Widgets', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_contacts_info',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Contact Details', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Contact Details</strong> on header/location widget on listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_author_info',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Author Info', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide listing author info on listing page.', 'townhub-add-ons' ),
            // ),


            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_wkhour_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Working Hours', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Working Hours</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),
            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_counter_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Event Counter', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Event Counter</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),
            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_pricerange_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Price Range', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Price Range</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_booking_form_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Booking Form', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Booking Form</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_weather_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Weather', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Weather</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),

            

            
            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_addfeatures_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Additional Features', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Additional Features</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_contacts_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Location / Contacts', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Location / Contacts</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_author_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide Listing Author', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>Listing Author</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'single_hide_moreauthor_widget',
            //     'args'=> array(
            //         'default' => 'no',
            //         'value' => 'yes',
            //     ),
            //     "title" => esc_html__('Hide More from Author', 'townhub-add-ons' ),
            //     'desc'          => __('Check this to hide <strong>More from Author</strong> widget on listing page.', 'townhub-add-ons' ),
            // ),

            array(
                "type" => "section",
                'id' => 'single_claim_opts',
                "title" => __( 'Listing Claim', 'townhub-add-ons' ),
                'callback' => function(){
                    echo sprintf(__( '<p>Read <a href="%s" target="_blank">Claim Listing</a> document for more details.</p>', 'townhub-add-ons' ), esc_url('https://docs.cththemes.com/docs/advance-features/claim-listing/'));
                    
                }
            ),

            

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'approve_claim_after_paid',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => esc_html__('Auto Approved', 'townhub-add-ons' ),
                'desc'          => __('Check this to make listing claim auto approved after paid.', 'townhub-add-ons' ),
            ),

        ),
        // end tab array
        'gmap' => array(

            
            array(
                "type" => "section",
                'id' => 'gmap_osm_sec',
                "title" => __( 'OpenStreetMap', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'use_osm_map',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Use Free OpenStreetMap Instead', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "section",
                'id' => 'gmap_section_1',
                "title" => __( 'Google API', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_api_key',
                "title" => __('Google Map API Key', 'townhub-add-ons'),
                'desc'  => sprintf( __( 'You have to enter your API key to use google map feature. Required services: <b>Google Places API Web Service</b>, <b>Google Maps JavaScript API</b>, <b>Google Maps Geocoding API</b> and <b>Street View Static API</b> for street view.<br><a href="%s" target="_blank">Get Your Key</a>', 'townhub-add-ons' ), esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key' ) ),
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'gmap_type',
                "title" => __('Google Map Type', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'ROADMAP',
                    'options'=> array(
                        "ROADMAP" => __('ROADMAP - default 2D map','townhub-add-ons'), 
                        "SATELLITE" => __('SATELLITE - photographic map','townhub-add-ons'), 
                        "HYBRID" => __('HYBRID - photographic map + roads and city names','townhub-add-ons'), 
                        "TERRAIN" => __('TERRAIN - map with mountains, rivers, etc','townhub-add-ons'), 
                        
                    ),
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'google_map_language',
                "title" => __('Google Map Language Code', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> '',
                ),
                'desc'  => sprintf( __( 'Leave this empty for user location or browser settings value. Available value at <a href="%s" target="_blank">Google Supported Languages</a>', 'townhub-add-ons' ), 'https://developers.google.com/maps/faq#languagesupport'),
            ),

            


            array(
                "type" => "section",
                'id' => 'gmap_section_geolocation',
                "title" => __( 'Place Autocomplete', 'townhub-add-ons' ),
            ),
            // https://developers.google.com/places/web-service/supported_types#table2
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'listing_location_result_type',
                "title" => __('Listing Location Type', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'administrative_area_level_1',
                    'options'=> array(
                        "locality" => __('Locality','townhub-add-ons'), 
                        "sublocality" => __('Sublocality','townhub-add-ons'), 
                        "postal_code" => __('Postal Code','townhub-add-ons'), 
                        "country" => __('Country','townhub-add-ons'), 
                        "administrative_area_level_1" => __('City','townhub-add-ons'), 
                        "administrative_area_level_2" => __('District','townhub-add-ons'),
                    ),
                )
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'listing_address_format',
                "title" => __('Or Define Your Address Format', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'formatted_address',
                ),
                'desc'  => sprintf( __( 'Define address format will received when user using google autocomplete place service. Address types separated by comma. Available types at <a href="%s" target="_blank">Google Address Types</a>', 'townhub-add-ons' ), 'https://developers.google.com/maps/documentation/geocoding/intro#Types'). '<br>'.__( 'Using <strong>formatted_address</strong> for Google formated address.', 'townhub-add-ons' ),
            ),



            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'country_restrictions',
                "title" => __('Restriction Countries', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> '',
                    'options'=> townhub_addons_get_google_contry_codes(),
                    'multiple' => true,
                    'use-select2' => true
                ),
                'desc' => __( 'Type to search. Restrict the search to a specific countries. Leave empty for all. ', 'townhub-add-ons' )
            ),

            array(
                "type" => "section",
                'id' => 'gmap_section_listings',
                "title" => __( 'Listings Map', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_default_lat',
                'args'=> array(
                    'default'=> '40.7',
                ),
                "title" => __('Default Latitude', 'townhub-add-ons'),
                'desc'  => sprintf( __( 'Enter your address latitude - default: 40.7. You can get value from this <a href="%s" target="_blank">website</a>', 'townhub-add-ons' ), esc_url('http://www.gps-coordinates.net/' ) ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_default_long',
                'args'=> array(
                    'default'=> '-73.87',
                ),
                "title" => __('Default Longtitude', 'townhub-add-ons'),
                'desc'  => sprintf( __( 'Enter your address longtitude - default: -73.87. You can get value from this <a href="%s" target="_blank">website</a>', 'townhub-add-ons' ), esc_url('http://www.gps-coordinates.net/' ) ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_default_zoom',
                'args'=> array(
                    'default'=> '10',
                ),
                "title" => __('Default Zoom', 'townhub-add-ons'),
                'desc'  => __('Default map zoom level, max: 18', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'gmap_single_zoom',
                'args'=> array(
                    'default'=> '16',
                ),
                "title" => __('Single Map Zoom', 'townhub-add-ons'),
                'desc'  => __('Default map zoom level for single page, max: 18', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'use_dfmarker',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Disable Featured marker', 'townhub-add-ons'),
                'desc'  => __('Use bellow marker instead of listing Featured image marker. Can be configured based on category.', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'gmap_marker',
                "title" => __('Map Marker', 'townhub-add-ons'),
                // 'args'=> array(
                //     'default'=> array(
                //         'url' => ESB_DIR_URL ."assets/images/marker.png"
                //     )
                // ),
                
                'desc'  => ''
            ),

            array(
                "type" => "section",
                'id' => 'map_card_opts',
                "title" => __( 'Map Card Options', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'map_card_hide_status',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Hide Open/Closed status', 'townhub-add-ons'),
                'desc'  => '',
            ),

            // get map data on marker
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'unfill_address',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Drag map marker does not fill address', 'townhub-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'unfill_state',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Drag map marker does not fill state', 'townhub-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'unfill_city',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Drag map marker does not fill city', 'townhub-add-ons'),
                'desc'  => '',
            ),
        ),
        // end tab array
        'booking' => array(
            array(
                "type" => "section",
                'id' => 'booking_sec_1',
                "title" => __( 'General', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_clock_24h',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Use 24-hour format', 'townhub-add-ons'),
                'desc'  => '',
            ),
            array(
                "type" => "field",
                "field_type" => "color",
                'id' => 'time_picker_color',
                'args'=> array(
                    'default' => '#4DB7FE',
                ),
                "title" => __('Time picker style color', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "section",
                'id' => 'booking_sec_woo',
                "title" => __( 'WooCommerce Integration', 'townhub-add-ons' ),
            ),

            

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'woo_redirect',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Redirect to WooCommerce cart after submit booking?', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'woo_redirect_zero',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Redirect to WooCommerce for free booking ( total price is zero )?', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'add_cart_delay',
                "title" => __('Add booking to cart delay', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '3000',
                    'min'  => '0',
                    'max'  => '86400000',
                    'step'  => '1000',
                ),
                'desc'  => __('The number of milliseconds to wait before redirecting to cart page when booking success. 0 for immediately redirect.', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_author_woo',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Mark Order as complete', 'townhub-add-ons'),
                'desc'  => __('Whether listing author will also mark WooCommerce order (for selling their booking) as completed when approve booking or not?', 'townhub-add-ons'),
            ),

            array(
                "type" => "section",
                'id' => 'booking_dashboard_sec',
                "title" => __( 'Dashboard Options', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_author_delete',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Author Can Delete Booking', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_del_trash',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Move Deleted Booking to Trash?', 'townhub-add-ons'),
                'desc'  => '',
            ),

            

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'booking_approved_cancel',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Approved Booking Cancelable?', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'bk_show_status',
                "title" => __('Status of booking to show on dashboard', 'townhub-add-ons'),
                'desc'  => '',
                'args'=> array(
                    'default'=> array(),
                    'options'=> array(
                        'pending' => __( 'Pending', 'townhub-add-ons' ),
                        'completed' => __( 'Completed', 'townhub-add-ons' ),
                        'canceled' => __( 'Canceled', 'townhub-add-ons' ),
                        
                    ),
                    'multiple' => true,
                    'use-select2' => true
                )
            ),


            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'bk_count_status',
                "title" => __('Count bookings status', 'townhub-add-ons'),
                'desc'  => __( 'Select booking status will deduct when calculating remaining quantity.', 'townhub-add-ons' ),
                'args'=> array(
                    'default'=> array('pending', 'completed'),
                    'options'=> array(
                        'pending' => __( 'Pending', 'townhub-add-ons' ),
                        'completed' => __( 'Completed', 'townhub-add-ons' ),
                        
                    ),
                    'multiple' => true,
                    'use-select2' => true
                )
            ),

        ),
        // end tab array

        'woocommerce'   => townhub_addons_options_get_woo(),

            


        'payments' => array(
            array(
                "type" => "section",
                'id' => 'payments_sec_general',
                "title" => __( 'General Options', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_test_mode',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Test mode', 'townhub-add-ons'),
                'desc'  => __('While in test mode no live transactions are processed. To fully use test mode, you must have a sandbox (test) account for the payment gateway you are testing.', 'townhub-add-ons'),
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_form',
                "title" => __( 'Submit Form', 'townhub-add-ons' ),
            ),

            
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_form_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this payment method', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_form_details',
                'args'=> array(
                    'default' => '<p>Your payment details will be submitted for review.</p>',
                ),
                "title" => __('Payment description', 'townhub-add-ons'),
                // 'desc'  => __( 'Enter your bank account details', 'townhub-add-ons' ) ,
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_cod',
                "title" => __( 'Cash on delivery', 'townhub-add-ons' ),
            ),

            
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_cod_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this payment method', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_cod_details',
                'args'=> array(
                    'default' => '<p>Your payment details will be submitted. Then pay on delivery.</p>',
                ),
                "title" => __('Payment description', 'townhub-add-ons'),
                // 'desc'  => __( 'Enter your bank account details', 'townhub-add-ons' ) ,
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_bank',
                "title" => __( 'Bank Transfer', 'townhub-add-ons' ),
            ),

            
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_banktransfer_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this payment method', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_banktransfer_details',
                'args'=> array(
                    'default' => '<p>
<strong>Bank name</strong>: Bank of America, NA<br />
<strong>Bank account number</strong>: 0175380000<br />
<strong>Bank address</strong>:USA 27TH Brooklyn NY<br />
<strong>Bank SWIFT code</strong>: BOFAUS 3N<br />
</p>',
                ),
                "title" => __('Bank Account', 'townhub-add-ons'),
                'desc'  => __( 'Enter your bank account details', 'townhub-add-ons' ) ,
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_paypal',
                "title" => __( 'Paypal Payment', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_paypal_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this payment method', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_paypal_desc',
                'args'=> array(
                    'default' => '<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>',
                ),
                "title" => __('Payment description', 'townhub-add-ons'),
                // 'desc'  => __( '', 'townhub-add-ons' ) ,
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_paypal_business',
                'args'=> array(
                    'default'=> 'cththemespp-facilitator@gmail.com',
                ),
                "title"         => __('Paypal Business Email', 'townhub-add-ons'),
                'desc'          => ''
            ),

            array(
                "type" => "section",
                'id' => 'payments_sec_stripe',
                "title" => __( 'Stripe Payment', 'townhub-add-ons' ),
            ),

            

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_stripe_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this payment method', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_stripe_desc',
                'args'=> array(
                    'default' => '<p>Pay via Stripe; you can pay with your credit card.</p>',
                ),
                "title" => __('Payment description', 'townhub-add-ons'),
                // 'desc'  => __( '', 'townhub-add-ons' ) ,
            ),
            array(
                "type" => "section",
                'id' => 'payments_sec_payfast',
                "title" => __( 'Payfast Payment', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_payfast_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this payment method', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'payments_payfast_desc',
                'args'=> array(
                    'default' => '<p>Pay via Payfast; you can pay with your credit card.</p>',
                ),
                "title" => __('Payment description', 'townhub-add-ons'),
                // 'desc'  => __( '', 'townhub-add-ons' ) ,
            ),
            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_payfast_merchant_id',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Payfast merchant id', 'townhub-add-ons'),
                'desc'          => ''
            ),
            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_payfast_merchant_key',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Payfast merchant key', 'townhub-add-ons'),
                'desc'          => ''
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payfast_passphrase',
                "title"         => __('Payfast Merchant passphrase', 'townhub-add-ons'),
                'desc'          => sprintf( __( 'Enter your PayFast passphrase. Learn how to create your <a href="%s">PayFast passphrase</a>.<br /><a href="%s">WooCommerce PayFast Payment Gateway</a>', 'townhub-add-ons' ), 'https://support.payfast.co.za/article/120-how-do-i-enable-a-passphrase-on-my-payfast-account', 'https://docs.woocommerce.com/document/payfast-payment-gateway/' ),
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payfast_rate',
                'args'=> array(
                    'default'=> '13.9893',
                ),
                "title"         => __('ZAR currency rate', 'townhub-add-ons'),
                'desc'          => __('Exchange rates for your current currency to South African Rand ( ZAR )', 'townhub-add-ons'),
            ),

            array(
                "type"          => "field",
                "field_type"    => "checkbox",
                'id'            => 'email_confirmation',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title"         => __('Email Confirmation?', 'townhub-add-ons'),
                'desc'          => __( 'Whether to send email confirmation to the merchant of the transaction.', 'townhub-add-ons' ),
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'confirmation_address',
                "title"         => __( 'Confirmation Email Address', 'townhub-add-ons' ),
                'desc'          => __( 'The address to send the confirmation email to.', 'townhub-add-ons' ),
            ),

            array(
                "type" => "section",
                'id' => 'payments_stripe_apis',
                "title" => __( 'Stripe API Keys - Settings', 'townhub-add-ons' ),
                'callback' => function(){
                    echo sprintf(__( '<p>You can get api keys in <a href="%s" target="_blank">the Dashboard</a></p>', 'townhub-add-ons' ), esc_url('https://dashboard.stripe.com/account/apikeys'));
                    
                }
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_live_secret',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Live Secret Key', 'townhub-add-ons'),
                'desc'          => ''
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_live_public',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Live Publishable Key', 'townhub-add-ons'),
                'desc'          => ''
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_test_secret',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Test Secret Key', 'townhub-add-ons'),
                'desc'          => __( 'For test mode only', 'townhub-add-ons' ),
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'payments_stripe_test_public',
                // 'args'=> array(
                //     'default'=> '',
                // ),
                "title"         => __('Test Publishable Key', 'townhub-add-ons'),
                'desc'          => __( 'For test mode only', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "info",
                'id' => 'payments_stripe_webhook',
                "title" => __('Webhooks End Point', 'townhub-add-ons'),
                'desc'  => sprintf( __( '<p>Webhooks are configured in the <a href="%1$s" target="_blank">Webhooks setting</a> section of the Dashboard.<br>Clicking <strong>Add endpoint</strong> reveals a form to add this URL <span class="webhooks-url">%2$s</span> for receiving webhooks.</p><p><img src="%3$s" class="webhooks-img"></p>', 'townhub-add-ons' ), esc_url('https://dashboard.stripe.com/account/webhooks'), esc_url(home_url('/?action=cth_stripewebhook' ) ), ESB_DIR_URL.'assets/admin/stripe-webhook.png'), 
            ),

            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'stripe_logo',
                "title" => __('Logo', 'townhub-add-ons'),
                'desc'  => __( 'A square image of your brand or product. The recommended minimum size is 128x128px. The supported image types are: <b>.gif</b>, <b>.jpeg</b>, and <b>.png</b>.', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'payments_stripe_use_email',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Use User Email', 'townhub-add-ons'),
                'desc'  => __('Enable this option for using current user email as Stripe checkout email form.', 'townhub-add-ons'),
            ),


            array(
                "type" => "section",
                'id' => 'payments_sec_skrill',
                "title" => __( 'Skrill Payment', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'skrill_enable',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this payment method', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'skrill_desc',
                'args'=> array(
                    'default' => '<p>Pay via Skrill; you can pay with your credit card.</p>',
                ),
                "title" => __('Payment description', 'townhub-add-ons'),
                // 'desc'  => __( '', 'townhub-add-ons' ) ,
            ),
            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'skrill_merchant_email',
                'args'=> array(
                    'default'=> 'demoqco@sun-fish.com',
                ),
                "title"         => __('Skrill merchant email', 'townhub-add-ons'),
                'desc'          => ''
            ),

            array(
                "type"          => "field",
                "field_type"    => "text",
                'id'            => 'skrill_secret_word',
                'args'=> array(
                    'default'=> 'skrill',
                ),
                "title"         => __('Skrill secret wrod', 'townhub-add-ons'),
                'desc'          => __( 'Enter your secret word ( added on Merchant Tools section of the Merchant\’s online Skrill account ).', 'townhub-add-ons' ),
            ),

            
            
        ),
        // end tab array
            


        // end tab array
        'emails' => townhub_addons_options_get_emails(), 
        // end tab array

        'chat'      => array(
            array(
                "type" => "section",
                'id' => 'user_chat_sec',
                "title" => __( 'Author chat', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'admin_chat',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show Chat', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'show_fchat',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Show Chat front-end', 'townhub-add-ons'),
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'messages_first_load',
                "title" => __('First load replies', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '10',
                    'min'  => '-1',
                    'max'  => '200',
                    'step'  => '1',
                ),
                'desc'  => __('Number of replies loading first', 'townhub-add-ons'),
            ),
            // array(
            //     "type" => "field",
            //     "field_type" => "user_select",
            //     'id' => 'user_id_default_contact',
            //     "title" => __('Set user default contact', 'townhub-add-ons'),
            //     'args' => array(
            //         'default'  => 1,
            //         'default_name' => 'admin'
            //     ),
            //     'desc'  => __('User default contact', 'townhub-add-ons'),
            // ),
            
            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'messages_prev_load',
                "title" => __('Previous loading replies', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '5',
                    'min'  => '1',
                    'max'  => '100',
                    'step'  => '1',
                ),
                'desc'  => __('Number of previous replies will load when user scrolling to top.', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'chatbox_message',
                "title" => __('Front-End chat message', 'townhub-add-ons'),
                // 'desc'  => __( 'Number of listings to show on a page (-1 for all)', 'townhub-add-ons' ),
                'args' => array(
                    'default' => 'We are here to help. Please ask us anything or share your feedback',
                )
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox", 
                'id' => 'chat_site_owner',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Allow chat to site owner?', 'townhub-add-ons'),   
                'desc'  => '',
            ),

            array(
                "type" => "field",
                "field_type" => "user_select",
                'id' => 'site_owner_id',
                "title" => __('Site owner account', 'townhub-add-ons'),
                'args' => array(
                    'default'  => 1,
                    'default_name' => 'admin'
                ),
                // 'desc'  => __('User default contact', 'townhub-add-ons'),
            ),
        

        ),
        // end chat tab

        'widgets' => array(


            array(
                "type" => "section",
                'id' => 'mailchimp_sub_section',
                "title" => __( 'Mailchimp Section', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'mailchimp_api',
                "title" => __('Mailchimp API key', 'townhub-add-ons'),
                'desc'  => '<a href="'.esc_url('http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key').'" target="_blank">'.esc_html__('Find your API key','townhub-add-ons' ).'</a>'
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'mailchimp_list_id',
                "title" => __('Mailchimp List ID', 'townhub-add-ons'),
                'desc'  => '<a href="'.esc_url('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id').'" target="_blank">'.esc_html__('Find your list ID','townhub-add-ons' ).'</a>',
            ),
        
            array(
                "type" => "field",
                "field_type" => "info",
                'id' => 'mailchimp_shortcode',
                "title" => __('Subscribe Shortcode', 'townhub-add-ons'),
                'desc'  => wp_kses_post( __('Use the <code><strong>[townhub_subscribe]</strong></code> shortcode  to display subscribe form inside a post, page or text widget.
<br>Available Variables:<br>
<code><strong>message</strong></code> (Optional) - The message above subscription form.<br>
<code><strong>placeholder</strong></code> (Optional) - The form placeholder text.<br>
<code><strong>button</strong></code> (Optional) - The submit button text.<br>
<code><strong>list_id</strong></code> (Optional) - List ID. If you want user subscribe to a different list from the option above.<br>
<code><strong>class</strong></code> (Optional) - Your extraclass used to style the form.<br><br>
Example: <code><strong>[townhub_subscribe list_id="b02fb5f96f" class="your_class_here"]</strong></code>', 'townhub-add-ons') )
                
            ),

            array(
                "type" => "section",
                'id' => 'tweets_section',
                "title" => __( 'Twitter Feeds Section', 'townhub-add-ons' ),
                'callback' => function($arg){ 
                    echo '<p>'.esc_html__('Visit ','townhub-add-ons' ).
                        '<a href="'.esc_url('https://apps.twitter.com' ).'" target="_blank">'.esc_html__("Twitter's Application Management",'townhub-add-ons' ).'</a> '
                        .__('page, sign in with your account, click on Create a new application and create your own keys if you haven\'t one.<br> Fill all the fields bellow with those keys.','townhub-add-ons' ).
                        '</p>';  
                }
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'consumer_key',
                "title" => __('Consumer Key', 'townhub-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'consumer_secret',
                "title" => __('Consumer Secret', 'townhub-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'access_token',
                "title" => __('Access Token', 'townhub-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'access_token_secret',
                "title" => __('Access Token Secret', 'townhub-add-ons'),
                'desc'  => ''
            ),
            array(
                "type" => "field",
                "field_type" => "info",
                'id' => 'tweets_shortcode',
                "title" => __('Access Token Secret', 'townhub-add-ons'),
                'desc'  => wp_kses_post( __('You can use <code><strong>TownHub Twitter Feed</strong></code> widget or  <code><strong>[townhub_tweets]</strong></code> shortcode  to display tweets inside a post, page or text widget.
<br>Available Variables:<br>
<code><strong>username</strong></code> (Optional) - Option to load tweets from another account. Leave this empty to load from your own.<br>
<code><strong>list</strong></code> (Optional) - List name to load tweets from. If you define list name you also must define the <strong>username</strong> of the list owner.<br>
<code><strong>hashtag</strong></code> (Optional) - Option to load tweets with a specific hashtag.<br>
<code><strong>count</strong></code> (Required) - Number of tweets you want to display.<br>
<code><strong>list_ticker</strong></code> (Optional) - Display tweets as a list ticker?. Values: <strong>yes</strong> or <strong>no</strong><br>
<code><strong>follow_url</strong></code> (Optional) - Follow us link.<br>
<code><strong>extraclass</strong></code> (Optional) - Your extraclass used to style the form.<br><br>
Example: <code><strong>[townhub_tweets count="3" username="CTHthemes" list_ticker="no" extraclass="your_class_here"]</strong></code>', 'townhub-add-ons') )
                
            ),
            // api weather
            array(
                "type" => "section",
                'id' => 'weather_api_section',
                "title" => __( 'Weather Section', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'weather_api',
                "title" => __('Weather API key', 'townhub-add-ons'),
                'desc'  => '<a href="'.esc_url('https://openweathermap.org/api').'" target="_blank">'.esc_html__('Find your API key','townhub-add-ons' ).'</a>'
            ),
            // socials share
            array(
                "type" => "section",
                'id' => 'widgets_section_3',
                "title" => __( 'Socials Share', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'widgets_share_names',
                "title" => __('Socials Share', 'townhub-add-ons'),
                'desc'  => __('Enter your social share names separated by a comma.<br> List bellow are available names:<strong><br> facebook,twitter,linkedin,in1,tumblr,digg,googleplus,reddit,pinterest,stumbleupon,email,vk</strong>', 'townhub-add-ons'),
                'args'=> array(
                    'default' => 'facebook, pinterest, googleplus, twitter, linkedin'
                ),
            ),


        ),
        // end tab array

        // end tab array
        'maintenance' => array(
            array(
                "type" => "section",
                'id' => 'maintenance_section_1',
                "title" => __( 'Status', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "radio",
                'id' => 'maintenance_mode',
                "title" => __('Mode', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'disable',
                    'options'=> array(
                        'disable' => __( 'Disable', 'townhub-add-ons' ),
                        'maintenance' => __( 'Maintenance', 'townhub-add-ons' ),
                        'coming_soon' => __( 'Coming Soon', 'townhub-add-ons' ),
                    ),
                    'options_block' => true
                )
            ),
            array(
                "type" => "section",
                'id' => 'maintenance_section_2',
                "title" => __( 'Maintenance Options', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'maintenance_msg',
                "title" => __('Message', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '<h3 class="soon-title">We\'ll be right back!</h3>
<p>We are currently performing some quick updates. Leave us your email and we\'ll let you know as soon as we are back up again.</p>
[townhub_subscribe message=""]
<div class="cs-social fl-wrap">
<ul>
<li><a href="#" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>
<li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-chrome"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-vk"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-whatsapp"></i></a></li>
</ul>
</div>',
                ),
                'desc'  => ''
            ),

            array(
                "type" => "section",
                'id' => 'maintenance_section_3',
                "title" => __( 'Coming Soon Options', 'townhub-add-ons' ),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'coming_soon_msg',
                "title" => __('Message', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '<h3 class="soon-title">Our website is coming soon!</h3>',
                ),
                'desc'  => ''
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'coming_soon_date',
                "title" => __('Coming Soon Date', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '09/12/2021',
                ),
                'desc'  => __('The date should be DD/MM/YYYY format. Ex: 09/12/2021', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'coming_soon_time',
                "title" => __('Coming Soon Time', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '10:30:00',
                ),
                'desc'  => __('The time should be hh:mm:ss format. Ex: 10:30:00', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "number",
                'id' => 'coming_soon_tz',
                "title" => __('Timezone Offset', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '0',
                    'min'  => '-12',
                    'max'  => '14',
                    'step'  => '1',
                ),
                'desc'  => __('Timezone offset value from UTC', 'townhub-add-ons'),
            ),
            array(
                "type" => "field",
                "field_type" => "textarea",
                'id' => 'coming_soon_msg_after',
                "title" => __('Message After', 'townhub-add-ons'),
                'args' => array(
                    'default'  => '[townhub_subscribe]
<div class="cs-social fl-wrap">
<ul>
<li><a href="#" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>
<li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-chrome"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-vk"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-whatsapp"></i></a></li>
</ul>
</div>',
                ),
                'desc'  => ''
            ),

            array(
                "type" => "field",
                "field_type" => "image",
                'id' => 'coming_soon_bg',
                "title" => __('Background', 'townhub-add-ons'),
                'desc'  => ''
            ),


        ),
        // end tab array



    );
}