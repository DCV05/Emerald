<?php

/**
 * Componente para generar una etiqueta visual con color e icono opcional.
 */
class Tag
{
  private string $text;
  private string $color;
  private string $icon;
  private string $icon_position;
  private string $id;
  private string $class;

  /**
   * Constructor del tag.
   *
   * @param string $text Contenido del tag
   * @param string $color Color base: gray, blue, green, yellow, red, purple (opcional)
   * @param string $icon HTML del icono (opcional)
   * @param string $icon_position Posición del icono (left|right) (opcional)
   * @param string $id ID del tag (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   */
  public function __construct( string $text, string $color = '', string $icon = '', string $icon_position = '', string $id = '', string $class = '' )
  {
    $this->text          = $text;
    $this->color         = $color;
    $this->icon          = $icon;
    $this->icon_position = $icon_position;
    $this->id            = $id;
    $this->class         = $class;
  }

  /**
   * Renderiza el tag como una etiqueta visual.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del tag
    $id = $this->id > '' ? 'id="' . $this->id . '"' :'';

    // Máscara del tag
    // Dependiendo de la posición seleccionada, cambiamos el orden o no
    if( $this->icon_position === 'right' )
    {
      $mask = '
        <span class="k-tag k-tag-{{ color }} {{ class }}" {{ id }}>
          <span>{{ text }}</span>
          {{ icon }}
        </span>
      ';
    }
    else
    {
      $mask = '
        <span class="k-tag k-tag-{{ color }} {{ class }}" {{ id }}>
          {{ icon }}
          <span>{{ text }}</span>
        </span>
      ';
    }

    // Establecemos un icono por defecto
    $icon = $this->icon !== '' ? '<i class="icon">' . $this->icon . '</i>' : '';

    // Generamos el array de datos del tag
    $data = [
        'text'  => $this->text
      , 'color' => $this->color
      , 'icon'  => $icon
      , 'id'    => $id
      , 'class' => $this->class
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>