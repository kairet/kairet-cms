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

use Doctrine\Common\Annotations\AnnotationRegistry;

function includeIfExists($file)
{
    if (file_exists($file)) {
        return include $file;
    }
    return null;
}

if (!$loader = includeIfExists(__DIR__ . "/../vendor/autoload.php")) {
    die("Composer is not setup correctly");
}
$loader->add("Tests", __DIR__);

// This is necessary as validation using annotations conflicts with doctrine-orm annotations otherwise...
AnnotationRegistry::registerLoader(function ($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(
    __DIR__ . '/../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
);

return $loader;
