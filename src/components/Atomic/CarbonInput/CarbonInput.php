<?php

/**
 * Componente Input basado en Carbon Design System, kodalizado y tematizado para Emerald.
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
 * echo ( new CarbonInput(
 *     id: 'input_email',
 *     label: 'Correo electrónico',
 *     type: 'email',
 *     placeholder: 'nombre@empresa.com',
 *     helper_text: 'No compartiremos tu email.',
 *     invalid: true,
 *     invalid_text: 'Email inválido.',
 *     max_count: 100
 * ) )->render();
 *
 * @required string $id
 * @required string $label
 * @enum string $type [text, email, password, number, url]
 * @enum string $size [sm, md, lg, xl]
 */
class CarbonInput
{
  private string $id;
  private string $label;
  private string $type;
  private string $placeholder;
  private string $value;
  private string $size;
  private string $helper_text;
  private bool   $disabled;
  private bool   $readonly;
  private bool   $invalid;
  private string $invalid_text;
  private bool   $warn;
  private string $warn_text;
  private bool   $inline;
  private bool   $hide_label;
  private int    $max_count;

  public function __construct(
      string $id
    , string $label         = ''
    , string $type          = 'text'
    , string $placeholder   = ''
    , string $value         = ''
    , string $size          = ''
    , string $helper_text   = ''
    , bool   $disabled      = false
    , bool   $readonly      = false
    , bool   $invalid       = false
    , string $invalid_text  = ''
    , bool   $warn          = false
    , string $warn_text     = ''
    , bool   $inline        = false
    , bool   $hide_label    = false
    , int    $max_count     = 0
  ) {
    $this->id           = $id;
    $this->label        = $label;
    $this->type         = $type;
    $this->placeholder  = $placeholder;
    $this->value        = $value;
    $this->size         = $size;
    $this->helper_text  = $helper_text;
    $this->disabled     = $disabled;
    $this->readonly     = $readonly;
    $this->invalid      = $invalid;
    $this->invalid_text = $invalid_text;
    $this->warn         = $warn;
    $this->warn_text    = $warn_text;
    $this->inline       = $inline;
    $this->hide_label   = $hide_label;
    $this->max_count    = $max_count;
  }

  public function render(): string
  {
    // ------------------------------------------------------------
    // Cálculo de clases y atributos
    // ------------------------------------------------------------
    $wrapper_class = 'em--form-item em--text-input-wrapper';
    if( $this->inline ) $wrapper_class .= ' em--text-input-wrapper--inline';

    $label_class = 'em--label';
    if( $this->hide_label ) $label_class .= ' em--visually-hidden';
    if( $this->disabled )   $label_class .= ' em--label--disabled';

    $input_class = 'em--text-input';
    if( $this->invalid ) $input_class .= ' em--text-input--invalid';
    if( $this->warn )    $input_class .= ' em--text-input--warning';
    if( $this->size )    $input_class .= ' em--text-input--' . $this->size . ' em--layout--size-' . $this->size;

    // ------------------------------------------------------------
    // Construcción del Input
    // ------------------------------------------------------------

    // Máscara del Input
    $input_mask = '
      <div class="em--text-input__inner">
        <input 
          id="{{ id }}"
          class="{{ class }}"
          type="{{ type }}"
          {{ placeholder }}
          {{ value }}
          {{ disabled }}
          {{ readonly }}
          {{ aria_describedby }}
          {{ aria_invalid }}
          {{ maxlength }}
        />
        {{ counter }}
      </div>
    ';

    // Si tiene un número máximo de caracteres, lo añadimos
    if( $this->max_count > 0 )
    {
      $counter_html = '
        <div class="em--text-input__counter-wrapper">
          <span class="em--text-input__counter-text">0 / ' . $this->max_count . '</span>
        </div>
      ';
    }
    else
      $counter_html = '';

    $input_data = [
        'id'                => $this->id
      , 'class'             => $input_class
      , 'type'              => $this->type
      , 'placeholder'       => $this->placeholder   ? ' placeholder="' . $this->placeholder . '"' : ''
      , 'value'             => $this->value         ? ' value="' . $this->value . '"' : ''
      , 'disabled'          => $this->disabled      ? ' disabled' : ''
      , 'readonly'          => $this->readonly      ? ' readonly' : ''
      , 'aria_describedby'  => $this->helper_text   ? ' aria-describedby="helper-' . $this->id . '"' : ''
      , 'aria_invalid'      => $this->invalid       ? ' aria-invalid="true"' : ''
      , 'maxlength'         => $this->max_count > 0 ? ' maxlength="' . $this->max_count . '"' : ''
      , 'counter'           => $counter_html
    ];

    $input = k_mask_row( $input_data, $input_mask );

    $message = '';
    if( $this->invalid )
      $message = '<div class="em--form-requirement">' . $this->invalid_text . '</div>';
    elseif( $this->warn )
      $message = '<div class="em--form-requirement">' . $this->warn_text . '</div>';
    elseif( $this->helper_text )
      $message = '<div id="helper-' . $this->id . '" class="em--form__helper-text">' . $this->helper_text . '</div>';

    if( $this->max_count > 0 )
      $message .= '<div class="em--text-input__counter-text">0 / ' . $this->max_count . '</div>';

    // Icono
    $icon = $this->invalid
      ? '<i class="icon" aria-hidden="true">warning</i>'
      : '';

    // ------------------------------------------------------------
    // Render final
    // ------------------------------------------------------------
    $mask = '
      <div class="{{ wrapper_class }}">
        <label for="{{ id }}" class="{{ label_class }}">{{ label }}</label>
        <div class="em--text-input__field-outer-wrapper">
          <div class="em--text-input__field-wrapper">
            {{ icon }}
            {{ input }}
          </div>
          {{ message }}
        </div>
      </div>
    ';

    $data = [
        'wrapper_class' => $wrapper_class
      , 'label_class'   => $label_class
      , 'id'            => $this->id
      , 'label'         => $this->label
      , 'icon'          => $icon
      , 'input'         => $input
      , 'message'       => $message
    ];

    return k_mask_row( $data, $mask );
  }
}