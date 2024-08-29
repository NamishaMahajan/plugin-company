<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

jQuery(document).ready(function($) {
        //console.log("Script Loaded");
        // Step 1 to Step 2
        $(".next-step-1").click(function(){
            console.log("Next Step 1 Button Clicked");
            $(".form-step.step-1").hide(); // Hide Step 1
            $("#step-2").show(); // Show Step 2
        });
    
        // Step 2 to Step 3
        
        $(".next-step-2").click(function(){
            console.log("Next Step 2 Button Clicked");
            $("#step-2").hide(); // Hide Step 2
            $("#step-3").show(); // Show Step 3
        });
    
        // Previous buttons
        $(".prev-btn-2").click(function(){
            console.log("Previous Step 2 Button Clicked");
            $("#step-2").hide(); // Hide Step 2
            $(".form-step.step-1").show(); // Show Step 1
        });
    
        $(".prev-btn-3").click(function(){
            console.log("Previous Step 3 Button Clicked");
            $("#step-3").hide(); // Hide Step 3
            $("#step-2").show(); // Show Step 2
        });
    
        // On form submission (final step)
        $(".submit-multi").click(function(){
            var formData = $('#multiStepForm').serialize(); // Serialize form data
    
            $.ajax({
                url: my_ajax_object.ajax_url, // WordPress AJAX URL
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'get_data', // Custom AJAX action
                    form_data: formData
                },
                success: function(response) {
                    console.log(response);
                    alert("HERE");
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        });
    
        // Dynamic fields for Company Name and Address
        let companyTemplate = `
            <div class='company-item'>
                <label for='company-name'>Company Name:</label>
                <input type='text' class='company-name' name='company_name[]' placeholder='Enter Company Name' />
                <label for='company-address'>Company Address:</label>
                <input type='text' class='company-address' name='company_address[]' placeholder='Enter Company Address' />
                <button type='button' class='remove-company'>Remove</button>
            </div>`;
    
        // Add another company on button click
        $("#add-company").on("click", function() {
            console.log("Add Another Company Button Clicked");
            $("#company-info").append(companyTemplate);
        });
    
        // Remove company item
        $("body").on("click", ".remove-company", function(e) {
            console.log("Remove Company Button Clicked");
            $(e.target).closest(".company-item").remove();
        });
    
    });

    
    $(document).ready(function() {

        function validateStep1() {
            let isValid = true;
    
            if ($('#first_name').val().trim() === '') {
                alert('First Name is required.');
                isValid = false;
            }
    
            if ($('#last_name').val().trim() === '') {
                alert('Last Name is required.');
                isValid = false;
            }
    
            if ($('#email').val().trim() === '') {
                alert('Email is required.');
                isValid = false;
            } else if (!validateEmail($('#email').val().trim())) {
                alert('Invalid Email format.');
                isValid = false;
            }
    
            return isValid;
        }
    
        function validateStep2() {
            let isValid = true;
    
            if ($('#company_name').val().trim() === '') {
                alert('Company Name is required.');
                isValid = false;
            }
    
            if ($('#company_address').val().trim() === '') {
                alert('Company Address is required.');
                isValid = false;
            }
    
            return isValid;
        }
    
        function validateStep3() {
            let isValid = true;
    
            if ($('#card_number').val().trim() === '') {
                alert('Card Number is required.');
                isValid = false;
            }
    
            if ($('#expiry_date').val().trim() === '') {
                alert('Expiry Date is required.');
                isValid = false;
            }
    
            if ($('#cvv').val().trim() === '') {
                alert('CVV is required.');
                isValid = false;
            }
    
            return isValid;
        }
    
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    
        $('.next-step-1').on('click', function() {
            if (validateStep1()) {
                $('.step-1').hide();
                $('.step-2').show();
            }
        });
    
        $('.next-step-2').on('click', function() {
            if (validateStep2()) {
                $('.step-2').hide();
                $('.step-3').show();
            }
        });
    
        $('.prev-step-1').on('click', function() {
            $('.step-2').hide();
            $('.step-1').show();
        });
    
        $('.prev-step-2').on('click', function() {
            $('.step-3').hide();
            $('.step-2').show();
        });
    
        $('#multiStepForm').on('submit', function(e) {
            if (!validateStep3()) {
                e.preventDefault();  // Prevent form submission if validation fails
            }
        });
    
    });
    
    

     

     


    


    