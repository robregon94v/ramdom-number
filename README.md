Se debe descargar el proyecto llamado Service Ramdom Number 

# Instalar 

Se debe instalar los paquetes  del microframework Mark y la libereria monolog 

- composer require mark-php/mark

- composer require monolog/monolog

# Ejecutar 

Se debe navegar hasta la carpeta del proyecto y ejecutar el siguiente comando: 

- php index.php start -d

# Probar

Para probar el servicio se debe ejecutar en una aplicación para realizar pruebas de APIs (ejemplo Postman)

la URL a ejecutar es: http://127.0.0.1:3000/generate-number

El metodo es POST

Se debe pasar por Body el siguiente Json con el numero minimo y maximo a generar: 

{
    "min":1,
    "max":50
}



 

