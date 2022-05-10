<script>
    var input_validation = true;

    $('.phone_field').attr("autocomplete", 'on');
    $('.phone_field').attr("maxlength", "14");
    $('.phone_field').on({
        input: function(e) {
            var str = $(this).val();
            if (str.match(/[a-z]/i)) {
                $(this).val(str.replace(/\D/g, ""));
            } else {
                $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d{4})+$/, "($1) $2-$3"));
            }
        },
    });

	$('.phone_field').change( function () {
        var phone = $(this).val().replace(/\D/g,"");
        if ( phone.length == 10 ){
            $('.phone-errors').remove();
            input_validation = true;
        } else { 
            $(".phone-errors").remove();
            $(this).after('<span class="text-danger phone-errors">Requires only 10 digits and match requested format!</span>');
            input_validation = false;
            
        }
    });

    $(".numerical_field").on('input', function(e) {
        $(".error_numerical_field").remove();
        if (/^[0-9]*$/.test($(this).val())) {
            input_validation = true;
            return true;
        } else {
            $(this).val($(this).val().slice(0, -1));
            $(this).after("<span class='text-danger error_numerical_field'>Please Type only digits!</span>");
            $(this).focus();
            input_validation = false;
            return false;
        }
    });

    $(".alpha_field").on('input', function(e) {
        $(".error_alpha_field").remove();
        if (/^[a-zA-Z ]*$/.test($(this).val())) {
            input_validation = true;
            return true;
        } else {
            $(this).val($(this).val().slice(0, -1));
            $(this).after("<span class='text-danger error_alpha_field'>Please Type only Alphabets!</span>");
            input_validation = false;
            return false;
        }
    });

    $(".email_address_field").blur(function() {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailaddress = $(this).val();
        var confirmemailaddress = $(".confirm_email_address_field").val();
        if (emailaddress != confirmemailaddress) {
            $(this).val('');
        }
    });

    $(".confirm_email_address_field").blur(function() {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var confirmemailaddress = $(this).val().toLowerCase();
        var emailaddress = $(".email_address_field").val().toLowerCase();
        if (emailaddress != confirmemailaddress) {
            $('.error-confirm_email_address_field').remove();
            $(this).after('<span class="text-danger error-confirm_email_address_field">Email and confirm email doesn\'t match</span>');
        } else {
            $('.error-confirm_email_address_field').remove();
        }
    });

    $('.confirm_email_address_field').on("cut copy paste", function(e) {
        e.preventDefault();
    });

    $('.email_address_field').on("cut copy paste", function(e) {
        e.preventDefault();
    });

    $('.zip_code_field').on('focus', function(e) {
        $(this).attr('maxlength', '5');
        $(this).on('input', function() {
            zipvalue = $(this).val()
            val = zipvalue.replace(/\D/g, "");
            $(this).val(val);
        });
    });

    $('.zip_code_field').change(function() {
        var zip = $(this).val();
        if (zip.length == 5) {
            $('.zip-errors').remove();
            input_validation = true;
        } else {
            $('.zip-errors').remove();
            $(this).after('<span class="text-danger zip-errors">Required 5 digits, Enter Valid Zip!</span>');
            input_validation = false;
        }
    });
    
    $('.website_field').change(function() {
        var txt = $(this).val();
        var re = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/
        if (re.test(txt)) {
            input_validation = true;
            $('.website_field-errors').remove();
        } else {
            $('.website_field-errors').remove();
            $(this).after('<span class="text-danger website_field-errors">Must be valid website</span>');
            input_validation = false;
        }
    });

    // master submit for all forms available in all pages. 
    $(document).on('submit', 'form', function(e) {
      console.log("input_validation====>",input_validation);
      if (input_validation) {
         on();
      }
    });
</script>
