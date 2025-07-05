# 📚 CRUD de Libros y Autores con Roles y Auditoría - Laravel 10

Este proyecto fue desarrollado como parte de la tarea #84 **"Implementación de Laravel Audity Log en CRUD de Libros y Autores"**, asignada por el ingeniero Manuel Parada en la Unidad de Desarrollo FESC. Tiene como propósito central registrar los eventos **create, update y delete** de las entidades **Autor** y **Libro**, incluyendo la trazabilidad de qué usuario hizo qué cambio y desde qué lugar. También sirve para evaluar qué tan viable y funcional es el uso del paquete **[Laravel Auditing](https://github.com/owen-it/laravel-auditing)**.

## Características

- CRUD completo para **Autores** y **Libros**
- Registro automático de auditoría con:
  - Usuario que hizo el cambio
  - Evento (creado, actualizado, eliminado)
  - IP, navegador y URL
- Roles con permisos (`usuario`, `admin`, `superadmin`)
- Protección de rutas por rol
- Interfaz de selección para admin y superadmin

---

## 🚀 Tecnologías y herramientas utilizadas

- PHP 8.1
- Laravel 10
- Breeze (autenticación)
- Spatie Laravel-Permission (gestión de roles)
- OwenIt Laravel-Auditing (auditorías)
- Tailwind CSS (frontend)
- Vite
- PHPUnit (pruebas automáticas)
- PostgreSQL (conexión por defecto)
- Laragon (entorno local)

---

## ⚙️ Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/tuusuario/crud-libros-autores-activity.git
cd crud-libros-autores-activity
```

2. Instala dependencias:

```bash
composer install
npm install
npm run dev
```

3. Copia el archivo `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configura tu base de datos en `.env`:

```env
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

5. Corre las migraciones y los seeders:

```bash
php artisan migrate:fresh --seed
```

---

## 👤 Usuarios de prueba

Ya vienen pre-cargados en el seeder:

| Rol        | Email                  | Contraseña     |
|------------|------------------------|----------------|
| Superadmin | nelis@ejemplo.com      | 12345678       |
| Admin      | admin@fesc.com         | admin123       |
| Usuario    | usuario@ejemplo.com    | usuario123     |

---

## 🧑‍💻 Roles y accesos

El sistema tiene 3 niveles de acceso:

- `superadmin`: acceso total, incluyendo gestión de roles y usuarios.
- `admin`: puede administrar libros y autores, menos la gestión de roles.
- `usuario`: solo puede ver libros (sin editar, crear ni eliminar).

Cada rol es gestionado usando el paquete **Spatie Laravel-Permission**.

---

## 📝 Auditoría con Laravel Auditing

Se usa el paquete [owen-it/laravel-auditing](https://github.com/owen-it/laravel-auditing) para registrar:

- Usuario autenticado
- Evento (created, updated, deleted)
- IP address
- User Agent
- URL
- Valores anteriores y nuevos

Audita los modelos `Author` y `Book`. Las pruebas automatizadas confirman que se están registrando correctamente.

---

## 🧪 Cómo usar el sistema

Inicia sesión usando cualquiera de los usuarios de prueba.

Si eres admin o superadmin, verás una pantalla de selección para gestionar Libros o Autores.

Si eres usuario, irás directo a la lista de libros en modo solo lectura.

Cada acción de crear, editar o eliminar un autor/libro generará un registro en la tabla audits.

Puedes consultar los registros de auditoría directamente desde base de datos o mediante pruebas automatizadas.

---
## 🧪 Pruebas automatizadas

Ubicadas en `tests/Feature/`:

```bash
php artisan test
```

Pruebas clave:

- `LibroAuditTest`: verifica la auditoría al crear, actualizar y eliminar libros.
- `AutorAuditTest`: verifica la auditoría al crear, actualizar y eliminar autores.
- `TestAudit`: test ultra rápido para visualizar los registros directamente desde la tabla `audits`.

---

## 📂 Estructura del proyecto (resumen)

```
├── app/
│   └── Models/
│       ├── Book.php        # Modelo auditado
│       └── Author.php      # Modelo auditado
├── database/
│   ├── migrations/         # Incluye tabla audits y softDeletes
│   └── seeders/
│       └── UserSeeder.php  # Crea usuarios con roles
├── tests/
│   └── Feature/
│       ├── AutorAuditTest.php
│       ├── LibroAuditTest.php
│       └── TestAudit.php
├── routes/
│   └── web.php             # Rutas protegidas por roles
├── resources/views/        # CRUD con select de autores y dashboard por rol
└── config/
    └── audit.php           # Configuración de auditoría
```

---

## 🙌 Créditos

Desarrollado por **Nelly Fabiola Cano Oviedo**  
👩‍💻 Estudiante de Ingeniería de Software - FESC  
💡 Unidad de Desarrollo 

📆 Julio 2025

Apoyado por **Jesus Manuel Parada**

👩‍💻 Desarrollador Full-Stack 

💡 Unidad de Desarrollo  

📆 Julio 2025


---

## 📬 Contacto

¿Sugerencias o mejoras? ¡Haz un Pull Request o abre un issue!https://github.com/Cfabiola25/CRUD-de-Libros-y-Autores.gitLinkedIn
