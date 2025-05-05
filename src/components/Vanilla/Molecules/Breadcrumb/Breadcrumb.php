<?php

/**
 * Componente Emerald para generar una ruta de navegación (breadcrumb).
 *
 * @required items
 */
class Breadcrumb
{
  private array $items;
  private string $class;
  private string $id;

  /**
   * @param array  $items Lista de pasos [ [ 'label' => '', 'url' => '', 'icon' => '' ], … ]
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $id    ID del componente (opcional)
   */
  public function __construct( array $items, string $class = '', string $id = '' )
  {
    $this->items = $items;
    $this->class = $class;
    $this->id    = $id;
  }

  /**
   * Renderiza el breadcrumb.
   *
   * @return string HTML generado
   */
  public function render(): string
  {
    $value   = '';
    $id_attr = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Máscara HTML del componente
    $mask = '
      <nav class="geist-mono em--breadcrumb {{ class }}" {{ id }}>
        <ul>
          {{ items }}
        </ul>
      </nav>
    ';

    // Generación de pasos
    $html_items = '';
    $last_index = count( $this->items ) - 1;

    foreach( $this->items as $index => $item )
    {
      $label     = $item['label'] ?? '';
      $url       = $item['url']   ?? '';
      $icon      = $item['icon']  ?? '';
      $icon_html = $icon > '' ? '<i class="icon">' . $icon . '</i>' : '';

      if( $index < $last_index && $url > '' )
        $html_items .= '<li><a href="' . $url . '">' . $icon_html . $label . '</a></li><div>/</div>';
      else
        $html_items .= '<li><span>' . $icon_html . $label . '</span></li>';
    }

    // Render final
    $data = [
        'class' => $this->class
      , 'id'    => $id_attr
      , 'items' => $html_items
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>