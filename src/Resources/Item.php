<?php

namespace SofWar\Opskins\Resources;


class Item extends BaseModel
{
    /**
     * Item ID
     *
     * @var int
     */
    protected $id;

    /**
     * Internal App ID
     *
     * @var int
     */
    protected $internal_app_id;

    /**
     * Unique Definition ID, this is a unique & unchanging identifier for each item, regardless of app_id.
     *
     * @var int
     */
    protected $def_id;

    /**
     * Item SKU #, mainly utilized for VGO items. For all other items that don't have a sku, this will be the same as def_id.
     *
     * @var int
     */
    protected $sku;

    /**
     * Wear float value, only applicable for certain apps
     *
     * @var boolean
     */
    protected $wear;

    /**
     * Is item tradable? Items may be temporarily untradable during certain operations, e.g. transfers.
     *
     * @var boolean
     */
    protected $tradable;

    /**
     * Trade hold expiration date. null if no trade hold
     *
     * @var int|null
     */
    protected $trade_hold_expires;

    /**
     * Simpler name for an item (compared to full market_name).
     *
     * @var string
     */
    protected $name;

    /**
     * Full market name
     *
     * @var string
     */
    protected $market_name;

    /**
     * Category name e.g.
     *
     * @var string
     */
    protected $category;

    /**
     * Category rarity e.g. Covert -- only outputted for VGO
     *
     * @var string|null
     */
    protected $rarity;

    /**
     * Category type e.g. Rifle -- only outputted for VGO
     *
     * @var string|null
     */
    protected $type;

    /**
     * Color hex
     *
     * @var string
     */
    protected $color;

    /**
     * Item's attributes
     *
     * @var object
     */
    protected $attributes;

    /**
     * Generic image URLs (300,600,900,1800,2500)px
     *
     * @var object
     */
    protected $images;

    /**
     * OPSkins 7-day suggested price (US cents)
     *
     * @var int
     */
    protected $suggested_price;

    /**
     * (Only for VGO) The minimum viable suggested price, does not change.
     *
     * @var int
     */
    protected $suggested_price_floor;

    /**
     * Field Inspection URLs for VGO items. Some of these properties may not be outputted if not available.
     *
     * @var object
     */
    protected $preview_urls;

    /**
     * Steam in-game inspection URL. Can be null.
     *
     * @var string|null
     */
    protected $inspect;

    /**
     * Etherscan.io Ethereum Transaction URL. null for inapplicable apps.
     *
     * @var string|null
     */
    protected $eth_inspect;

    /**
     * Pattern index (value between 1-1000) (only available for VGO, null for other apps)
     *
     * @var  int
     */
    protected $pattern_index;

    /**
     * Paint index value for a CS:GO item. 0 or null for items without a paint-index.
     *
     * @var int|null
     */
    protected $paint_index;

    /**
     * Wear Tier Index for a VGO item, not set for other apps.
     *
     * @var int
     */
    protected $wear_tier_index;

    /**
     * Unix timestamp of when this item was created
     * @var int
     */
    protected $time_created;

    /**
     * Unix timestamp of when this item was last updated
     * @var int
     */
    protected $time_updated;

    public function __construct($data)
    {
        $this->source = $data;

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}