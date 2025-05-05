<?php

/**
 * Componente SideNavLink
 *
 * Representa un enlace dentro del SideNav.
 *
 * DEPENDE DE:
 * - SideNav (como hijo directo)
 * - SideNavMenu (como item anidado)
 */
class SideNavLink
{
  private string  $label;
  private string  $href;
  private string  $icon;
  private bool    $is_active;
  private string  $id;
  private string  $class;
  private ?string $badge;

  /**
   * Constructor del enlace lateral
   *
   * @param string      $label      Texto visible del enlace
   * @param string      $href       URL destino
   * @param string      $icon       Nombre del icono Material (opcional)
   * @param bool        $is_active  Marca si es el enlace actual
   * @param string      $id         ID único (opcional)
   * @param string      $class      Clases CSS adicionales (opcional)
   * @param string|null $badge      Etiqueta opcional al final del enlace
   */
  public function __construct(
      string  $label
    , string  $href
    , string  $icon      = ''
    , bool    $is_active = false
    , string  $id        = ''
    , string  $class     = ''
    , ?string $badge     = null
  )
  {
    $this->label     = $label;
    $this->href      = $href;
    $this->icon      = $icon;
    $this->is_active = $is_active;
    $this->id        = $id;
    $this->class     = $class;
    $this->badge     = $badge;
  }

  /**
   * Renderiza el enlace del SideNav
   */
  public function render(): string
  {
    // Cálculo de clases
    $link_class = 'em-sidenav__link';
    if( $this->is_active ) $link_class .= ' em-sidenav__link--current';
    if( $this->class > '' ) $link_class .= ' ' . $this->class;

    // ID
    $id_attr = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Icono
    $icon_html = $this->icon > '' ? '<i class="icon">' . $this->icon . '</i>' : '';

    // Badge
    $badge_html = $this->badge !== null ? '<span class="em-sidenav__badge">' . $this->badge . '</span>' : '';

    // Plantilla HTML
    $mask = '
      <li class="em-sidenav__item">
        <a href="{{ href }}" class="{{ class }}" {{ id }}>
          {{ icon }}
          <span class="em-sidenav__link-text">{{ label }}</span>
          {{ badge }}
        </a>
      </li>
    ';

    // Datos para k_mask_row
    $data = [
        'href'  => $this->href
      , 'class' => $link_class
      , 'id'    => $id_attr
      , 'icon'  => $icon_html
      , 'label' => $this->label
      , 'badge' => $badge_html
    ];

    return k_mask_row( $data, $mask );
  }
}