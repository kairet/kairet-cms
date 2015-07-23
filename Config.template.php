<?php
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
