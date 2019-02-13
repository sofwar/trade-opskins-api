<?php

namespace SofWar\Opskins\Resources;

abstract class BaseModel
{
    /**
     * @var array
     */
    protected $source;

    public function __call($name, $arguments)
    {
        $key = $name;

        if (mb_strpos($name, 'get') !== false) {
            $key = $this->snakeCase(str_replace('get', '', $name));

            if (property_exists($this, $key)) {
                $arguments[0] = $key;

                return call_user_func_array([$this, 'getProtected'], $arguments);
            }
        }

        throw new \Exception('Fatal error: Call to undefined method '.__CLASS__."->{$key}");
    }

    public function getSource(): array
    {
        return $this->source;
    }

    protected function snakeCase($value, $delimiter = '_')
    {
        static $snakeCache = [];

        $key = $value.$delimiter;

        if (isset($snakeCache[$key])) {
            return $snakeCache[$key];
        }

        if (!ctype_lower($value)) {
            $value = strtolower(preg_replace('/(.)(?=[A-Z])/', '$1'.$delimiter, $value));
        }

        return $snakeCache[$key] = $value;
    }

    protected function getProtected($key)
    {
        return $this->{$key};
    }
}
