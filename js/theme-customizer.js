jQuery( document ).ready(function( $ )
{
	wp.customize( 'blogname', function( value ) 
    {
		value.bind( function( val ) 
        {
			$( '#site-title span' ).html( val );
		} );
	} );
    
	wp.customize( 'blogdescription', function( value ) 
    {
		value.bind( function( val ) 
        {
			$( '#site-description span' ).html( val );
		} );
	} );
        
});