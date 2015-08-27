<?php
namespace KCMS;

/**
 * Class Config
 * @package KCMS
 */
class Config
{
    /** Database configuration */
    const DB_USER   = "root";
    const DB_PASS   = "";
    const DB_HOST   = "localhost";
    const DB_PORT   = "3306";
    const DB_NAME   = "kcms-dev";
    const DB_DRIVER = "pdo_mysql"; // pdo_pgsql, pdo_mysql, pdo_mssql

    /** Developer options */
    const DEV_MODE = true; // false, true
}
