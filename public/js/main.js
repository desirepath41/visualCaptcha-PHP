( function( $ ) {
    $( function() {
        $( '.captcha' ).visualCaptcha( {
            imgPath: '/img/',
            captcha: {
              numberOfImages: 5
            }
        } );
    } );
}( jQuery ) );