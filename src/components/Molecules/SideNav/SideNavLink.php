<?php

/**
 * Componente SideNavLink
 *
 * Representa un enlace dentro del SideNav, compatible con modo rail y estado activo.
 *
 * DEPENDENCIAS:
 * - se usa dentro de: SideNav (sidenav.php)
 * - se usa dentro de: SideNavMenu (sidenav-menu.php)
 */
class SideNavLink
{
  private string $label;
  private string $href;
  private string $icon;
  private bool   $is_active;
  private bool   $is_expanded;
  private string $id;
  private string $class;

  /**
   * Constructor del SideNavLink
   */
  public function __construct(
      string $label
    , string $href
    , string $icon         = ''
    , bool $is_active      = false
    , bool $is_expanded    = true
    , string $id           = ''
    , string $class        = ''
  )
  {
    $this->label       = $label;
    $this->href        = $href;
    $this->icon        = $icon;
    $this->is_active   = $is_active;
    $this->is_expanded = $is_expanded;
    $this->id          = $id;
    $this->class       = $class;
  }

  /**
   * Renderiza el enlace
   */
  public function render(): string
  {
    // Clases, ID y tabindex
    $link_class = 'em-sidenav__link';
    if( $this->is_active )     $link_class .= ' em-sidenav__link--current';
    if( $this->class !== '' )  $link_class .= ' ' . $this->class;

    $id_attr     = $this->id !== '' ? 'id="' . $this->id . '"' : '';
    $tab_index   = $this->is_expanded ? '' : 'tabindex="-1"';
    $icon_html   = $this->icon !== '' ? '<i class="icon">' . $this->icon . '</i>' : '';

    // Plantilla HTML
    $mask = '
      <li class="em-sidenav__item">
        <a href="{{ href }}" class="{{ class }}" {{ id }} {{ tabindex }}>
          {{ icon }}
          <span class="em-sidenav__link-text">{{ label }}</span>
        </a>
      </li>
    ';

    // Datos
    $data = [
        'href'     => $this->href
      , 'class'    => $link_class
      , 'id'       => $id_attr
      , 'tabindex' => $tab_index
      , 'icon'     => $icon_html
      , 'label'    => $this->label
    ];

    return k_mask_row( $data, $mask );
  }
}