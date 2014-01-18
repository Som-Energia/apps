<?php
namespace SomEnergia\SocioBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use SomEnergia\SocioBundle\Entity\Socio;

class ImportSociosCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('somenergia:socios:import')
            ->setDefinition(array(
                new InputArgument('archivo', InputArgument::REQUIRED, 'archivo'),
            ))
            ->setDescription('Archivo CSV con socios')
            ->addOption('force', null, InputOption::VALUE_NONE, 'If set, the task will save changes to database')
            ->setHelp(
<<<EOT
El comando <info>somenergia:socios:import</info> importa un archivo CSV de socios a la base datos. El archivo tiene que estar delimitado por comas, con campos encarrados entre comillas dobles y un salto de linea por cada registro. El formato de entrada de los campos debe ser: id, active, name, ref, vat, street, zip, city, phone, mobile, email, language y fecha alta.
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('<info>Welcome to the Som Energia import socios command.</info>');
        if ($input->getOption('force')) {
            $output->writeln('<comment>--force option enabled (this option persists changes to database)</comment>');
        }
        $contenedor = $this->getContainer();
        $em = $contenedor->get('doctrine')->getManager();
        $row = 0; $new = 0; $wrong = 0; $updated = 0; $noupdated = 0; $errors = 0;
        $dtStart = new \DateTime();
        $output->writeln('Leyendo archivo de entrada ' . $input->getArgument('archivo') . ' a las ' . date('h:m:s d/m/Y', $dtStart->getTimestamp()) . '...');
        if (($handle = fopen($input->getArgument('archivo'), "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                if ($num == 13) {
                    $socio = new Socio();
                    $socio->setErpid($data[0]);
                    $socio->setActive(false);
                    if ($data[1] == 't' || strtolower($data[1]) == 'true' || $data[1] == '1') $socio->setActive(true);
                    $socio->setName($data[2]);
                    $socio->setRef($data[3]);
                    $socio->setVat($data[4]);
                    $socio->setStreet($data[5]);
                    $socio->setZip($data[6]);
                    $socio->setCity($data[7]);
                    $socio->setPhone($data[8]);
                    $socio->setMobile($data[9]);
                    $socio->setEmail($data[10]);
                    $socio->setLanguage($data[11]);
                    if (strlen($data[12] > 0)) $socio->setFechaAlta(\DateTime::createFromFormat('Y-m-d', $data[12]));
                    //$socio->setFechaBaja(\DateTime::createFromFormat('Y-m-d', $data[13]));
                    //$output->writeln($socio->toLongString());
                    $output->write('Importando socio ERPID:' . $socio->getErpid() . '... ');
                    $query = $em->createQuery('SELECT s FROM SocioBundle:Socio s WHERE s.erpid = :erpid');
                    $query->setParameter('erpid', $socio->getErpid());
                    //$query->setMaxResults('1');
                    /** @var Socio $socioBD */
                    $socioBD = $query->getOneOrNullResult();
                    if (!is_null($socioBD)) {
                        if ($socio->isEqual($socioBD)) {
                            $noupdated++;
                            $output->writeln('<comment>existe y NO hay cambios (NO procesa nada)</comment>');
                        } else {
                            $output->writeln('<info>existe y hay cambios (procesando su actualización)</info>');
                            $socioBD->setName($socio->getName());
                            $socioBD->setRef($socio->getRef());
                            $socioBD->setVat($socio->getVat());
                            $socioBD->setStreet($socio->getStreet());
                            $socioBD->setZip($socio->getZip());
                            $socioBD->setCity($socio->getCity());
                            $socioBD->setPhone($socio->getPhone());
                            $socioBD->setMobile($socio->getMobile());
                            $socioBD->setEmail($socio->getEmail());
                            $socioBD->setLanguage($socio->getLanguage());
                            $socioBD->setFechaAlta($socio->getFechaAlta());
                            //$socioBD->setFechaBaja($socio->getFechaBaja());
                            //$output->writeln($socio->toLongString());
                            //$output->writeln($socioBD->toLongString());
                            if ($input->getOption('force')) {
                                if (!$em->isOpen()) {
                                    $contenedor->set('doctrine.orm.entity_manager', null);
                                    $contenedor->set('doctrine.orm.default_entity_manager', null);
                                    $em = $contenedor->get('doctrine')->getManager();
                                }
                                try {
                                    $em->persist($socioBD);
                                    $em->flush()->clear();
                                    $updated++;
                                } catch (\Doctrine\DBAL\DBALException $e) {
                                    $errors++;
                                    $output->writeln('<error>ERROR: ' . $e->getMessage() . '</error>');
                                } catch (\Exception $e) {
                                    $errors++;
                                    $output->writeln('<error>ERROR: ' . $e->getMessage() . '</error>');
                                }
                            } else {
                                $updated++;
                            }
                        }
                    } else {
                        $output->writeln('<info>NO existe (creando registro de socio nuevo)</info>');
                        if ($input->getOption('force')) {
                            if (!$em->isOpen()) {
                                $contenedor->set('doctrine.orm.entity_manager', null);
                                $contenedor->set('doctrine.orm.default_entity_manager', null);
                                $em = $contenedor->get('doctrine')->getManager();
                            }
                            try {
                                $em->persist($socio);
                                $em->flush()->clear();
                                $new++;
                            } catch (\Doctrine\DBAL\DBALException $e) {
                                $errors++;
                                $output->writeln('<error>ERROR: ' . $e->getMessage() . '</error>');
                            } catch (\Exception $e) {
                                $errors++;
                                $output->writeln('<error>ERROR: ' . $e->getMessage() . '</error>');
                            }
                        } else {
                            $new++;
                        }
                    }
                } else {
                    $wrong++;
                    $output->writeln('<error>Registro de importacion incorrecto (NO procesa nada)</error>');
                }
                $row++;
            }
            fclose($handle);
            $dtEnd = new \DateTime();
            $interval = $dtStart->diff($dtEnd);
            $output->writeln('Proceso finalizado a las ' . date('h:m:s d/m/Y', $dtEnd->getTimestamp()));
            $output->writeln($new. ' socios nuevos registrados');
            $output->writeln($updated. ' socios actualizados');
            $output->writeln($noupdated. ' socios existentes NO actualizados');
            $output->writeln($wrong. ' items de importacion incorrectos');
            $output->writeln($errors. ' errores detectados');
            $output->writeln('TOTAL: ' . $row . ' ITEMS GESTIONADOS');
            $output->writeln('TIEMPO EMPLEADO: ' . $interval->format('%H:%S'));
        } else {
            $output->writeln('ERROR! Imposible leer archivo de entrada');
        }
    }
}