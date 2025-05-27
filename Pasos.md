# 🛡️ Middleware en Laravel 12: `VerificarUsuario`

En Laravel 12, los *middlewares* permiten interceptar las solicitudes HTTP antes o después de que lleguen al controlador. En este ejemplo, crearemos un middleware llamado `VerificarUsuario`.

---

## 📌 Crear el middleware

Ejecuta el siguiente comando en la terminal:

```bash
php artisan make:middleware VerificarUsuario
```

Esto generará el archivo en:

```
app/Http/Middleware/VerificarUsuario.php
```

---

## 🧱 Estructura del middleware

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarUsuario
{
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!Auth::check()) {
            $ruta = encrypt($request->fullUrl());
            return redirect()->route('welcome', ['r' => $ruta]);
        }
        return $next($request);
    }
}
```

---

## ⚙️ Registrar el middleware

Abre el archivo `app/Http/Kernel.php`.

### ➤ Como middleware global (se aplica a todas las rutas)

Agrega en el arreglo `$middleware`:

```php
protected $middleware = [
    // otros middleware...
    \App\Http\Middleware\VerificarUsuario::class,
];
```

### ➤ Como middleware de ruta

Agrega en el arreglo `$routeMiddleware`:

```php
protected $routeMiddleware = [
    'verificar.usuario' => \App\Http\Middleware\VerificarUsuario::class,
];
```

---

## 🛣️ Usar middleware en rutas

En `routes/web.php`:

```php
Route::get('/panel', function () {
    return 'Bienvenido al panel';
})->middleware('verificar.usuario');
```

---

## 🧪 Usar en controladores

```php
public function __construct()
{
    $this->middleware('verificar.usuario')->only('mostrarPanel');
}
```

---

## 🧩 Middleware en grupo de rutas

```php
Route::middleware(['auth', 'verificar.usuario'])->group(function () {
    Route::get('/panel', function () {
        return 'Panel de usuario';
    });
});
```

---

## 📚 Middleware comunes en Laravel

- `auth`: verifica que el usuario esté autenticado
- `guest`: verifica que el usuario no esté autenticado
- `verified`: comprueba verificación de email
- `throttle`: limita número de solicitudes
- `signed`: valida firmas de URL

---

✅ Con esto ya tienes un middleware personalizado funcionando en Laravel 12.
