<?php

/**
 * Componente Input
 *
 * Campo de entrada de texto con icono y shortcut opcionales.
 */
class Input
{
  private string $name;
  private string $value;
  private string $placeholder;
  private string $type;
  private string $class;
  private string $id;
  private string $icon;
  private string $shortcut_icon;

  /**
   * Constructor del input
   *
   * @param string $name           Nombre del campo
   * @param string $value          Valor por defecto (opcional)
   * @param string $placeholder    Texto de ayuda (opcional)
   * @param string $type           Tipo de input (por defecto "text")
   * @param string $class          Clases CSS adicionales (opcional)
   * @param string $id             ID único (opcional)
   * @param string $icon           Nombre del icono Material (opcional)
   * @param string $shortcut_icon  URL de la imagen del atajo (opcional)
   */
  public function __construct(
      string $name
    , string $value         = ''
    , string $placeholder   = ''
    , string $type          = 'text'
    , string $class         = ''
    , string $id            = ''
    , string $icon          = ''
    , string $shortcut_icon = ''
  )
  {
    $this->name           = $name;
    $this->value          = $value;
    $this->placeholder    = $placeholder;
    $this->type           = $type;
    $this->class          = $class;
    $this->id             = $id;
    $this->icon           = $icon;
    $this->shortcut_icon  = $shortcut_icon;
  }

  /**
   * Renderiza el input con estructura enriquecida
   */
  public function render(): string
  {
    // Cálculo de ID
    $id_attr = $this->id !== '' ? 'id="' . $this->id . '"' : '';
    $id_val  = $this->id !== '' ? $this->id : $this->name;

    // Bloque de icono si aplica
    $icon_html = $this->icon !== '' ? '<i class="icon">' . $this->icon . '</i>' : '';

    // Bloque de shortcut si aplica
    $shortcut_html = $this->shortcut_icon !== ''
      ? '<img src="' . $this->shortcut_icon . '" alt="Shortcut" />'
      : '';

    // Máscara HTML completa dentro de un label
    $mask = '
      <label for="{{ id_val }}" class="k-control">
        {{ icon }}
        <input
          type="{{ type }}"
          name="{{ name }}"
          value="{{ value }}"
          placeholder="{{ placeholder }}"
          class="{{ class }}"
          autocomplete="off"
          {{ id_attr }}
        />
        {{ shortcut }}
      </label>
    ';

    // Datos para máscara
    $data = [
        'icon'        => $icon_html
      , 'name'        => $this->name
      , 'value'       => $this->value
      , 'placeholder' => $this->placeholder
      , 'type'        => $this->type
      , 'class'       => $this->class
      , 'id_val'      => $id_val
      , 'id_attr'     => $id_attr
      , 'shortcut'    => $shortcut_html
    ];

    return k_mask_row( $data, $mask );
  }
}