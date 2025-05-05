<?php

/**
 * Componente Textarea basado en Carbon Design System, kodalizado y tematizado para Emerald.
 *
 * Estados admitidos:
 * - normal
 * - focus
 * - disabled
 * - invalid
 * - warning
 * - readonly
 *
 * Ejemplo de uso:
 * echo ( new CarbonTextarea(
 *     id: 'textarea_bio',
 *     label: 'Biografía',
 *     placeholder: 'Escribe algo sobre ti...',
 *     helper_text: 'Máximo 300 caracteres.',
 *     max_count: 300
 * ) )->render();
 *
 * @required string $id
 * @required string $label
 * @enum string $size [sm, md, lg]
 */
class CarbonTextarea
{
  private string $id;
  private string $label;
  private string $placeholder;
  private string $value;
  private string $helper_text;
  private string $invalid_text;
  private string $warn_text;
  private string $size;
  private bool   $disabled;
  private bool   $readonly;
  private bool   $invalid;
  private bool   $warn;
  private bool   $hide_label;
  private int    $max_count;

  public function __construct(
      string $id
    , string $label
    , string $placeholder   = ''
    , string $value         = ''
    , string $helper_text   = ''
    , string $invalid_text  = ''
    , string $warn_text     = ''
    , string $size          = ''
    , bool   $disabled      = false
    , bool   $readonly      = false
    , bool   $invalid       = false
    , bool   $warn          = false
    , bool   $hide_label    = false
    , int    $max_count     = 0
  ) {
    $this->id           = $id;
    $this->label        = $label;
    $this->placeholder  = $placeholder;
    $this->value        = $value;
    $this->helper_text  = $helper_text;
    $this->invalid_text = $invalid_text;
    $this->warn_text    = $warn_text;
    $this->size         = $size;
    $this->disabled     = $disabled;
    $this->readonly     = $readonly;
    $this->invalid      = $invalid;
    $this->warn         = $warn;
    $this->hide_label   = $hide_label;
    $this->max_count    = $max_count;
  }

  public function render(): string
  {
    // ------------------------------------------------------------
    // Cálculo de clases
    // ------------------------------------------------------------
    $wrapper_class = 'em--textarea-wrapper';
    $label_class   = 'em--label';
    $textarea_class = 'em--textarea';

    if( $this->hide_label )   $label_class .= ' em--visually-hidden';
    if( $this->disabled )     $label_class .= ' em--label--disabled';
    if( $this->invalid )      $textarea_class .= ' em--textarea--invalid';
    if( $this->warn )         $textarea_class .= ' em--textarea--warning';
    if( $this->size )         $textarea_class .= ' em--textarea--' . $this->size;

    // ------------------------------------------------------------
    // Contador si hay límite de caracteres
    // ------------------------------------------------------------
    $counter_html = '';
    if( $this->max_count > 0 )
    {
      $counter_html = '
        <div class="em--textarea__counter-wrapper">
          <span class="em--textarea__counter-text">0 / ' . $this->max_count . '</span>
        </div>
      ';
    }

    // ------------------------------------------------------------
    // Área de texto
    // ------------------------------------------------------------
    $textarea_mask = '
      <div class="em--textarea__inner">
        <textarea
          id="{{ id }}"
          class="{{ class }}"
          {{ placeholder }}
          {{ disabled }}
          {{ readonly }}
          {{ aria_describedby }}
          {{ aria_invalid }}
          {{ maxlength }}
        >{{ value }}</textarea>
        {{ counter }}
      </div>
    ';

    $textarea_data = [
        'id'               => $this->id
      , 'class'            => $textarea_class
      , 'placeholder'      => $this->placeholder   ? 'placeholder="' . $this->placeholder . '"' : ''
      , 'disabled'         => $this->disabled      ? 'disabled' : ''
      , 'readonly'         => $this->readonly      ? 'readonly' : ''
      , 'aria_describedby' => $this->helper_text   ? 'aria-describedby="helper-' . $this->id . '"' : ''
      , 'aria_invalid'     => $this->invalid       ? 'aria-invalid="true"' : ''
      , 'maxlength'        => $this->max_count > 0 ? 'maxlength="' . $this->max_count . '"' : ''
      , 'value'            => htmlspecialchars( $this->value )
      , 'counter'          => $counter_html
    ];

    $textarea = k_mask_row( $textarea_data, $textarea_mask );

    // ------------------------------------------------------------
    // Mensajes auxiliares
    // ------------------------------------------------------------
    $helper = '';
    if( $this->helper_text && !$this->invalid && !$this->warn )
      $helper = '<div id="helper-' . $this->id . '" class="em--form__helper-text">' . $this->helper_text . '</div>';

    $message = '';
    if( $this->invalid )
      $message = '<div class="em--form-requirement">' . $this->invalid_text . '</div>';
    elseif( $this->warn )
      $message = '<div class="em--form-requirement">' . $this->warn_text . '</div>';

    // ------------------------------------------------------------
    // Render final
    // ------------------------------------------------------------
    $mask = '
      <div class="{{ wrapper_class }}">
        <label for="{{ id }}" class="{{ label_class }}">{{ label }}</label>
        {{ textarea }}
        {{ helper }}
        {{ message }}
      </div>
    ';

    $data = [
        'wrapper_class' => $wrapper_class
      , 'label_class'   => $label_class
      , 'id'            => $this->id
      , 'label'         => $this->label
      , 'textarea'      => $textarea
      , 'helper'        => $helper
      , 'message'       => $message
    ];

    return k_mask_row( $data, $mask );
  }
}
?>