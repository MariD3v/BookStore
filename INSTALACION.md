## Instalación en servidor

Esta guía te explica cómo desplegar **BookStore** en un servidor web para que esté accesible desde cualquier dispositivo conectado a la red.

### Requisitos previos

- Servidor con soporte PHP 8.3.6 o superior.
- Base de datos MySQL o MariaDB.
- Servidor web (Apache, Nginx, etc.).
- Acceso SSH o panel de control para gestionar el servidor.
- Opcional: máquina virtual (VirtualBox, VMware) con sistema operativo Linux o Windows configurado.

### Pasos para la instalación

1. **Subir archivos al servidor**

   - Usa FTP, SFTP o SCP para transferir los archivos del proyecto a la carpeta pública del servidor (`/var/www/html` en Linux con Apache, por ejemplo).

     <details>
       <summary>Resultado</summary>

       ```plaintext
       ├── html
       │   ├── public
       │   │   ├── assets
       │   │   └── interface
       │   └── src
       │       ├── assets
       │       │   └── images
       │       │       ├── author_photos
       │       │       └── covers
       │       ├── database
       │       ├── pages
       │       ├── scripts
       │       ├── server
       │       └── styles
       ```
     </details>

2. **Configurar la base de datos y conexión**

   - Crea una base de datos en el servidor.
   - Importa el script SQL (`database/database.sql`) para crear las tablas y datos iniciales.

   - Modifica `src/server/getConnection.php` con los datos reales de acceso a la base de datos (host, usuario, contraseña y nombre de la base).

    > [!TIP]
    > Si estás en local, puedes cambiar el valor de `"crearBase"` a `true` y entrar a tu web; automáticamente se crearán las tablas. Recuerda que después debes volver a cambiarlo a `false`.

  

3. **Permisos**

   Para que el servidor web (como Apache o Nginx) pueda acceder a los archivos del proyecto, es fundamental asignar los permisos adecuados.

   - Cambia el propietario y grupo de todos los archivos y carpetas dentro de `/var/www/` al usuario y grupo del servidor web (`www-data` en la mayoría de distribuciones Linux como Ubuntu/Debian).

   - Esto garantiza que el servidor web tenga permisos para leer (y si es necesario, escribir) en esos archivos.

   Ejecuta el siguiente comando desde la terminal:

   ```bash
   cd /var/www/
   sudo chown -R www-data:www-data .
4. **Configurar el servidor web**

   - En Apache, configura el `VirtualHost` para apuntar a la carpeta pública de BookStore.
   - En Nginx, configura el bloque `server` equivalente:

     <details>
       <summary>Configuración para Nginx</summary>

       ```nginx
       server {
           listen 80;
           server_name URL/IP;

           root /var/www/html/src;
           index index.php index.html index.htm;

           location / {
               try_files $uri $uri/ /index.php?$query_string;
           }

           location ~ \.php$ {
               include snippets/fastcgi-php.conf;
               fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
           }
       }
       ```
     </details>

5. **Probar la instalación**

   - Accede al dominio o IP donde has instalado la aplicación.
   - Comprueba que la página carga correctamente y que los endpoints de la API responden.

---

### Consejos adicionales

<details>
  <summary>Habilita HTTPS y certificados SSL</summary>

Para entornos de producción, es fundamental proteger la comunicación entre cliente y servidor usando HTTPS.

- Usa [Let's Encrypt](https://letsencrypt.org/) para obtener certificados SSL gratuitos.
- En **Apache**, una vez instalados los certificados, activa SSL con:

  ```bash
  sudo a2enmod ssl
  sudo a2ensite default-ssl
  sudo systemctl reload apache2
  ```
</details>

<details>
    <summary>Configura un firewall o reglas de seguridad</summary>

Proteger tu servidor es esencial para evitar accesos no autorizados y mantener la integridad del sistema.

- **Limita los puertos abiertos** solo a los necesarios:
  - `22` → SSH
  - `80` → HTTP
  - `443` → HTTPS

- En sistemas basados en **Ubuntu/Debian**, puedes usar `ufw`:

    ```bash
    sudo ufw allow ssh
    sudo ufw allow http
    sudo ufw allow https
    sudo ufw enable
    ```
</details>

<details>
  <summary>Realiza copias de seguridad periódicas de la base de datos y archivos</summary>

Mantener backups actualizados es fundamental para evitar pérdida de datos ante errores, ataques o fallos del sistema.

#### Base de datos (MySQL/MariaDB)

Puedes usar `mysqldump` para exportar toda la base de datos a un archivo `.sql`:

```bash
mysqldump -u usuario -p base_de_datos > copia.sql
```

Para editar las tareas programadas con `cron`, ejecuta:

```bash
crontab -e
```
```bash
0 2 * * * /usr/bin/mysqldump -u usuario -p'contraseña' base_de_datos > /ruta/respaldo_$(date +\%F).sql
```