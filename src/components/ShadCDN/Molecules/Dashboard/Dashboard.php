<?php

/**
 * Componente para renderizar el contenido principal del dashboard con opción de incluir un breadcrumb como header.
 *
 * @dependency breadcrumb.php
 */
class Dashboard
{
  private string $header;
  private string $content;
  private string $class;
  private string $id;

  /**
   * Constructor del dashboard.
   *
   * @param string $header  Contenido HTML del header (ej. breadcrumb)
   * @param string $content Contenido principal
   * @param string $class   Clases CSS adicionales (opcional)
   * @param string $id      ID adicional (opcional)
   */
  public function __construct( string $header = '', string $content = '', string $class = '', string $id = '' )
  {
    $this->header  = $header;
    $this->content = $content;
    $this->class   = $class;
    $this->id      = $id;
  }

  /**
   * Renderiza el dashboard.
   *
   * @return string HTML del componente
   */
  public function render(): string
  {
    $value = '';

    // Clases del dashboard
    $classes = 'em--dashboard';
    if( $this->class > '' ) $classes .= ' ' . $this->class;

    // ID del componente
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Máscara del componente
    $mask = '
      <main class="{{ class }}" {{ id }}>
        <div class="em--dashboard__header">
          {{ header }}
        </div>
        <div class="em--dashboard__content">
          {{ content }}
        </div>
      </main>
    ';

    // Array de datos para la máscara
    $data = [
        'class'   => $classes
      , 'id'      => $id
      , 'header'  => $this->header
      , 'content' => $this->content
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>