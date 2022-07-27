<?php

	DEFINE( 'HOST', 'localhost' );
	
	DEFINE( 'USER', 'root' );
	
	DEFINE( 'PASSWORD', '' );
	
	DEFINE( 'DATABASE', 'pi-db' );

	TRY {

		$connect = new mysqli( HOST, USER, PASSWORD, DATABASE );

	} CATCH( Exception $e ) {

		echo 'Connection Failed!';

		exit();

	} FINALLY {

		return true;

	}

?>