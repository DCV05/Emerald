<?php

/**
 * Componente visual para mostrar un spinner giratorio.
 *
 * Ejemplo de uso:
 * $spinner = new Spinner( 32, '1.2s', 'blue' );
 */
class Spinner
{
  private int $size;
  private string $speed;
  private string $color;
  private string $id;
  private string $class;

  /**
   * Constructor del spinner.
   *
   * @param int $size Tamaño en píxeles (ej. 32)
   * @param string $speed Duración de giro (ej. 1s)
   * @param string $color Color del icono (opcional)
   * @param string $id ID del spinner (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   */
  public function __construct( int $size = 32, string $speed = '1s', string $color = '', string $id = '', string $class = '' )
  {
    $this->size  = $size;
    $this->speed = $speed;
    $this->color = $color;
    $this->id    = $id;
    $this->class = $class;
  }

  /**
   * Renderiza el spinner giratorio.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del spinner
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Clase de color si se define
    $color = $this->color > '' ? 'k-spinner-' . $this->color : '';

    // Estilos inline para tamaño y velocidad
    $style = 'style="--spinner-size:' . $this->size . 'px; --spinner-speed:' . $this->speed . ';"';

    // Máscara del spinner
    $mask = '
      <div class="k-spinner {{ class }} ' . $color . '" {{ id }} ' . $style . '>
        <i class="icon">progress_activity</i>
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