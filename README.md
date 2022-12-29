# Módulo procesos eventos Suplos

Toda la solución está desarrollada en PHP puro. Las tecnologías usadas son:

* PHP v8.0.26
* Tailwind como framework CSS
* MySql v5.7

### Configuración de variables de base de datos

Deberá cambiar los datos de la configuración de las variables de la base de datos, desde el archivo config.php

```
'db' => [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => 'xxxxxxxx',
    'name' => 'prueba_suplos',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
  ]
```

### Creación de base de datos, tablas y datos

Para crear las tablas e importar los datos del Excel de actividades deberá hacer clic en el siguiente link:

:alien: [http://localhost/prueba_suplos/public/install.php](http://localhost/prueba_suplos/public/install.php)

### Ingreso al módulo

Para ingresar debe hacer clic el el siguiente link:

:rocket: [http://localhost/prueba_suplos/public](http://localhost/prueba_suplos/public)