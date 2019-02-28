<?php

namespace SofWar\Opskins\Resources;

use SofWar\Opskins\Actions\IItem;
use SofWar\Opskins\Enum\CurrencyType;
use SofWar\Opskins\Exceptions\OpskinsClientException;
use SofWar\Opskins\Resources\IItem\InstantSellRecentItems;

class Item extends BaseModel
{
    /**
     * Item ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Internal App ID.
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
     * Wear float value, only applicable for certain apps.
     *
     * @var bool
     */
    protected $wear;

    /**
     * Is item tradable? Items may be temporarily untradable during certain operations, e.g. transfers.
     *
     * @var bool
     */
    protected $tradable;

    /**
     * Trade hold expiration date. null if no trade hold.
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
     * Full market name.
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
     * Category rarity e.g. Covert -- only outputted for VGO.
     *
     * @var string|null
     */
    protected $rarity;

    /**
     * Category type e.g. Rifle -- only outputted for VGO.
     *
     * @var string|null
     */
    protected $type;

    /**
     * Color hex.
     *
     * @var string
     */
    protected $color;

    /**
     * Item's attributes.
     *
     * @var object
     */
    protected $attributes;

    /**
     * Generic image URLs (300,600,900,1800,2500)px.
     *
     * @var object
     */
    protected $images;

    /**
     * OPSkins 7-day suggested price (US cents).
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
     * Pattern index (value between 1-1000) (only available for VGO, null for other apps).
     *
     * @var int
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
     * Unix timestamp of when this item was created.
     *
     * @var int
     */
    protected $time_created;

    /**
     * Unix timestamp of when this item was last updated.
     *
     * @var int
     */
    protected $time_updated;

    /**
     * @var IItem|null
     */
    private $IItem;

    public function __construct($data, ?IItem $IItem = null)
    {
        $this->source = $data;
        $this->IItem = $IItem;

        foreach ($data as $key => $value) {
            if ($key === 'image') {
                $key = 'images';
            }

            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getInternalAppId(): int
    {
        return $this->internal_app_id;
    }

    public function getDefId(): int
    {
        return $this->def_id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getWear(): float
    {
        return $this->wear;
    }

    public function getTradable(): bool
    {
        return $this->tradable;
    }

    public function getTradeHoldExpires(): ?int
    {
        return $this->trade_hold_expires;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMarketName(): string
    {
        return $this->market_name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getRarity(): string
    {
        return $this->rarity;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function getSuggestedPrice(): int
    {
        return $this->suggested_price;
    }

    public function getSuggestedPriceFloor(): int
    {
        return $this->suggested_price_floor;
    }

    public function getPreviewUrls()
    {
        return $this->preview_urls;
    }

    public function getInspect(): ?string
    {
        return $this->inspect;
    }

    public function getEthInspect(): ?string
    {
        return $this->eth_inspect;
    }

    public function getPatternIndex(): int
    {
        return $this->pattern_index;
    }

    public function getPaintIndex(): ?int
    {
        return $this->paint_index;
    }

    public function getWearTierIndex(): int
    {
        return $this->wear_tier_index;
    }

    public function getTimeCreated(): int
    {
        return $this->time_created;
    }

    public function getTimeUpdated(): int
    {
        return $this->time_updated;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAmount(): float
    {
        return round($this->suggested_price / 100, 2);
    }

    /**
     * Instant Sell Recent Items
     *
     * @param int $currency_id
     * @param string|null $access_token
     * @return InstantSellRecentItems
     * @throws OpskinsClientException
     * @throws \SofWar\Opskins\Exceptions\OpskinsApiException
     */
    public function instantSell(int $currency_id = CurrencyType::USD, string $access_token = null): InstantSellRecentItems
    {
        if ($this->IItem === null) {
            throw new OpskinsClientException('IItem not initialized');
        }

        return $this->IItem->instantSellRecentItems($this->id, $currency_id, $access_token);
    }
}
