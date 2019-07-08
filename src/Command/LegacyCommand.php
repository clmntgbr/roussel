<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LegacyCommand extends Command
{
    protected static $defaultName = 'roussel:legacy';

    protected function configure()
    {
        $this->setDescription('Add a short description for your command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->legacyAddress();

    }

    private function legacyAddress()
    {
        $content = file_get_contents('public/legacy_json/address.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf('INSERT INTO address (id, street, postal_code, country, created_at) VALUES ("%s", "%s", "%s", "%s", "2019-07-08 17:52:00");', $item['id'], $item['street'], $item['postal_code'], $item['country']);
            file_put_contents('public/legacy_sql/address.txt', $sql, FILE_APPEND);
        }
    }
}
