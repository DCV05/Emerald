// em--select.js

$( document ).ready( function() {

  // ------------------------------------------------------------
  // Abre o cierra el menú desplegable al hacer clic en el botón
  // ------------------------------------------------------------
  $( document ).on( 'click', '.em--select__button', function( e ) {
    e.preventDefault();

    const $dropdown = $( this ).closest( '.em--select' );
    const is_open   = $dropdown.hasClass( 'em--select--open' );

    // Cerramos todos los menús abiertos
    $( '.em--select' ).removeClass( 'em--select--open' );
    $( '.em--select' ).find( '[aria-expanded]' ).attr( 'aria-expanded', 'false' );

    // Si el menú estaba cerrado, lo abrimos
    if( !is_open ) {
      $dropdown.addClass( 'em--select--open' );
      $dropdown.find( '[aria-expanded]' ).attr( 'aria-expanded', 'true' );
      $dropdown.find( '.em--select__option' ).first().focus();
    }
  } );

  // ------------------------------------------------------------
  // Selecciona una opción al hacer clic sobre ella
  // ------------------------------------------------------------
  $( document ).on( 'click', '.em--select__option', function() {
    select_option( $( this ) );
  } );

  // ------------------------------------------------------------
  // Función para gestionar la selección de una opción
  // ------------------------------------------------------------
  function select_option( $item )
  {
    const $menu      = $item.closest( '.em--select__list' );
    const $dropdown  = $item.closest( '.em--select' );
    const $label     = $dropdown.find( '.em--select__label' );
    const text       = $item.text().trim();

    // Quitamos selección previa
    $menu.find( '.em--select__option' ).removeClass( 'is-selected' ).removeAttr( 'aria-selected' );

    // Seleccionamos nuevo ítem
    $item.addClass( 'is-selected' ).attr( 'aria-selected', 'true' );

    // Actualizamos el texto visible
    $label.text( text );

    // Cerramos el menú
    $dropdown.removeClass( 'em--select--open' );
    $dropdown.find( '[aria-expanded]' ).attr( 'aria-expanded', 'false' );
  }

  // ------------------------------------------------------------
  // Cierra el menú si hacemos clic fuera del componente
  // ------------------------------------------------------------
  $( document ).on( 'click', function( e ) {
    if( !$( e.target ).closest( '.em--select' ).length ) {
      $( '.em--select' ).removeClass( 'em--select--open' );
      $( '.em--select' ).find( '[aria-expanded]' ).attr( 'aria-expanded', 'false' );
    }
  } );

  // ------------------------------------------------------------
  // Navegación por teclado entre opciones
  // ------------------------------------------------------------
  $( document ).on( 'keydown', '.em--select__option', function( e ) {
    const $current = $( this );

    if( e.key === 'ArrowDown' )
    {
      e.preventDefault();
      $current.nextAll( '.em--select__option' ).first().focus();
    }

    if( e.key === 'ArrowUp' )
    {
      e.preventDefault();
      $current.prevAll( '.em--select__option' ).first().focus();
    }

    if( e.key === 'Enter' || e.key === ' ' )
    {
      e.preventDefault();
      select_option( $current );
    }

    if( e.key === 'Escape' )
    {
      const $dropdown = $current.closest( '.em--select' );
      $dropdown.removeClass( 'em--select--open' );
      $dropdown.find( '[aria-expanded]' ).attr( 'aria-expanded', 'false' );
      $dropdown.find( '.em--select__button' ).focus();
    }
  } );

} );