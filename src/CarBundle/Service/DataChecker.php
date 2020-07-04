<?php

namespace CarBundle\Service;

use CarBundle\Entity\Car;
use Doctrine\ORM\EntityManager;

class DataChecker
{
    protected $requireImagesToPromoteCar;

    protected $em;

    public function __construct(EntityManager $entiryManager, $requireImagesToPromoteCar)
    {
        $this->em = $entiryManager;
        $this->requireImagesToPromoteCar = $requireImagesToPromoteCar;
    }

    public function checkCar(Car $car)
    {
        $promote = $this->requireImagesToPromoteCar ? false : true;

        $car->setPromoted($promote);

        $this->em->persist($car);

        $this->em->flush();

        return $promote;
    }
}