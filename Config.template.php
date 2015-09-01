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

    /** Unit test configuration */
    const UNIT_TEST_BASE_URL = "http://localhost/";

    /** Logging */
    const LOG_PATH   = '/logs/log.log';
    const LOG_LEVEL  = 'INFO'; // DEBUG, INFO, WARNING, ERROR
}
