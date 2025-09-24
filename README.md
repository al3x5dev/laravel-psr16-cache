# Laravel PSR-16 Cache

**PSR-16 Simple Cache implementation for Laravel projects**

Una implementación simple y elegante del estándar PSR-16 para Laravel, permitiendo usar Redis, Memcached, File y todos los drivers de cache de Laravel con una interfaz estandarizada.

---

## 📦 Instalación

```bash
composer require mk4u/laravel-psr16-cache
```

## 🚀 Uso Rápido

```php
use Mk4U\LaravelCache\LaravelPsr16Cache;

$cache = new LaravelPsr16Cache();

// Almacenar valor
$cache->set('user:1', ['name' => 'Juan'], 3600);

// Recuperar valor
$user = $cache->get('user:1', 'default_value');

// Verificar existencia
if ($cache->has('user:1')) {
    // Hacer algo
}

// Eliminar
$cache->delete('user:1');
```

## 💡 Características

- ✅ **Implementación PSR-16 completa**
- ✅ **Soporte para todos los drivers de Laravel** (Redis, Memcached, File, Database, etc.)
- ✅ **Configuración automática** mediante Laravel
- ✅ **Interfaz simple y estandarizada**
- ✅ **Ideal para librerías y packages** que requieran PSR-16

## 🔧 Configuración

La librería utiliza automáticamente la configuración de cache de tu proyecto Laravel (`config/cache.php`). Simplemente configura tus drivers preferidos:

```php
// .env
CACHE_DRIVER=redis
# o
CACHE_DRIVER=memcached
# o  
CACHE_DRIVER=file
```

## 📚 Métodos Disponibles

```php
$cache->get($key, $default = null);
$cache->set($key, $value, $ttl = null);
$cache->delete($key);
$cache->clear();
$cache->getMultiple($keys, $default = null);
$cache->setMultiple($values, $ttl = null);
$cache->deleteMultiple($keys);
$cache->has($key);
```

## 🔄 Uso con Inyección de Dependencias

```php
use Psr\SimpleCache\CacheInterface;

class UserService 
{
    public function __construct(private CacheInterface $cache) {}
    
    public function findUser($id)
    {
        return $this->cache->get("user:{$id}", function() use ($id) {
            return User::find($id);
        });
    }
}
```

## 📋 Requisitos

- PHP 8.2 o superior
- Laravel 12.x
- Extensión Redis o Memcached (opcional, según driver)

## 🔗 Relacionado

**Para proyectos PHP sin Laravel:**  
👉 [mk4u/cache](https://github.com/al3x5dev/cache) - Implementación simple con drivers APCu y File

## 📄 Licencia

MIT License - ver archivo LICENSE para más detalles.
