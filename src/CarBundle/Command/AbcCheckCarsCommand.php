<?php

namespace CarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use CarBundle\Entity\Car;
use Symfony\Component\Console\Helper\ProgressBar;

class AbcCheckCarsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('abc:check-cars')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $dataChecker = $this->getContainer()->get('car.data_checker');
        $carRepository = $manager->getRepository(Car::class);
        $cars = $carRepository->findAll();

        $bar = new ProgressBar($output, count($cars));
        $bar->start();

        foreach($cars as $car) {
            $dataChecker->checkCar($car);
            sleep(1);
            $bar->advance();
        }
        $bar->finish();
    }

}
