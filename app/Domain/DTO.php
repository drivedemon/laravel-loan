<?php

namespace App\Domain;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class DTO
 * @package App\Domain
 */
class DTO
{
    /**
     * DTO constructor.
     * @param Request|array|null $payload
     */
    public function __construct($payload = null)
    {
        if (null === $payload) {
            return;
        }
        $data = $payload instanceof Request ? $payload->all() : $payload;
        $data = is_array($data) ? $data : $data->toArray();
        $attributes = array_keys(get_object_vars($this));
        foreach ($data as $key => $value) {
            $attributeName = Str::camel($key);
            if (!in_array($attributeName, $attributes)) {
                continue;
            }
            $this->{$attributeName} = $value;
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $tmp = [];
        foreach (get_object_vars($this) as $key => $value) {
            if (null === $value) {
                continue;
            }
            $tmp[Str::snake($key)] = $value;
        }
        return $tmp;
    }
}
