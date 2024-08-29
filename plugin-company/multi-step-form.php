<?php

if (!class_exists('MultiStepFormPlugin')) {
    class MultiStepFormPlugin {
        
        public function __construct() {
            add_shortcode('TESTER', array($this, 'test'));
            add_shortcode('multi_step_form', array($this, 'render_form'));
            add_action('admin_menu',  array($this, 'my_cool_plugin_create_menu'));
        }
        
        public function my_cool_plugin_create_menu() {
            //create new top-level menu     
            add_menu_page('My custom-plugin-setting','custom-plugin-settings','manage_options','my_plugin',[$this, 'plugin_settings_page'],plugins_url('/img/one.png', __FILE__));
            add_submenu_page( 'my_plugin', 'Import', 'Import', 'manage_options', 'settings_page_import', [$this, 'plugin_settings_page_import'] );
            add_submenu_page( 'my_plugin', 'Export', 'Export', 'manage_options', 'settings_page_export',  [$this, 'plugin_settings_page_export']);            
        }
        
        public function plugin_settings_page_import() {
            if(isset($_POST['company_plugin_settings_import'])){
                //code here 
            }

            $html = '';
            $html .= '<h2>Import</h2>'; 
            $html .= '<div class="content">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>'; 
                //form impirt
            echo $html;
        }

        public function plugin_settings_page_export() {
            if(isset($_POST['company_plugin_settings_export'])){
                //code here 
            }

            $html = '';
            $html .= '<h2>Export</h2>'; 
            $html .= '<div class="content">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>';
                //form export
            echo $html;
        }

        public function plugin_settings_page() {
           
            if(isset($_POST['company_plugin_settings'])){
                update_option( 'cp_plugin_name', $_POST['plugin_name'] );
                update_option( 'cp_plugin_dec', $_POST['plugin_desc'] );
            }

            $cp_plugin_name = !empty(get_option( 'cp_plugin_name' )) ? get_option( 'cp_plugin_name' ) : ''; 
            $cp_plugin_dec = !empty(get_option( 'cp_plugin_dec' )) ? get_option( 'cp_plugin_dec' ) : '';
            
            $html = '';
            $html .= '<h2>Setting page</h2>'; 
            $html .= '<div class="content">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>';
            $html .= '<form action="" method="post">
                    <label for="plugin_name">Plugin Name:</label><br>
                    <input type="text" id="plugin_name" name="plugin_name" value="'. $cp_plugin_name.'"><br>
                    <label for="plugin_desc">Plugin Description:</label><br>
                    <input type="text" id="plugin_desc" name="plugin_desc" value="'. $cp_plugin_dec.'"><br><br>
                    <input type="submit" name="company_plugin_settings" value="Submit">
                    </form>';
            echo $html;
        }

        // Render the form using a shortcode
        public function render_form() {
            ob_start();
            ?>
<form id="multiStepForm" method="POST">
 <!-- Step 1: Personal Information -->
    <div class="form-step step-1">
        <h2>Step 1: Personal Information</h2>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name"  required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address">
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" class="autocomplete">
        <label for="state">State:</label>
        <input type="text" id="state" name="state">
        <label for="city">City:</label>
        <input type="text" id="city" name="city">
        <button type="button" id="nextbutton" class="next-step next-step-1">Next</button>
    </div>
    <div class="step" id="step-2" style="display:none;">
        <h2>Step 2: Company Info</h2>
        <div id="company-info">
            <div class="company-item">
                <label for="company-name">Company Name:</label>
                <input type="text" class="company-name" name="company_name[]" placeholder="Enter Company Name">
                <label for="company-address">Company Address:</label>
                <input type="text" class="company-address" name="company_address[]" placeholder="Enter Company Address">
                <button type="button" class="remove-company">Remove</button>
            </div>
        </div>
        <button type="button" id="add-company">Add Another Company</button>
        <!-- Ensure the buttons are below the dynamic fields -->
        <div class="navigation-buttons">
            <button type="button" class="prev-btn prev-btn-2">Previous</button>
            <button type="button" class="next-btn next-step-2">Next</button>
        </div>
    </div>
    <!-- Step 3 -->
    <div class="step" id="step-3" style="display:none;">
        <h2>Step 3: Card Info</h2>
        <label for="card-number">Card Number:</label>
        <input type="text" id="card-number" name="card_number">
        <label for="expiry-date">Expiry Date:</label>
        <input type="text" id="expiry-date" name="expiry_date">
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv">
        <button type="button" class="prev-btn prev-btn-3">Previous</button>
        <button type="button" class="submit-multi">Submit</button>
        <div id="formLoader" style="display:none"> <img src="<?php echo  plugins_url('/includes/admin/images/loader.gif',__FILE__)?>" alt = "no loader"></div>
    </div>
</form>
<?php
            return ob_get_clean();
        }
        //add_shortcode('renderform', 'render_form');

        public function test(){
            ob_start();
            echo "This is a test shortcode.";
            return ob_get_clean();
        }
    }

    new MultiStepFormPlugin();
}
// Sample data
