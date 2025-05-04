<?php

/**
 * Componente SideNavMenu
 *
 * Representa un menú desplegable dentro del SideNav, compatible con modo rail y expansión controlada.
 *
 * DEPENDENCIAS:
 * - se usa dentro de: SideNav (sidenav.php)
 * - contiene: SideNavLink (sidenav-link.php) u otros SideNavMenu
 */
class SideNavMenu
{
  private string $title;
  private array  $items;
  private bool   $default_expanded;
  private bool   $is_expanded;
  private string $icon;
  private string $id;
  private string $class;

  /**
   * Constructor del SideNavMenu
   */
  public function __construct(
      string $title
    , array $items
    , bool $default_expanded = false
    , string $icon           = ''
    , string $id             = ''
    , string $class          = ''
  )
  {
    $this->title            = $title;
    $this->items            = $items;
    $this->default_expanded = $default_expanded;
    $this->is_expanded      = $default_expanded;
    $this->icon             = $icon;
    $this->id               = $id;
    $this->class            = $class;
  }

  /**
   * Renderiza el menú completo
   */
  public function render(): string
  {
    // Clases del botón y lista
    $li_class  = 'em-sidenav__item';
    $ul_class  = 'em-sidenav__menu';
    if( $this->is_expanded ) $ul_class .= ' is-expanded';

    $button_class = 'em-sidenav-menu__button';
    if( $this->class !== '' ) $button_class .= ' ' . $this->class;

    $id_attr    = $this->id !== '' ? 'id="' . $this->id . '"' : '';
    $expanded   = $this->is_expanded ? 'true' : 'false';
    $icon_html  = $this->icon !== '' ? '<i class="icon">' . $this->icon . '</i>' : '';

    // Items internos
    $items_html = '';
    foreach( $this->items as $item )
      $items_html .= $item->render();

    // Plantilla HTML
    $mask = '
      <li class="{{ li_class }}">
        <button class="{{ button_class }}" aria-expanded="{{ expanded }}" {{ id }}>
          {{ icon }}
          <span class="em-sidenav__link-text">{{ title }}</span>
          <span class="em-sidenav-link__icon"><i class="icon">keyboard_arrow_up</i></span>
        </button>
        <ul class="{{ ul_class }}">
          {{ items }}
        </ul>
      </li>
    ';

    // Datos
    $data = [
        'li_class'      => $li_class
      , 'button_class'  => $button_class
      , 'expanded'      => $expanded
      , 'id'            => $id_attr
      , 'icon'          => $icon_html
      , 'title'         => $this->title
      , 'ul_class'      => $ul_class
      , 'items'         => $items_html
    ];

    return k_mask_row( $data, $mask );
  }
}