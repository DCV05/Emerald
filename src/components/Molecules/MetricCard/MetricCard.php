<?php

/**
 * Componente Emerald para mostrar una tarjeta KPI flexible con icono y contenido opcional.
 *
 * @required string $title           Título superior de la tarjeta
 * @required string $value           Valor principal (numérico, monetario, etc.)
 * @optional string $description     Subtexto contextual bajo el valor
 * @optional string $icon_html       Icono embebido en HTML (SVG, Material, etc.)
 * @optional string $content_html    Contenido flexible (tag, gráfico, etc.)
 * @optional string $class           Clases CSS adicionales
 * @optional bool   $class           Activo o no
 */
class MetricCard
{
  private string $title;
  private string $value;
  private string $description;
  private string $icon_html;
  private string $content_html;
  private string $class;
  private bool $active;

  /**
   * Constructor del componente MetricCard.
   */
  public function __construct(
      string $title
    , string $value
    , string $description  = ''
    , string $icon_html    = ''
    , string $content_html = ''
    , string $class        = ''
    , bool   $active       = false
  ) {
    $this->title        = $title;
    $this->value        = $value;
    $this->description  = $description;
    $this->icon_html    = $icon_html;
    $this->content_html = $content_html;
    $this->class        = $class;
    $this->active       = $active;
  }

  /**
   * Renderiza la tarjeta con icono y contenido flexible.
   */
  public function render(): string
  {
    $mask = '
      <div class="em--metric-card {{ class }} {{ active }}" role="region" aria-label="{{ title }}">
        <div class="em--metric-card__header">
          <div class="em--metric-card__icon">
            {{ icon }}
          </div>
          <div class="em--metric-card__info">
            <div class="em--metric-card__title">{{ title }}</div>
            <div class="em--metric-card__value">{{ value }}</div>
            {{ content }}
            {{ description }}
          </div>
        </div>
      </div>
    ';

    $description_html = $this->description
      ? '<div class="em--metric-card__description">' . htmlspecialchars( $this->description ) . '</div>'
      : '';

    $data = [
        'title'       => htmlspecialchars( $this->title )
      , 'value'       => htmlspecialchars( $this->value )
      , 'description' => $description_html
      , 'icon'        => $this->icon_html     ? '<div class="em--metric-card__icon">'     . $this->icon_html    . '</div>' : ''
      , 'content'     => $this->content_html  ? '<div class="em--metric-card__content">'  . $this->content_html . '</div>' : ''
      , 'class'       => $this->class
      , 'active'      => $this->active        ? 'active' : ''
    ];

    return k_mask_row( $data, $mask );
  }
}
?>