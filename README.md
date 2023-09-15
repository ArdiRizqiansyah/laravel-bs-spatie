<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tutorial Bootstrap (SCSS) Dan Spatie Laravel Library
## A. Tutorial Instalasi Bootstrap SCSS di Laravel
1. Instalasi NPM:
```bash
npm install
```

2. Install Bootstrap via NPM:
```bash
npm install bootstrap
```

3. Install Sass via NPM:
```bash
npm install sass
```

4. Perbarui vite.config.js (path var dan alias), seperti ini:
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path');
 
export default defineConfig({
    resolve: {
        alias: {
            '~bootstrap': path.resolve('node_modules/bootstrap'),
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
```

5. pastikan file input style dan js sesuai dengan struktur folder yang mau dibuat:
```javascript
plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ]
```

6. Buat file scss di /resources/scss/app.scss dan impor bootstrap css:
```php
@import "~bootstrap/scss/bootstrap";
```

7. Perhatikan import bootstrap file /resources/js/app.js (karena dibeberapa kasus file tidak tepanggil dengan benar):
```php
import 'bootstrap';
```

## B. Tutorial Instalasi Spatie Role Permission di Laravel
[Text Link](https://spatie.be/docs/laravel-permission/v5/introduction)

1. instal package via composer
```bash
composer require spatie/laravel-permission
```

2. Tambahkan service provider pada file config/app.php:
```php
'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];
```

3. Tambahkan beberapa service yang diperlukan seperti role, middleware, dll (sesuai kebutuhan) di file app\Http\Kernel.php berikut yang biasa saya pakai:
```php
'providers' => [
    // ...
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
];
```

4. Publish migrasi dan config permission dengan jalankan perintah diterminal:
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

5. Hapus cache konfigurasi, jalankan perintah berikut diterminal:
```bash
php artisan optimize
```

6. Jalankan perintah migrasi di terminal:
```bash
php artisan migrate
```

7. *Catatan penting tambahkan trait berikut pada model user:
```php
use HasRoles;
```

### C. Tutorial Instalasi Spatie Media Library di Laravel
[Text Link](https://spatie.be/docs/laravel-medialibrary/v10/introduction)

1. instal package via composer
```bash
composer require "spatie/laravel-medialibrary:^10.0.0"
```

2. Publish migrasi media tabel:
```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
```

3. Jalankan perintah migrasi di terminal:
```bash
php artisan migrate
```

4. *Catatan penggunaan, silahkan tambahkan beberapa trait dan implement berikut pada model yang akan menggunakan Spatie Media Library:
```php
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ModelName implements HasMedia
{
    use InteractsWithMedia;
}
```