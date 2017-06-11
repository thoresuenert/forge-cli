<?php

namespace Sven\ForgeCLI\Commands\Recipes;

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
        $this->setName('update:recipe')
            ->addArgument('recipe', InputArgument::REQUIRED, 'The id of the recipe to update.')
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'The new name of the recipe.')
            ->addOption('user', null, InputOption::VALUE_REQUIRED, 'The new user to run the recipe as.')
            ->addOption('script', null, InputOption::VALUE_REQUIRED, 'The new contents of the recipe.')
            ->setDescription('Update the given recipe.');
    }

    /**
     * {@inheritdoc}
     */
    public function perform(InputInterface $input, OutputInterface $output)
    {
        $payload = $this->fillData($input->getOptions());

        $payload['script'] = $this->getFileContent($input, 'script');

        $this->forge->updateRecipe(
            $input->getArgument('recipe'), $payload
        );
    }
}
