$( document ).ready( function() {

  $( '.em--sidebar__toggle-button' ).on( 'click', function( e ) {

    e.preventDefault();

    const $sidebar  = $( '.em--sidebar' );
    const current   = $sidebar.attr( 'data-collapsible' );

    // Alternamos entre "icon" y "offcanvas" (o vacío si prefieres)
    if( current === 'icon' )
      $sidebar.attr( 'data-collapsible', 'offcanvas' );
    else
      $sidebar.attr( 'data-collapsible', 'icon' );

  } );

} );