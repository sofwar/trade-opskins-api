<?php

namespace SofWar\Opskins\Resources;


class MetaData extends BaseModel
{
    /**
     * Limit of objects on the page
     *
     * @var int
     */
    //protected $limit;

    /**
     * Total pages
     *
     * @var int
     */
    protected $total;

    /**
     * Current page
     *
     * @var int
     */
    protected $current_page;

    public function __construct($data)
    {
        $this->source = $data;

        //$this->limit = $data['limit'] ?? 100;
        $this->total = $data['total'] ?? 1;
        $this->current_page = $data['current_page'] ?? 1;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getCurrentPage(): int
    {
        return $this->current_page;
    }
}