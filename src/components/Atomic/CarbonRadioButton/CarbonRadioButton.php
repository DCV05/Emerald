<?php

/**
 * Componente Radio Button kodalizado, basado en Carbon Design System.
 *
 * @required string $id             ID del radio button
 * @required string $label          Texto visible asociado al radio
 * @required string $name           Nombre del grupo
 * @required string $value          Valor que representa esta opción
 * @enum     string $label_position Posición de la etiqueta ['left', 'right']
 */
class CarbonRadioButton
{
  private string $id;
  private string $label;
  private string $name;
  private string $value;
  private string $label_position;
  private bool   $checked;
  private bool   $disabled;
  private bool   $required;
  private bool   $readonly;
  private bool   $hide_label;

  /**
   * Constructor del componente.
   */
  public function __construct(
      string $id
    , string $label
    , string $name
    , string $value
    , string $label_position = 'right'
    , bool   $checked        = false
    , bool   $disabled       = false
    , bool   $required       = false
    , bool   $readonly       = false
    , bool   $hide_label     = false
  ) {
    $this->id             = $id;
    $this->label          = $label;
    $this->name           = $name;
    $this->value          = $value;
    $this->label_position = $label_position;
    $this->checked        = $checked;
    $this->disabled       = $disabled;
    $this->required       = $required;
    $this->readonly       = $readonly;
    $this->hide_label     = $hide_label;
  }

  /**
   * Renderiza el HTML del radio button con clases kodalizadas.
   */
  public function render(): string
  {
    // ------------------------------------------------------------
    // Clases del contenedor principal
    // ------------------------------------------------------------
    $wrapper_class = 'em--radio-wrapper';
    if( $this->label_position === 'left' ) $wrapper_class .= ' em--radio-wrapper--label-left';
    if( $this->disabled )                  $wrapper_class .= ' em--radio-wrapper--disabled';

    // ------------------------------------------------------------
    // Clases de la etiqueta visual
    // ------------------------------------------------------------
    $label_class = 'em--radio-label';
    if( $this->hide_label ) $label_class .= ' em--visually-hidden';

    // Máscara del input
    $input_mask = '
      <input
        type="radio"
        id="{{ id }}"
        name="{{ name }}"
        value="{{ value }}"
        class="em--radio"
        {{ checked }}
        {{ disabled }}
        {{ required }}
        {{ readonly }}
      />
    ';

    // Datos de compilación
    $input_data = [
        'id'       => $this->id
      , 'name'     => $this->name
      , 'value'    => trim( strtolower( str_replace( ' ', '_', $this->value ) ) )
      , 'checked'  => $this->checked  ? 'checked'              : ''
      , 'disabled' => $this->disabled ? 'disabled'             : ''
      , 'required' => $this->required ? 'required'             : ''
      , 'readonly' => $this->readonly ? 'aria-readonly="true"' : ''
    ];

    // Compilación de la máscara
    $input_html = k_mask_row( $input_data, $input_mask );

    // ------------------------------------------------------------
    // Plantilla HTML del componente
    // ------------------------------------------------------------
    $mask = '
      <div class="{{ wrapper_class }}">
        {{ input }}
        <label class="{{ label_class }}" for="{{ id }}">
          <span class="em--radio-label-text">{{ label }}</span>
        </label>
      </div>
    ';

    // Datos para añadir en la plantilla
    $data = [
        'wrapper_class' => $wrapper_class
      , 'label_class'   => $label_class
      , 'label'         => $this->label
      , 'id'            => $this->id
      , 'input'         => $input_html
    ];

    return k_mask_row( $data, $mask );
  }
}

?>