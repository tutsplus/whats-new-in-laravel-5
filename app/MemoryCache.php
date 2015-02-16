<?php
namespace App;

class MemoryCache implements \Illuminate\Contracts\Cache\Repository
{
    protected $db = [];

    public function has($key) { return isset($this->db[$key]); }
    public function get($key, $default = null) { return $this->has($key) ? $this->db[$key] : $default; }
    public function pull($key, $default = null)
    {
        $item = $this->get($key, $default);
        $this->forget($key);
        return $item;
    }
    public function put($key, $value, $minutes) { $this->db[$key] = $value; }
    public function add($key, $value, $minutes) { !$this->has($key) && $this->put($key, $value, $minutes); }
    public function forever($key, $value) { return $this->put($key, $value, null); }
    public function remember($key, $minutes, Closure $callback)
    {
        if (! $this->has($key)) {
            $this->put($key, $callback(), $minutes);
        }
        return $this->get($key);
    }
    public function sear($key, Closure $callback)
    {
        if (! $this->has($key)) {
            $this->forever($key, $callback());
        }
        return $this->get($key);
    }
    public function rememberForever($key, Closure $callback)
    {
        return $this->sear($key, $callback);
    }
    public function forget($key) { unset($this->db[$key]); }
}


