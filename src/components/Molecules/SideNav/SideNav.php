<?php

/**
 * Componente SideNav
 *
 * Replica fielmente el comportamiento del SideNav de IBM Carbon Design System.
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

  /**
   * Constructor del SideNav
   */
  public function __construct(
      array $items
    , string $class             = ''
    , string $id                = ''
    , bool $expanded            = false
    , bool $is_rail             = false
    , bool $is_fixed_nav        = false
    , bool $is_persistent       = true
    , bool $is_child_of_header  = true
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
  }

  /**
   * Renderiza el SideNav completo
   */
  public function render(): string
  {
    // Cálculo de clases de navegación
    $nav_class = 'em-sidenav';
    if( $this->expanded )                       $nav_class .= ' em-sidenav--expanded';
    if( !$this->expanded && $this->is_fixed_nav ) $nav_class .= ' em-sidenav--collapsed';
    if( $this->is_rail )                        $nav_class .= ' em-sidenav--rail';
    if( $this->is_child_of_header )             $nav_class .= ' em-sidenav--ux';
    if( !$this->is_persistent )                 $nav_class .= ' em-sidenav--hidden';
    if( $this->class !== '' )                   $nav_class .= ' ' . $this->class;

    $id_attr = $this->id !== '' ? 'id="' . $this->id . '"' : '';

    // Generar hijos
    $items_html = '';
    foreach( $this->items as $item )
      $items_html .= $item->render();

    // Plantilla HTML
    $mask = '
      <nav class="em-sidenav__navigation {{ nav_class }}" {{ id }}>
        <ul class="em-sidenav__list">
          {{ items }}
        </ul>
      </nav>
    ';

    // Datos
    $data = [
        'nav_class' => $nav_class
      , 'id'        => $id_attr
      , 'items'     => $items_html
    ];

    return k_mask_row( $data, $mask );
  }
}