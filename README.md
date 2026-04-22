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
2. Ejecutar  o crear un .sh 

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
[Descargar Manual Técnico (PDF)](./docs/manual_tecnico.pdf)
