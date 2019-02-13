<?php

namespace SofWar\Opskins\Resources;


class EmptyObject extends BaseModel
{
    public function __construct($data)
    {
        $this->source = $data;
    }
}