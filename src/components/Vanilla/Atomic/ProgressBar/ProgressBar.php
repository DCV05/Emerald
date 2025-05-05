<?php 

/**
 * Componente para mostrar una barra de progreso horizontal.
 *
 * Ejemplo de uso:
 * $progress = new ProgressBar( 72, 'green', 'progreso-1' );
 */
class ProgressBar
{
  private int $percent;
  private string $color;
  private string $id;
  private string $class;

  /**
   * Constructor de la barra de progreso.
   *
   * @param int $percent Porcentaje entre 0 y 100
   * @param string $color Color visual (opcional)
   * @param string $id ID del componente (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   */
  public function __construct( int $percent, string $color = '', string $id = '', string $class = '' )
  {
    $this->percent = max( 0, min( 100, $percent ) );
    $this->color   = $color;
    $this->id      = $id;
    $this->class   = $class;
  }

  /**
   * Renderiza la barra de progreso.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // ID del contenedor
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Clase de color
    $color = $this->color > '' ? 'k-progress-' . $this->color : 'k-progress-gray';

    // Estilo del ancho
    $width = 'style="width:' . $this->percent . '%;"';

    // Máscara de la barra
    $mask = '
      <div class="k-progress {{ class }} ' . $color . '" {{ id }}>
        <div class="bar" ' . $width . '></div>
      </div>
    ';

    $data = [
        'class' => $this->class
      , 'id'    => $id
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>