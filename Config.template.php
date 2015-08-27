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

namespace KCMS;

/**
 * Class Config
 * @package KCMS
 */
class Config
{
    /** Database configuration */
    const DB_USER   = "";
    const DB_PASS   = "";
    const DB_HOST   = "";
    const DB_PORT   = "";
    const DB_NAME   = "";
    const DB_DRIVER = ""; // pdo_pgsql, pdo_mysql, pdo_mssql

    /** Developer options */
    const DEV_MODE = false; // false, true
}
