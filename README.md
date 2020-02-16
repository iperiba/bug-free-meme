<b><h2>Juego de tres en raya realizado por Ignacio Pérez en PHP con Laravel</h2></b>

<b>Versiones de las herramientas empleadas:</b><br>
Laravel Framework 6.15.1<br>
PHP 7.4.2<br>
Última versión de XAMPP (Apache 2.4.41)<br>
Composer version 1.8.5<br>
Node.js v12.16.0.<br><br>

<b>Instalación:</b><br>
1 git clone https://github.com/iperiba/tres_en_raya<br>
2 Para evitar problemas con las rutas hacia la carpeta public de Laravel, en mi caso, empleando XAMPP, he modificado los archivos de Apache:<br>
C:\xampp02\apache\conf\extra<br>    
Quedando de esta forma:<br>  
NameVirtualHost *:80<br>
<VirtualHost *:80><br>
    DocumentRoot "C:/xampp/htdocs"<br>
    ServerName localhost<br>
<\/VirtualHost><br>
<VirtualHost *:80><br>
    DocumentRoot "C:/xampp/htdocs/tres_en_raya/public/"<br>
    ServerName tres_en_raya.local<br>
<\/VirtualHost><br>  
Y C:\Windows\System32\drivers\etc\hosts<br>
Añadiendo al final del documento esta línea: <br>
127.0.0.3 tres_en_raya.local<br><br>
3. Creación de una base de datos e importación del archivo baseDatos_tresEnRaya.sql<br><br>
4. En el root del proyecto, a través del terminal, ejecutar el siguiente comando: composer install<br><br>
5. Ejecutar también: npm install<br><br>
6. Crear una copia del archivo .env.example que se descarga por defecto: cp .env.example .env<br><br>
7. En el nuevo archivo .env creado, modificar el apartado en el que se configura la conexión con la base de datos. En mi caso, queda así:<br>
DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=tres_en_raya<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br><br>
8. Generar una nueva clave de encriptación: php artisan key:generate


















