<?php

namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class InitCommand extends Command
{
    protected static $defaultName = 'init';

    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Quickly initialize an existing Laravel application')
            ->addOption('lumen', null, InputOption::VALUE_NONE, 'Initialize a Lumen project')
            ->addOption('npm', null, InputOption::VALUE_NONE, 'Initialize a laravel project using npm');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<fg=red>Laravel initializator</>');

        // Reset PHP and Node.js dependencies
        echo shell_exec("rm -rf vendor");

        if ($input->getOption('npm')) {
            echo shell_exec("rm -rf node_modules");
        }

        // Reset default "Laravel" database
        if ($input->getOption('lumen')) {
            echo shell_exec("mysql -u root -Bse \"drop database homestead;create database homestead;\"");
        } else {
            echo shell_exec("mysql -u root -Bse \"drop database laravel;create database laravel;\"");
        }

        // Install dependencies
        echo shell_exec("composer install");

        if ($input->getOption('npm')) {
            echo shell_exec("npm install");
        }

        if ($input->getOption('lumen')) {
            # Update .env files values by creating my own .env file
            $envContent = "APP_NAME=Lumen\nAPP_ENV=local\nAPP_KEY=\nAPP_DEBUG=true\nAPP_URL=http://localhost\nAPP_TIMEZONE=UTC\n\nLOG_CHANNEL=stack\nLOG_SLACK_WEBHOOK_URL=\n\nDB_CONNECTION=mysql\nDB_HOST=127.0.0.1\nDB_PORT=3306\nDB_DATABASE=homestead\nDB_USERNAME=root\nDB_PASSWORD=\n\nCACHE_DRIVER=file\nQUEUE_CONNECTION=sync";
            echo shell_exec("echo \"{$envContent}\" > .env");
        } else {
            // Install Laravel
            echo shell_exec("cp .env.example .env");
            echo shell_exec("php artisan key:generate");

            // Clear Laravel caches
            echo shell_exec("php artisan route:clear");
            echo shell_exec("php artisan config:clear");
            echo shell_exec("php artisan cache:clear");
        }

        // Init datebase
        echo shell_exec("php artisan migrate");
        echo shell_exec("php artisan db:seed");

        $output->writeln("<comment>Done 👍</comment>");
        return Command::SUCCESS;
    }
}
