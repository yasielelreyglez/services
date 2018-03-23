# Servicios
**Pasos para desplegar**

instalar las dependencias de php con el comando
`composer install`

configurar el acceso a la base de datos en 
`/application/config/database.php`

configurar url base o dominio de la aplicacion en 
`/application/config/config.php`

crear DB schema y llenarla con los datos bases
`php index.php migrate seed`


acceder a la url base de la aplicacion

**Administracion**
La administracion es accesible en `url_base/admin/home`
