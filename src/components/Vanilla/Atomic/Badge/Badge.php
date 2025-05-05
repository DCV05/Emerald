<?php

/**
 * Componente para mostrar una insignia visual (badge).
 *
 * Ejemplo de uso:
 *
 * $badge = new Badge( 'Activo', 'green', 'check', 'left' );
 */
class Badge
{
  private string $label;
  private string $color;
  private string $icon;
  private string $icon_position;
  private string $id;
  private string $class;

  /**
   * Constructor del badge.
   *
   * @param string $label Texto de la insignia
   * @param string $color Nombre del color (opcional)
   * @param string $icon Icono Material Icons (opcional)
   * @param string $icon_position Posición del icono: left o right (opcional)
   * @param string $id ID del elemento (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   */
  public function __construct( string $label, string $color = '', string $icon = '', string $icon_position = 'left', string $id = '', string $class = '' )
  {
    $this->label         = $label;
    $this->color         = $color;
    $this->icon          = $icon;
    $this->icon_position = $icon_position;
    $this->id            = $id;
    $this->class         = $class;
  }

  /**
   * Renderiza el badge como span estilizado.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Generamos clase de color
    $color_class = $this->color > '' ? 'k-badge-' . $this->color : 'k-badge-gray';

    // Icono HTML
    $icon = $this->icon > '' ? '<i class="icon">' . $this->icon . '</i>' : '';

    // Máscara del badge
    if( $this->icon_position === 'right' )
    {
      $mask = '
        <span class="k-badge ' . $color_class . ' {{ class }}" {{ id }}>
          <span>{{ label }}</span>
          ' . $icon . '
        </span>
      ';
    }
    else
    {
      $mask = '
        <span class="k-badge ' . $color_class . ' {{ class }}" {{ id }}>
          ' . $icon . '
          <span>{{ label }}</span>
        </span>
      ';
    }

    // Datos del badge
    $data = [
        'label' => $this->label
      , 'class' => $this->class
      , 'id'    => $id
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>