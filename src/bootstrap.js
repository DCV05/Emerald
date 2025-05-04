/**
 * Emerald Bootstrap Loader
 *
 * Este archivo importa todos los scripts Javascript de los componentes Emerald
 * de forma centralizada. Permite que, al incluir este archivo con `type="module"`,
 * todos los módulos Emerald queden disponibles automáticamente.
 *
 * Requisitos:
 * - Este archivo debe incluirse con `<script type="module" src="/src/bootstrap.js"></script>`
 * - Las rutas de importación deben ser estáticas y absolutas (no se puede automatizar
 *   el descubrimiento de archivos sin un sistema de build).
 *
 * Si deseas automatizar la generación de este archivo, puedes usar un script PHP que
 * recorra el sistema de archivos e imprima todos los `import` necesarios.
 *
 * Ejemplo de uso:
 * ```html
 * <script type="module" src="/src/bootstrap.js"></script>
 * ```
 *
 * @author Emerald Builder
 * @version 1.0.0
 */

const EmeraldDir = '/k/apps/kodalogic/Emerald/src';

import( `${EmeraldDir}/components/Molecules/SideNav/Sidenav.js` );