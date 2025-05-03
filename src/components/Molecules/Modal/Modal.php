<?php

/**
 * Componente para mostrar una ventana modal.
 *
 * Ejemplo de uso:
 *
 * $modal = new Modal(
 *   'Título del modal',
 *   '<p>Contenido libre del modal</p>',
 *   'modal-id',
 *   'k-modal-lg'
 * );
 */
class Modal
{
  private string $title;
  private string $content;
  private string $id;
  private string $class;

  /**
   * Constructor del modal.
   *
   * @param string $title Título del modal
   * @param string $content Contenido HTML
   * @param string $id ID único para mostrar/ocultar el modal
   * @param string $class Clases CSS adicionales (opcional)
   */
  public function __construct( string $title, string $content, string $id, string $class = '' )
  {
    $this->title   = $title;
    $this->content = $content;
    $this->id      = $id;
    $this->class   = $class;
  }

  /**
   * Renderiza el modal completo.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Máscara del modal
    $mask = '
      <div class="k-modal {{ class }}" {{ id }} style="display:none;">
        <div class="k-modal-backdrop"></div>
        <div class="k-modal-box">
          <div class="k-modal-header">
            <div class="k-modal-title">{{ title }}</div>
            <button class="k-modal-close" aria-label="Cerrar">
              <i class="icon">close</i>
            </button>
          </div>
          <div class="k-modal-body">
            {{ content }}
          </div>
        </div>
      </div>
    ';

    // Generamos los datos
    $data = [
        'class'   => $this->class
      , 'id'      => $id
      , 'title'   => $this->title
      , 'content' => $this->content
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>