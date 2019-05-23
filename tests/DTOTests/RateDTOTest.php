<?php

namespace App\Tests\Util;

use App\DTO\RateDTO;
use App\Entity\Rate;
use PHPUnit\Framework\TestCase;

class RateDTOTest extends TestCase
{
    /**
     * method __construct
     * when called
     * should createProperDTO
     */
    public function test__construct_called_createProperDTO()
    {
        $entity = new Rate();
        $entity->setRate(1);
        $entity->setCurrency('XXX');

        $sut = new RateDTO($entity);

        $this->assertEquals('XXX', $sut->getCurrency());
        $this->assertEquals(1, $sut->getRate());
    }

    /**
     * method toArray
     * when called
     * should returnArray
     */
    public function test_toArray_called_returnArray()
    {
        $entity = new Rate();
        $entity->setRate(1);
        $entity->setCurrency('XXX');

        $sut = new RateDTO($entity);

        $array = $sut->toArray();

        $this->assertArrayHasKey('rate', $array);
        $this->assertArrayHasKey('currency', $array);
    }
}