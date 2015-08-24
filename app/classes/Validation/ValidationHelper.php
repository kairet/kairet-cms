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

namespace KCMS\Validation;

use KCMS\Services\ServiceContext;

/**
 * Service class for validation
 * @package KCMS\Validation
 */
class ValidationHelper
{
    /**
     * @param $object
     * @throws ValidationException
     */
    public static function validate($object)
    {
        $errors = ServiceContext::getValidator()->validate($object);
        if (count($errors) > 0) {
            $errorMsg = 'Validation failed:' . PHP_EOL;
            foreach ($errors as $error) {
                $errorMsg .= $error . PHP_EOL;
            }

            throw new ValidationException('Validation failed:' . PHP_EOL . $errorMsg);
        }
    }
}
