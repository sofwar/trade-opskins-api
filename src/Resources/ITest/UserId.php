<?php
/**
 * Email: ya.sofwar@yandex.com
 * Date: 11.02.2019 18:40
 */

namespace SofWar\Opskins\Resources\ITest;


use SofWar\Opskins\Resources\BaseModel;

class UserId extends BaseModel
{
    /**
     * OPSkins.com User ID
     * @var int
     */
    protected $id;

    public function __construct($data)
    {
        $this->source = $data;

        $this->id = $data['uid'] ?? null;
    }
}