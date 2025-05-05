<?php

/**
 * Componente para generar un botón.
 */
class Button
{
  private string $title;
  private string $type;
  private string $class;
  private string $icon;
  private string $icon_position;
  private string $id;
  private string $size;

  /**
   * Constructor del botón.
   *
   * @param string $title Texto del botón
   * @param string $type Tipo de botón (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $icon  HTML del icono (opcional)
   * @param string $icon  Posición del icono (opcional)
   * @param string $id    ID del botón (opcional)
   * @param string $size Tamaño del botón: sm|base|md|lg|xl (opcional)
   */
  public function __construct(
      string $title
    , string $type = ''
    , string $class = ''
    , string $icon = ''
    , string $icon_position = ''
    , string $id = ''
    , string $size = 'base'
  )
  {
    $this->title          = $title;
    $this->type           = $type;
    $this->class          = $class;
    $this->icon           = $icon;
    $this->icon_position  = $icon_position;
    $this->id             = $id;
    $this->size           = $size;
  }

  /**
   * Renderiza el botón usando una máscara HTML.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del botón
    $id = $this->id > '' ? 'id="' . $this->id . '"' :'';

    // Máscara del botón
    // Dependiendo de la posición seleccionada, cambiamos el orden o no
    if( $this->icon_position === 'right' )
    {
      $mask = '
        <button type="{{ type }}" class="em-button {{ class }}" {{ id }}>
          {{ title }}
          {{ icon }}
        </button>
      ';
    }
    else
    {
      $mask = '
        <button type="{{ type }}" class="em-button {{ class }}" {{ id }}>
          {{ icon }}
          {{ title }}
        </button>
      ';
    }

    // Establecemos un icono por defecto
    $icon = $this->icon !== '' ? '<i class="icon">' . $this->icon . '</i>' : '';
    
    // Generamos el array de datos del botón
    $button_data = [
        'title' => $this->title ? '<span>' . $this->title . '</span>' : ''
      , 'type'  => $this->type
      , 'class' => $this->class
      , 'icon'  => $icon
      , 'id'    => $id
    ];
    
    $value = k_mask_row( $button_data, $mask );
    return $value;
  }
}
?>