<?php

namespace SomEnergia\MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand; //replace use statement below if you don't need DIC
// use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
//use Flux\CustomerBundle\Entity\Invoice;

class ImportPostalCodesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('somenergia:postalcodes:import')
            ->setDescription('Import postal codes form file')
            //->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
            ->addOption('force', null, InputOption::VALUE_NONE, 'If set, the task will save postal codes to database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Welcome to the Som Energia import posatl codes command.</info>');
    }
}