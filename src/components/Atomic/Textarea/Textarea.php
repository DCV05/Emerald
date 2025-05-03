// archivo Textarea.php
<?php

/**
 * Componente para generar un campo de texto multilínea.
 */
class Textarea
{
  private string $name;
  private string $value;
  private string $placeholder;
  private string $class;
  private string $id;

  /**
   * Constructor del textarea.
   *
   * @param string $name Nombre del campo
   * @param string $value Texto por defecto (opcional)
   * @param string $placeholder Texto de ayuda (opcional)
   * @param string $class Clases CSS adicionales (opcional)
   * @param string $id ID del campo (opcional)
   */
  public function __construct( string $name, string $value = '', string $placeholder = '', string $class = '', string $id = '' )
  {
    $this->name        = $name;
    $this->value       = $value;
    $this->placeholder = $placeholder;
    $this->class       = $class;
    $this->id          = $id;
  }

  /**
   * Renderiza el textarea usando una máscara HTML.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del textarea
    $id = $this->id > '' ? 'id="' . $this->id . '"' :'';

    // Máscara del textarea
    $mask = '
      <div class="k-control {{ class }}" {{ id }}>
        <textarea name="{{ name }}" placeholder="{{ placeholder }}">{{ value }}</textarea>
      </div>
    ';

    // Generamos el array de datos del textarea
    $data = [
        'name'        => $this->name
      , 'value'       => $this->value
      , 'placeholder' => $this->placeholder
      , 'class'       => $this->class
      , 'id'          => $id
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>