<?php

/**
 * Componente Checkbox basado en Carbon Design System, kodalizado y tematizado para Emerald.
 *
 * Estados admitidos:
 * - normal
 * - checked
 * - indeterminate
 * - disabled
 * - readonly
 * - invalid
 * - warning
 *
 *  echo ( new CarbonCheckbox(
 *     id: 'check_politica',
 *     label: 'Acepto la política de privacidad',
 *     checked: true,
 *     helper_text: 'Puedes cambiar tu decisión en cualquier momento.',
 *     invalid: true,
 *     invalid_text: 'Debes aceptar la política para continuar.'
 * ) )->render();
 * 
 * @required string $id
 * @required string $label
 */
class CarbonCheckbox
{
  private string $id;
  private string $label;
  private bool   $checked;
  private bool   $indeterminate;
  private bool   $disabled;
  private bool   $readonly;
  private bool   $invalid;
  private bool   $warn;
  private string $helper_text;
  private string $invalid_text;
  private string $warn_text;
  private bool   $hide_label;

  public function __construct(
      string $id
    , string $label
    , bool   $checked        = false
    , bool   $indeterminate  = false
    , bool   $disabled       = false
    , bool   $readonly       = false
    , bool   $invalid        = false
    , bool   $warn           = false
    , string $helper_text    = ''
    , string $invalid_text   = ''
    , string $warn_text      = ''
    , bool   $hide_label     = false
  ) {
    $this->id             = $id;
    $this->label          = $label;
    $this->checked        = $checked;
    $this->indeterminate  = $indeterminate;
    $this->disabled       = $disabled;
    $this->readonly       = $readonly;
    $this->invalid        = $invalid;
    $this->warn           = $warn;
    $this->helper_text    = $helper_text;
    $this->invalid_text   = $invalid_text;
    $this->warn_text      = $warn_text;
    $this->hide_label     = $hide_label;
  }

  public function render(): string
  {
    // ------------------------------------------------------------
    // Clases dinámicas
    // ------------------------------------------------------------
    $wrapper_class = 'em--form-item em--checkbox-wrapper';
    if( $this->invalid )  $wrapper_class .= ' em--checkbox-wrapper--invalid';
    if( $this->warn )     $wrapper_class .= ' em--checkbox-wrapper--warning';
    if( $this->readonly ) $wrapper_class .= ' em--checkbox-wrapper--readonly';

    $label_class = 'em--checkbox-label';
    $text_class  = 'em--checkbox-label-text';
    if( $this->hide_label ) $text_class .= ' em--visually-hidden';

    // ------------------------------------------------------------
    // Compilación del Checkbox
    // ------------------------------------------------------------

    // Máscara
    $input_mask = '
      <input
        type="checkbox"
        class="em--checkbox"
        id="{{ id }}"
        {{ checked }}
        {{ disabled }}
        {{ readonly }}
        {{ indeterminate }}
        {{ invalid }}
        aria-describedby="helper-{{ id }}"
      />
    ';

    // Datos a compilar
    $input_data = [
        'type'    => 'checkbox'
      , 'id'      => $this->id
      , 'class'   => 'em--checkbox'
      , 'data-id' => $this->id
    ];

    // Parámetros opcionales del componente
    $input_data['checked']       = $this->checked       ? 'checked'   : '';
    $input_data['disabled']      = $this->disabled      ? 'disabled'  : '';
    $input_data['readonly']      = $this->readonly      ? 'true'      : '';
    $input_data['indeterminate'] = $this->indeterminate ? 'true'      : '';
    $input_data['invalid']       = $this->invalid       ? 'true'      : '';     

    // Compilamos
    $input_html = k_mask_row( $input_data, $input_mask );

    // ------------------------------------------------------------
    // Helper y mensajes
    // ------------------------------------------------------------

    $helper  = '';
    $message = '';

    if( $this->helper_text && !$this->invalid && !$this->warn )
      $helper = '<div class="em--form__helper-text" id="helper-' . $this->id . '">' . $this->helper_text . '</div>';

    if( $this->invalid )
      $message = '<div class="em--form-requirement">' . $this->invalid_text . '</div>';
    elseif( $this->warn )
      $message = '<div class="em--form-requirement">' . $this->warn_text . '</div>';

    // ------------------------------------------------------------
    // Estructura final
    // ------------------------------------------------------------
    $mask = '
      <div class="{{ wrapper_class }}">
        {{ input }}
        <label for="{{ id }}" class="{{ label_class }}">
          <span class="{{ text_class }}">{{ label }}</span>
        </label>
        {{ message }}
        {{ helper }}
      </div>
    ';

    $data = [
        'wrapper_class' => $wrapper_class
      , 'input'         => $input_html
      , 'id'            => $this->id
      , 'label_class'   => $label_class
      , 'text_class'    => $text_class
      , 'label'         => $this->label
      , 'helper'        => $helper
      , 'message'       => $message
    ];

    return k_mask_row( $data, $mask );
  }
}
?>