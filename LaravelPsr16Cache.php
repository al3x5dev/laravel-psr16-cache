<?php

namespace Mk4U\LaravelCache;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\CacheInterface;

/**
 * Laravel PSR 16 Simple Cache class
 */
final class LaravelPsr16Cache implements CacheInterface
{

    /**
     * Recupera un valor de la caché por su clave.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if ($this->has($key)) {
            return Cache::get($key);
        }
        return $default;
    }

    /**
     * Almacena un valor en la caché con una clave especificada.
     */
    public function set(string $key, mixed $value, null|int|\DateInterval $ttl = null): bool
    {
        if ($this->has($key)) {
            return Cache::put($key, $value, $ttl);
        }
        return Cache::add($key, $value, $ttl);
    }

    /**
     * Elimina un valor de la caché por su clave.
     */
    public function delete(string $key): bool
    {
        if ($this->has($key)) {
            return Cache::forget($key);
        }
        return false;
    }

    /**
     * Limpia toda la caché.
     */
    public function clear(): bool
    {
        return Cache::flush();
    }

    /**
     * Recupera múltiples valores de la caché por sus claves.
     *
     * @param iterable $keys Una colección iterable de claves de caché.
     * @param mixed $default El valor por defecto a devolver para las claves que no existen.
     * @return iterable Un array asociativo de claves y sus correspondientes 
     * valores almacenados en caché.
     */
    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        if (!is_array($keys)) throw new \InvalidArgumentException('$keys is neither an array nor a Traversable');

        $values = [];

        foreach ($keys as $key) {
            $values[$key] = $this->get($key, $default);
        }
        return $values;
    }

    /**
     * Almacena múltiples valores en la caché.
     *
     * @param iterable $values Una colección iterable de pares clave-valor para 
     * almacenar en la caché.
     * @param null|int|\DateInterval $ttl Tiempo de vida opcional para los elementos 
     * de caché.
     * @return bool Verdadero en caso de éxito, falso en caso de fallo.
     */
    public function setMultiple(iterable $values, null|int|\DateInterval $ttl = null): bool
    {
        if (!is_array($values)) throw new \InvalidArgumentException('$values is neither an array nor a Traversable');

        $result = [];

        foreach ($values as $key => $value) {
            $result[] = $this->set($key, $value, $ttl);
        }

        return !in_array(false, $result);
    }


    /**
     * Elimina múltiples valores de la caché por sus claves.
     *
     * @param iterable $keys Una colección iterable de claves de caché a eliminar.
     * @return bool Verdadero en caso de éxito, falso en caso de fallo.
     */
    public function deleteMultiple(iterable $keys): bool
    {
        if (!is_array($keys)) throw new \InvalidArgumentException('$keys is neither an array nor a Traversable');

        $result = [];

        foreach ($keys as $key) {
            $result[] = $this->delete($key);
        }

        return !in_array(false, $result);
    }

    /**
     * Verifica si un valor existe en la caché por su clave.
     */
    public function has(string $key): bool
    {
        return Cache::has($key);
    }
}
