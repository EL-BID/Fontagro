[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=EL-BID_Fontagro&metric=alert_status)](https://sonarcloud.io/dashboard?id=EL-BID_Fontagro)
![analytics image (flat)](https://raw.githubusercontent.com/vitr/google-analytics-beacon/master/static/badge-flat.gif)
![analytics](https://www.google-analytics.com/collect?v=1&cid=555&t=pageview&ec=repo&ea=open&dp=/Fontagro/readme&dt=&tid=UA-4677001-16)

# Plataforma de Proyectos FONTAGRO
---
Es una aplicación web que permite diseñar, gestionar y analizar proyectos de investigación. 

Ofrece un conjunto de herramientas para una comunicación y gestión del conocimiento moderna y eficiente y el ágil ingreso y monitoreo de proyectos de investigación.

![](https://i.imgur.com/vi46z5d.jpg)

El principal objetivo de la plataforma es unificar la información generada por los proyectos y visibilizar los resultados para facilitar la transferencia de tecnología.

Una vez implementada la herramienta, se logra disponer de bases de datos que permiten tomar decisiones de manera más eficiente.

La herramienta ofrece a los investigadores una oportunidad para disminuir tiempos y costos en la generación de productos de conocimiento y diseminación.

![](https://i.imgur.com/FHeykNd.png)


### Detalles del proyecto

Para conocer más sobre este proyecto, visita el siguiente enlace: 
http://digital.fontagro.org/nueva-plataforma-digital-fontagro/


### Guía de instalación
---
Requerimientos para la instalación:

PHP 7.2 o superior

MySQL 5.7.31 o superior

Dependencias (comandos para Ubuntu con servidor apache2): 

    sudo apt-get install php-curl

    sudo apt-get install php-imagick

    sudo apt-get install php-gd

    sudo apt-get install php-mbstring

    sudo apt-get install php-zip

Luego de instalar todas las dependencias, copiar el código en el directorio correspondiente. 

Crear una base de datos nueva y crear las tablas a partir del archivo base-datos.sql

Agregar los datos de configuracion del sitio en application/config/config.php y los datos de acceso a la base de datos en application/config/database.php

Se deben dar permisos de escritura al servidor web a las carpetas que se encuentran dentro de la carpeta uploads.

Si se instala en un subdirectorio, se deben modificar las lineas 8 y 18 del archivo .htaccess

Ir a la direccion: url_de_instalacion/admin y loguearse con el usuario "admin@admin.com" y password "admin". Inmediatamente cambiar los datos de acceso. 

### Guía de usuario
---
Una vez instalado el sistema lo primero que se requiere es ingresar al panel de administración a cargar la información de la plataforma. 

El instructivo para realizar la carga como usuario administrador se encuentra en https://github.com/EL-BID/Fontagro/blob/master/guias/Instructivos_administrador.pdf

El instructivo para realizar la carga como usuario investigador se encuentra en https://github.com/EL-BID/Fontagro/blob/master/guias/Instructivos_investigadores.pdf


### Autores
---
Desarrollado por Cooperativa Animus (http://www.animus.com.ar)

### Licencia para el código de la herramienta
---
Por favor vea la licencia AM-331-A3 en https://github.com/EL-BID/Fontagro/blob/master/LICENSE.md

### Licencia para la documentación de la herramienta
---
Licencia CC0 http://creativecommons.org/publicdomain/zero/1.0/

## Limitación de responsabilidades
---
La Cooperativa de Trabajo Animus LTDA. no será responsable, bajo circunstancia alguna, de daño ni indemnización, moral o patrimonial; directo o indirecto; accesorio o especial; o por vía de consecuencia, previsto o imprevisto, que pudiese surgir:

i. Bajo cualquier teoría de responsabilidad, ya sea por contrato, infracción de derechos de propiedad intelectual, negligencia o bajo cualquier otra teoría; y/o

ii. A raíz del uso de la Herramienta Digital, incluyendo, pero sin limitación de potenciales defectos en la Herramienta Digital, o la pérdida o inexactitud de los datos de cualquier tipo. Lo anterior incluye los gastos o daños asociados a fallas de comunicación y/o fallas de funcionamiento de computadoras, vinculados con la utilización de la Herramienta Digital.
