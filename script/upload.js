jQuery(function($){

    // on upload button click
    $('body').on( 'click', '#upload_portrait-button', function(e){

        e.preventDefault();


           const custom_uploader = wp.media({
                title: 'Insert image',
                library : {
                    // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                    type : 'image'
                },
                button: {
                    text: 'Use this image' // button label text
                },
                multiple: false
            }).on('select', function() { // it also has "open" and "close" events
                const attachment = custom_uploader.state().get('selection').first().toJSON();
                $("#upload_portrait").val(attachment.url)

                $('#upload_portrait-view').html('<img src="' + attachment.url + '">').next().val(attachment.id).next().show();
            }).open();

    });

    // on remove button click
    $('body').on('click', '.misha-rmv', function(e){

        e.preventDefault();

        var button = $(this);
        button.next().val(''); // emptying the hidden field
        button.hide().prev().html('Upload image');
    });

});