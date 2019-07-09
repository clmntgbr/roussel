<?php

namespace App\Command;

use App\Util\File;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class LegacyCommand extends Command
{
    protected static $defaultName = 'roussel:legacy';

    /** @var File */
    private $file;

    /* @var EntityManagerInterface */
    private $em;

    public function __construct(File $file, EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
        $this->file = $file;
        $this->em = $em;
    }

    protected function configure()
    {
        $this->setDescription('Add a short description for your command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('doctrine:database:drop');
        $arguments = ['command' => 'doctrine:database:drop', '--force' => true, '--if-exists' => true];
        $input = new ArrayInput($arguments);
        $command->run($input, $output);

        $command = $this->getApplication()->find('doctrine:database:create');
        $arguments = ['command' => 'doctrine:database:create', '--if-not-exists' => true];
        $input = new ArrayInput($arguments);
        $command->run($input, $output);

        $command = $this->getApplication()->find('doctrine:migration:migrate');
        $arguments = ['command' => 'doctrine:migration:migrate', '--no-interaction' => true];
        $input = new ArrayInput($arguments);
        $command->run($input, $output);

        $this->legacyUser();
        $this->legacyAddress();
        $this->legacyContact();
        $this->legacySpecialty();
        $this->legacyImplantation();
        $this->legacyExecutive();
        $this->legacyNote();
        $this->legacyOperation();
        $this->legacySociety();
        $this->legacyTarget();
        $this->legacyPositioning();
        $this->legacyFoundsUnderManagement();
        $this->legacyPreview();
        $this->legacyInvestment();
        $this->legacyInvestmentNotes();
        $this->legacySocietyExecutive();
        $this->legacySocietyImplantation();
        $this->legacySocietyNotes();
        $this->legacySocietyOperation();
        $this->legacySocietySpecialty();

        $files = scandir('public/legacy_sql/');
        unset($files[0], $files[1]);

        foreach ($files as $file) {
            $finder = new Finder();
            $finder->in('public/legacy_sql/');
            $finder->name($file);

            foreach( $finder as $ite ){
                try {
                    $content = $ite->getContents();
                    $sql = $this->em->getConnection()->prepare($content);
                    $sql->execute();
                    $this->file->delete('public/legacy_sql/' . $file);
                } catch (\Exception $exception) {
                    dump($exception->getMessage());
                    dump($file);
                    die;
                }
            }
        }
    }

    private function legacyUser()
    {
        $content = file_get_contents('public/user.sql');
        file_put_contents('public/legacy_sql/00-user.txt', $content, FILE_APPEND);
    }

    private function legacyAddress()
    {
        $this->file->delete('public/legacy_sql/01-address.txt');

        $content = file_get_contents('public/legacy_json/address.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf('INSERT INTO address (id, street, postal_code, country, created_at, created_by) VALUES ("%s", "%s", "%s", "%s", "2019-07-08 00:00:00", 1);', $item['id'], $item['street'], $item['postal_code'], $item['country']);
            file_put_contents('public/legacy_sql/01-address.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyContact()
    {
        $this->file->delete('public/legacy_sql/02-contact.txt');

        $content = file_get_contents('public/legacy_json/contact.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO person (id, name, position, phone_number, contact_email, created_at, created_by) VALUES ("%s", "%s", "%s", "%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], $item['name'], $item['job'], $item['phone'], $item['mail']);
            file_put_contents('public/legacy_sql/02-contact.txt', $sql, FILE_APPEND);
        }
    }

    private function legacySpecialty()
    {
        $this->file->delete('public/legacy_sql/03-specialty.txt');

        $content = file_get_contents('public/legacy_json/specialty.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO specialty (id, name, created_at, created_by) VALUES ("%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], $item['name']);
            file_put_contents('public/legacy_sql/03-specialty.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyImplantation()
    {
        $this->file->delete('public/legacy_sql/04-implantation.txt');

        $content = file_get_contents('public/legacy_json/implantation.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO implantation (id, name, created_at, created_by) VALUES ("%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], $item['name']);
            file_put_contents('public/legacy_sql/04-implantation.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyExecutive()
    {
        $this->file->delete('public/legacy_sql/05-executive.txt');

        $content = file_get_contents('public/legacy_json/executive.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $birthDate = 'NULL';
            if((int)$item['birth_date'] > 0) {
                $birthDate = "'" . (int)$item['birth_date'] . "-01-01 00:00:00'";
            }
            $sql = sprintf(
                'INSERT INTO person (id, name, position, phone_number, contact_email, birthday, created_at, created_by) VALUES ("%s", "%s", "%s", "%s", "%s", %s, "2019-07-08 00:00:00", 1);',
                (int)$item['id'] + 10000, $item['name'], $item['function'], $item['phone'], $item['email'], $birthDate);
            file_put_contents('public/legacy_sql/06-executive.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyNote()
    {
        $this->file->delete('public/legacy_sql/07-notes.txt');

        $content = file_get_contents('public/legacy_json/notes.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO note (id, name, created_at, created_by) VALUES ("%s", "%s", "%s", 1);',
                $item['id'], sprintf('%s - %s', $item['title'], $item['content']), $item['created_at']);
            file_put_contents('public/legacy_sql/07-notes.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyOperation()
    {
        $this->file->delete('public/legacy_sql/08-operation.txt');

        $content = file_get_contents('public/legacy_json/operation.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO operation (id, name, created_at, created_by) VALUES ("%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], $item['name']);
            file_put_contents('public/legacy_sql/08-operation.txt', $sql, FILE_APPEND);
        }
    }

    private function legacySociety()
    {
        $this->file->delete('public/legacy_sql/09-society.txt');

        $content = file_get_contents('public/legacy_json/society.json');
        $json = json_decode($content, true);

        $identities = $this->identity();

        foreach ($json as $item) {
            $turnoverDate = 'NULL';
            if($item['date_ca'] !== null) {
                $turnoverDate = "'"  . $item['date_ca'] . " 00:00:00'";
            }

            $updatedAt = 'NULL';
            if($item['updated_at'] !== null) {
                $updatedAt = "'" . $item['updated_at'] . "'";
            }

            $creationDate = 'NULL';
            if((int)$identities[$item['identity_id']]['creation_date'] > 0) {
                $creationDate = "'" . (int)$identities[$item['identity_id']]['creation_date'] . "-01-01 00:00:00'";
            }

            $sql = sprintf(
                'INSERT INTO society (id, address_id, name, investment_fund, parent_company, holding, age, sector, activity, turnover, gross_operating_surplus, profit_before_interest_and_taxes, treasury, financial_debt, siren, contact_email, created_at, updated_at, date_turnover, phone_number, website, date_creation, created_by) VALUES ("%s", %s, "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", %s, %s, "%s", "%s", %s, 1);',
                $item['id'], $item['place_id'] !== null ? "'" . $item['place_id'] . "'": 'NULL', $item['name'], $item['investment_funds'], $item['parent_company'], $item['holding'], $item['age'], $item['sector'], $item['activity'], $item['ca'], $item['ebe'], $item['ebit'], $item['treasury'], $item['financial_debt'], $item['siren'], $identities[$item['identity_id']]['mail'], $item['created_at'], $updatedAt, $turnoverDate, $identities[$item['identity_id']]['phone'], $identities[$item['identity_id']]['website'], $creationDate);
            file_put_contents('public/legacy_sql/09-society.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyTarget()
    {
        $this->file->delete('public/legacy_sql/10-target.txt');

        $content = file_get_contents('public/legacy_json/target.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO target (id, geography, ve, investment_ticket, investment_sector, created_at, created_by) VALUES ("%s", "%s", "%s", "%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], $item['geography'], $item['ve'], str_replace("\"", "'", $item['investment_ticket']), str_replace("\"", "'", $item['investment_sector']));
            file_put_contents('public/legacy_sql/10-target.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyPositioning()
    {
        $this->file->delete('public/legacy_sql/11-positioning.txt');

        $content = file_get_contents('public/legacy_json/positioning.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO positioning (id, operation_type, approach, created_at, created_by) VALUES ("%s", "%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], str_replace("\"", "'", $item['operation_type']), str_replace("\"", "'", $item['approach']));
            file_put_contents('public/legacy_sql/11-positioning.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyFoundsUnderManagement()
    {
        $this->file->delete('public/legacy_sql/12-founds_under_management.txt');

        $content = file_get_contents('public/legacy_json/founds_under_management.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO funds_under_management (id, capital_structure, managed_capital, created_at, created_by) VALUES ("%s", "%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], str_replace("\"", "'", $item['capital_structure']), str_replace("\"", "'", $item['managed_capital']));
            file_put_contents('public/legacy_sql/12-founds_under_management.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyPreview()
    {
        $this->file->delete('public/legacy_sql/13-preview.txt');

        $content = file_get_contents('public/legacy_json/preview.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO media (id, name, type, path, created_at, created_by) VALUES ("%s", "%s", "%s", "%s", "2019-07-08 00:00:00", 1);',
                $item['id'], $item['filename'], $item['directory'], sprintf('public/images/%s/', $item['directory']));
            file_put_contents('public/legacy_sql/13-preview.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyInvestment()
    {
        $this->file->delete('public/legacy_sql/14-investment.txt');

        $content = file_get_contents('public/legacy_json/investment.json');
        $json = json_decode($content, true);

        $identities = $this->identity();

        foreach ($json as $item) {
            $creationDate = 'NULL';
            if((int)$identities[$item['identity_id']]['creation_date'] > 0) {
                $creationDate = "'" . (int)$identities[$item['identity_id']]['creation_date'] . "-01-01 00:00:00'";
            }
            $sql = sprintf(
                'INSERT INTO investment_fund (id, name, phone_number, contact_email, website, date_creation, address_id, positioning_id, target_id, funds_under_management_id, created_at, created_by) VALUES ("%s", "%s", "%s", "%s", "%s", %s, %s, %s, %s, %s, "2019-07-08 00:00:00", 1);',
                $item['id'],
                $item['name'],
                $identities[$item['identity_id']]['phone'],
                $identities[$item['identity_id']]['mail'],
                $identities[$item['identity_id']]['website'],
                $creationDate,
                $item['place_id'] !== null ? "'" . $item['place_id'] . "'": 'NULL',
                $item['positioning_id'] !== null ? "'" . $item['positioning_id'] . "'": 'NULL',
                $item['target_id'] !== null ? "'" . $item['target_id'] . "'": 'NULL',
                $item['founds_under_management_id'] !== null ? "'" . $item['founds_under_management_id'] . "'": 'NULL'
            );
            file_put_contents('public/legacy_sql/14-investment.txt', $sql, FILE_APPEND);
        }
    }

    private function legacyInvestmentNotes()
    {
        $this->file->delete('public/legacy_sql/15-investment_notes.txt');

        $content = file_get_contents('public/legacy_json/investment_notes.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO investment_fund_note (investment_fund_id, note_id) VALUES ("%s", "%s");',
                $item['investment_id'],
                $item['notes_id']
            );
            file_put_contents('public/legacy_sql/15-investment_notes.txt', $sql, FILE_APPEND);
        }
    }

    private function legacySocietyExecutive()
    {
        $this->file->delete('public/legacy_sql/16-society_executive.txt');

        $content = file_get_contents('public/legacy_json/society_executive.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO society_leader (society_id, person_id) VALUES ("%s", "%s");',
                $item['society_id'],
                (int)$item['executive_id'] + 10000
            );
            file_put_contents('public/legacy_sql/16-society_executive.txt', $sql, FILE_APPEND);
        }
    }

    private function legacySocietyImplantation()
    {
        $this->file->delete('public/legacy_sql/17-society_implantation.txt');

        $content = file_get_contents('public/legacy_json/society_implantation.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO society_implantation (society_id, implantation_id) VALUES ("%s", "%s");',
                $item['society_id'],
                $item['implantation_id']
            );
            file_put_contents('public/legacy_sql/17-society_implantation.txt', $sql, FILE_APPEND);
        }
    }

    private function legacySocietyNotes()
    {
        $this->file->delete('public/legacy_sql/18-society_notes.txt');

        $content = file_get_contents('public/legacy_json/society_notes.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO society_note (society_id, note_id) VALUES ("%s", "%s");',
                $item['society_id'],
                $item['notes_id']
            );
            file_put_contents('public/legacy_sql/18-society_notes.txt', $sql, FILE_APPEND);
        }
    }

    private function legacySocietyOperation()
    {
        $this->file->delete('public/legacy_sql/19-society_operation.txt');

        $content = file_get_contents('public/legacy_json/society_operation.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO society_operation (society_id, operation_id) VALUES ("%s", "%s");',
                $item['society_id'],
                $item['operation_id']
            );
            file_put_contents('public/legacy_sql/19-society_operation.txt', $sql, FILE_APPEND);
        }
    }

    private function legacySocietySpecialty()
    {
        $this->file->delete('public/legacy_sql/20-society_specialty.txt');

        $content = file_get_contents('public/legacy_json/society_specialty.json');
        $json = json_decode($content, true);

        foreach ($json as $item) {
            $sql = sprintf(
                'INSERT INTO society_specialty (society_id, specialty_id) VALUES ("%s", "%s");',
                $item['society_id'],
                $item['specialty_id']
            );
            file_put_contents('public/legacy_sql/20-society_specialty.txt', $sql, FILE_APPEND);
        }
    }

    private function identity()
    {
        $content = file_get_contents('public/legacy_json/identity.json');
        $json = json_decode($content, true);

        $identities = [];
        foreach ($json as $item) {
            $identities[$item['id']] = $item;
        }
        return $identities;
    }
}
