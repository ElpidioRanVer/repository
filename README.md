# repository

Este proyecto se enfoca en el desarrollo de un Repositorio Institucional para la preservación y/o publicación de información biológica. Para la implementación del repositorio se utilizan herramientas como:

  [Metacat](https://knb.ecoinformatics.org/knb/docs/).

  [OAI-PMH](https://www.openarchives.org/pmh/).

  [OpenAire](https://guidelines.openaire.eu/en/latest/data/index.html).

  [Laravel](https://laravel.com/docs/5.3).


Además de las tecnologías existentes:

[GBIF](http://www.gbif.org/).
  
[NCBI](https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi).




La totalidad del proyecto se divide en tres partes:
	
## Servidor Metacat
Este sistema consta de un servidor que utiliza Metacat como herramienta de apoyo para la creación de un repositorio, el cual contendrá Bases de Datos con información biológica y metadatos en formato oai-dc. Además se configuró el protocolo OAI-PMH para la compartición de metadatos y cosecha de los mismos.

El archivo "instrucciones.txt" contiene las configuraciones realizadas para la implementación del servidor Metacat.

## Sitio Web
Es el sistema principal del repositorio, su desarrollo está en progreso y se utiliza Laravel como framework. En este sistema están implementadas funcionalidades que permiten reunir información taxonómica de diversas especies y su posterior almacenamiento en una Base de Datos.

## Sistema de búsqueda
El apartado de búsqueda general y avanzada de especies almacenadas en la Base de Datos, la cual despliega la información completa relacionada al espécimen, incluyendo la distribución en un mapa y la opción de descargar la información en formato csv.
Este sistema se integrará en el sitio web principal del repositorio.


