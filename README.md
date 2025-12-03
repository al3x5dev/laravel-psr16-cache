# Laravel PSR-16 Cache

A simple and elegant implementation of the PSR-16 standard for Laravel, allowing you to use Redis, Memcached, File, and all Laravel cache drivers with a standardized interface.

---

## 📦 Install

```bash
composer require al3x5/laravel-psr16-cache
```

## 🚀 Quick Use

```php
use Al3x5\LaravelPsr16Cache;

$cache = new LaravelPsr16Cache();

// Save data
$cache->set('user:1', ['name' => 'Juan'], 3600);

// Get data
$user = $cache->get('user:1', 'default_value');

// Check
if ($cache->has('user:1')) {
    // Do something
}

// Remove
$cache->delete('user:1');
```

## 💡 Features

- ✅ **Full PSR-16 Implementation**
- ✅ **Support for all Laravel cache drivers** (Redis, Memcached, File, Database, etc.)
- ✅ **Automatic Configuration** via Laravel
- ✅ **Simple and Standardized Interface**
- ✅ **Ideal for Libraries and Packages** that require PSR-16

## 🔧 Configuration

The library automatically uses your Laravel project's cache configuration (`config/cache.php`). Simply configure your preferred cache drivers:

```php
// .env
CACHE_DRIVER=redis
# or
CACHE_DRIVER=memcached
# or
CACHE_DRIVER=file
```

## 📚 Available Methods

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

## 🔄 Usage with Dependency Injection

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

## 📋 Requirements

- PHP 8.2 or higher
- Laravel 12.x
- Redis or Memcached extension (optional, depending on the driver)

## 🔗 Related

**For PHP projects without Laravel:**
👉 [mk4u/cache](https://github.com/al3x5dev/cache) - Simple implementation with APCu, File, and other drivers.

## 📄 License

MIT License - see the LICENSE file for details.
