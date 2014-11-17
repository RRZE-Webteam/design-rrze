


/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
   var custom_uploader;

    $('#upload_image_button').click(function(e) {
        e.preventDefault();
        var button = $(this);
	
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: { text:'Choose Image' },
            library: { type: 'image' }, 
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();            
            $('#upload_image').val(attachment.url); 
            htmlshow = "<img src=\""+attachment.url + "\">";
            $('.showimg').html(htmlshow); 
           
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
    
    $('.custom_clear_image_button').click(function() {  
        var defaultImage = $(this).parent().siblings('.custom_default_image').text();  
        $(this).parent().siblings('#upload_image').val('');  
        $(this).parent().siblings('#upload_image-show').attr('src', defaultImage);
        return false;  
    });  
    
    
});
