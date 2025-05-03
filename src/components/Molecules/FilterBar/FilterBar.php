<?php

/**
 * Componente para agrupar filtros visuales en un dashboard.
 *
 * Ejemplo de uso:
 *
 * $bar = new FilterBar( '
 *   ' . ( new Input( 'Buscar', 'text', 'k-input', 'search', 'left', 'f_search' ) )->render() . '
 *   ' . ( new Select( 'Estado', [ 'Activo', 'Inactivo' ], 'k-select', 'estado' ) )->render() . '
 *   ' . ( new Button( 'Filtrar', 'submit', 'k-button-blue', 'filter', 'left' ) )->render() . '
 * ', 'filters-top' );
 */
class FilterBar
{
  private string $content;
  private string $class;
  private string $id;

  /**
   * Constructor de la barra de filtros.
   *
   * @param string $content Contenido HTML (inputs, selects, botones, etc.)
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $id ID del componente (opcional)
   */
  public function __construct( string $content, string $class = '', string $id = '' )
  {
    $this->content = $content;
    $this->class   = $class;
    $this->id      = $id;
  }

  /**
   * Renderiza la barra de filtros.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del contenedor
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Máscara del bloque
    $mask = '
      <div class="k-filterbar {{ class }}" {{ id }}>
        {{ content }}
      </div>
    ';

    // Datos del bloque
    $data = [
        'class'   => $this->class
      , 'id'      => $id
      , 'content' => $this->content
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>