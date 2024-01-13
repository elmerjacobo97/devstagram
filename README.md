<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Utilizar DaisyUI

-   importar los estilos JS respectivamente: `@import "animate.css/animate.min.css";` y ` mport 'daisyui';`

## Correr en desarrollo

1. Clonar el repositorio
2. Inicializar las variables de entorno. Copiar el archivo `.env.example` a `.env` y reemplazar los valores.
3. Instalar las dependencias de Laravel y Node y ejecutar: `npm install` `composer update` `composer install`
4. Generar la clave de la aplicación `php artisan key:generate`
5. Ejecuta las migraciones y seeders `php artisan migrate` `php artisan db:seed`

## Notas

-   Helpers

1. `now()->year` imprimir el año actual

-   Convención resources controllers

1. `index` muestra una vista
2. `store` guarda un registro

-   Formularios

1. `@csrf` ataques CSRF

-   Rutas nombradas

1. `Route::get('/register', [RegisterController::class, 'index'])->name('register');` `{{ route('register') }}`

-   Factories

1. Son datos de prueba

-   Policy

1. permite que un usuario puede realizar una acción en particular en un modelo determinado
2. Centralización de la lógica de autorización
