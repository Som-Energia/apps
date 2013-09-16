<?php

namespace SomEnergia\MainBundle\Command;

use SomEnergia\MainBundle\Entity\CodigoPostal;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand; //replace use statement below if you don't need DIC
// use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPostalCodesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('somenergia:postalcodes:import')
            ->setDescription('Import postal codes form file')
            ->addArgument('file', InputArgument::REQUIRED, 'import file')
            ->addOption('force', null, InputOption::VALUE_NONE, 'If set, the task will save postal codes to database')
            ->setHelp(
                <<<EOT
                El comando <info>somenergia:postalcodes:import</info> importa un archivo CSV de socios a la base datos. El archivo tiene que estar delimitado por pipe (| ALT+1), con campos no encarrados y un salto de linea por cada registro. El formato de entrada de los campos debe ser: CP|poblacion
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Welcome to the Som Energia import posatl codes command.</info>');
        if ($input->getOption('force')) {
            $output->writeln('<comment>--force option enabled (this option persists changes to database)</comment>');
        }
        $file = $input->getArgument('file');
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $row = 0; $new = 0; $updated = 0; $noupdated = 0;
        $dtStart = new \DateTime();
        $output->writeln('Reading imput file ' . $file . ' at ' . date('h:m:s d/m/Y', $dtStart->getTimestamp()) . '...');
        if (($handle = fopen($file, "r")) !== false) {
            while (($line = fgets($handle)) !== false) {
                $data = explode("|", $line);
                $output->write($data[0] . ' | ' . $data[1]);
                $cp = new CodigoPostal();
                $cp->setCp($data[0]);
                $cp->setPoblacion(strtoupper($data[1]));
                /** @var CodigoPostal $cpDB */
                $cpDB = $em->getRepository('MainBundle:CodigoPostal')->findOneByCp($cp->getCp());
                if (!is_null($cpDB)) {
                    if ($cp->getPoblacion() == $cpDB->getPoblacion()) {
                        $output->writeln(' | <error>X record found and nothing updated</error>');
                        $noupdated++;
                    } else {
                        $output->writeln(' | <info>X record found and updated</info>');
                        $cp->setPoblacion($cpDB->getPoblacion());
                        $em->persist($cp);
                        if ($input->getOption('force')) {
                            $em->flush();
                        }
                        $updated++;
                    }
                } else {
                    $output->writeln(' | <info>√ new record added</info>');
                    $em->persist($cp);
                    if ($input->getOption('force')) {
                        $em->flush();
                    }
                    $new++;
                }
                $row++;
            }
            fclose($handle);
            $dtEnd = new \DateTime();
            $interval = $dtStart->diff($dtEnd);
            $output->writeln('Process finished at ' . date('h:m:s d/m/Y', $dtEnd->getTimestamp()));
            $output->writeln($new. ' new postal codes added');
            $output->writeln($updated. ' postal codes updated');
            $output->writeln($noupdated. ' postal codes NOT updated');
            $output->writeln('TOTAL: ' . $row . ' ITEMS');
            $output->writeln('ELLAPSED TIME: ' . $interval->format('%H:%S'));
        } else {
            $output->writeln('<error>ERROR! Unable to read input file</error>');
        }
    }
}