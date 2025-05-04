<?php

/**
 * Componente Avatar
 *
 * Muestra un avatar circular que puede ser imagen o iniciales.
 */
class Avatar
{
  private string $initials;
  private string $src;
  private string $alt;
  private string $size;
  private string $id;
  private string $class;

  /**
   * Constructor del avatar
   *
   * @param string $initials  Letras a mostrar si no hay imagen
   * @param string $src       URL de la imagen (opcional)
   * @param string $alt       Texto alternativo (opcional)
   * @param string $size      Tamaño: sm, md, lg (por defecto 'md')
   * @param string $id        ID único (opcional)
   * @param string $class     Clases CSS adicionales (opcional)
   */
  public function __construct(
      string $initials
    , string $src   = ''
    , string $alt   = ''
    , string $size  = 'md'
    , string $id    = ''
    , string $class = ''
  )
  {
    $this->initials = $initials;
    $this->src      = $src;
    $this->alt      = $alt;
    $this->size     = $size;
    $this->id       = $id;
    $this->class    = $class;
  }

  /**
   * Renderiza el avatar
   */
  public function render(): string
  {
    // Cálculo de clases e ID
    $avatar_class = 'em-avatar em-avatar--' . $this->size;
    if( $this->class !== '' ) $avatar_class .= ' ' . $this->class;
    $id_attr = $this->id !== '' ? 'id="' . $this->id . '"' : '';

    // Determinar si se usa imagen o iniciales
    if( $this->src !== '' )
      $html = '<img src="{{ src }}" alt="{{ alt }}" class="{{ avatar_class }}" {{ id }} />';
    else
      $html = '<div class="{{ avatar_class }}" {{ id }}>{{ initials }}</div>';

    // Datos
    $data = [
        'initials'      => htmlspecialchars( $this->initials )
      , 'src'           => htmlspecialchars( $this->src )
      , 'alt'           => htmlspecialchars( $this->alt)
      , 'avatar_class'  => $avatar_class
      , 'id'            => $id_attr
    ];

    return k_mask_row( $data, $html );
  }
}

?>