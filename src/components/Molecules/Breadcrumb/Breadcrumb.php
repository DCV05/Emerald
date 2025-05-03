<?php

/**
 * Componente para generar una ruta de navegación (breadcrumb).
 *
 * Ejemplo de uso:
 *
 * $breadcrumb = new Breadcrumb( [
 *   [ 'label' => 'Inicio', 'url' => '/', 'icon' => 'home' ],
 *   [ 'label' => 'Sección', 'url' => '/seccion' ],
 *   [ 'label' => 'Actual', 'icon' => 'circle' ]
 * ] );
 */
class Breadcrumb
{
  private array $items;
  private string $class;
  private string $id;

  /**
   * Constructor del breadcrumb.
   *
   * @param array $items Lista de pasos [ [ 'label' => '', 'url' => '', 'icon' => '' ], … ]
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $id ID del componente (opcional)
   */
  public function __construct( array $items, string $class = '', string $id = '' )
  {
    $this->items = $items;
    $this->class = $class;
    $this->id    = $id;
  }

  /**
   * Renderiza el breadcrumb como lista navegable.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del componente
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Máscara del breadcrumb
    $mask = '
      <nav class="k-breadcrumb {{ class }}" {{ id }}>
        <ul>
          {{ items }}
        </ul>
      </nav>
    ';

    // Recorremos los pasos
    $html_items = '';
    $last_index = count( $this->items ) - 1;

    foreach( $this->items as $item_index => $item )
    {
      $label      = $item['label'] ?? '';
      $url        = $item['url']   ?? '';
      $icon       = $item['icon']  ?? '';
      $icon_html  = $icon > '' ? '<i class="icon">' . $icon . '</i>' : '';

      // Si no es el último paso y tiene URL, lo hacemos clicable
      if( $item_index < $last_index && $url > '' )
        $html_items .= '<li><a href="' . $url . '">' . $icon_html . $label . '</a></li>';
      else
        $html_items .= '<li><span>' . $icon_html . $label . '</span></li>';
    }

    // Generamos el array de datos del breadcrumb
    $data = [
        'class' => $this->class
      , 'id'    => $id
      , 'items' => $html_items
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>