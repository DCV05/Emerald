<?php

/**
 * Grupo de botones radio tematizado para Emerald.
 *
 * Usa internamente instancias de CarbonRadio para cada opción.
 *
 * @required string   $id
 * @required string   $label
 * @required string[] $items
 * @enum     string   $layout [row, column]
 * @enum     string   $size [sm, md, lg]
 */
class CarbonRadioGroup
{
  private string  $id;
  private string  $label;
  private array   $items;
  private string  $selected_item;
  private string  $helper_text;
  private string  $invalid_text;
  private string  $warn_text;
  private string  $name;
  private string  $size;
  private string  $layout;
  private bool    $disabled;
  private bool    $readonly;
  private bool    $hide_label;
  private bool    $invalid;
  private bool    $warn;

  public function __construct(
      string $id
    , string $label
    , array  $items
    , string $selected_item = ''
    , string $helper_text   = ''
    , string $invalid_text  = ''
    , string $warn_text     = ''
    , string $name          = ''
    , string $size          = ''
    , string $layout        = 'column'
    , bool   $disabled      = false
    , bool   $readonly      = false
    , bool   $hide_label    = false
    , bool   $invalid       = false
    , bool   $warn          = false
  ) {
    $this->id            = $id;
    $this->label         = $label;
    $this->items         = $items;
    $this->selected_item = $selected_item;
    $this->helper_text   = $helper_text;
    $this->invalid_text  = $invalid_text;
    $this->warn_text     = $warn_text;
    $this->name          = $name ?: $id;
    $this->size          = $size;
    $this->layout        = $layout;
    $this->disabled      = $disabled;
    $this->readonly      = $readonly;
    $this->hide_label    = $hide_label;
    $this->invalid       = $invalid;
    $this->warn          = $warn;
  }

  public function render(): string
  {
    // ------------------------------------------------------------
    // Clases del fieldset
    // ------------------------------------------------------------
    $group_class = 'em--radio-group';
    if( $this->layout === 'row' ) $group_class .= ' em--radio-group--inline';
    if( $this->size )             $group_class .= ' em--radio-group--' . $this->size;

    // ------------------------------------------------------------
    // Etiqueta superior del grupo
    // ------------------------------------------------------------
    $label_class = 'em--label';
    if( $this->hide_label ) $label_class .= ' em--visually-hidden';

    $label_html = '<div class="' . $label_class . '">' . $this->label . '</div>';

    // ------------------------------------------------------------
    // Radio buttons individuales
    // ------------------------------------------------------------
    $radios = '';
    foreach( $this->items as $index => $item )
    {
      $radio = new CarbonRadioButton(
        id: $this->id . '-' . $index,
        label: $item,
        value: $item,
        name: $this->name,
        checked: $item === $this->selected_item,
        disabled: $this->disabled,
        readonly: $this->readonly,
        required: false,
        hide_label: false
      );
      $radios .= $radio->render();
    }

    // ------------------------------------------------------------
    // Mensajes auxiliares
    // ------------------------------------------------------------
    $helper  = $this->helper_text && !$this->invalid && !$this->warn ? '<div class="em--form__helper-text" id="helper-' . $this->id . '">' . $this->helper_text . '</div>' : '';
    $message = '';
    if( $this->invalid )
      $message = '<div class="em--form-requirement">' . $this->invalid_text . '</div>';
    elseif( $this->warn )
      $message = '<div class="em--form-requirement">' . $this->warn_text . '</div>';

    // ------------------------------------------------------------
    // Máscara general del grupo
    // ------------------------------------------------------------
    $mask = '
      <fieldset class="{{ group_class }}">
        {{ label }}
        {{ radios }}
        {{ helper }}
        {{ message }}
      </fieldset>
    ';

    $data = [
        'group_class' => $group_class
      , 'label'       => $label_html
      , 'radios'      => $radios
      , 'helper'      => $helper
      , 'message'     => $message
    ];

    return k_mask_row( $data, $mask );
  }
}