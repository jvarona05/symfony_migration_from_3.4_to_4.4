<?php

namespace CarBundle\Tests\Controller;

use CarBundle\Service\DataChecker;

class DataCheckerTest extends \PHPUnit_Framework_TestCase
{
    protected $em;

    public function setUp()
    {
        $this->em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
                        ->disableOriginalConstructor()->getMock();
    }

    public function testCheckCarWithRequiredPhotosWillReturnFalse()
    {
        $subject = new DataChecker($this->em, true);
        $expectedResult = false;
        $car = $this->getMockBuilder('CarBundle\Entity\Car')->getMock();
        
        //esto verifica que el metodo setPromoted solo se llame una vez
        $car->expects($this->once())
            ->method('setPromoted')
            ->with($expectedResult);

        $result = $subject->checkCar($car);
        $this->assertEquals($expectedResult, $result);
    }
}