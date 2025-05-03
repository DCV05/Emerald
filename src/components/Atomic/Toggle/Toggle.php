<?php

/**
 * Componente para generar un interruptor visual tipo toggle.
 */
class Toggle
{
  private string $name;
  private string $value;
  private bool $checked;
  private string $id;
  private string $class;

  /**
   * Constructor del toggle.
   *
   * @param string $name Nombre del campo
   * @param string $value Valor del toggle
   * @param bool $checked Estado inicial (opcional)
   * @param string $id ID del input (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   */
  public function __construct( string $name, string $value = '1', bool $checked = false, string $id = '', string $class = '' )
  {
    $this->name    = $name;
    $this->value   = $value;
    $this->checked = $checked;
    $this->id      = $id;
    $this->class   = $class;
  }

  /**
   * Renderiza el toggle como componente visual.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del input
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Establecemos si está activado
    $checked = $this->checked ? 'checked' : '';

    // Máscara del toggle
    $mask = '
      <label class="k-toggle {{ class }}">
        <input type="checkbox" name="{{ name }}" value="{{ value }}" {{ checked }} {{ id }}>
        <span class="track"></span>
      </label>
    ';

    // Generamos los datos
    $data = [
        'name'    => $this->name
      , 'value'   => $this->value
      , 'checked' => $checked
      , 'id'      => $id
      , 'class'   => $this->class
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>