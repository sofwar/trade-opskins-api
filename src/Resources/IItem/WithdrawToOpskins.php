<?php

namespace SofWar\Opskins\Resources\IItem;


use SofWar\Opskins\Resources\BaseModel;

class WithdrawToOpskins extends BaseModel
{
    /**
     * @var array
     */
    protected $sales = [];

    /**
     * @var array
     */
    protected $output_items = [];

    public function __construct(array $data)
    {
        $this->source = $data;

        $this->sales = $data['results']['response']['sales'] ?? [];

        foreach ($data['output']['items'] ?? [] as $item) {
            foreach ($this->sales as $sale) {
                if ($item['item_id'] === $sale['original_item_id']) {
                    $item['original_sale_id'] = $sale['id'];
                    break;
                }
            }

            $this->output_items[] = $item;
        }
    }

    public function getSales(): array
    {
        return $this->sales;
    }

    public function getOutput(): array
    {
        return $this->output_items;
    }
}