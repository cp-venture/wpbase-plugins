<?php 
/* add_ons_php */

function townhub_addons_options_get_emails(){
    return array(
            array(
                "type" => "section",
                'id' => 'email_section_1',
                "title" => __( 'General', 'townhub-add-ons' ),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_name',
                "title" => __('Sender Name', 'townhub-add-ons'),
                'desc'  => __( 'This should probably be your listing sitename.', 'townhub-add-ons' ) ,
            ),
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_email',
                "title" => __('Sender Email', 'townhub-add-ons'),
                'desc'  => __( 'This will act as the "from" and "reply-to" email address.', 'townhub-add-ons' ) ,
            ),
            array(
                "type" => "field",
                "field_type" => "select",
                'id' => 'emails_ctype',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'default'=> 'html',
                    'options'=> array(
                        "html" => __('HTML Template','townhub-add-ons'), 
                        "plain" => __('Plain Text only','townhub-add-ons'),
                    ),
                )
            ),

            array(
                "type" => "section",
                'id' => 'emails_section_admin_new_listing',
                "title" => __( 'New Listing Admin Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New listing emails are sent to admin recipient(s) when a new listing is submitted.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_new_listing_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_listing_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'townhub-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'townhub-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_listing_subject',
                'args'=> array(
                    'default' => '[{site_title}] New listing ({listing_number}) {listing_title} - {listing_date}',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {listing_number} - Listing ID<br>
        {listing_title} - Listing Title<br>
        {listing_date} - Listing Date<br>', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_new_listing_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">There is new listing from {listing_author}</p>
<p style="text-align: left;"><em>Listing Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Date:</strong> {listing_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {listing_number}</p>
<p style="text-align: left;"><strong>Title:</strong> {listing_title}</p>
<p style="text-align: left;"><strong>Category:</strong> {listing_category}</p>
<p style="text-align: left;"><strong>Excerpt:</strong> {listing_excerpt}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {listing_author} - The author's display name<br>
        {listing_number} - Listing ID<br>
        {listing_title} - Listing Title<br>
        {listing_category} - Listing categories<br>
        {listing_excerpt} - The listing excerpt<br>
        {listing_date} - The listing date.<br>",'townhub-add-ons'),

                )
            ),

            // end new listing admin emails

            array(
                "type" => "section",
                'id' => 'emails_section_auth_new_listing',
                "title" => __( 'New Listing Author Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New listing email are sent to author when a new listing is submitted.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_auth_new_listing_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_new_listing_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your new listing {listing_title}',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {listing_title} - Listing Title<br>', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_new_listing_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {listing_author},</p>
<p style="text-align: left;">Thank you for submiting new listing to our site. We will review and publish it soon.</p>
<p style="text-align: left;"><em>Your Listing Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Title:</strong> {listing_title}</p>
<p style="text-align: left;"><strong>Category:</strong> {listing_category}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">You can also edit the listing from <a href="{listing_dashboard}">dashboard</a> area to make it publish immediately by using paid plan.</p>',
                    
                    'desc' => __("Enter the email that is sent to listing author after completing a submission. Available template tags:<br>
        {site_title} - The site title<br>
        {listing_author} - The author's display name<br>
        {listing_title} - Listing Title<br>
        {listing_category} - Listing categories<br>
        {listing_dashboard} - The author dashboard page<br>",'townhub-add-ons'),

                )
            ),
            // end new listing author email
            array(
                "type" => "section",
                'id' => 'emails_section_admin_new_order',
                "title" => __( 'New Order Admin Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New order emails are sent to admin recipient(s) when a new order is received.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_new_order_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_order_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'townhub-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'townhub-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_order_subject',
                'args'=> array(
                    'default' => '[{site_title}] New order ({order_number}) {order_date}',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {order_number} - Order ID<br>
        {order_date} - Order Date<br>', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_new_order_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">You have received an order from {author}</p>
<p style="text-align: left;"><em>Order Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {order_amount}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {order_method}</p>
<p style="text-align: left;"><strong>Date:</strong> {order_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {order_number}</p>
<p style="text-align: left;"><strong>For Listing:</strong> {listing_title}</p>
<p style="text-align: left;"><strong>Listing Category:</strong> {listing_category}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {order_amount} - Order total/amount<br>
        {order_currency} - Order currency<br>
        {order_method} - Payment method<br>
        {order_number} - Order ID<br>
        {order_date} - Order Date<br>
        {listing_title} - The listing title<br>
        {listing_category} - The listing categories<br>",'townhub-add-ons'),

                )
            ),
            // and new order admin emails
            array(
                "type" => "section",
                'id' => 'emails_section_admin_order_completed',
                "title" => __( 'Completed Order Admin Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New order emails are sent to admin recipient(s) when a order is paid (mark as completed).', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_order_completed_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_order_completed_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'townhub-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'townhub-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_order_completed_subject',
                'args'=> array(
                    'default' => '[{site_title}] Order from {order_date} is complete',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {order_number} - Order ID<br>
        {order_date} - Order Date<br>', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_order_completed_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">An order from {author} is paid (or mark as completed)</p>
<p style="text-align: left;"><em>Order Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {order_amount}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {order_method}</p>
<p style="text-align: left;"><strong>Date:</strong> {order_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {order_number}</p>
<p style="text-align: left;"><strong>For Listing:</strong> {listing_title}</p>
<p style="text-align: left;"><strong>Listing Category:</strong> {listing_category}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {order_amount} - Order total/amount<br>
        {order_currency} - Order currency<br>
        {order_method} - Payment method<br>
        {order_number} - Order ID<br>
        {order_title} - Order Title<br>
        {order_date} - Order Date<br>
        {listing_title} - The listing title<br>
        {listing_category} - The listing categories<br>",'townhub-add-ons'),

                )
            ),
            // and completed order admin emails
            array(
                "type" => "section",
                'id' => 'emails_section_auth_order_completed',
                "title" => __( 'Completed Order Author Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'New order emails are sent to listing author when an order is paid (mark as completed).', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_auth_order_completed_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'free_auth_order_completed_disabled',
                'args'=> array(
                    'default' => 'no',
                    'value' => 'yes',
                ),
                "title" => __('Disable for free plan', 'townhub-add-ons'),
                'desc'  => '',
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_order_completed_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your order from {order_date} is complete',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {order_number} - Order ID<br>
        {order_date} - Order Date<br>', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_order_completed_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">Your order is completed</p>
<p style="text-align: left;"><em>Order Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {order_amount}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {order_method}</p>
<p style="text-align: left;"><strong>Date:</strong> {order_date}</p>
<p style="text-align: left;"><strong>ID:</strong> {order_number}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {order_amount} - Order total/amount<br>
        {order_currency} - Order currency<br>
        {order_method} - Payment method<br>
        {order_number} - Order ID<br>
        {order_title} - Order Title<br>
        {order_date} - Order Date",'townhub-add-ons'),

                )
            ),
            // and completed order author emails





            // and new invoice admin emails
            array(
                "type" => "section",
                'id' => 'emails_admin_new_invoice',
                "title" => __( 'New Invoice Admin Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to admin recipient(s) when a new invoice is created. This can be invoice for new order/subscription or renew invoice for recurring subscription.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_new_invoice_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_invoice_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'townhub-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'townhub-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_invoice_subject',
                'args'=> array(
                    'default' => '[{site_title}] New Invoice #{number}',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {number} - Invoice ID<br>
        {date} - Invoice Date<br>', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_new_invoice_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello Admin,</p>
<p style="text-align: left;">New invoice from {author}</p>
<p style="text-align: left;"><em>Invoice Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Amount:</strong> {amount}</p>
<p style="text-align: left;"><strong>Payment method:</strong> {method}</p>
<p style="text-align: left;"><strong>Date:</strong> {date}</p>
<p style="text-align: left;"><strong>ID:</strong> {number}</p>
<p style="text-align: left;"><strong>For Plan:</strong> {plan}</p>
<p style="text-align: left;"><strong>Expire at:</strong> {expire}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The Invoice author's display name<br>
        {amount} - Invoice total/amount<br>
        {method} - Payment method<br>
        {number} - Invoice ID<br>
        {title} - Invoice Title<br>
        {expire} - Invoice expiration date<br>
        {plan} - Subscription plan title<br>
        {date} - Invoice Date<br>",'townhub-add-ons'),

                )
            ),
            // end new invoice admin emails
            array(
                "type" => "section",
                'id' => 'emails_auth_new_invoice',
                "title" => __( 'New Invoice Author Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to listing author when a new invoice is created. This can be invoice for new order/subscription or renew invoice for recurring subscription.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_auth_new_invoice_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_new_invoice_subject',
                'args'=> array(
                    'default' => '[{site_title}] New Invoice #{number} for you',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {number} - Invoice ID<br>
        {date} - Invoice Date<br>', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_new_invoice_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<div style="width:595px;min-height:842px;margin:0 auto;padding:56px 56px 48px;font-family:Roboto,Helvetica,Arial,sans-serif;font-weight:normal;box-sizing:border-box">
<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">We received payment for your subscription {title}</p>
<table style="border-collapse:collapse;width:100%">
        <tbody><tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Date
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                {date}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Subscribed with
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                {author}
            </td>
        </tr>
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Charged via
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                
                    {method}
                
            </td>
        </tr>
        
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Expiration date
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;font-weight:700;color:#574751">
                <span>{expire}</span>
            </td>
        </tr>
        
        
        <tr>
            <td colspan="4" style="width:80%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);line-height:16px;font-size:14px;color:#574751">
                Subscription to {plan}
            </td>
            <td style="width:20%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;color:#574751">
                {amount}
            </td>
        </tr>
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#bcb5b9">
                Subtotal
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;color:#574751">
                {amount}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#bcb5b9">
                Total
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;border-bottom:1px solid rgba(188,181,185,0.3);text-align:right;line-height:16px;font-size:14px;color:#574751">
                {amount}
            </td>
        </tr>
        
        
        <tr>
            <td colspan="2" style="width:40%;padding:10px 0;text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#574751">
                Paid
            </td>
            <td colspan="3" style="width:60%;padding:10px 0 10px 10px;text-align:right;line-height:16px;font-size:14px;font-weight:700;color:#574751">
                {amount}
            </td>
        </tr>
        
    </tbody></table>
<div style="width:150px;margin-top:70px">
    <div style="font-weight:700;line-height:25px;font-size:22px;color:#bcb5b9">
        Thank you!
    </div>
    <div style="margin-top:12px;font-weight:500;line-height:16px;font-size:14px;color:#574751">
        CTHthemes
    </div>
</div>
</div>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The Invoice author's display name<br>
        {amount} - Invoice total/amount<br>
        {method} - Payment method<br>
        {number} - Invoice ID<br>
        {title} - Invoice Title<br>
        {expire} - Invoice expiration date<br>
        {plan} - Subscription plan title<br>
        {date} - Invoice Date<br>",'townhub-add-ons'),

                )
            ),
            // and new invoice author emails






            // and booking author emails
            array(
                "type" => "section",
                'id' => 'emails_section_auth_booking_insert',
                "title" => __( 'New Booking Author Emails', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Emails send to author when a customer booked their listing.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_section_auth_booking_insert_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_section_auth_booking_insert_subject',
                'args'=> array(
                    'default' => '[{site_title}] New booking for {listing_title}',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {listing_title} - Listing title', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_section_auth_booking_insert_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">You have a new booking for {listing_title}</p>
<p style="text-align: left;"><em>Booking Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Name:</strong> {name}</p>
<p style="text-align: left;"><strong>Email:</strong> {email}</p>
<p style="text-align: left;"><strong>Phone:</strong> {phone}</p>
<p style="text-align: left;"><strong>Checkin:</strong> {checkin}</p>
<p style="text-align: left;"><strong>Checkout:</strong> {checkout}</p>
<p style="text-align: left;"><strong>Times:</strong> {times}</p>
<p style="text-align: left;"><strong>Or Slots:</strong> {slots}</p>
<p style="text-align: left;"><strong>Additional Info:</strong> {notes}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {name} - Customer name<br>
        {email} - Cusotmer email<br>
        {phone} - Customer phone number<br>
        {quantity} - Quantity<br>
        {person} - Person<br>
        {day} - Booking day<br>
        {date} - Booking date<br>
        {time} - Booking time<br>
        {info} or {notes} - Additional info<br>
        {checkin} - Checkin date<br>
        {checkout} - Checkout date<br>
        {times} - Booking times<br>
        {slots} - Booking time slots<br>
        {rooms} - Room details<br>
        {tickets} - Event booking tickets<br>
        {listing_title} - The listing title<br>",'townhub-add-ons'),

                )
            ),
            // and booking author emails

            // and booking customer email
            array(
                "type" => "section",
                'id' => 'emails_section_customer_booking_insert',
                "title" => __( 'New Booking Customer Email', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to customer book a listing.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_section_customer_booking_insert_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_section_customer_booking_insert_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your booking for {listing_title} listing is received',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {listing_title} - Listing title', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_section_customer_booking_insert_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {name},</p>
<p style="text-align: left;">You have booked for {listing_title} listing</p>
<p style="text-align: left;"><em>Booking Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Name:</strong> {name}</p>
<p style="text-align: left;"><strong>Email:</strong> {email}</p>
<p style="text-align: left;"><strong>Phone:</strong> {phone}</p>
<p style="text-align: left;"><strong>Checkin:</strong> {checkin}</p>
<p style="text-align: left;"><strong>Checkout:</strong> {checkout}</p>
<p style="text-align: left;"><strong>Times:</strong> {times}</p>
<p style="text-align: left;"><strong>Or Slots:</strong> {slots}</p>
<p style="text-align: left;"><strong>Additional Info:</strong> {notes}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {name} - Customer name<br>
        {email} - Cusotmer email<br>
        {phone} - Customer phone number<br>
        {quantity} - Quantity<br>
        {person} - Person<br>
        {day} - Booking day<br>
        {date} - Booking date<br>
        {time} - Booking time<br>
        {info} or {notes} - Additional info<br>
        {checkin} - Checkin date<br>
        {checkout} - Checkout date<br>
        {times} - Booking times<br>
        {slots} - Booking time slots<br>
        {rooms} - Room details<br>
        {tickets} - Event booking tickets<br>
        {listing_title} - The listing title<br>",'townhub-add-ons'),

                )
            ),
            // and booking customer email

            // and booking approved customer email
            array(
                "type" => "section",
                'id' => 'emails_section_customer_booking_approved',
                "title" => __( 'Approved Booking Customer Email', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to customer when a booking is approved.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_section_customer_booking_approved_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_section_customer_booking_approved_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your booking for {listing_title} listing is approved',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {listing_title} - Listing title', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_section_customer_booking_approved_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {name},</p>
<p style="text-align: left;">Your booking for {listing_title} listing is approved.</p>
<p style="text-align: left;"><em>Booking Detials</em></p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>Name:</strong> {name}</p>
<p style="text-align: left;"><strong>Email:</strong> {email}</p>
<p style="text-align: left;"><strong>Phone:</strong> {phone}</p>
<p style="text-align: left;"><strong>Checkin:</strong> {checkin}</p>
<p style="text-align: left;"><strong>Checkout:</strong> {checkout}</p>
<p style="text-align: left;"><strong>Times:</strong> {times}</p>
<p style="text-align: left;"><strong>Or Slots:</strong> {slots}</p>
<p style="text-align: left;"><strong>Additional Info:</strong> {notes}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {name} - Customer name<br>
        {email} - Cusotmer email<br>
        {phone} - Customer phone number<br>
        {quantity} - Quantity<br>
        {person} - Person<br>
        {day} - Booking day<br>
        {date} - Booking date<br>
        {time} - Booking time<br>
        {checkin} - Checkin date<br>
        {checkout} - Checkout date<br>
        {times} - Booking times<br>
        {slots} - Booking time slots<br>
        {info} or {notes} - Additional info<br>
        {rooms} - Room details<br>
        {tickets} - Event booking tickets<br>
        {listing_title} - The listing title<br>",'townhub-add-ons'),

                )
            ),
            // and booking approved customer email

            array(
                "type" => "section",
                'id' => 'emails_admin_new_claim',
                "title" => __( 'New Claim Admin Email', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to admin recipient(s) when a new claim is submitted.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_admin_new_claim_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_claim_recipients',
                'args'=> array(
                    'default' => get_bloginfo('admin_email'),
                ),
                "title" => __('Recipient(s)', 'townhub-add-ons'),
                'desc'  => sprintf(__('Enter recipients (comma separated) for this email. Default is: %s', 'townhub-add-ons'), get_bloginfo('admin_email'))
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_admin_new_claim_subject',
                'args'=> array(
                    'default' => '[{site_title}] New listing claim',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {id} - Claim post id<br>
        {date} - Email sending date', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_admin_new_claim_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello admin,</p>
<p style="text-align: left;">New listing claim is received. Bellow is the details:</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>For listing:</strong> <a href="{listing_url}" target="_blank">{listing_title}</a></p>
<p style="text-align: left;"><strong>Claim Time:</strong> {date}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {date} - Claim created date<br>
        {listing_id} - Listing ID<br>
        {listing_title} - Listing title<br>
        {listing_url} - The listing url<br>",'townhub-add-ons'),

                )
            ),
            // and new claim admin email

            array(
                "type" => "section",
                'id' => 'emails_auth_new_claim',
                "title" => __( 'New Claim Author Email', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to author recipient(s) when his listing claim is received.', 'townhub-add-ons' ).'</p>';
                }
            ),

            array(
                "type" => "field",
                "field_type" => "checkbox",
                'id' => 'emails_auth_new_claim_enable',
                'args'=> array(
                    'default' => 'yes',
                    'value' => 'yes',
                ),
                "title" => __('Enable/Disable', 'townhub-add-ons'),
                'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_new_claim_subject',
                'args'=> array(
                    'default' => '[{site_title}] Your listing claim is received',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {id} - Claim post id<br>
        {date} - Email sending date', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_new_claim_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">Your listing claim is received. We will check it and contact with you soon. Bellow is the details:</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>For listing:</strong> <a href="{listing_url}" target="_blank">{listing_title}</a></p>
<p style="text-align: left;"><strong>Claim Time:</strong> {date}</p>
<p style="text-align: left;">-------------------------</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {date} - Claim created date<br>
        {listing_id} - Listing ID<br>
        {listing_title} - Listing title<br>
        {listing_url} - The listing url<br>",'townhub-add-ons'),

                )
            ),
            // and new claim author email

            array(
                "type" => "section",
                'id' => 'emails_section_auth_claim',
                "title" => __( 'Listing Claim Fee Request Email', 'townhub-add-ons' ),
                'callback' => function(){
                    echo '<p>'.esc_html__( 'Email send to author when his listing claim post is request to charge a fee.', 'townhub-add-ons' ).'</p>';
                }
            ),

            // array(
            //     "type" => "field",
            //     "field_type" => "checkbox",
            //     'id' => 'emails_section_customer_booking_approved_enable',
            //     'args'=> array(
            //         'default' => 'yes',
            //         'value' => 'yes',
            //     ),
            //     "title" => __('Enable/Disable', 'townhub-add-ons'),
            //     'desc'  => __('Enable this email notification', 'townhub-add-ons'),
            // ),

            
            array(
                "type" => "field",
                "field_type" => "text",
                'id' => 'emails_auth_claim_subject',
                'args'=> array(
                    'default' => '[{site_title}] Claim listing fee request',
                ),
                "title" => __('Subject', 'townhub-add-ons'),
                'desc'  => __('Available template tags:<br>
        {site_title} - The site title<br>
        {id} - Claim post id<br>
        {date} - Email sending date', 'townhub-add-ons'),
            ),

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'emails_auth_claim_temp',
                "title" => __('Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">You listing claim details:</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;"><strong>For listing:</strong> <a href="{listing_url}" target="_blank">{listing_title}</a></p>
<p style="text-align: left;"><strong>Claim Time:</strong> {date}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">Please follow this link <a href="{add_to_cart}" target="_blank">{add_to_cart}</a> to pay for the claim fee. <br>After you finish, you will have immediate be owner of the listing and access to all of our business tools!</p>',
                    
                    'desc' => __("Available template tags:<br>
        {site_title} - The site title<br>
        {author} - The order author's display name<br>
        {date} - Claim created date<br>
        {add_to_cart} - Add to cart link, allow author pay the fee<br>
        {listing_id} - Listing ID<br>
        {listing_title} - Listing title<br>
        {listing_url} - The listing url<br>",'townhub-add-ons'),

                )
            ),
            // claim listing email

            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'new_chat_temp',
                "title" => __('New Chat Reply Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {receiver},</p>
<p style="text-align: left;">{replyer} has just replied you on {site_title}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">{reply_text}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">Please login to view details.</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {receiver} -  Receiver name<br />
        {reply_text} - Reply Text<br />
        {date} - date<br />
        {replyer} - replyer name<br />",'townhub-add-ons'),

                )
            ),
            // new chat email
            array(
                "type" => "field",
                "field_type" => "editor",
                'id' => 'new_auth_msg_temp',
                "title" => __('New Message Email Template', 'townhub-add-ons'),
                'args'=> array(
                    'rows'=> 12,
                    'default'=> '<p style="text-align: left;">Hello {author},</p>
<p style="text-align: left;">{name} has just sent you a message on {site_title}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">{phone}</p>
<p style="text-align: left;">{message}</p>
<p style="text-align: left;">-------------------------</p>
<p style="text-align: left;">Reply him or login to view details.</p>',
                    
                    'desc' => __("Available template tags:<br />
        {site_title} - The site title<br />
        {author} -  Author name<br />
        {message} - Message text<br />
        {date} - date<br />
        {name} - User name<br />
        {phone} - User phone<br />",'townhub-add-ons'),

                )
            ),
            // new auth message email

    );
}
