<?php //if (!defined('DATATABLES')) exit(); // Ensure being used in DataTables env.

// Enable error reporting for debugging (remove for production)
//error_reporting(E_ALL);
//ini_set('display_errors', '1');


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Database user / pass
 */
$sql_details = array(
	"type" => "Mysql",  // Database type: "Mysql", "Postgres", "Sqlite" or "Sqlserver"
	"user" => "chimeric_brain",       // Database user name
	"pass" => "Chimericbrain123!",       // Database password
	"host" => "chimeric.sg",       // Database host
//    "host" => "173.194.252.249",   // Database host
	"port" => "",       // Database connection port (can be left empty for default)
	"db"   => "chimeric_adstest",       // Database name
	"dsn"  => "charset-utf8"        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL
);


