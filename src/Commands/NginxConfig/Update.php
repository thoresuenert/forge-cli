<?php

namespace Sven\ForgeCLI\Commands\NginxConfig;

use Sven\ForgeCLI\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Update extends BaseCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('update:nginx-config')
             ->addArgument('server', InputArgument::REQUIRED, 'The id of the server the site is on.')
             ->addArgument('site', InputArgument::REQUIRED, 'The id of the site you want to update the nginx config of.')
             ->addOption('file', null, InputOption::VALUE_REQUIRED, 'The path to your new nginx config file.')
             ->setDescription('Update the nginx config script of the given site.');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->forge->updateSiteNginxFile(
            $input->getArgument('server'), $input->getArgument('site'), $this->getFileContent($input, 'file')
        );
    }
}
