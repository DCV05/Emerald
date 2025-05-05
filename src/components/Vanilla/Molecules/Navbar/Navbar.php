<?php

/**
 * Clase para generar componente navbar HTML simple usando máscaras.
 */
class Navbar
{
  private string $brand;
  private string $brand_url;

  /**
   * @var array<int,array{
   *   title:string,
   *   url:string,
   *   is_button:bool,
   *   class:string,
   *   position?:string
   * }>
   */
  private array $links;

  private string $classes;

  /**
   * Constructor del navbar
   *
   * @param string $brand       Texto del logo o marca
   * @param string $brand_url   URL de destino para la marca
   * @param array<int,object|array{title:string,url:string,is_button?:bool,class?:string,position?:string}> $links
   * Links o botones configurables.
   * @param string $classes     Clases css personalizadas
   */
  public function __construct( string $brand, string $brand_url, array $links = [], string $classes = '' )
  {
    $this->brand     = $brand;
    $this->brand_url = $brand_url;
    $this->links     = $links;
    $this->classes   = $classes;
  }

  /**
   * Renderiza el navbar usando máscaras HTML
   *
   * @return string
   */
  public function render(): string
  {
    $value = '';

    // Máscara principal del navbar
    $navbar_mask = '
      <nav id="navbar" class="k-navbar {{ classes }}">
        <div class="k-navbar-brand">
          <a href="{{ brand_url }}" id="kodalogic-brand" class="lufga-regular">
            {{ brand }}
          </a>
          <button class="k-navbar-toggle" aria-label="Toggle navigation">
            <i class="icon">menu</i>
          </button>
        </div>

        <div class="k-navbar-menu">
          {{ left_items }}
          {{ center_items }}
          {{ right_items }}
        </div>

        <div class="k-navbar-section k-navbar-left">
          {{ left_items }}
        </div>

        <div class="k-navbar-section k-navbar-center">
          {{ center_items }}
        </div>

        <div class="k-navbar-section k-navbar-right">
          {{ right_items }}
        </div>
      </nav>
    ';

    $link_mask = '
      <div class="k-nav-item">
        <a href="{{ url }}" class="k-nav-link {{ class }}">{{ title }}</a>
      </div>
    ';

    // Inicializamos las posiciones del navbar
    $left_items = $center_items = $right_items = '';

    // Renderizamos los items del navbar usando máscaras
    foreach( $this->links as $position => $links )
    {
      // Renderizamos todos los links
      $links_html = '';
      foreach( $links as $link )
      {
        // Si se trata de un botón, insertamos el HTML directamente
        if( $link instanceof Button )
          $links_html .= $link->render();
        else
        {
          // Establecemos la clase por defecto
          $link['class'] ??= '';
          $links_html .= k_mask_row( $link, $link_mask );
        }
      }

      // Según la posición añadimos los links a un div u otro
      if( $position === 'left' )
        $left_items .= $links_html;

      elseif( $position === 'center' )
        $center_items .= $links_html;

      else
        $right_items .= $links_html;
    }

    // Datos para la máscara principal del navbar
    $navbar_data = [
        'brand'         => $this->brand
      , 'brand_url'     => $this->brand_url
      , 'left_items'    => $left_items
      , 'center_items'  => $center_items
      , 'right_items'   => $right_items
      , 'classes'       => $this->classes
    ];

    // Retornamos navbar renderizado
    $value = k_mask_row( $navbar_data, $navbar_mask );
    return $value;
  }
}

?>