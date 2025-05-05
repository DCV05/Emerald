<?php

/**
 * Clase para generar el componente "ExplodingUI" en varias capas (layers),
 * usando máscaras HTML con placeholders. Siguiendo el formato
 * y estilo de la clase Navbar.
 */
class ExplodingUI
{
  /**
   * @var array Datos para la capa principal (main layer): títulos, placeholders, etc.
   */
  private array $main_layer;

  /**
   * @var array Datos para la capa de la tabla (table layer): encabezados, tabla HTML, etc.
   */
  private array $table_layer;

  /**
   * @var array Datos para la capa de status (status layer): estadísticas, labels, valores, etc.
   */
  private array $status_layer;

  /**
   * @var array Datos para la capa del diálogo (dialog layer): botones, contenido del dialog, etc.
   */
  private array $dialog_layer;

  /**
   * Constructor para inicializar todas las capas del ExplodingUI.
   *
   * @param array $main_layer   Datos para la capa principal
   * @param array $table_layer  Datos para la capa de la tabla
   * @param array $status_layer Datos para la capa de estadísticas
   * @param array $dialog_layer Datos para la capa de diálogo
   */
  public function __construct(
    array $main_layer   = [],
    array $table_layer  = [],
    array $status_layer = [],
    array $dialog_layer = []
  ) {
    $this->main_layer   = $main_layer;
    $this->table_layer  = $table_layer;
    $this->status_layer = $status_layer;
    $this->dialog_layer = $dialog_layer;
  }

  /**
   * Getter para obtener los datos de la capa principal
   *
   * @return array
   */
  public function getMainLayer(): array
  {
    return $this->main_layer;
  }

  /**
   * Setter para actualizar la capa principal
   *
   * @param array $main_layer
   * @return void
   */
  public function setMainLayer( array $main_layer ): void
  {
    $this->main_layer = $main_layer;
  }

  /**
   * Getter para obtener los datos de la capa de tabla
   *
   * @return array
   */
  public function getTableLayer(): array
  {
    return $this->table_layer;
  }

  /**
   * Setter para actualizar la capa de tabla
   *
   * @param array $table_layer
   * @return void
   */
  public function setTableLayer( array $table_layer ): void
  {
    $this->table_layer = $table_layer;
  }

  /**
   * Getter para obtener los datos de la capa de estadísticas
   *
   * @return array
   */
  public function getStatusLayer(): array
  {
    return $this->status_layer;
  }

  /**
   * Setter para actualizar la capa de estadísticas
   *
   * @param array $status_layer
   * @return void
   */
  public function setStatusLayer( array $status_layer ): void
  {
    $this->status_layer = $status_layer;
  }

  /**
   * Getter para obtener los datos de la capa de diálogo
   *
   * @return array
   */
  public function getDialogLayer(): array
  {
    return $this->dialog_layer;
  }

  /**
   * Setter para actualizar la capa de diálogo
   *
   * @param array $dialog_layer
   * @return void
   */
  public function setDialogLayer( array $dialog_layer ): void
  {
    $this->dialog_layer = $dialog_layer;
  }

  /**
   * Renderiza el componente completo, uniendo todas las capas.
   *
   * @return string
   */
  public function render(): string
  {
    // Construimos cada capa por separado
    $main_html   = $this->buildMainLayer();
    $table_html  = $this->buildTableLayer();
    $status_html = $this->buildStatusLayer();
    $dialog_html = $this->buildDialogLayer();

    // Máscara principal (une todas las subcapas en un <section>)
    // Ajusta la ruta de tu CSS si es necesario
    $component_mask = '
      <link rel="stylesheet" href="https://www.kodalogic.com/k/apps/kodalogic/components/styles/ExplodingUI.css">
      <section class="exploding-ui">
        {{ main_layer }}
        {{ table_layer }}
        {{ status_layer }}
        {{ dialog_layer }}
      </section>
    ';

    // Datos para la máscara principal
    $component_data = [
        'main_layer'   => $main_html,
        'table_layer'  => $table_html,
        'status_layer' => $status_html,
        'dialog_layer' => $dialog_html,
    ];

    // Devolvemos el HTML completo reemplazando placeholders
    return k_mask_row($component_data, $component_mask);
  }

  /**
   * Construye la capa principal (main layer) con placeholders.
   * Sin valores predefinidos; todo viene de $this->main_layer.
   *
   * @return string
   */
  private function buildMainLayer(): string
  {
    // Máscara para la capa principal.
    $mask = '
      <div class="ui-layer main-layer">
        <div class="layer-wrapper">
          <div class="background-shadow table-shadow">
            <div></div>
          </div>
          <div class="content-container main-content">
            <p class="main-header">
              {{ main_header_svg }}
              <span>{{ main_title }}</span>
            </p>
            <div class="table-placeholder"></div>
            {{ main_extra_html }}
          </div>
        </div>
      </div>
    ';

    // Se espera que $this->main_layer contenga: main_header_svg, main_title, main_extra_html, etc.
    $data = [
      'main_header_svg' => $this->main_layer['main_header_svg']  ?? '',
      'main_title'      => $this->main_layer['main_title']       ?? '',
      'main_extra_html' => $this->main_layer['main_extra_html']  ?? '',
    ];

    return k_mask_row($data, $mask);
  }

  /**
   * Construye la capa de la tabla (table layer) con placeholders.
   *
   * @return string
   */
  private function buildTableLayer(): string
  {
    // Máscara para la capa de la tabla.
    $mask = '
      <div class="ui-layer table-layer">
        <div class="layer-wrapper nested-layer">
          <div class="background-shadow status-shadow">
            <div></div>
          </div>
          <div class="content-container table-content">
            <div class="table-header">
              <span>{{ table_header }}</span>
              <span class="badge">{{ table_badge }}</span>
              <button aria-label="Open database options">{{ table_button_svg }}</button>
            </div>
            <div class="table">
              {{ table_html }}
            </div>
            {{ table_extra_html }}
          </div>
        </div>
      </div>
    ';

    // Esperamos: table_header, table_badge, table_button_svg, table_html, table_extra_html
    $data = [
      'table_header'     => $this->table_layer['table_header']     ?? '',
      'table_badge'      => $this->table_layer['table_badge']      ?? '',
      'table_button_svg' => $this->table_layer['table_button_svg'] ?? '',
      'table_html'       => $this->table_layer['table_html']       ?? '',
      'table_extra_html' => $this->table_layer['table_extra_html'] ?? '',
    ];

    return k_mask_row($data, $mask);
  }

  /**
   * Construye la capa de estadísticas (status layer).
   *
   * @return string
   */
  private function buildStatusLayer(): string
  {
    // Máscara para la capa de status.
    $mask = '
      <div class="ui-layer status-layer">
        <div class="layer-wrapper nested-layer">
          <div class="content-container status-content">
            {{ status_info_html }}
            {{ status_extra_html }}
          </div>
          <div class="shadow-wrapper">
            <div class="background-shadow dialog-shadow">
              <div></div>
            </div>
          </div>
        </div>
      </div>
    ';

    // Esperamos: status_info_html, status_extra_html
    $data = [
      'status_info_html'  => $this->status_layer['status_info_html']   ?? '',
      'status_extra_html' => $this->status_layer['status_extra_html']  ?? '',
    ];

    return k_mask_row($data, $mask);
  }

  /**
   * Construye la capa de diálogo (dialog layer).
   *
   * @return string
   */
  private function buildDialogLayer(): string
  {
    // Máscara para la capa del diálogo.
    // Se agrega "dialog_extra_html" para más contenido si se desea.
    $mask = '
      <div class="ui-layer dialog-layer">
        <div class="layer-wrapper">
          <div class="content-container">
            <dialog class="options-dialog">
              {{ dialog_buttons_html }}
              {{ dialog_extra_html }}
            </dialog>
          </div>
        </div>
      </div>
    ';

    // Calculamos el array de datos final para la compilación de la máscara
    $data = [
      'dialog_buttons_html' => $this->dialog_layer['dialog_buttons_html'] ?? '',
      'dialog_extra_html'   => $this->dialog_layer['dialog_extra_html']   ?? '',
    ];

    return k_mask_row($data, $mask);
  }
}

?>