<?php
require_once('../config.php');
// DB table to use
$table = 'domains_data';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'id', 'dt' => 0 ),
	array( 'db' => 'domain',  'dt' => 1 ),
	array( 'db' => 'last_date',   'dt' => 2 ),
	array( 'db' => 'estimated_worth',   'dt' => 3 )
);

$columns2 = array(
	array( 'db' => 'id', 'dt' => 0 ),
	array( 'db' => 'domain',  'dt' => 1 ),
	array( 'db' => 'last_date',   'dt' => 2 ),
	array( 'db' => 'estimated_worth',   'dt' => 3 ),
	array( 'db' => 'details',  'dt' => 4 ),
	array( 'db' => 'delete',   'dt' => 5)
);


// SQL server connection information
$sql_details = array(
	'user' => $mysql_user,
	'pass' => $mysql_pass,
	'db'   => $mysql_database,
	'host' => $mysql_host
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.domains.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $columns2 )
);
?>