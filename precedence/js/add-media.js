$(document).ready(function () {
    //form validation rules
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    });
    
    // validate signup form on keyup and submit 
    
    $("#media-form").validate({
        rules: {
            img: {
                required: true,
                extension: "jpg|jpeg|png|webp|gif"
            },
            
        },
        messages: {
            img: {
                required: "Image is required",
                extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp, webp, gif)."
            },
            
        },
        errorElement: "span",
        submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
        }
    });
});
