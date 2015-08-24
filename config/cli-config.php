<?php
/*************************************************************************
 * Copyright (C) 2015 kairet                                             *
 *                                                                       *
 * This program is free software: you can redistribute it and/or modify  *
 * it under the terms of the GNU General Public License as published by  *
 * the Free Software Foundation, either version 3 of the License, or     *
 * (at your option) any later version.                                   *
 *                                                                       *
 * This program is distributed in the hope that it will be useful,       *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 * GNU General Public License for more details.                          *
 *                                                                       *
 * You should have received a copy of the GNU General Public License     *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. *
 *************************************************************************/

/**
 * Helper file for database schema update
 * Use "vendor\bin\doctrine orm:schema-tool:update --force --dump-sql" to update db-schema
 * or "vendor\bin\doctrine orm:schema-tool:create" to create a new schema
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use KCMS\Config;

require __DIR__ . "/../bootstrap.php";

return ConsoleRunner::createHelperSet(\KCMS\Services\ServiceContext::getEntityManager());
