function showInpostMap() {

    // Grab our post meta value
    //var um_val = $( '#um_form #um_key' ).val();

    // Do very simple value validation
    $.ajax( {
        url : ajax_url,                 // Use our localized variable that holds the AJAX URL
        type: 'POST',                   // Declare our ajax submission method ( GET or POST )
        data: {                         // This is our data object
            action  : 'save_easypack_code',          // AJAX POST Action
            'first_name': 'maniek',       // Replace `um_key` with your user_meta key name
        }
    } )
    .success( function( results ) {
        console.log( 'User Meta Updated!' );
    } )
    .fail( function( data ) {
        console.log( data.responseText );
        console.log( 'Request failed: ' + data.statusText );
    } );

} 