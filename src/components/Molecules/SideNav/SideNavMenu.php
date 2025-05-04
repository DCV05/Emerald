<?php

/**
 * Componente SideNavMenu
 *
 * Representa un menú desplegable dentro del SideNav.
 *
 * DEPENDE DE:
 * - SideNav (como hijo directo)
 * - SideNavLink (como elementos anidados)
 */
class SideNavMenu
{
  private string $title;
  private array  $items;
  private bool   $is_expanded;
  private string $icon;
  private string $id;
  private string $class;

  /**
   * Constructor del menú lateral
   *
   * @param string $title        Texto del botón principal
   * @param array  $items        Lista de componentes hijos (SideNavLink u otros)
   * @param bool   $is_expanded  Define si está expandido por defecto
   * @param string $icon         Nombre del icono Material
   * @param string $id           ID único (opcional)
   * @param string $class        Clases CSS adicionales (opcional)
   */
  public function __construct(
      string $title
    , array  $items
    , bool   $is_expanded = false
    , string $icon        = ''
    , string $id          = ''
    , string $class       = ''
  )
  {
    $this->title        = $title;
    $this->items        = $items;
    $this->is_expanded  = $is_expanded;
    $this->icon         = $icon;
    $this->id           = $id;
    $this->class        = $class;
  }

  /**
   * Renderiza el menú del SideNav
   */
  public function render(): string
  {
    // Cálculo de clases e ID
    $li_class      = 'em-sidenav__item';
    $ul_class      = 'em-sidenav__menu';
    $button_class  = 'em-sidenav-menu__button';
    $expanded_attr = $this->is_expanded ? 'true' : 'false';

    if( $this->is_expanded ) $ul_class .= ' is-expanded';
    if( $this->class !== '' ) $button_class .= ' ' . $this->class;
    $id_attr = $this->id !== '' ? 'id="' . $this->id . '"' : '';

    // HTML de icono si lo hay
    $icon_html = $this->icon !== '' ? '<i class="icon">' . $this->icon . '</i>' : '';

    // Cálculo de hijos
    $items_html = '';
    foreach( $this->items as $item )
      $items_html .= $item->render();

    // Máscara HTML
    $mask = '
      <li class="{{ li_class }}">
        <button class="{{ button_class }}" aria-expanded="{{ expanded }}" {{ id }}>
          {{ icon }}
          <span class="em-sidenav__link-text">{{ title }}</span>
          <span class="em-sidenav-link__icon"><i class="icon">keyboard_arrow_down</i></span>
        </button>
        <ul class="{{ ul_class }}">
          {{ items }}
        </ul>
      </li>
    ';

    // Datos
    $data = [
        'li_class'     => $li_class
      , 'button_class' => $button_class
      , 'expanded'     => $expanded_attr
      , 'id'           => $id_attr
      , 'icon'         => $icon_html
      , 'title'        => $this->title
      , 'ul_class'     => $ul_class
      , 'items'        => $items_html
    ];

    return k_mask_row( $data, $mask );
  }
}