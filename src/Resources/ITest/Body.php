<?php

namespace SofWar\Opskins\Resources\ITest;


use SofWar\Opskins\Resources\BaseModel;

class Body extends BaseModel
{
    public function __construct($data)
    {
        $this->source = $data;

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}