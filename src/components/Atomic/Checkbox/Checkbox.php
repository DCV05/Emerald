<?php

/**
 * Componente para generar un checkbox
 */
class Checkbox
{
  private string $name;
  private string $value;
  private bool $checked;
  private string $id;
  private string $class;

  /**
   * Constructor del checkbox.
   *
   * @param string $name Nombre del campo
   * @param string $value Valor del checkbox
   * @param bool $checked Estado inicial (opcional)
   * @param string $id ID único (opcional)
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
   * Renderiza el checkbox como componente visual.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del input
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';
    $checked = $this->checked ? 'checked' : '';

    // Máscara del checkbox
    $mask = '
      <label class="k-checkbox {{ class }}">
        <input type="checkbox" name="{{ name }}" value="{{ value }}" {{ checked }} {{ id }}>
        <span class="box">
          <i class="icon">check</i>
        </span>
      </label>
    ';

    $data = [
        'name'    => $this->name
      , 'value'   => $this->value
      , 'checked' => $checked
      , 'class'   => $this->class
      , 'id'      => $id
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>