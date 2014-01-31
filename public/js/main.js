( function( window, $ ) {
    $( function() {
        $( '.captcha' ).visualCaptcha( {
            imgPath: '/img/',
            captcha: {
                url: window.location.protocol.origin,
                numberOfImages: 5
            }
        } );
    } );
}( window, jQuery ) );