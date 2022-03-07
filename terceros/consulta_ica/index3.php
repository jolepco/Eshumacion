<?php
echo "hola";
echo $_SERVER['HTTP_HOST'];

if (!empty($_SERVER['HTTP_HOST'])) {
    if ($_SERVER['HTTP_HOST'] == 'tramitesenlinea.saludcapital.gov.co') {
           echo "prod";
        }
   else {
		if ($_SERVER['HTTP_HOST'] == '172.16.0.97'){		
			echo "test";
		}
		else if ($_SERVER['SERVER_NAME'] == 'localhost') {
			echo "dev";
		}
	}
} else {	
   echo "test";

}

?>