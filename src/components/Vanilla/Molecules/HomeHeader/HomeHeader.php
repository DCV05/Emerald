<?php

/**
 * Componente HomeHeader
 *
 * Cabecera superior con mensaje, fecha, avatar e input de búsqueda.
 *
 * DEPENDE DE:
 * - Avatar (para mostrar la imagen o iniciales del usuario)
 * - Input (HTML pasado como string externo)
 */
class HomeHeader
{
  private string $message;
  private string $date_text;
  private string $avatar_src;
  private string $avatar_alt;
  private string $initials;
  private string $input_html;
  private string $id;
  private string $class;

  /**
   * Constructor del HomeHeader
   *
   * @param string $message       Texto completo del mensaje (ej. "Welcome, Carlos")
   * @param string $date_text     Texto de fecha (ej. "4 May, 2025")
   * @param string $avatar_src    URL de la imagen del avatar (opcional)
   * @param string $avatar_alt    Texto alternativo del avatar (opcional)
   * @param string $initials      Iniciales a mostrar si no hay imagen
   * @param string $input_html    HTML del campo de búsqueda (se asume generado)
   * @param string $id            ID único del bloque (opcional)
   * @param string $class         Clases CSS adicionales (opcional)
   */
  public function __construct(
      string $message
    , string $date_text
    , string $avatar_src
    , string $avatar_alt
    , string $initials
    , string $input_html
    , string $id    = ''
    , string $class = ''
  )
  {
    $this->message      = $message;
    $this->date_text    = $date_text;
    $this->avatar_src   = $avatar_src;
    $this->avatar_alt   = $avatar_alt;
    $this->initials     = $initials;
    $this->input_html   = $input_html;
    $this->id           = $id;
    $this->class        = $class;
  }

  /**
   * Renderiza el header principal
   */
  public function render(): string
  {
    // Cálculo de clases e ID
    $wrapper_class = 'em-home-header';
    if( $this->class !== '' ) $wrapper_class .= ' ' . $this->class;
    $id_attr = $this->id !== '' ? 'id="' . $this->id . '"' : '';

    // Renderizado del avatar con fallback a iniciales
    $avatar = new Avatar(
        $this->initials
      , $this->avatar_src
      , $this->avatar_alt
      , 'lg'
    );
    $avatar_html = $avatar->render();

    // Definición de la máscara HTML
    $mask = '
      <div class="{{ wrapper_class }}" {{ id }}>
        <div class="em-home-header__left">
          {{ avatar }}
          <div class="em-home-header__text">
            <div class="em-home-header__message">{{ message }}</div>
            <div class="em-home-header__date">{{ date }}</div>
          </div>
        </div>
        <div class="em-home-header__search">
          {{ input }}
        </div>
      </div>
    ';

    // Datos para reemplazo en máscara
    $data = [
        'wrapper_class' => $wrapper_class
      , 'id'            => $id_attr
      , 'avatar'        => $avatar_html
      , 'message'       => htmlspecialchars( $this->message )
      , 'date'          => htmlspecialchars( $this->date_text )
      , 'input'         => $this->input_html
    ];

    // Render final con k_mask_row
    return k_mask_row( $data, $mask );
  }
}
?>