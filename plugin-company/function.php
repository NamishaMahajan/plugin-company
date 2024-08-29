<?php

// if (!class_exists('Company')) {
//     class  { Company
//         // Constructor
//         public function __construct() {
//             // Add actions, filters, or initialize methods here
//             add_action('init', array($this, 'init'));
//         }

//         // Initialize method
//         public function init() {
//             // Custom functionality to initialize
//             // Example: Register a custom post type
//             $this->register_custom_post_type();
//         }

//         // Example function: Register a custom post type
//         private function register_custom_post_type() {
//             $args = array(
//                 'public' => true,
//                 'label'  => 'Books',
//             );
//             register_post_type('book', $args);
//         }

//         // More custom methods can be added here
//     }

//     // Instantiate the class to ensure the plugin functionality is loaded
//     $Company= new Company();
// }



//contact-info
function display_company_info() {
    ob_start();
    
    if (function_exists('get_field')) {
        $company_info = get_field('company_info'); // Replace with your actual field name

        if ($company_info) {
            echo '<ul class="company-info-list">';
            foreach ($company_info as $company) {
                echo '<li>';
                echo '<strong>Company Name:</strong> ' . esc_html($company['company_name']) . '<br />';
                echo '<strong>Company Address:</strong> ' . esc_html($company['company_address']);
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo 'No company information found.';
        }
    }

    return ob_get_clean();
}
add_shortcode('company_info', 'display_company_info');





// AJAX handler for form submission
function submit_multi_step_form() {
    // Check if the form data is set
    if (isset($_POST['form_data'])) {
        // Parse the serialized form data
        parse_str($_POST['form_data'], $form_data);

        // Prepare the post data for the custom post type
        $new_post = array(
            'post_title' => 'My New Post',
            'post_content' => 'Lorem ipsum dolor sit amet...',
            'post_status' => 'publish',
            'post_date' => date('Y-m-d H:i:s'),
            'post_type' => 'contact',
            );
            $post_id = wp_insert_post($new_post);

        // Insert the post into the database
        // $post_id = wp_insert_post($post_data);
        
        // echo "<pre>";
        // print_r($form_data_array);
        //  die;   
    //     $first_name = $Array['first_name'];
    //     $last_name =  $Array[' last_name'];
    //     $email =  $Array['email'];
    //     $address =  $Array['address'];
    //     $country =  $Array['country'];
    //     $state =  $Array['state'];
    //     $city =  $Array['city'];
    //     $first_company_name =  $Array['company_name'][0];
    //     $first_company_address = $form_data_array['company_address'][0]; 
    //     $second_company_name = $form_data_array['company_name'][1]; 
    //     $second_company_address = $form_data_array['company_address'][1]; 
    //     $card_number =  $Array['card_number'];
    //     $expiry_date = $Array['expiry_date'];
    //     $cvv = $Array['cvv'];
       

    //     echo 'First Name: ' . $first_name . '<br>';
    //     echo 'Last Name: ' .  $last_name . '<br>';
    //    echo 'email' . $email . '<br';
    //    echo 'address' . $address . '<br';
    //    echo 'country' . $country. '<br';
    //    echo 'state' . $state. '<br';
    //    echo 'city' .$city. '<br';
    //    echo 'city' .$city. '<br';
    //    echo 'city' .$city. '<br';
    //    echo 'First Company: ' . $first_company_name . ' is located at ' . $first_company_address . '<br>';
    //    echo 'Second Company: ' . $second_company_name . ' is located at ' . $second_company_address . '<br>';
       
    //    echo 'Card Nnumber: ' . $card_number . '<br>';
    //    echo 'Expiry Date: ' .  $expiry_date . '<br>';
    //    echo 'Cvv: ' . $cvv . '<br>';
       

     

           




       

        if ($post_id) {
            wp_send_json_success(array('message' => 'Post created successfully!'));
        } else {
            wp_send_json_error(array('message' => 'Failed to create post.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Invalid form submission.'));
    }
}
add_action('wp_ajax_submit_multi_step_form', 'submit_multi_step_form');
add_action('wp_ajax_nopriv_submit_multi_step_form', 'submit_multi_step_form');





