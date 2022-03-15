<?php
$conexion = mysql_connect('127.0.0.1', 'root', '');
mysql_select_db('dbsacramentos', $conexion);

function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
}
?>