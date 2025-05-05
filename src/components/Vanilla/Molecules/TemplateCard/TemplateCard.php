<?php

/**
 * Componente para generar una tarjeta de un template.
 * Utilizado en Templates
 */
class TemplateCard
{
  private string $title;
  private string $description;
  private string $image;
  private string $link;
  private string $data_sources;
  private string $price;

  /**
   * Constructor de la tarjeta.
   *
   * @param array $template Array de datos del template a renderizar
   */
  public function __construct( array $template )
  {
    $this->title        = $template['title'];
    $this->description  = $template['description'];
    $this->image        = $template['image'];
    $this->link         = $template['link'];
    $this->data_sources = $template['data_sources'];
    $this->price        = $template['price'];
  }

  /**
   * Renderiza el botón usando una máscara HTML.
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Máscara de la tarjeta
    $template_mask = '
      <div class="template-card">
        <div>
          <img class="template-image" src="{{ image }}" alt="{{ title }}">
        </div>

        <div class="ds-container">{{ data_sources }}</div>

        <h3>{{ title }}</h3>
        <p>{{ description }}</p>

        <div>
          <div>
            <h4>${{ price }}</h4>
            <p>One-time payment</p>
          </div>
          {{ link }}
        </div>

      </div>
    ';

    // Generamos el array de datos del botón
    $template_data = [
        'title'         => $this->title
      , 'description'   => $this->description
      , 'image'         => $this->image
      , 'link'          => $this->link
      , 'data_sources'  => $this->data_sources
      , 'price'         => $this->price
    ];

    $value = k_mask_row( $template_data, $template_mask );
    return $value;
  }
}
?>