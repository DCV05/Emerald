$( document ).ready( function() {
  // Toggle de submenús al hacer clic
  $( '.em-sidenav-menu__button' ).on( 'click', function() {
    const button    = $( this );
    const submenu   = button.next( '.em-sidenav__menu' );
    const expanded  = button.attr( 'aria-expanded' ) === 'true';

    // Cambiar el atributo ARIA
    button.attr( 'aria-expanded', !expanded );

    // Transición usando scrollHeight
    if( expanded ) {
      submenu.css( 'max-height', submenu[0].scrollHeight + 'px' );
      submenu[0].offsetHeight; // trigger reflow
      submenu.css( 'max-height', '0px' );
    } else {
      submenu.css( 'max-height', submenu[0].scrollHeight + 'px' );
    }

    // Al terminar la transición, quitar inline style si está expandido
    submenu.off('transitionend').on('transitionend', function () {
      if( !expanded )
        submenu.css( 'max-height', 'none' );
    } );
  } );
} );