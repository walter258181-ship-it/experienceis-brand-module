## Configuración Inicial

Si tras la instalación la funcionalidad de mostrar las marcas en el frontend no aparece , o si deseas desactivar temporalmente, sigue estos pasos:

Ve a Tiendas (Stores) > Settings > Configuración (Configuration).

En la pestaña lateral izquierda, busca el apartado Experienceis > Brand Configuration.

En la sección General Settings, verás la opción Enable Brand Display in Frontend.

Una vez seleccionado Yes, pulsa el botón Save Config

¿Por qué es útil? Esto te permite habilitar o deshabilitar la funcionalidad de la vista de marca en  el frontend en segundos sin tocar código ni entrar en el servidor.

Para que los cambios se reflejen, limpia la caché: bin/magento cache:clean.

Una de las grandes ventajas de este módulo es que no necesitas conocimientos técnicos para gestionarlo, ya que puedes controlar su funcionamiento directamente desde el panel de administración.

¿Qué ganas con esto?

Independencia: Tú decides cuándo se ve la información de marca 

Rapidez: Ideal para realizar pruebas visuales o cambios rápidos en campañas de marketing.


# Nombre del Módulo Experienceis_Brand
Se ha creado un archivo pdf que esta dentro la carpeta docs que explioca con imagenes el resultado que se obtuvo y se explica  la parte tecnica
Módulo personalizado para Magento 2 que añade la entidad **Brand** (Marcas).

## Funcionalidades
* CRUD completo en el Admin (Grid y Formulario).
* Se ha creado una configracion para que negocio cuando quiera quitar la visibilidad del brand en el PDP del producto lo desactiva 
* Atributo de marca en productos.
* Soporte para REST API y graphql
* Visualización en el frontend.
* Filtros en el forntend

## Instalación
1. Copiar contenido en `app/code/Experienceis/Brand`.
2. Ejecutar o crear un .sh 

#!/bin/bash
sudo rm -rf generated
sudo php bin/magento setup:upgrade
sudo chown -R www-data:root .
sudo chmod 777 -R .
sudo php bin/magento setup:di:compile
sudo php bin/magento setup:static-content:deploy -f
sudo php bin/magento c:c
sudo php bin/magento c:f	
sudo chown -R www-data:root .
sudo chmod 777 -R .

## Manual
[Descargar Manual Técnico (PDF)](./docs/Experienceis_Brand_Technical_Review.pdf)
