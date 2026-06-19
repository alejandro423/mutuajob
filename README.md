# MutuaJob

## Requisitos

* PHP 8.2+
* Composer
* MySQL
* Node.js
* NPM

## Instalación

```bash
git clone <repositorio>
cd mutuajob
composer install
npm install
npm run build
```

## Configuración

Copiar el archivo de entorno:

```bash
cp .env.example .env
```

Configurar la base de datos en `.env`.

Generar clave:

```bash
php artisan key:generate
```

Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

Iniciar servidor:

```bash
php artisan serve
```
## usuarios de prueba (email y password)
admin123@gmail.com
admin123

trabajador@gmail.com
trabajador123

empleador@gmail.com
empleador123
## Funcionalidades

* Gestión de trabajadores
* Gestión de empleadores
* Sistema de postulaciones
* Sistema de invitaciones
* Administración
* Autenticación de doble factor (2FA)

## Producción

URL del sistema:

https://TU-URL-AQUI
