# personal-web

Sitio personal estilo "terminal" interactiva, migrado desde una versión estática (React/Babel vía CDN servida con Express) a Laravel. El frontend visual se mantiene igual (misma experiencia de terminal en el navegador); lo que cambia es que el contenido ahora vive en base de datos y se edita desde un backoffice Filament en `/admin`, en vez de estar hardcodeado en el JS.

## Stack

- Laravel 13 (PHP 8.3+)
- SQLite
- Frontend: React 18 + Babel standalone, cargados vía CDN (unpkg) directo en `resources/views/home.blade.php`. No hay bundler ni build step: los archivos `public/*.jsx` se sirven tal cual y se transpilan en el navegador con `<script type="text/babel">`.

## Cómo correr en local

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

El sitio queda en `http://localhost:8000`

## Estructura básica

- **Contenido / datos**: modelos en `app/Models/` (`Profile`, `Project`, `Experience`, `SkillGroup`, `Link`), con sus migraciones en `database/migrations/`. Toda la UI de edición vive en `app/Filament/Resources/` (uno por modelo CRUD) y `app/Filament/Pages/ManageProfile.php` (el perfil, al ser un registro único, se edita como página en vez de resource).
- **Frontend**: `public/app.jsx`, `public/components.jsx`, `public/root.jsx` y `public/tweaks-panel.jsx` son los assets de la terminal, copiados tal cual del sitio original.
- **Punto de unión**: `routes/web.php` define `GET /` apuntando a `HomeController@index`, que arma el objeto `$site` a partir de los modelos y lo inyecta como `window.SITE` en `resources/views/home.blade.php`, vista que a su vez carga los `.jsx` de `public/`.
