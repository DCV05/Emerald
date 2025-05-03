<?php

/**
 * Componente para mostrar un dato clave (KPI) con icono y variación.
 *
 * Ejemplo de uso:
 *
 * $kpi = new KPI(
 *   'Usuarios activos',
 *   '1.245',
 *   '↑ 12.4%',
 *   'user',
 *   'green',
 *   'kpi-usuarios'
 * );
 */
class KPI
{
  private string $title;
  private string $value;
  private string $change;
  private string $icon;
  private string $color;
  private string $id;

  /**
   * Constructor del KPI.
   *
   * @param string $title Título del dato
   * @param string $value Valor principal
   * @param string $change Texto de variación (opcional)
   * @param string $icon Icono principal (opcional)
   * @param string $color Color visual (opcional)
   * @param string $id ID del bloque (opcional)
   */
  public function __construct( string $title, string $value, string $change = '', string $icon = '', string $color = '', string $id = '' )
  {
    $this->title  = $title;
    $this->value  = $value;
    $this->change = $change;
    $this->icon   = $icon;
    $this->color  = $color;
    $this->id     = $id;
  }

  /**
   * Renderiza el KPI como un bloque de métrica.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Calculamos el ID del KPI
    $id = $this->id > '' ? 'id="' . $this->id . '"' : '';

    // Creamos el icono visual
    $icon = $this->icon > '' ? '<i class="k-icon-block ' . $this->color . '">' . $this->icon . '</i>' : '';

    // Si la variación tiene una flecha textual, la sustituimos por icono visual
    $change = '';
    if( $this->change > '' )
    {
      $direction = str_contains( $this->change, '↑' ) ? 'arrow_upward' :
                   ( str_contains( $this->change, '↓' ) ? 'arrow_downward' : '' );

      $change = '
        <div class="k-kpi-change ' . $this->color . '">
          <i class="icon">' . $direction . '</i>
          <span>' . preg_replace( '/[↑↓]/u', '', $this->change ) . '</span>
        </div>
      ';
    }

    // Máscara del KPI
    $mask = '
      <div class="k-mini-block" {{ id }}>
        <div class="k-kpi-wrap">
          {{ icon }}
          <div class="k-kpi-data">
            <div class="k-header">{{ title }}</div>
            <div class="k-kpi-value">{{ value }}</div>
            {{ change }}
          </div>
        </div>
      </div>
    ';

    // Generamos los datos
    $data = [
        'id'     => $id
      , 'title'  => $this->title
      , 'value'  => $this->value
      , 'icon'   => $icon
      , 'change' => $change
    ];

    $value = k_mask_row( $data, $mask );
    return $value;
  }
}
?>