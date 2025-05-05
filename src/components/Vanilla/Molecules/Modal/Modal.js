$( document ).ready( function () {

  // Al hacer clic en un botón con data-modal-open, mostramos el modal correspondiente
  $( document ).on( 'click', '[data-modal-open]', function() {
    let target = $( this ).data( 'modal-open' );
    $( '#' + target ).css( 'display', 'flex' );
  } );

  // Al hacer clic en el botón de cierre, ocultamos el modal
  $( document ).on( 'click', '.k-modal-close', function() {
    $( this ).closest( '.k-modal' ).css( 'display', 'none' );
  } );

  // Al hacer clic en el fondo del modal (backdrop), también lo cerramos
  $( document ).on( 'click', '.k-modal', function( e ) {
    if( $( e.target ).hasClass( 'k-modal' ) || $( e.target ).hasClass( 'k-modal-backdrop' ) ) {
      $( this ).css( 'display', 'none' );
    }
  } );

} );