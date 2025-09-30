<?php

namespace ChicoRei\Packages\Correios;

use InvalidArgumentException;

abstract class CorreiosObject
{
    /**
     * CorreiosObject constructor.
     */
    public function __construct(array $values = [])
    {
        $this->fill($values);
    }

    /**
     * @return static
     */
    public function fill(array $array = [])
    {
        foreach ($array as $key => $value) {
            $setter = 'set'.ucfirst($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }

        return $this;
    }

    /**
     * @param array|static $data
     * @return static
     */
    public static function create($data = [])
    {
        if ($data instanceof static) {
            return $data;
        }

        if (! is_array($data)) {
            throw new InvalidArgumentException('create() argument must be an array');
        }

        return new static($data);
    }

    /**
     * Returns array representation of object
     */
    abstract public function toArray(): array;
}
