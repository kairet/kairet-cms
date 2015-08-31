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

namespace KCMS\Converter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConverterAdapter
 * @package KCMS\Converter
 */
class ConverterAdapter extends AbstractConverter
{
    /**
     * @param $id
     * @return object
     */
    public function convertFromId($id)
    {
        return null;
    }

    /**
     * @param         $null
     * @param Request $request
     * @return object
     */
    public function convertFromRequestBody($null, Request $request)
    {
        return null;
    }
}
