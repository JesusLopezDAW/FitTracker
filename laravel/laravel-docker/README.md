# Proyecto Laravel

Este proyecto fue generado con [Laravel Framework](https://laravel.com/).

## Descripción

Este es el esqueleto de una aplicación Laravel que utiliza diversas dependencias para facilitar el desarrollo.

## Requisitos

- PHP >= 8.2
- Composer

## Dependencias principales

- **Inertia.js**: Para crear aplicaciones de una sola página (SPA) con Laravel.
- **AdminLTE**: Un panel de administración de código abierto basado en Bootstrap.
- **Jetstream**: Proporciona autenticación por defecto, dos factores de autenticación, verificación de correo electrónico y otros servicios comunes de inicio de sesión.
- **Sanctum**: Para autenticación de API.
- **Tinker**: Consola REPL interactiva para interactuar con tu aplicación.
- **Ziggy**: Para generar rutas JavaScript en tu aplicación.

## Dependencias de desarrollo

- **Faker**: Para generar datos ficticios para pruebas y sembrado de base de datos.
- **Pint**: Herramienta de inspección y depuración para Laravel.
- **Sail**: Para crear un entorno de desarrollo local con Docker.
- **Mockery**: Biblioteca de pruebas de objetos simulados para pruebas de unidad.
- **Collision**: Manejo de errores de consola mejorado.
- **PHPUnit**: Framework de pruebas unitarias para PHP.
- **Ignition**: Herramienta de depuración y mejora del error para Laravel.

## Instalación

1. Clona este repositorio: `git clone https://github.com/tu-usuario/tu-proyecto.git`
2. Instala las dependencias PHP: `composer install`
3. Copia el archivo de configuración: `cp .env.example .env`
4. Genera la clave de aplicación: `php artisan key:generate`
5. Configura tu base de datos en el archivo `.env`
6. Ejecuta las migraciones para crear las tablas de la base de datos: `php artisan migrate`
7. Opcional: ejecuta los seeders para sembrar la base de datos con datos ficticios: `php artisan db:seed`

## Uso

- Ejecuta el servidor de desarrollo: `php artisan serve`
- Accede a la aplicación desde tu navegador en `http://localhost:8000`

## Comandos

| Comandos                             | Descripción                                                     |
| -------------------------------------| --------------------------------------------------------------- |
| `php db_data.php`                    | Script automatico para hacer migrate & refresh & seed           |
| `php artisan serve`                  | Inicia el servidor de desarrollo                                |
| `php artisan migrate`                | Ejecuta todas las migraciones para crear las tablas             |
| `php artisan db:seed`                | Ejecuta los seeders para sembrar la base de datos               |
| `php artisan tinker`                 | Inicia el REPL interactivo de Laravel para pruebas              |
| `php artisan key:generate`           | Genera una nueva clave de aplicación                            |
| `php artisan make:model Modelo`      | Crea un nuevo modelo en la aplicación                           |
| `php artisan make:controller Nombre` | Crea un nuevo controlador en la aplicación                      |

## Licencia

Este proyecto está bajo la licencia [MIT License](LICENSE).
