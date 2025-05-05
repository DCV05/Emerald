<?php

/**
 * Componente SideNav
 *
 * Renderiza una barra lateral con enlaces, menús y secciones.
 * Soporta elementos SideNavLink, SideNavMenu y títulos como string.
 *
 * DEPENDENCIAS:
 * - requiere: SideNavLink (sidenav-link.php)
 * - requiere: SideNavMenu (sidenav-menu.php)
 */
class SideNav
{
  private array  $items;
  private string $class;
  private string $id;
  private bool   $expanded;
  private bool   $is_rail;
  private bool   $is_fixed_nav;
  private bool   $is_persistent;
  private bool   $is_child_of_header;
  private string $header_html;

  /**
   * Constructor del SideNav
   *
   * @param array  $items               Lista de elementos (strings, SideNavLink o SideNavMenu)
   * @param string $class               Clases CSS adicionales (opcional)
   * @param string $id                  ID del componente (opcional)
   * @param bool   $expanded            Estado expandido (true) o en modo rail (false)
   * @param bool   $is_rail             Si está en modo rail o no
   * @param bool   $is_fixed_nav        Si está colapsado de forma fija (modo botón hamburguesa)
   * @param bool   $is_persistent       Si está visible siempre (false = oculto)
   * @param bool   $is_child_of_header  Si está debajo del header
   * @param string $header_html         HTML opcional para mostrar arriba del todo
   */
  public function __construct(
      array  $items
    , string $class              = ''
    , string $id                 = ''
    , bool   $expanded           = false
    , bool   $is_rail            = false
    , bool   $is_fixed_nav       = false
    , bool   $is_persistent      = true
    , bool   $is_child_of_header = true
    , string $header_html        = ''
  )
  {
    $this->items              = $items;
    $this->class              = $class;
    $this->id                 = $id;
    $this->expanded           = $expanded;
    $this->is_rail            = $is_rail;
    $this->is_fixed_nav       = $is_fixed_nav;
    $this->is_persistent      = $is_persistent;
    $this->is_child_of_header = $is_child_of_header;
    $this->header_html        = $header_html;
  }

  /**
   * Renderiza el bloque completo de navegación
   */
  public function render(): string
  {
    // Cálculo de clases
    $nav_class = 'em-sidenav';
    if( $this->expanded )                       $nav_class .= ' em-sidenav--expanded';
    if( !$this->expanded && $this->is_fixed_nav ) $nav_class .= ' em-sidenav--collapsed';
    if( $this->is_rail )                        $nav_class .= ' em-sidenav--rail';
    if( $this->is_child_of_header )             $nav_class .= ' em-sidenav--ux';
    if( !$this->is_persistent )                 $nav_class .= ' em-sidenav--hidden';
    if( $this->class !== '' )                   $nav_class .= ' ' . $this->class;

    $id_attr = $this->id !== '' ? 'id="' . $this->id . '"' : '';

    // Render de elementos hijos
    $items_html = '';
    foreach( $this->items as $item )
    {
      if( is_string( $item ) )
        $items_html .= '<li class="em-sidenav__section-title">' . strtoupper( $item ) . '</li>';
      else
        $items_html .= $item->render();
    }

    // Plantilla HTML
    $mask = '
      <nav class="em-sidenav__navigation {{ nav_class }}" {{ id }}>
        {{ header }}
        <ul class="em-sidenav__list">
          {{ items }}
        </ul>
      </nav>
    ';

    // Datos para k_mask_row
    $data = [
        'nav_class' => $nav_class
      , 'id'        => $id_attr
      , 'header'    => $this->header_html
      , 'items'     => $items_html
    ];

    return k_mask_row( $data, $mask );
  }
}