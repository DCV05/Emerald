// carbon-input.js

$( document ).ready( function () {

  // ------------------------------------------------------------
  // Contador de caracteres si hay atributo maxlength
  // ------------------------------------------------------------
  $( document ).on( 'input', '.em--text-input[maxlength]', function () {

    let $input        = $( this );
    let max_count     = parseInt( $input.attr( 'maxlength' ), 10 );
    let current_count = $input.val().length;
    let $wrapper      = $input.closest( '.em--text-input-wrapper' );
    let $counter      = $wrapper.find( '.em--text-input__counter-text' );

    if ( $counter.length ) {
      $counter.text( current_count + ' / ' + max_count );
    }

    // Ocultamos el mensaje si el campo deja de estar vacío
    let $message = $wrapper.find( '.em--form-requirement' );
    if ( current_count > 0 ) {
      $message.hide();
    }

  } );

  // ------------------------------------------------------------
  // Mostrar u ocultar mensaje de error al perder el foco
  // ------------------------------------------------------------
  $( document ).on( 'blur', '.em--text-input', function () {

    let $input   = $( this );
    let $wrapper = $input.closest( '.em--text-input-wrapper' );
    let $message = $wrapper.find( '.em--form-requirement' );
    let is_empty = $input.val().trim() === '';

    if ( is_empty ) {
      $message.show();
    } else {
      $message.hide();
    }

  } );

} );