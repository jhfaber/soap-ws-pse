## Resumen
Proyecto creado para la presentación a PlaceToPay, el proyecto fue tomado de [Joan Quiroga](https://github.com/johanquiroga/placetopay-ws-client/), según mi analisis es el mejor repositorio frente a los requerimientos entregados, este proyecto tiene como fin realizar una aplicación que pueda consumir un servicio WEB (soap) con php, en este caso particular con laravel.

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

Luego de un analisis se llega a la conclusion que se debe enviar con el paquete PHP.7.1-soap la data para poder obtener un resultado del web-service.

## Metodología
La implementacion y experiencia en **SOAP** no es mi fuerte, por lo que aborde el tema de la siguiente manera:

- Busque los repositorios y la documentación que me permitiera entregar el mejor resultado, por esto revise los repositorios existentes como la [documentación oficial](http://php.net/manual/en/book.soap.php) instalando de esta forma las librerias necesarias de soap adicionales y necesarias para la puesta en marcha  de este proceso.

- Busco los repositorios que han realizado un trabajo parecido, en este caso igual.

- Se crea un modulo SOAP dentro de APP (Estructura Laravel), el cual contiene toda la logica prevista en los requerimientos de PlaceToPlay, luego es consumida por el controlador para imprimir en la vista el resultado final. 


## Flujo del proyecto
Se piden los datos de Auth (autentificación), se le permite al usuario crear su propia transaccion, se conecta a la clase [Consummer Class](app/Soap/Consumer.php), la cuál recibe el cliente, esta clase puede consumir dinamicamente todos los metodos necesarios, redireccionando segun sea el caso al metodo que convenga como por ejemplo getBankList, etc. Se siguen buenas practicas de modularidad y clases cortas (no más de una pantalla de código), todos estos metodos son consumidos por el controlador SOAP, luego de procesar la data se imprimi la data en la vista para continuar con la siguiente operación.

## Agradecimientos
Este proyecto fue realmente interesante, me pone en frente un reto mas, pues encuentro elementos adicionales que desconozco frente a la arquitectura que pude evidenciar en el repositorio encontrado, pienso que este tipo de pruebas son las que se necesitan para realmente comprender en un proceso de desarrollo tanto a la empresa como a la persona las falencias como los conocimientos que se puedan tener y de paso enriquecer el proceso que lleva la persona. 





