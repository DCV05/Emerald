$( document ).ready( function() {

  // ------------------------------------------------------------
  // Marcar como indeterminado si lo indica el atributo
  // ------------------------------------------------------------
  $( '[data-indeterminate="true"]' ).each( function() {
    this.indeterminate = true;
  } );

  // ------------------------------------------------------------
  // Bloquear interacción si readonly
  // ------------------------------------------------------------
  $( document ).on( 'click', '.em--checkbox[aria-readonly="true"]', function( e ) {
    e.preventDefault();
  } );

} );