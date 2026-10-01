# personal-web (Laravel)

Sitio personal estilo "terminal" interactiva, migrado desde una versión estática (React/Babel vía CDN servida con Express) a Laravel. El frontend visual se mantiene igual (misma experiencia de terminal en el navegador); lo que cambia es que el contenido ahora vive en base de datos y se edita desde un backoffice Filament en `/admin`, en vez de estar hardcodeado en el JS.

## Stack

- Laravel 13 (PHP 8.3+)
- Filament v4 (panel admin en `/admin`)
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

El sitio queda en `http://localhost:8000` y el panel admin en `http://localhost:8000/admin`.

## Contenido editable desde `/admin`

El panel Filament expone los siguientes módulos (todo el contenido que antes estaba hardcodeado en el frontend):

- **Profile** (página "Manage Profile", registro único): usuario/host/path del prompt, banner ASCII, filas de "neofetch", texto de "about", stack tecnológico y metadatos de SEO (título y descripción).
- **Projects** (CRUD): proyectos mostrados en la terminal (nombre, lenguaje, color, stars, descripción, tags, URL, orden).
- **Experiences** (CRUD): experiencia laboral (hash, rol, empresa, período, descripción, stack, orden).
- **Skill Groups** (CRUD): grupos de habilidades con sus items (nombre, nivel, nota), con orden.
- **Links** (CRUD): enlaces de contacto/redes (label, texto a mostrar, href, orden).

## Estructura básica

- **Contenido / datos**: modelos en `app/Models/` (`Profile`, `Project`, `Experience`, `SkillGroup`, `Link`), con sus migraciones en `database/migrations/`. Toda la UI de edición vive en `app/Filament/Resources/` (uno por modelo CRUD) y `app/Filament/Pages/ManageProfile.php` (el perfil, al ser un registro único, se edita como página en vez de resource).
- **Frontend**: `public/app.jsx`, `public/components.jsx`, `public/root.jsx` y `public/tweaks-panel.jsx` son los assets de la terminal, copiados tal cual del sitio original.
- **Punto de unión**: `routes/web.php` define `GET /` apuntando a `HomeController@index`, que arma el objeto `$site` a partir de los modelos y lo inyecta como `window.SITE` en `resources/views/home.blade.php`, vista que a su vez carga los `.jsx` de `public/`.

## Seguridad antes de producción

- Cambiar la contraseña del usuario admin por defecto (seed) antes de exponer el panel `/admin` públicamente.
- Actualizar `APP_URL` y el dominio real en el sitemap/robots antes de deployar.
