<?php

/**
 * Componente para generar un link.
 */
class Link
{
  private string $title;
  private string $url;
  private string $class;
  private string $icon;
  private string $icon_position;
  private string $id;

  /**
   * Constructor del link.
   *
   * @param string $title Texto del link
   * @param string $url   URL de destino
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $icon  HTML del icono (opcional)
   * @param string $icon  Posición del icono (opcional)
   * @param string $id    ID del link (opcional)
   */
  public function __construct( string $title, string $url, string $class = '', string $icon = '', string $icon_position = '', string $id = '' )
  {
    $this->title          = $title;
    $this->url            = $url;
    $this->class          = $class;
    $this->icon           = $icon;
    $this->icon_position  = $icon_position;
    $this->id             = $id;
  }

  /**
   * Renderiza el link usando una máscara HTML.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del link
    $id = $this->id > '' ? 'id="' . $this->id . '"' :'';

    // Máscara del link
    // Dependiendo de la posición seleccionada, cambiamos el orden o no
    if( $this->icon_position === 'right' )
    {
      $mask = '
        <a href="{{ url }}" class="k-button {{ class }}" {{ id }}>
          <span>{{ title }}</span>
          {{ icon }}
        </a>
      ';
    }
    else
    {
      $mask = '
        <a href="{{ url }}" class="k-button {{ class }}" {{ id }}>
          {{ icon }}
          <span>{{ title }}</span>
        </a>
      ';
    }

    // Establecemos un icono por defecto
    $icon = $this->icon !== '' ? '<i class="icon">' . $this->icon . '</i>' : '';
    
    // Generamos el array de datos del link
    $button_data = [
        'title' => $this->title
      , 'url'   => $this->url
      , 'class' => $this->class
      , 'icon'  => $icon
      , 'id'    => $id
    ];
    
    $value = k_mask_row( $button_data, $mask );
    return $value;
  }
}
?>