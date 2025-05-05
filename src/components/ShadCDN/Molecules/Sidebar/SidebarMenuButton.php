<?php

/**
 * Botón de menú lateral para Sidebar.
 * Puede usarse como enlace o botón, con soporte para icono y tooltip.
 *
 * @required string $label
 * @optional string $url
 * @optional string $icon (nombre del icono, clase o HTML)
 * @optional string $tooltip
 */
class SidebarMenuButton
{
  private string $label;
  private string $url;
  private string $icon;
  private string $tooltip;

  public function __construct(
      string $label
    , string $url     = ''
    , string $icon    = ''
    , string $tooltip = ''
  ) {
    $this->label   = $label;
    $this->url     = $url;
    $this->icon    = $icon;
    $this->tooltip = $tooltip;
  }

  public function render(): string
  {
    // ------------------------------------------------------------
    // Determinamos el tipo de etiqueta (a o button)
    // ------------------------------------------------------------
    $tag = 'button';

    if( $this->url > '' )
      $tag = 'a';

    // ------------------------------------------------------------
    // Construimos atributos y contenidos
    // ------------------------------------------------------------
    $attrs = '';
    if( $this->tooltip > '' )
      $attrs .= ' data-tooltip="' . $this->tooltip . '"';

    if( $this->url > '' )
      $attrs .= ' href="' . $this->url . '"';

    $icon_html = '';
    if( $this->icon > '' )
      $icon_html = '<i class="icon">' . $this->icon . '</i>';

    // ------------------------------------------------------------
    // Definimos la máscara HTML
    // ------------------------------------------------------------
    $mask = '
      <{{ tag }} class="em--sidebar__menu-button"{{ attrs }}>
        {{ icon }}
        <span>{{ label }}</span>
      </{{ tag }}>
    ';

    // ------------------------------------------------------------
    // Datos para la máscara
    // ------------------------------------------------------------
    $data = [
        'tag'   => $tag
      , 'attrs' => $attrs
      , 'icon'  => $icon_html
      , 'label' => $this->label
    ];

    return k_mask_row( $data, $mask );
  }
}