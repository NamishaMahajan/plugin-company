<?php

if (!class_exists('Cm_Scripts')) {
    class Cm_Scripts {
        public function __construct() {
            add_action('wp_enqueue_scripts', array($this, 'admin_enqueue_scripts'));       
            add_action( 'wp_ajax_nopriv_get_data', array($this, 'get_data') );
            add_action( 'wp_ajax_get_data', array($this, 'get_data') );
        }

        // Enqueue necessary scripts and styles
        public function admin_enqueue_scripts() {
           
            wp_enqueue_style('multi-step-form-style', plugins_url( '/admin/css/multi-step-form.css' , __FILE__ ) );
            wp_enqueue_script('multi-step-form-script', plugins_url('/admin/js/multi-step-form.js', __FILE__), array('jquery'), null, true);
            wp_localize_script( 'multi-step-form-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        }

        public function get_data() {

            $form_data_array = [];
            $data =$_POST;
            
            // Convert the serialized form data to an associative array
            parse_str($data['form_data'], $form_data_array);
            // echo "<pre>";
            // print_r($form_data_array);
            // die;

            // Print the resulting array
            // echo "<pre>";
            // print_r($form_data_array);
            //  logic
            $title = $form_data_array['first_name']." ".$form_data_array['last_name'];
            $new_post = array(
                'post_title' =>  $title,
                'post_content' => 'Lorem ipsum dolor sit amet...',
                'post_status' => 'publish',
                'post_date' => date('Y-m-d H:i:s'),
                'post_type' => 'multi-step',
                );
                $post_id = wp_insert_post($new_post);

            update_post_meta( $post_id, 'first_name', $form_data_array['first_name']);
            update_post_meta( $post_id, 'last_name',$form_data_array['last_name']);
            update_post_meta( $post_id, 'email', $form_data_array['email']);
            update_post_meta( $post_id, 'address',$form_data_array['address']);
            update_post_meta( $post_id, 'country', $form_data_array['country']);
            update_post_meta( $post_id, 'state',$form_data_array['state']);
            update_post_meta( $post_id, 'city', $form_data_array['city'] );
            update_post_meta( $post_id, 'company_name',json_encode($form_data_array['company_name'])  );
            update_post_meta( $post_id, 'company_address',json_encode($form_data_array['company_address']) );
            update_post_meta( $post_id, 'card_number',$form_data_array['card_number']);
            update_post_meta( $post_id, 'expiry_date',$form_data_array['expiry_date']   );
            update_post_meta( $post_id, 'cvv',$form_data_array['cvv'] );

            // echo "<pre>";
            //   print_r($form_data_array);
            //   die;  
            

            // echo "<pre>";
            // print_r($post_id);
            //  die; 


        //     echo json_encode(['status' => 1,'message' => 'success']);
        //     wp_die();  //die();
        // }
    }
    // new Cm_Scripts();
}

}