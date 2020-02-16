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
    DocumentRoot "C:/xampp02/htdocs/tres_en_raya/public/"<br>
    ServerName tres_en_raya.local<br>
<\/VirtualHost><br>  

Y C:\Windows\System32\drivers\etc\hosts<br>
Añadiendo al final del documento esta línea: <br>
127.0.0.3 tres_en_raya.local<br>














