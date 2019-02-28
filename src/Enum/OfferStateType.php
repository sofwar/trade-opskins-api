<?php

namespace SofWar\Opskins\Enum;


class OfferStateType
{
    /**
     * The offer is active and the recipient can accept it to exchange the items
     */
    public const ACTIVE = 2;

    /**
     * The recipient accepted the offer and items were exchanged
     */
    public const ACCEPTED = 3;

    /**
     *  The offer expired from inactivity
     */
    public const EXPIRED = 5;

    /**
     * The sender canceled the offer
     */
    public const CANCELED = 6;

    /**
     * The recipient declined the offer
     */
    public const DECLINED = 7;

    /**
     * One of the items in the offer is no longer available so the offer was canceled automatically
     */
    public const INVALID_ITEMS = 8;

    /**
     * The trade offer was initiated by a VCase site and it's awaiting eth confirmations.
     */
    public const PENDING_CASE_OPEN = 9;

    /**
     * The trade offer was initiated by a VCase site and there was an error opening case due to back-end issues. No items should have been exchanged.
     */
    public const EXPIRED_CASE_OPEN = 10;

    /**
     * The trade offer was initiated by a VCase site and we were unable to generate items on the blockchain, so the user's keys have been refunded.
     */
    public const FAILED_CASE_OPEN = 12;

    private function __construct()
    {

    }
}