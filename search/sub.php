<?php

$var=$_POST['Column'];
$connection=odbc_connect('ClouderaODBC','','');
				$SQL_Exec_String="select distinct ".$var." from biological_species";
				$result=odbc_exec($connection, $SQL_Exec_String);
				while ( $Tables=odbc_fetch_array($result)) {
					echo "<option>".$Tables[$var]."</option>";
				}

?>
