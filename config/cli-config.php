<?php
/**
 * Helper file for database schema update
 * Use "vendor\bin\doctrine orm:schema-tool:update --force --dump-sql" to update db-schema
 * or "vendor\bin\doctrine orm:schema-tool:create" to create a new schema
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use KCMS\Config;

require __DIR__ . "/../bootstrap.php";

return ConsoleRunner::createHelperSet(\KCMS\Services\ServiceContext::getEntityManager());
