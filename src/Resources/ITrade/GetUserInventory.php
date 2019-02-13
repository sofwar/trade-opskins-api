<?php

namespace SofWar\Opskins\Resources\ITrade;

use SofWar\Opskins\Resources\InventoryUser;
use SofWar\Opskins\Resources\IUser\Inventory;

class GetUserInventory extends Inventory
{
    /**
     * User Inventory+
     * @var object
     */
    protected $user;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->user = new InventoryUser($data['user_data']);
    }

    public function getUser(): InventoryUser
    {
        return $this->user;
    }
}