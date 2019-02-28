<?php

namespace SofWar\Opskins\Enum;


class SortType
{
    /**
     * By name ASC (alphabetical, z first)
     */
    public const NAME_ASC = 1;

    /**
     * By name DESC (alphabetical, a first)
     */
    public const NAME_DESC = 2;

    /**
     * By last_update ASC (oldest first by update)
     */
    public const LAST_UPDATE_ASC = 3;

    /**
     * By last_update DESC (newest first by update)
     */
    public const LAST_UPDATE_DESC = 4;

    /**
     * By suggested price ASC (lowest first)
     */
    public const SUGGESTED_PRICE_ASC = 5;

    /**
     * By suggested price DESC (highest first)
     */
    public const SUGGESTED_PRICE_DESC = 6;

    /**
     * By id ASC (oldest first by creation)
     */
    public const ID_ASC = 7;

    /**
     * By id DESC (newest first by creation)
     */
    public const ID_DESC = 8;

    private function __construct()
    {

    }
}