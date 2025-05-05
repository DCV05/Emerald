$( document ).ready( function() {

  // ------------------------------------------------------------
  // Contador de caracteres para textareas con maxlength
  // ------------------------------------------------------------
  $( document ).on( 'input', '.em--textarea[maxlength]', function () {

    const $textarea     = $( this );
    const max_count     = parseInt( $textarea.attr( 'maxlength' ), 10 );
    const current_count = $textarea.val().length;
    const $wrapper      = $textarea.closest( '.em--textarea-wrapper' );
    const $counter      = $wrapper.find( '.em--textarea__counter-text' );

    if( $counter.length ) {
      $counter.text( current_count + ' / ' + max_count );
    }

    // Ocultamos el mensaje de error si empieza a escribir
    const $message = $wrapper.find( '.em--form-requirement' );
    if( current_count > 0 ) {
      $message.hide();
    }

  } );

  // ------------------------------------------------------------
  // Mostrar el mensaje de error si el textarea queda vacío al perder el foco
  // ------------------------------------------------------------
  $( document ).on( 'blur', '.em--textarea', function () {

    const $textarea = $( this );
    const $wrapper  = $textarea.closest( '.em--textarea-wrapper' );
    const $message  = $wrapper.find( '.em--form-requirement' );
    const is_empty  = $textarea.val().trim() === '';

    if( is_empty ) {
      $message.show();
    } else {
      $message.hide();
    }

  } );

} );