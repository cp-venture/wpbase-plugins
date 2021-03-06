<?php
/* add_ons_php */

defined('ABSPATH') || exit;

class Esb_Class_Frontend_Scripts
{

    private static $plugin_url;

    public static function init()
    {
        self::$plugin_url = plugin_dir_url(ESB_PLUGIN_FILE);
        // hide admin bar front-end

        add_action('wp_enqueue_scripts', array(get_called_class(), 'enqueue_scripts'));
        // withdrawal
        // earning - user meta
    }
    private static function enqueue_react_libraries()
    {
        wp_enqueue_script('react', self::$plugin_url . "assets/js/react.production.min.js", array(), null, true);
        wp_enqueue_script('react-dom', self::$plugin_url . "assets/js/react-dom.production.min.js", array(), null, true);
        wp_enqueue_script('react-router-dom', self::$plugin_url . "assets/js/react-router-dom.min.js", array(), null, true);
        // wp_enqueue_script('redux', self::$plugin_url . "assets/js/redux.min.js", array(), null, true);
        // wp_enqueue_script('react-redux', self::$plugin_url . "assets/js/react-redux.min.js", array(), null, true);
        // wp_enqueue_script('redux-thunk', self::$plugin_url . "assets/js/redux-thunk.min.js", array(), null, true);
        // wp_enqueue_script('qs', self::$plugin_url . "assets/js/qs.js", array(), null, true);
        // wp_enqueue_script('axios', self::$plugin_url . "assets/js/axios.min.js", array(), null, true);

        // for submit page only
        // wp_enqueue_script('Sortable', self::$plugin_url . "assets/js/Sortable.min.js", array(), null, true);
        // wp_enqueue_script('react-sortable', self::$plugin_url . "assets/js/react-sortable.min.js", array(), null, true);
    }
    private static function enqueue_redux_libraries()
    {
        
        wp_enqueue_script('redux', self::$plugin_url . "assets/js/redux.min.js", array(), null, true);
        wp_enqueue_script('react-redux', self::$plugin_url . "assets/js/react-redux.min.js", array(), null, true);
        wp_enqueue_script('redux-thunk', self::$plugin_url . "assets/js/redux-thunk.min.js", array(), null, true);
        wp_enqueue_script('qs', self::$plugin_url . "assets/js/qs.js", array(), null, true);
        wp_enqueue_script('axios', self::$plugin_url . "assets/js/axios.min.js", array(), null, true);

    }
    public static function enqueue_scripts()
    {
        global $wp_query;
        // global $post;
        // wp_enqueue_style( 'daterangepicker-css', self::$plugin_url ."assets/css/daterangepicker.css", array(  ), null );
        // wp_enqueue_style('select2', self::$plugin_url . "assets/css/select2.min.css", false);
        // wp_enqueue_style( 'jscrollpane' , self::$plugin_url ."assets/css/jquery.jscrollpane.css", false );
        if ( is_page(esb_addons_get_wpml_option('dashboard_page')) || is_page(esb_addons_get_wpml_option('submit_page')) || is_page(esb_addons_get_wpml_option('edit_page')) ) {
            wp_enqueue_style('townhub-addons-dashboard', self::$plugin_url . "assets/css/townhub-dashboard.min.css", false);
        }
        wp_enqueue_style('townhub-addons', self::$plugin_url . "assets/css/townhub-add-ons.min.css", false);

        if (townhub_addons_get_option('azp_css_external') == 'yes') {
            $upload     = wp_upload_dir();
            $upload_url = $upload['baseurl'];
            wp_enqueue_style('listing_types', $upload_url . "/azp/css/listing_types.css", false);
        } else {
            $azp_csses = Esb_Class_Listing_Type_CPT::get_azp_css();
            wp_add_inline_style('townhub-addons', $azp_csses);
        }

        wp_enqueue_script('townhub-addons-plugins', self::$plugin_url . "assets/js/plugins.js", array(), null, true);
        // wp_enqueue_script( 'backbone.marionette', $this->plugin_url ."assets/js/backbone.marionette.min.js" , array('jquery','backbone','underscore'), null , true );
        // wp_enqueue_script( 'jquery.selectbox', $this->plugin_url ."assets/js/jquery.selectbox.min.js" , array(), null , true );
        // wp_enqueue_script("moment-js", self::$plugin_url . "assets/js/moment.min.js", array(), null, true);
        // wp_enqueue_script("daterangepicker-js", self::$plugin_url ."assets/js/daterangepicker.js" , array(), null , true);
        // wp_enqueue_script('select2', self::$plugin_url . "assets/js/select2.min.js", array('jquery'), null, true);
        // wp_enqueue_script('mousewheel', self::$plugin_url . "assets/js/jquery.mousewheel.js", array(), null, true);
        // wp_enqueue_script( 'jscrollpane', self::$plugin_url ."assets/js/jquery.jscrollpane.min.js" , array(), null , true );

        $gmap_api_key        = townhub_addons_get_option('gmap_api_key');
        $google_map_language = townhub_addons_get_option('google_map_language') ? '&language=' . townhub_addons_get_option('google_map_language') : '';

        if (townhub_addons_get_option('use_osm_map') == 'yes') {
            wp_enqueue_style('openlayers', self::$plugin_url . "assets/css/ol.css", false);
            wp_enqueue_script('openlayers', self::$plugin_url . "assets/js/ol.js", array(), null, true);

            wp_enqueue_style('mapbox-gl-js', self::$plugin_url . "assets/css/mapbox-gl.css", false);
            wp_enqueue_script('mapbox-gl-js', self::$plugin_url . "assets/js/mapbox-gl.js", array(), null, true);

        } else {
            wp_enqueue_script("googleapis", "https://maps.googleapis.com/maps/api/js?key=$gmap_api_key&libraries=places$google_map_language", array(), false, true);
            wp_enqueue_script('infobox', self::$plugin_url . "assets/js/infobox.js", array('googleapis'), null, true);
            wp_enqueue_script('markerclusterer', self::$plugin_url . "assets/js/markerclusterer.min.js", array('googleapis'), null, true);
            wp_enqueue_script('oms', self::$plugin_url . "assets/js/oms.min.js", array(), null, true);
        }

        if (townhub_addons_must_enqueue_media()) {
            wp_enqueue_media();
        }

        // wp_enqueue_script('chart.js', self::$plugin_url . "assets/js/Chart.js", array(), null, true);
        // https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
        wp_enqueue_script('townhub-addons', self::$plugin_url . "assets/js/townhub-add-ons.min.js", array( 'underscore', 'masonry', 'jquery-ui-sortable'), null, true);

        // AIzaSyChCXNJOoVajjJ1KvF3g0kq63yb5KQLPMA

        // wp_enqueue_script( 'townhub-app', self::$plugin_url ."assets/js/townhub-app.js" , array('backbone.marionette','jquery.selectbox','townhub-gmap'), null , true );

        $gmap_marker    = townhub_addons_get_option('gmap_marker');
        $curr_user_data = array(
            'id'           => 0,
            'display_name' => '',
            'avatar'       => '',
            'can_upload'   => false,

            'role'         => false,
            'is_author'    => false,
        );

        if (is_user_logged_in()) {
            $current_user   = wp_get_current_user();
            $curr_user_data = array(
                'id'           => $current_user->ID,
                'display_name' => $current_user->display_name,
                'avatar'       => get_avatar($current_user->user_email, '150', 'https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=150', $current_user->display_name),

                'can_upload'   => current_user_can('upload_files'),
                'role'         => townhub_addons_get_user_role(),
                'is_author'    => Esb_Class_Membership::is_author(),
                // 'is_author'         => true,
            );
        }
        $checkout_page_id = esb_addons_get_wpml_option('checkout_page');
        $_townhub_add_ons = array(
            'url'                  => esc_url(admin_url('admin-ajax.php')),
            'nonce'                => wp_create_nonce('townhub-add-ons'),
            'posted_on'            => __('Posted on ', 'townhub-add-ons'),
            'reply'                => __('Reply', 'townhub-add-ons'),
            'retweet'              => __('Retweet', 'townhub-add-ons'),
            'favorite'             => __('Favorite', 'townhub-add-ons'),
            'pl_w'                 => __('Please wait...', 'townhub-add-ons'),
            'like'                 => esc_html__('Like', 'townhub-add-ons'),
            'unlike'               => esc_html__('Unlike', 'townhub-add-ons'),
            
            'use_dfmarker'         => townhub_addons_get_option('use_dfmarker') == 'yes' ? true : false,
            'marker'               => !empty( $gmap_marker['id'] )? wp_get_attachment_url($gmap_marker['id']) : ESB_DIR_URL . "assets/images/marker.png",
            'center_lat'           => floatval(townhub_addons_get_option('gmap_default_lat')),
            'center_lng'           => floatval(townhub_addons_get_option('gmap_default_long')),
            'map_zoom'             => townhub_addons_get_option('gmap_default_zoom'),
            'socials'              => townhub_addons_get_socials_list(),
            'gmap_type'            => townhub_addons_get_option('gmap_type'),
            'login_delay'          => townhub_addons_get_option('login_delay'),
            // 'files'                => townhub_addons_cont_fiels_select(),
            // 'features'             => townhub_addons_get_listing_features(),
            'listing_type_opts'    => Esb_Class_Membership::author_listing_types(),
            'chatbox_message'      => townhub_addons_get_option('chatbox_message'),
            // 'submit_timezone_hide' => townhub_addons_get_option('submit_timezone_hide'),
            // 'working_days'         => Esb_Class_Date::week_days(),
            // 'working_hours'        => Esb_Class_Date::wkhours_select(),
            // 'timezones'            => townhub_addons_generate_timezone_list(),
            // 'timezone'             => get_option('timezone_string', 'Europe/London'),
            'post_id'              => get_queried_object_id(),
            'ckot_url'             => esc_url(get_permalink($checkout_page_id)),

            'location_type'        => townhub_addons_get_option('listing_location_result_type'),
            'address_format'       => array_filter(explode(",", townhub_addons_get_option('listing_address_format'))),
            'country_restrictions' => townhub_addons_get_option('country_restrictions'),

            'place_lng'            => townhub_addons_get_option('google_map_language') ? townhub_addons_get_option('google_map_language') : '',

            'disable_bubble'       => townhub_addons_get_option('disable_bubble', 'no'),

            // 'filter_subcats'    => townhub_addons_get_option('search_load_subcat'),

            'lb_approved'          => __('Approved', 'townhub-add-ons'),

            'lb_24h'               => townhub_addons_get_option('booking_clock_24h') == 'yes' ? true : false,
            'td_color'             => townhub_addons_get_option('time_picker_color'),
            'lb_delay'             => townhub_addons_get_option('add_cart_delay'),
            'md_limit'             => townhub_addons_get_option('submit_media_limit'),
            'md_limit_msg'         => sprintf(__('Max upload files is %s', 'townhub-add-ons'), townhub_addons_get_option('submit_media_limit')),
            'md_limit_size'        => townhub_addons_get_option('submit_media_limit_size'),
            'md_limit_size_msg'    => sprintf(__('Max upload file size is %s MB', 'townhub-add-ons'), townhub_addons_get_option('submit_media_limit_size')),

            'search'               => __('Search...', 'townhub-add-ons'),

            'gcaptcha'             => (townhub_addons_get_option('enable_g_recaptcah') == 'yes' && townhub_addons_get_option('g_recaptcha_site_key') != '') ? true : false,
            'gcaptcha_key'         => townhub_addons_get_option('g_recaptcha_site_key'),
            'location_show_state'  => townhub_addons_get_option('location_show_state'),
            
            'weather_strings'      => array(
                'days'      => array(
                    _x('Sunday', 'weather widget', 'townhub-add-ons'),
                    _x('Monday', 'weather widget', 'townhub-add-ons'),
                    _x('Tuesday', 'weather widget', 'townhub-add-ons'),
                    _x('Wednesday', 'weather widget', 'townhub-add-ons'),
                    _x('Thursday', 'weather widget', 'townhub-add-ons'),
                    _x('Friday', 'weather widget', 'townhub-add-ons'),
                    _x('Saturday', 'weather widget', 'townhub-add-ons'),
                ),
                'min'       => _x('Min', 'weather widget', 'townhub-add-ons'),
                'max'       => _x('Max', 'weather widget', 'townhub-add-ons'),
                'direction' => array(
                    _x('N', 'wind direction', 'townhub-add-ons'),
                    _x('NNE', 'wind direction', 'townhub-add-ons'),
                    _x('NE', 'wind direction', 'townhub-add-ons'),
                    _x('ENE', 'wind direction', 'townhub-add-ons'),
                    _x('E', 'wind direction', 'townhub-add-ons'),
                    _x('ESE', 'wind direction', 'townhub-add-ons'),
                    _x('SE', 'wind direction', 'townhub-add-ons'),
                    _x('SSE', 'wind direction', 'townhub-add-ons'),
                    _x('S', 'wind direction', 'townhub-add-ons'),
                    _x('SSW', 'wind direction', 'townhub-add-ons'),
                    _x('SW', 'wind direction', 'townhub-add-ons'),
                    _x('WSW', 'wind direction', 'townhub-add-ons'),
                    _x('W', 'wind direction', 'townhub-add-ons'),
                    _x('WNW', 'wind direction', 'townhub-add-ons'),
                    _x('NW', 'wind direction', 'townhub-add-ons'),
                    _x('NNW', 'wind direction', 'townhub-add-ons'),
                ),
            ),
            'i18n'                 => array(
                'share_on'              => __('Share this on {SOCIAL}', 'townhub-add-ons'),
                'del-listing'           => __("Are you sure want to delete {{listing_title}} listing and its data?\nThe listing is permanently deleted.", 'townhub-add-ons'),
                'cancel-booking'        => __("Are you sure want to cancel {{booking_title}} booking?", 'townhub-add-ons'),
                'approve-booking'       => __("Are you sure want to approve {{booking_title}} booking?", 'townhub-add-ons'),
                'del-booking'           => __("Are you sure want to delete {{booking_title}} booking and its data?\nThe booking is permanently deleted.", 'townhub-add-ons'),
                'del-message'           => __("Are you sure want to cancel {{message_title}} message?", 'townhub-add-ons'),
                'chats_h3'              => __('Inbox', 'townhub-add-ons'),
                'chat_fr_owner'         => __('Chat With Owner', 'townhub-add-ons'),
                'chat_fr_login'         => __('Login to chat', 'townhub-add-ons'),
                'chat_fr_cwith'         => __('Chat with ', 'townhub-add-ons'),
                'chat_fr_conver'        => __('Conversations', 'townhub-add-ons'),
                'change_pas_h3'         => __(' Change Password', 'townhub-add-ons'),
                'change_pas_lb_CP'      => __('Current Password', 'townhub-add-ons'),
                'change_pas_lb_NP'      => __('New Password', 'townhub-add-ons'),
                'change_pas_lb_CNP'     => __('Confirm New Password', 'townhub-add-ons'),

                'inner_chat_op_W'       => __('Week', 'townhub-add-ons'),
                'inner_chat_op_M'       => __('Month', 'townhub-add-ons'),
                'inner_chat_op_Y'       => __('Year', 'townhub-add-ons'),

                'inner_listing_li_E'    => __('Edit ', 'townhub-add-ons'),
                'inner_listing_li_D'    => __('Delete ', 'townhub-add-ons'),

                'author_review_h3'      => __('Reviews for your listings', 'townhub-add-ons'),

                'likebtn'               => __('Like Button', 'townhub-add-ons'),
                'welcome'               => __('Welcome', 'townhub-add-ons'),
                'listings'              => __('Listings', 'townhub-add-ons'),
                'bookings'              => __('Bookings', 'townhub-add-ons'),
                'reviews'               => __('Reviews', 'townhub-add-ons'),
                'log_out'               => __('Log Out ', 'townhub-add-ons'),
                'add_hour'              => __('Add Hour', 'townhub-add-ons'),
                // 'timezone'              => __('Timezone', 'townhub-add-ons'),

                'book_dates'            => __('Dates', 'townhub-add-ons'),
                'book_services'         => __('Extra Services', 'townhub-add-ons'),
                'book_ad'               => __('ADULTS', 'townhub-add-ons'),
                'book_chi'              => __('CHILDREN', 'townhub-add-ons'),
                'book_avr'              => __('Available Rooms', 'townhub-add-ons'),
                'book_ts'               => __('Total Cost', 'townhub-add-ons'),
                'book_chev'             => __('Check availability', 'townhub-add-ons'),
                'book_bn'               => __('Book Now', 'townhub-add-ons'),
                'checkout_can'          => __('Cancel', 'townhub-add-ons'),
                'checkout_app'          => __('Apply', 'townhub-add-ons'),
                'roomsl_avai'           => __('Available:', 'townhub-add-ons'),
                'roomsl_maxg'           => __('Max Guests: ', 'townhub-add-ons'),
                'roomsl_quan'           => __('Quantity', 'townhub-add-ons'),

                'btn_save'              => __('Save Change', 'townhub-add-ons'),
                'btn_save_c'            => __('Save Changes', 'townhub-add-ons'),
                'btn_close'             => __('Close me', 'townhub-add-ons'),
                'btn_send'              => __('Send Listing', 'townhub-add-ons'),

                'btn_add_F'             => __('Add Fact', 'townhub-add-ons'),
                'fact_title'            => __('Fact Title', 'townhub-add-ons'),
                'fact_number'           => __('Fact Number', 'townhub-add-ons'),
                'fact_icon'             => __('Fact Icon', 'townhub-add-ons'),
                'location_country'      => __('Country', 'townhub-add-ons'),
                'location_state'        => __('State', 'townhub-add-ons'),
                'location_city'         => __('City', 'townhub-add-ons'),

                'faq_title'             => __('Question', 'townhub-add-ons'),
                'faq_content'           => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'townhub-add-ons'),
                'btn_add_Faq'           => __('Add FAQ', 'townhub-add-ons'),

                'btn_add_S'             => __('Add Social', 'townhub-add-ons'),
                'btn_add_R'             => __('Add Room', 'townhub-add-ons'),

                'image_upload'          => __(' Click here to upload', 'townhub-add-ons'),

                'btn_send'              => __('Send', 'townhub-add-ons'),

                'th_mount'              => __('Amount', 'townhub-add-ons'),
                'th_method'             => __('Method', 'townhub-add-ons'),
                'th_to'                 => __('To', 'townhub-add-ons'),
                'th_date'               => __('Date Submitted', 'townhub-add-ons'),
                'th_status'             => __('Status', 'townhub-add-ons'),
                'calendar_dis_number'   => __('Select the number of months displayed.', 'townhub-add-ons'),
                'calendar_number_one'   => __('One Months', 'townhub-add-ons'),
                'calendar_number_two'   => __('Two Months', 'townhub-add-ons'),
                'calendar_number_three' => __('Three Months', 'townhub-add-ons'),
                'calendar_number_four'  => __('Four Months', 'townhub-add-ons'),
                'calendar_number_five'  => __('Five Months', 'townhub-add-ons'),
                'calendar_number_six'   => __('Six Months', 'townhub-add-ons'),
                'calendar_number_seven' => __('Seven Months', 'townhub-add-ons'),
                'coupon_code'           => __('Coupon code', 'townhub-add-ons'),
                'coupon_discount'       => __('Discount type', 'townhub-add-ons'),
                'coupon_percentage'     => __('Percentage discount', 'townhub-add-ons'),
                'coupon_fix_cart'       => __('Fixed cart discount', 'townhub-add-ons'),
                'coupon_desc'           => __('Description', 'townhub-add-ons'),
                'coupon_show'           => __('Display content in widget banner?', 'townhub-add-ons'),
                'coupon_amount'         => __('Discount amount', 'townhub-add-ons'),
                'coupon_qtt'            => __('Coupon quantity', 'townhub-add-ons'),
                'coupon_expiry'         => __('Coupon expiry date', 'townhub-add-ons'),
                'coupon_format'         => __('Format:YY-mm-dd HH:ii:ss', 'townhub-add-ons'),

                'bt_coupon'             => __('Add Coupon', 'townhub-add-ons'),
                'bt_services'           => __('Add Service', 'townhub-add-ons'),
                'services_name'         => __('Service Name', 'townhub-add-ons'),
                'services_desc'         => __('Description', 'townhub-add-ons'),
                'services_price'        => __('Service Price', 'townhub-add-ons'),
                'bt_member'             => __('Add Member', 'townhub-add-ons'),
                'member_name'           => __('Name: ', 'townhub-add-ons'),
                'member_job'            => __('Job or Position: ', 'townhub-add-ons'),
                'member_desc'           => __('Description', 'townhub-add-ons'),
                'member_img'            => __('Image', 'townhub-add-ons'),
                'memeber_social'        => __('Socials', 'townhub-add-ons'),
                'member_url'            => __('Website', 'townhub-add-ons'),

                'days'                  => array(
                    _x('Sun', 'calendar', 'townhub-add-ons'),
                    _x('Mon', 'calendar', 'townhub-add-ons'),
                    _x('Tue', 'calendar', 'townhub-add-ons'),
                    _x('Wed', 'calendar', 'townhub-add-ons'),
                    _x('Thu', 'calendar', 'townhub-add-ons'),
                    _x('Fri', 'calendar', 'townhub-add-ons'),
                    _x('Sat', 'calendar', 'townhub-add-ons'),
                ),
                'months'                => array(
                    _x('January', 'calendar', 'townhub-add-ons'),
                    _x('February', 'calendar', 'townhub-add-ons'),
                    _x('March', 'calendar', 'townhub-add-ons'),
                    _x('April', 'calendar', 'townhub-add-ons'),
                    _x('May', 'calendar', 'townhub-add-ons'),
                    _x('June', 'calendar', 'townhub-add-ons'),
                    _x('July', 'calendar', 'townhub-add-ons'),
                    _x('August', 'calendar', 'townhub-add-ons'),
                    _x('September', 'calendar', 'townhub-add-ons'),
                    _x('October', 'calendar', 'townhub-add-ons'),
                    _x('November', 'calendar', 'townhub-add-ons'),
                    _x('December', 'calendar', 'townhub-add-ons'),
                ),
                // earnings
                'earnings_title'        => __('Your Earnings', 'townhub-add-ons'),
                'th_date_'              => __('Date', 'townhub-add-ons'),
                'th_total_'             => __('Total', 'townhub-add-ons'),
                'th_fee_'               => __('Author Fee', 'townhub-add-ons'),
                'th_earning_'           => __('Earning', 'townhub-add-ons'),
                'th_order_'             => __('Order', 'townhub-add-ons'),
                'go_back'               => __('Go back', 'townhub-add-ons'),
                'no_earning'            => __('You have no earning.', 'townhub-add-ons'),
                'th_vat_ser'            => __( 'VAT - Services', 'townhub-add-ons' ),
                
                'cancel'                => __('Cancel', 'townhub-add-ons'),
                'submit'                => __('Submit', 'townhub-add-ons'),

                'ltype_title'           => _x('Listing type', 'Listing type', 'townhub-add-ons'),
                'ltype_desc'            => _x('Listing type description', 'Listing type', 'townhub-add-ons'),
                'wkh_enter'             => _x('Enter Hours', 'Working hour', 'townhub-add-ons'),
                'wkh_open'              => _x('Open all day', 'Working hour', 'townhub-add-ons'),
                'wkh_close'             => _x('Close all day', 'Working hour', 'townhub-add-ons'),
                'calen_lock'            => _x('Lock this month', 'Calendar', 'townhub-add-ons'),
                'calen_unlock'          => _x('Unlock this month', 'Calendar', 'townhub-add-ons'),

                'smwdtitle'             => __('Submit a withdrawal request', 'townhub-add-ons'),
                'wdfunds'               => __('Withdraw funds', 'townhub-add-ons'),
                'goearnings'            => __('View Earnings', 'townhub-add-ons'),

                'chat_type_msg'         => __('Type Message', 'townhub-add-ons'),

                'save'                  => __('Save', 'townhub-add-ons'),
                'cal_event_start'       => __('Event start time: ', 'townhub-add-ons'),
                'cal_event_end'         => __('Event end date: ', 'townhub-add-ons'),
                'cal_opts'              => __('Options', 'townhub-add-ons'),

                'wth_payments'          => __('PayPal / Stripe Email', 'townhub-add-ons'),
                'wth_amount'            => __('Amount ', 'townhub-add-ons'),
                'wth_plh_email'         => __('email@gmail.com', 'townhub-add-ons'),
                'wth_acount_balance'    => __('Account Balance', 'townhub-add-ons'),
                'wth_will_process'      => __('Your request will be processed on ', 'townhub-add-ons'),
                'wth_no_request'        => __('You have no withdrawal request', 'townhub-add-ons'),

                'bt_slots'              => __('Add Time Slot', 'townhub-add-ons'),
                'slot_time'             => __('Time', 'townhub-add-ons'),
                'slot_guests'           => __('Guests', 'townhub-add-ons'),
                'slot_available'        => __('Available slots', 'townhub-add-ons'),

                'no_ltype'              => __('There is no listing type. Please contact to site owner for more details.', 'townhub-add-ons'),
                'ltype_select_guide'    => __('Click to change listing type', 'townhub-add-ons'),

                'bt_add_menu'           => __('Add Menu', 'townhub-add-ons'),
                'menu_name'             => __('Menu Name', 'townhub-add-ons'),
                'menu_cats'             => __('Menu Types (comma separated)', 'townhub-add-ons'),
                'menu_desc'             => __('Menu Description', 'townhub-add-ons'),
                'menu_price'            => __('Menu Price', 'townhub-add-ons'),
                'menu_url'              => __('Menu Link', 'townhub-add-ons'),
                'menu_photos'           => __('Menu Photos', 'townhub-add-ons'),

                'headm_mp4'             => __('MP4 Video', 'townhub-add-ons'),
                'headm_youtube'         => __('Youtube Video ID', 'townhub-add-ons'),
                'headm_vimeo'           => __('Vimeo Video ID', 'townhub-add-ons'),
                'headm_bgimg'           => __('Background Image', 'townhub-add-ons'),
                'preview_btn'           => __('Preview', 'townhub-add-ons'),
                'add_listing'           => __('Add Listing', 'townhub-add-ons'),
                'edit_listing'           => __('Edit Listing', 'townhub-add-ons'),

                'add_room'              => __('Add Room', 'townhub-add-ons'),
                'edit_room'             => __('Edit Room', 'townhub-add-ons'),
                'nights'                 => __('Nights', 'townhub-add-ons'),
                'slots_add'             => __( 'Add Slot', 'townhub-add-ons' ),
                'slots_guests'             => __( 'Max Guests', 'townhub-add-ons' ),
                'slots_start'             => __( 'Start time', 'townhub-add-ons' ),
                'slots_end'             => __( 'End time', 'townhub-add-ons' ),
                'slots_price'             => __( 'Price', 'townhub-add-ons' ),

                'raselect_placeholder'             => __( 'Select', 'townhub-add-ons' ),
                'raselect_nooptions'             => __( 'No options', 'townhub-add-ons' ),

                'cal_bulkedit'             => __( 'Bulk Edit', 'townhub-add-ons' ),
                'save_bulkedit'            => __( 'Save', 'townhub-add-ons' ),
                'cancel_bulkedit'            => __( 'Cancel', 'townhub-add-ons' ),

                'adults'                => __('Adults', 'townhub-add-ons'),
                'children'              => __('Children', 'townhub-add-ons'),

                'AM'                            => _x( 'AM', 'Time picker AM', 'townhub-add-ons' ),
                'PM'                            => _x( 'PM', 'Time picker PM', 'townhub-add-ons' ),
                'evt_start'                            => _x( 'Start', 'Submit page', 'townhub-add-ons' ),
                'evt_end'                            => _x( 'End', 'Submit page', 'townhub-add-ons' ),
            ),

            'distance_df'          => townhub_addons_get_option('distance_df'),
            'curr_user'            => $curr_user_data,

            'free_map'             => townhub_addons_get_option('use_osm_map') == 'yes' ? true : false,

            'currency'             => townhub_addons_get_currency_attrs(),
            'base_currency'        => townhub_addons_get_base_currency(),

            

            // 'wpeditor'                      => townhub_addons_get_wp_editor(),

            'wpml'                          => apply_filters( 'wpml_current_language', null ),

            'unfill_address'             => townhub_addons_get_option('unfill_address'),
            'unfill_state'             => townhub_addons_get_option('unfill_state'),
            'unfill_city'             => townhub_addons_get_option('unfill_city'),

            
        );
        // if(is_singular('listing')){
        //     $_townhub_add_ons['slid'] =
        // }
        if (townhub_addons_must_enqueue_editor()) {
            wp_enqueue_editor();
        }

        self::enqueue_react_libraries();
        self::enqueue_redux_libraries();

        
        wp_enqueue_script('townhub-react-app', self::$plugin_url . "assets/js/townhub-react-app.min.js", array('townhub-addons'), null, true);
        
        if( is_singular( 'listing' ) ){
            wp_enqueue_script('townhub-single', self::$plugin_url . "assets/js/townhub-single.min.js", array('townhub-addons'), null, true);
        }
        if( townhub_addons_get_option('admin_chat') == 'yes' && townhub_addons_get_option('show_fchat') == 'yes' ){
            wp_enqueue_script('townhub-chat-app', self::$plugin_url . "assets/js/townhub-chat-app.min.js", array('townhub-addons'), null, true);
        }
        
        wp_localize_script('townhub-addons', '_townhub_add_ons', $_townhub_add_ons);

        $_townhub_dashboard = array(
            
            'i18n' => array(
                'inner_chat_op_W'    => __('Week', 'townhub-add-ons'),
                'inner_chat_op_M'    => __('Month', 'townhub-add-ons'),
                'inner_chat_op_Y'    => __('Year', 'townhub-add-ons'),
                'chart_alltime'      => __('All time', 'townhub-add-ons'),
                'chart_views_lbl'    => __('Listing Views', 'townhub-add-ons'),
                'chart_earnings_lbl' => __('Earnings', 'townhub-add-ons'),
                'chart_bookings_lbl' => __('Bookings', 'townhub-add-ons'),

                'withdrawals'           => __( 'Withdrawals', 'townhub-add-ons' ),
                'wth_notes'           => __( 'Additional Infos', 'townhub-add-ons' ),

            ),

            'chart_hide_views'               => townhub_addons_get_option('chart_hide_views') == 'yes' ? true : false,
            'chart_hide_earning'               => townhub_addons_get_option('chart_hide_earning') == 'yes' ? true : false,
            'chart_hide_booking'               => townhub_addons_get_option('chart_hide_booking') == 'yes' ? true : false,
            // nonce for rest api - Cookie Authentication
            // 'nonce' => wp_create_nonce( 'wp_rest' ),

            'payment'              => townhub_addons_get_payments(),
            'withdrawal_min'        => (float)townhub_addons_get_option('withdrawal_min'),

        );

        // for submit page
        if ( is_page(esb_addons_get_wpml_option('submit_page')) || is_page(esb_addons_get_wpml_option('edit_page')) ) {

            $_townhub_submit = array(
                'submit_timezone_hide' => townhub_addons_get_option('submit_timezone_hide'),
                'timezones'            => townhub_addons_generate_timezone_list(),
                'timezone'             => get_option('timezone_string', 'Europe/London'),
                'working_days'         => Esb_Class_Date::week_days(),
                'working_hours'        => Esb_Class_Date::wkhours_select(),

                'features'             => townhub_addons_get_listing_features(),
                
                'i18n'                 => array(
                    'timezone'              => __('Timezone', 'townhub-add-ons'),
                ),
            );
            wp_enqueue_script('Sortable', self::$plugin_url . "assets/js/Sortable.min.js", array(), null, true);
            wp_enqueue_script('react-sortable', self::$plugin_url . "assets/js/react-sortable.min.js", array(), null, true);

            wp_enqueue_script('townhub-submit', self::$plugin_url . "assets/js/townhub-submit.min.js", array('townhub-addons'), null, true);
            wp_localize_script('townhub-submit', '_townhub_submit', $_townhub_submit);
        }


        


        

        wp_localize_script('townhub-addons', '_townhub_dashboard', $_townhub_dashboard);

        // for dashboard page
        if ( is_page(esb_addons_get_wpml_option('dashboard_page')) ) {
            wp_enqueue_script('chart.js', self::$plugin_url . "assets/js/Chart.js", array(), null, true);
            wp_enqueue_script('townhub-dashboard', self::$plugin_url . "assets/js/townhub-dashboard.min.js", array('townhub-addons'), null, true);
        }

        // if (function_exists('wp_set_script_translations')) {
        //     wp_set_script_translations('townhub-addons', 'townhub-add-ons');
        // }

        // if (function_exists('wp_set_script_translations')) {
        //     wp_set_script_translations('townhub-react-app', 'townhub-add-ons');
        // }

        // google reCAPTCHA - v2
        if (townhub_addons_get_option('enable_g_recaptcah') == 'yes' && townhub_addons_get_option('g_recaptcha_site_key') != '') {
            wp_enqueue_script('g-recaptcha', "https://www.google.com/recaptcha/api.js?onload=cthCaptchaCallback&render=explicit#cthasync#cthdefer", array('townhub-addons'), null, true);
        }

        // for Stripe payment
        if (is_page(esb_addons_get_wpml_option('checkout_page'))) {
            wp_enqueue_script('checkout.stripe', 'https://checkout.stripe.com/checkout.js', array(), null, false);
            wp_enqueue_script('add-ons-payments', self::$plugin_url . "assets/js/payments.min.js", array('jquery', 'checkout.stripe'), null, true);
            $stripe_logo               = townhub_addons_get_option('stripe_logo');
            $_townhub_add_ons_payments = array(
                'site_title'      => get_bloginfo('name'),
                // 'site_desc'         => get_bloginfo('description'),
                'logo'            => $stripe_logo['url'],
                'publishable_key' => townhub_addons_get_option('payments_test_mode') == 'yes' ? townhub_addons_get_option('payments_stripe_test_public') : townhub_addons_get_option('payments_stripe_live_public'),
                'currency_code'   => townhub_addons_get_currency(),

                'one_time_text'   => __('Pay for {{plan}} plan', 'townhub-add-ons'),
                'recurring_text'  => __('Subscription for {{plan}} plan', 'townhub-add-ons'),
                'use_email'       => townhub_addons_get_option('payments_stripe_use_email') == 'yes' ? true : false,

                // 'url'           => esc_url(admin_url( 'admin-ajax.php' ) ),
                // 'nonce'         => wp_create_nonce( 'townhub-add-ons' ),

            );
            wp_localize_script('add-ons-payments', '_townhub_add_ons_payments', $_townhub_add_ons_payments);
        }
    }
}
Esb_Class_Frontend_Scripts::init();
