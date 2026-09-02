# API Invitación de Boda

Aplicación backend desarrollada en Laravel para gestionar la invitación digital de una boda. El proyecto permite registrar invitados, generar tokens JWT para acceso seguro, confirmar asistencia, crear pases en PDF, generar códigos QR y recopilar mensajes de los asistentes desde un panel administrativo.

## Descripción general

Este proyecto está pensado para un flujo completo de invitación para un evento con:

- registro de invitados y cantidad de personas asociadas;
- identificación por UUID para cada invitado;
- autenticación mediante JWT para endpoints protegidos;
- confirmación de asistencia;
- generación de QR con enlace personalizado;
- generación de pase PDF por invitado;
- panel administrativo para consultar asistencia y mensajes;
- almacenamiento de datos dinámicos del evento.

## Stack tecnológico

- PHP 8.2
- Laravel 13
- Composer
- MySQL / base relacional
- Blade templates
- JWT con `firebase/php-jwt`
- Dompdf para generación de PDFs
- Simple QrCode para códigos QR
- PHPUnit / Pest

## Estructura principal

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── ComentariosInvitadosController.php
│   │   ├── DashboardController.php
│   │   ├── InvitadosController.php
│   │   ├── LoginController.php
│   │   └── PaseController.php
│   ├── Middleware/
│   │   └── JwtVerify.php
│   └── Requests/
│       ├── GenerateTokenRequest.php
│       ├── StoreComentariosInvitadosRequest.php
│       ├── StoreInvitadoRequest.php
│       └── UpdateInvitadoRequest.php
├── Models/
│   ├── ComentariosInvitado.php
│   ├── DynamicData.php
│   ├── Invitado.php
│   └── User.php
├── Services/
│   ├── JWTokenService.php
│   └── PdfService.php
└── Providers/
    └── AppServiceProvider.php

database/
├── migrations/
├── seeders/
│   ├── DatabaseSeeder.php
│   └── DatosDinamicosSeeder.php
└── factories/

resources/
├── css/
├── js/
└── views/
    ├── deseos/
    ├── panel/
    └── pdf/
        └── pase.blade.php

routes/
├── api.php
├── web.php
├── console.php
```

## Modelos principales

### Invitado
Representa a cada persona invitada. Guarda:

- nombre del invitado;
- cantidad de personas asociadas;
- UUID único;
- estado de aceptación;
- fecha de confirmación.

### DynamicData
Almacena texto y valores dinámicos del evento (fecha, hora, lugar, mensajes, etc.) que se reutilizan en el QR y en el pase PDF.

### ComentariosInvitado
Guarda comentarios o deseos dejados por los invitados.

## Funcionalidades del sistema

### 1. Registro de invitados
Se crea un invitado con nombre y cantidad de personas. El sistema genera un UUID para identificarlo de forma segura.

### 2. Generación de token JWT
Se genera un JWT con los datos del invitado para permitir acceso a rutas protegidas.

### 3. Confirmación de asistencia
El invitado puede confirmar que asistirá. El sistema actualiza el campo `acepto_invitacion` y guarda la fecha.

### 4. Validación de aceptación
Se puede consultar si el invitado ya aceptó o no la invitación.

### 5. Código QR
Se genera un QR basado en el UUID del invitado y el enlace configurado en `app.url_front`.

### 6. Pase PDF
Se genera un PDF con el nombre del invitado, la cantidad de personas, y los datos del evento configurados en el sistema.

### 7. Panel administrativo
La vista `/panel` muestra el listado de invitados, el total de personas y la cantidad de aceptaciones.

### 8. Deseos y mensajes
Los invitados pueden dejar comentarios y estas entradas quedan almacenadas para revisión desde la vista de administración.

## Endpoints principales

### API

```text
POST /api/invitados
POST /api/invitados/genera-token
GET /api/invitados/{uuid_invitado}
POST /api/invitados/confirmar-asistencia
GET /api/invitados/validar-aceptacion
POST /api/comentarios-invitados
```

### Web

```text
GET /
POST /login
GET /logout
GET /panel
GET /genera-pase/{uuid_invitado}
GET /invitados/generar-qr/{uuid_invitado}
GET /deseos
```

## Servicios clave

### `JWTokenService`
Encapsula la creación y decodificación de JWT para autenticar invitado en endpoints protegidos.

### `PdfService`
Genera documentos PDF a partir de vistas Blade con Dompdf.

## Migraciones y datos iniciales

Las migraciones crean las tablas necesarias para:

- invitados;
- comentarios de invitados;
- datos dinámicos del evento;
- tokens personales de Sanctum.

La semilla `DatosDinamicosSeeder.php` añade valores iniciales del evento para ser usados en el pase y la QR.

## Instalación

1. Clona el repositorio.

```bash
git clone <url-del-repositorio>
cd api-invitacion-boda
```

2. Instala dependencias de PHP.

```bash
composer install
```

3. Instala dependencias del frontend.

```bash
npm install
```

4. Copia el archivo de entorno.

```bash
cp .env.example .env
```

5. Genera la clave de la app.

```bash
php artisan key:generate
```

6. Configura la base de datos en `.env` y ejecuta migraciones.

```bash
php artisan migrate
php artisan db:seed
```

7. Inicia la aplicación.

```bash
php artisan serve
```

8. Si usas Vite para frontend:

```bash
npm run dev
```

## Variables de entorno relevantes

```env
APP_NAME="Invitación de Boda"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_db
DB_USERNAME=usuario
DB_PASSWORD=password
APP_URL_FRONT=http://localhost:5173/
```

> `APP_URL_FRONT` se usa para construir el enlace dentro del QR.

## Notas de desarrollo

- El flujo principal se basa en el `uuid_invitado`.
- La autenticación del invitado usa JWT en el header `Authorization: Bearer ...`.
- El panel administrativo usa auth normal de Laravel con sesión.
- Los valores del evento se mantienen en base de datos para no hardcodearlos en el código.

## Licencia

Este proyecto se distribuye bajo la licencia MIT.
