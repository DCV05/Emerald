<?php

/**
 * Carga todos los componentes Emerald.
 */

// Ruta base del sistema de componentes
$components_base_path = __DIR__ . '/components';

// Carga todos los archivos PHP de forma recursiva
$iterator = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator( $components_base_path )
);

// Añadimos cada fichero
foreach( $iterator as $file )
{
  if( $file->isFile() && $file->getExtension() === 'php' )
    require_once $file->getPathname();
}

?>