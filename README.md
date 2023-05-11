<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Utilizar DaisyUI
- importar los estilos JS respectivamente: ```@import "animate.css/animate.min.css";``` y ``` mport 'daisyui';```

## Notas

* Helpers

1. ```now()->year``` imprimir el año actual

* Convención resources controllers

1. ```index``` muestra una vista
2. ```store``` guarda un registro

* Formularios

1. ```@csrf``` ataques CSRF

* Rutas nombradas

1. ```Route::get('/register', [RegisterController::class, 'index'])->name('register');``` ```{{ route('register') }}```

* Factories
1. Son datos de prueba

* Policy
1. permite que un usuario puede realizar una acción en particular en un modelo determinado
2. Centralización de la lógica de autorización
