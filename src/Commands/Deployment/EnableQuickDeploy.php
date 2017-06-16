<?php

namespace Sven\ForgeCLI\Commands\Deployment;

use Sven\ForgeCLI\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnableQuickDeploy extends BaseCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('enable:quickdeploy')
            ->addArgument('server', InputArgument::REQUIRED, 'The id of the server the site is on.')
            ->addArgument('site', InputArgument::REQUIRED, 'The id of the site to enable quick deployment for.')
            ->setDescription('Enable quick deployment on the given site.');
    }

    /**
     * {@inheritdoc}
     */
    public function perform(InputInterface $input, OutputInterface $output)
    {
        $this->forge->enableQuickDeploy(
            $input->getArgument('server'), $input->getArgument('site')
        );
    }
}
