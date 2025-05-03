<?php

/**
 * Componente para generar un campo de selección desplegable.
 */
class Select
{
  private string $name;
  private array $options;
  private string $selected;
  private string $placeholder;
  private string $class;
  private string $id;

  /**
   * Constructor del select.
   *
   * @param string $name Nombre del campo
   * @param array $options Array asociativo [valor => etiqueta]
   * @param string $selected Valor seleccionado por defecto (opcional)
   * @param string $placeholder Texto inicial (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $id ID del campo (opcional)
   */
  public function __construct( string $name, array $options, string $selected = '', string $placeholder = '', string $class = '', string $id = '' )
  {
    $this->name        = $name;
    $this->options     = $options;
    $this->selected    = $selected;
    $this->placeholder = $placeholder;
    $this->class       = $class;
    $this->id          = $id;
  }

  /**
   * Renderiza el select usando una máscara HTML.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del select
    $id = $this->id > '' ? 'id="' . $this->id . '"' :'';

    // Creamos las opciones HTML
    $options_html = '';
    if( $this->placeholder > '' )
      $options_html .= '<option disabled selected hidden>' . $this->placeholder . '</option>';

    foreach( $this->options as $value_opt => $label_opt )
    {
      $selected = $value_opt === $this->selected ? 'selected' : '';
      $options_html .= '<option value="' . $value_opt . '" ' . $selected . '>' . $label_opt . '</option>';
    }

    // Máscara del select
    $mask = '
      <select name="{{ name }}" class="k-select {{ class }}" {{ id }}>
        {{ options }}
      </select>
    ';

    // Generamos el array de datos del select
    $data = [
        'name'    => $this->name
      , 'class'   => $this->class
      , 'id'      => $id
      , 'options' => $options_html
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>