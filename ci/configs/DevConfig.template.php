<?php
namespace KCMS;

/**
 * Class Config
 * @package KCMS
 */
class Config
{
    /** Database configuration */
    const DB_USER   = 'root';
    const DB_PASS   = '';
    const DB_HOST   = 'localhost';
    const DB_PORT   = '3306';
    const DB_NAME   = 'kcmsdev';
    const DB_DRIVER = 'pdo_mysql'; // pdo_pgsql, pdo_mysql, pdo_mssql

    /** Developer options */
    const DEV_MODE = false; // false, true

    /** Unit test configuration */
    const UNIT_TEST_BASE_URL = 'http://localhost/';

    /** Logging */
    const LOG_PATH  = '/logs/log.log';
    const LOG_LEVEL = 'INFO'; // DEBUG, INFO, WARNING, ERROR
}
