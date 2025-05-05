<?php

/**
 * Componente principal Sidebar para navegación lateral.
 * Construye toda la estructura (header, content, footer) desde arrays.
 *
 * @required string $id
 * @optional string $class
 * @optional string $collapsible [offcanvas, icon, none]
 * @optional array  $items (estructura completa con grupos y botones)
 */
class Sidebar
{
  private string $id;
  private string $class;
  private string $collapsible;
  private array  $items;

  public function __construct(
      string $id
    , string $class = ''
    , string $collapsible = 'none'
    , array  $items = []
  ) {
    $this->id          = $id;
    $this->class       = $class;
    $this->collapsible = $collapsible;
    $this->items       = $items;
  }

  public function render(): string
  {
    // Clase general
    $class = 'em--sidebar';
    if( $this->class )
      $class .= ' ' . $this->class;

    // Atributo data
    $data = '';
    if( $this->collapsible !== 'none' )
      $data = ' data-collapsible="' . $this->collapsible . '"';

    // Header
    $header = '';
    if( !empty( $this->items['header'] ) )
      $header = $this->render_block( $this->items['header'], 'em--sidebar__header' );

    // Content (grupos)
    $content = '';
    if( !empty( $this->items['content'] ) )
    {
      // Generamos cada grupo
      $groups_html = '';
      foreach( $this->items['content'] as $group )
        $groups_html .= $this->render_block( $group );

      $data_content = [
        'class' => 'em--sidebar__content',
        'body'  => $groups_html
      ];

      // Generamos el contenido mediante máscaras
      $mask_content = '<div class="{{ class }}">{{ body }}</div>';
      $content = k_mask_row( $data_content, $mask_content );
    }

    // Footer
    $footer = '';
    if( !empty( $this->items['footer'] ) )
      $footer = $this->render_block( $this->items['footer'], 'em--sidebar__footer' );

    // Render final
    $data_sidebar = [
        'id'    => $this->id
      , 'class' => $class
      , 'data'  => $data
      , 'body'  => $header . $content . $footer
    ];

    $mask_sidebar = '<aside id="{{ id }}" class="{{ class }}"{{ data }}>{{ body }}</aside>';
    return k_mask_row( $data_sidebar, $mask_sidebar );
  }

  private function render_block( array $block, string $wrapper_class = '' ): string
  {
    // Label
    $label = '';
    if( !empty( $block['label'] ) )
      $label = '<div class="em--sidebar__group-label">' . $block['label'] . '</div>';

    // Botones del grupo
    $items_html = '';
    $buttons    = $block['menu'] ?? $block['items'] ?? [];

    // Compilamos cada item o botón
    foreach( $buttons as $item )
    {
      $button = new SidebarMenuButton(
          label:   $item['label']   ?? ''
        , url:     $item['url']     ?? ''
        , icon:    $item['icon']    ?? ''
        , tooltip: $item['tooltip'] ?? ''
      );

      // Añadimos el nuevo item
      $items_html .= '<li class="em--sidebar__menu-item">' . $button->render() . '</li>';
    }

    // Lista de botones
    $data_ul = [ 'items' => $items_html ];
    $mask_ul = '<ul class="em--sidebar__menu">{{ items }}</ul>';
    $ul = k_mask_row( $data_ul, $mask_ul );

    // Si hay clase de bloque
    if( $wrapper_class )
    {
      $data_wrapper = [
        'class' => $wrapper_class,
        'body'  => $label . $ul
      ];

      $mask_wrapper = '<div class="{{ class }}">{{ body }}</div>';
      return k_mask_row( $data_wrapper, $mask_wrapper );
    }

    return $label . $ul;
  }
}