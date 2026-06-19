 README.md – MutuaJob (Laravel)
# MutuaJob

MutuaJob es una plataforma desarrollada en Laravel para la gestión de empleos, donde los trabajadores pueden postular a ofertas y los empleadores pueden publicar y administrar vacantes.

---

##  Tecnologías utilizadas

- Laravel 10+
- PHP 8.2+
- MySQL
- Blade (Frontend básico)
- Git & GitHub

---

##  Instalación local

### 1. Clonar el repositorio

```bash
git clone https://github.com/alejandro423/mutuajob.git
cd mutuajob
2. Instalar dependencias
composer install
npm install
npm run build
3. Configurar entorno
cp .env.example .env
php artisan key:generate

Configurar base de datos en .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mutuajob
DB_USERNAME=root
DB_PASSWORD=
4. Ejecutar migraciones y seeders con datos pregrabados
php artisan migrate:fresh --seed
5. Iniciar servidor
php artisan serve

Acceder en:

http://127.0.0.1:8000
📁 Estructura del proyecto
app/ → Lógica del sistema
routes/ → Rutas web y API
resources/views/ → Vistas Blade
database/migrations/ → Estructura de BD
public/ → Archivos públicos
⚠️ Notas importantes
El archivo .env no se sube al repositorio
vendor/ y node_modules/ están excluidos por .gitignore
El proyecto requiere MySQL activo para funcionar correctamente

usuarios de prueba:

admin123@gmail.com
admin123
codigo (si pide):HDSRUVVSSBKWN5WY

trabajador@gmail.com
trabajador123

empleador@gmail.com
empleador123
