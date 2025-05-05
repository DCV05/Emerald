<?php

/**
 * Componente Select basado en Carbon Design System, kodalizado y tematizado para Emerald.
 *
 * Estados admitidos:
 * - normal
 * - open
 * - focus
 * - disabled
 * - invalid
 * - warning
 * - readonly
 *
 * Ejemplo de uso:
 * echo ( new EmeraldSelect(
 *     id: 'select_plan',
 *     label: 'Elige un plan',
 *     items: ['Básico', 'Profesional', 'Empresarial'],
 *     selected_item: 'Profesional',
 *     helper_text: 'Puedes cambiarlo luego.',
 *     invalid: true,
 *     invalid_text: 'Selecciona una opción válida.'
 * ) )->render();
 *
 * @required string   $id
 * @required string   $label
 * @required string[] $items
 * @enum     string   $size [sm, md, lg]
 */
class CarbonSelect
{
  private string  $id;
  private string  $label;
  private array   $items;
  private string  $selected_item;
  private string  $helper_text;
  private string  $invalid_text;
  private string  $warn_text;
  private string  $size;
  private bool    $disabled;
  private bool    $readonly;
  private bool    $inline;
  private bool    $hide_label;
  private bool    $invalid;
  private bool    $warn;
  private bool    $is_open;
  private string  $direction;

  public function __construct(
      string $id
    , string $label
    , array  $items
    , string $selected_item = ''
    , string $helper_text   = ''
    , string $invalid_text  = ''
    , string $warn_text     = ''
    , string $size          = ''
    , bool   $disabled      = false
    , bool   $readonly      = false
    , bool   $inline        = false
    , bool   $hide_label    = false
    , bool   $invalid       = false
    , bool   $warn          = false
    , bool   $is_open       = false
    , string $direction     = 'bottom'
  ) {
    $this->id            = $id;
    $this->label         = $label;
    $this->items         = $items;
    $this->selected_item = $selected_item;
    $this->helper_text   = $helper_text;
    $this->invalid_text  = $invalid_text;
    $this->warn_text     = $warn_text;
    $this->size          = $size;
    $this->disabled      = $disabled;
    $this->readonly      = $readonly;
    $this->inline        = $inline;
    $this->hide_label    = $hide_label;
    $this->invalid       = $invalid;
    $this->warn          = $warn;
    $this->is_open       = $is_open;
    $this->direction     = $direction;
  }

  public function render(): string
  {
// ------------------------------------------------------------
    // Cálculo de clases
    // ------------------------------------------------------------
    $wrapper_class = 'em--select-wrapper';
    if( $this->inline ) $wrapper_class .= ' em--select-wrapper--inline';

    $label_class = 'em--label';
    if( $this->hide_label ) $label_class .= ' em--visually-hidden';
    if( $this->disabled )   $label_class .= ' em--label--disabled';

    $select_class = 'em--select';
    if( $this->invalid )   $select_class .= ' em--select--invalid';
    if( $this->warn )      $select_class .= ' em--select--warning';
    if( $this->is_open )   $select_class .= ' em--select--open';
    if( $this->readonly )  $select_class .= ' em--select--readonly';
    if( $this->disabled )  $select_class .= ' em--select--disabled';
    if( $this->size )      $select_class .= ' em--select--' . $this->size;
    if( $this->direction === 'top' ) $select_class .= ' em--select--up';

    // ------------------------------------------------------------
    // Icono de desplegable
    // ------------------------------------------------------------
    $icon_svg = '<svg class="em--select__icon" viewBox="0 0 16 16"><path d="M8 11L3 6l.7-.7L8 9.6l4.3-4.3.7.7z"/></svg>';

    // ------------------------------------------------------------
    // Generación de opciones
    // ------------------------------------------------------------
    $options = '';

    foreach( $this->items as $i => $item )
    {
      // Capturamos si el item está seleccionado
      $is_selected = $item === $this->selected_item;
    
      // Máscara
      $option_mask = '
        <li
          class="em--select__option{{ selected_class }}"
          data-value="{{ value }}"
          role="option"
          id="option-{{ id }}-{{ index }}"
          {{ aria_selected }}
          {{ tabindex }}
        >
          {{ label }}
          {{ icon }}
        </li>
      ';
    
      $option_data = [
          'selected_class' => $is_selected ? ' is-selected' : ''
        , 'value'          => htmlspecialchars( $item )
        , 'id'             => $this->id
        , 'index'          => $i
        , 'aria_selected'  => $is_selected ? ' aria-selected="true"' : ''
        , 'label'          => $item
        , 'tabindex'       => 'tabindex="0"'
        , 'icon'           => $is_selected
                              ? '<svg class="em--select__check" viewBox="0 0 16 16"><path d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16zm3.646-10.854L6.75 10.043 4.354 7.646l-.708.708 3.104 3.103 5.604-5.603-.708-.708z"/></svg>'
                              : ''
      ];
    
      $options .= k_mask_row( $option_data, $option_mask );
    }

    // ------------------------------------------------------------
    // Mensajes auxiliares
    // ------------------------------------------------------------
    $helper = '';
    if( $this->helper_text && !$this->invalid && !$this->warn )
      $helper = '<div class="em--form__helper-text" id="helper-' . $this->id . '">' . $this->helper_text . '</div>';

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
        <div class="{{ select_class }}" id="{{ id }}" role="combobox" aria-haspopup="listbox" aria-expanded="{{ expanded }}">
          <button type="button" class="em--select__button" {{ disabled }} {{ readonly }}>
            <span class="em--select__label">{{ selected }}</span>
            {{ icon }}
          </button>
          <ul class="em--select__list" role="listbox">{{ options }}</ul>
        </div>
        {{ helper }}
        {{ message }}
      </div>
    ';

    $data = [
        'wrapper_class' => $wrapper_class
      , 'label_class'   => $label_class
      , 'select_class'  => $select_class
      , 'id'            => $this->id
      , 'label'         => $this->label
      , 'selected'      => $this->selected_item ?: $this->label
      , 'icon'          => $icon_svg
      , 'options'       => $options
      , 'expanded'      => $this->is_open ? 'true' : 'false'
      , 'disabled'      => $this->disabled ? 'disabled' : ''
      , 'readonly'      => $this->readonly ? 'aria-disabled="true"' : ''
      , 'helper'        => $helper
      , 'message'       => $message
    ];

    return k_mask_row( $data, $mask );
  }
}