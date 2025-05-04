<?php

/**
 * Componente para generar un campo de entrada de texto.
 */
class Input
{
  private string $name;
  private string $value;
  private string $placeholder;
  private string $type;
  private string $class;
  private string $id;

  /**
   * Constructor del input.
   *
   * @param string $name Nombre del campo
   * @param string $value Valor por defecto (opcional)
   * @param string $placeholder Texto de ayuda (opcional)
   * @param string $type Tipo de input (por defecto "text")
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $id ID del campo (opcional)
   */
  public function __construct( string $name, string $value = '', string $placeholder = '', string $type = 'text', string $class = '', string $id = '' )
  {
    $this->name        = $name;
    $this->value       = $value;
    $this->placeholder = $placeholder;
    $this->type        = $type;
    $this->class       = $class;
    $this->id          = $id;
  }

  /**
   * Renderiza el campo de texto usando una máscara HTML.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    $id_attr = $this->id > '' ? 'id="' . $this->id . '"' : '';

    $mask = '
      <input
        type="{{ type }}"
        name="{{ name }}"
        value="{{ value }}"
        placeholder="{{ placeholder }}"
        class="k-input {{ class }}"
        {{ id }}
      />
    ';

    $input_data = [
        'type'        => $this->type
      , 'name'        => $this->name
      , 'value'       => $this->value
      , 'placeholder' => $this->placeholder
      , 'class'       => $this->class
      , 'id'          => $id_attr
    ];

    $value = k_mask_row( $input_data, $mask );
    return $value;
  }
}
?>