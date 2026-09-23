<?php
/**
 * Plugin Name: MAGNA Tech Core
 * Description: Business content types and project enquiry handling for the MAGNA Tech website.
 * Version: 1.0.0
 * Author: MAGNA Tech
 */

if (!defined('ABSPATH')) exit;


/**
 * Register MAGNA Tech custom post types.
 */
function magna_core_register_types() {

    register_post_type(
        'magna_service',
        array(
            'labels' => array(
                'name'          => 'Services',
                'singular_name' => 'Service',
                'add_new_item'  => 'Add Service',
                'edit_item'     => 'Edit Service'
            ),
            'public'       => true,
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-admin-tools',
            'supports'     => array(
                'title',
                'editor',
                'thumbnail',
                'page-attributes'
            ),
            'has_archive' => true,
            'rewrite'     => array(
                'slug' => 'services'
            )
        )
    );


    register_post_type(
        'magna_project',
        array(
            'labels' => array(
                'name'          => 'Projects',
                'singular_name' => 'Project',
                'add_new_item'  => 'Add Project',
                'edit_item'     => 'Edit Project'
            ),
            'public'       => true,
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-portfolio',
            'supports'     => array(
                'title',
                'editor',
                'thumbnail',
                'page-attributes'
            ),
            'has_archive' => true,
            'rewrite'     => array(
                'slug' => 'projects'
            )
        )
    );


    register_post_type(
        'magna_testimonial',
        array(
            'labels' => array(
                'name'          => 'Testimonials',
                'singular_name' => 'Testimonial',
                'add_new_item'  => 'Add Testimonial',
                'edit_item'     => 'Edit Testimonial'
            ),
            'public'       => false,
            'show_ui'      => true,
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-format-quote',
            'supports'     => array(
                'title',
                'editor',
                'thumbnail'
            )
        )
    );


    register_post_type(
        'magna_enquiry',
        array(
            'labels' => array(
                'name'          => 'Enquiries',
                'singular_name' => 'Enquiry',
                'add_new_item'  => 'Add Enquiry',
                'edit_item'     => 'View Enquiry'
            ),
            'public'       => false,
            'show_ui'      => true,
            'show_in_rest' => false,
            'menu_icon'    => 'dashicons-email-alt',
            'supports'     => array(
                'title',
                'editor',
                'custom-fields'
            )
        )
    );
}

add_action('init', 'magna_core_register_types');


/**
 * Handle project enquiry submission.
 */
function magna_core_submit_enquiry() {

    /*
     * Security check.
     */
    if (
        !isset($_POST['magna_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(
                wp_unslash($_POST['magna_nonce'])
            ),
            'magna_enquiry'
        )
    ) {
        wp_die('Security check failed.');
    }


    /*
     * Existing enquiry fields.
     */
    $name = sanitize_text_field(
        wp_unslash($_POST['name'] ?? '')
    );

    $email = sanitize_email(
        wp_unslash($_POST['email'] ?? '')
    );

    $company = sanitize_text_field(
        wp_unslash($_POST['company'] ?? '')
    );

    $phone = sanitize_text_field(
        wp_unslash($_POST['phone'] ?? '')
    );

    $service = sanitize_text_field(
        wp_unslash($_POST['service'] ?? '')
    );

    $message = sanitize_textarea_field(
        wp_unslash($_POST['message'] ?? '')
    );


    /*
     * Budget fields.
     */
    $budget_currency = strtoupper(
        sanitize_text_field(
            wp_unslash($_POST['budget_currency'] ?? '')
        )
    );

    $budget_amount = sanitize_text_field(
        wp_unslash($_POST['budget_amount'] ?? '')
    );

    $budget_not_sure = (
        isset($_POST['budget_not_sure']) &&
        $_POST['budget_not_sure'] === '1'
    );


    /*
     * Only allow USD, INR and EUR.
     */
    if (
        !in_array(
            $budget_currency,
            array('USD', 'INR', 'EUR'),
            true
        )
    ) {
        $budget_currency = '';
    }


    /*
     * Keep only numbers and decimal point
     * in the budget amount.
     */
    $budget_amount = preg_replace(
        '/[^0-9.]/',
        '',
        $budget_amount
    );


    /*
     * If the visitor isn't sure about budget,
     * clear currency and amount.
     */
    if ($budget_not_sure) {
        $budget_currency = '';
        $budget_amount   = '';
    }


    /*
     * Required field validation.
     */
    if (
        !$name ||
        !is_email($email) ||
        !$message
    ) {
        wp_safe_redirect(
            add_query_arg(
                'enquiry',
                'error',
                home_url('/#contact')
            )
        );

        exit;
    }


    /*
     * Enquiry title.
     */
    $title = 'Enquiry from ' . $name;

    if ($company) {
        $title .= ' - ' . $company;
    }


    /*
     * Create readable budget text.
     */
    if ($budget_not_sure) {

        $budget_text = 'Not sure about budget';

    } elseif (
        $budget_currency &&
        $budget_amount
    ) {

        $budget_text =
            $budget_currency . ' ' . $budget_amount;

    } else {

        $budget_text = 'Not specified';
    }


    /*
     * Enquiry content.
     */
    $content =
        "Name: {$name}\n" .
        "Email: {$email}\n" .
        "Company: {$company}\n" .
        "Phone: {$phone}\n" .
        "Service: {$service}\n" .
        "Budget: {$budget_text}\n\n" .
        "Message:\n{$message}";


    /*
     * Save enquiry as a private WordPress post.
     */
    $post_id = wp_insert_post(
        array(
            'post_type'    => 'magna_enquiry',
            'post_status'  => 'private',
            'post_title'   => $title,
            'post_content' => $content
        ),
        true
    );


    /*
     * Save enquiry metadata and send email.
     */
    if (!is_wp_error($post_id)) {

        update_post_meta(
            $post_id,
            'name',
            $name
        );

        update_post_meta(
            $post_id,
            'email',
            $email
        );

        update_post_meta(
            $post_id,
            'company',
            $company
        );

        update_post_meta(
            $post_id,
            'phone',
            $phone
        );

        update_post_meta(
            $post_id,
            'service',
            $service
        );

        update_post_meta(
            $post_id,
            'budget_currency',
            $budget_currency
        );

        update_post_meta(
            $post_id,
            'budget_amount',
            $budget_amount
        );

        update_post_meta(
            $post_id,
            'budget_not_sure',
            $budget_not_sure ? 'yes' : 'no'
        );

        update_post_meta(
            $post_id,
            'status',
            'new'
        );


        /*
         * Send enquiry notification email.
         */
        $enquiry_sent = wp_mail(
    'techmagna26@gmail.com',
    'New MAGNA Tech project enquiry',
    $content,
    array(
        'Reply-To: ' . $email
    )
);

if (!$enquiry_sent) {
    wp_safe_redirect(
        add_query_arg(
            'enquiry',
            'error',
            home_url('/#contact')
        )
    );
    exit;
}
    }


    /*
     * Redirect visitor back to contact section.
     */
    wp_safe_redirect(
        add_query_arg(
            'enquiry',
            is_wp_error($post_id) ? 'error' : 'sent',
            home_url('/#contact')
        )
    );

    exit;
}


add_action(
    'admin_post_nopriv_magna_submit_enquiry',
    'magna_core_submit_enquiry'
);

add_action(
    'admin_post_magna_submit_enquiry',
    'magna_core_submit_enquiry'
);


/**
 * Flush rewrite rules when plugin is activated.
 */
function magna_core_flush_on_activation() {

    magna_core_register_types();

    flush_rewrite_rules();
}

register_activation_hook(
    __FILE__,
    'magna_core_flush_on_activation'
);


/**
 * Flush rewrite rules when plugin is deactivated.
 */
register_deactivation_hook(
    __FILE__,
    'flush_rewrite_rules'
);