<?php

namespace App\DTO;

use App\Entity\Rate;

class RateDTO implements IDTO
{
    private $entity;

    protected $currency;
    protected $rate;

    public function __construct(Rate $rate)
    {
        $this->entity = $rate;
        $this->exchange();
    }

    public function exchange()
    {
        $this->currency = $this->entity->getCurrency();
        $this->rate = $this->entity->getRate();
    }

    public function toArray()
    {
        return [
            'currency' => $this->currency,
            'rate' => $this->rate,
        ];
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }
}