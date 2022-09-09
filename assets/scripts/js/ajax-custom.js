
(function($) {
    $(document).ready(function() {
        $(document).on('submit', '[data-ajax=filter]', function(e) {
            e.preventDefault(); //
            data = {
                'action': 'data',
                'query': wpAjax.posts, // that's how we get params from wp_localize_script() function
                'offset':postoffset,
                'page' : wpAjax.current_page
            };

            //console.log($(this));
            var data = $(this).serialize();
            var postoffset = $('.hentry').length;

            
            $.ajax({
                url: wpAjax.ajaxUrl,
                data: data,
                type: 'post',
                success: function(result) {
                    $('[data-ajax=target]').html(result);
                }, 
                error: function(result) {
                    console.warn(result);
                }
            });
        
        });
    });    
}) (jQuery);

jQuery(function ($){
    $('.misha_loadmore').click(function(){   
        var button = $(this);
        var postoffset = $('.hentry').length;
        
            data = {
                'action': 'loadmore',
                'query': wpAjax.posts, // that's how we get params from wp_localize_script() function
                'offset':postoffset,
                'page' : wpAjax.current_page
            };
            //console.log($(this));
        $.ajax({
            url : wpAjax.ajaxUrl, // AJAX handler
            data : data,
            type : 'POST',
           // beforeSend : function ( xhr ) {
            //    button.text('Loading...'); // change the button text, you can also add a preloader image
           // },
            success : function( data ){
                if( data ) { 
                    $('[data-ajax=target]').append(data); // insert new posts
                    wpAjax.current_page++;

                    if ( wpAjax.current_page == wpAjax.max_page ) 
                        button.remove(); // if last page, remove the button

                    // you can also fire the "post-load" event here if you use a plugin that requires it
                    // $( document.body ).trigger( 'post-load' );
                } else {
                    button.remove(); // if no data, remove the button as well
                }
            }
        });
    }); 
});