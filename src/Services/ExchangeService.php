<?php

namespace App\Services;

use App\DTO\RateDTO;
use App\Entity\Rate;
use App\Repository\RateRepository;
use Doctrine\ORM\EntityManagerInterface;

class ExchangeService {

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function get($currency)
    {
        //TODO: move to repository
        $items = $this->em->getRepository(Rate::class)->findBy(
            ['currency' => $currency]
        );

        if($items) {
            return new RateDTO($items[0]);
        }
        else
        {
            return false;
        }
    }

    public function create($currency, $rate)
    {
        try {
            $entity = new Rate();

            $entity->setCurrency($currency);
            $entity->setRate($rate);

            $this->em->persist($entity);
            $this->em->flush();

            return true;
        }
        catch (\Exception $e){
            return false;
        }
    }

    public function update($currency, $rate)
    {

        //TODO: move to repository
        $items = $this->em->getRepository(Rate::class)->findBy(
            ['currency' => $currency]
        );

        //TODO: validate
        try {

            $items[0]->setRate($rate);

            //TODO: move to repository
            $this->em->persist($items[0]);
            $this->em->flush();
            return true;
        }
        catch(\Exception $e){
            return false;
        }

    }


}