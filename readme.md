## Resumen
Proyecto creado para la presentación a PlaceToPay, el proyecto base fue tomado de [Joan Quiroga](https://github.com/johanquiroga/placetopay-ws-client/), según mi analisis es el mejor repositorio frente a los requerimientos entregados, este proyecto tiene como fin realizar una aplicación que pueda consumir un servicio WEB (soap) con php, en este caso particular con laravel.

## Abordar el tema
Al utilizar SOAP UI, me encuentro con que no puedo consumir los servicios según la especificacin entregada.

**Login**
Entregado por PlaceToPlay 

**trankey**
Llave entregada por PlaceToPlay, se genera manualmente un trankedy de la siguiente forma SHAR1(seed + trankey) 

**seed**
Fecha actual formateada según la ISO 8601

**Additional** 
Datos adicionales. 

## Metodología
Ante mi falta de conocimiento bajo un enfoque **SOAP** busque los repositorios y la documentación que me permitiera entregar el mejor resultado, por esto revise los repositorios existentes como la [documentación oficial](http://php.net/manual/en/book.soap.php) instalando de esta forma las librerias necesarias de soap adicionales y necesarias para la puesta en marcha  de este proceso.


## Flujo del proyecto
Se conecta a la clase [Consummer Class](app/Soap/Consumer.php), la cuál recibe el cliente, siguiendo una buena practica de modularidad y clases cortas (no más de una pantalla de código) se separan las clases en una estructura Methods, donde se hace el llamado a la logica de getBankList, CreateTransaction, GetTransactionInformation etc.

## Agradecimientos
Este proyecto fue realmente interesante, me pone en frente un reto mas, pues encuentro elementos adicionales que desconozco frente a la arquitectura que pude evidenciar en el repositorio encontrado, pienso que este tipo de pruebas son las que se necesitan para realmente comprender en un proceso de desarrollo tanto a la empresa como a la persona las falencias como los conocimientos que se puedan tener y de paso enriquecer el proceso que lleva la persona. 





