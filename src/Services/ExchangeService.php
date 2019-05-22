<?php

namespace App\Services;

use App\Entity\Rate;
use App\Repository\RateRepository;
use Doctrine\ORM\EntityManagerInterface;

class ExchangeService {

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function get($currency){

        $items = $this->em->getRepository(Rate::class)->findBy(
            ['currency' => $currency]
        );

        if($items) {
            return [
                'rate' => $items[0]->getRate(), //TODO: use dto
            ];
        }
        else
        {
            return false;
        }
    }

    public function update($currency, $rate){

        //TODO: Update the storage

        $items = $this->em->getRepository(Rate::class)->findBy(
            ['currency' => $currency]
        );

        //TODO: validate
        try {
            $items[0]->setRate($rate);

            $this->em->persist($items[0]);
            $this->em->flush();
            return true;
        }
        catch(\Exception $e){
            return false;
        }

    }


}