<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
/*
* Excel library for Code Igniter applications
* Author: Derek Allard
*/
 
function to_excel($sql, $filename='exceloutput')
{
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below
 
     $obj =& get_instance(); 
     $query = $sql["query"]; 
     //$fields = $sql["fields"];
	
	if ($query->num_rows() == 0) {
			print '<script language="JavaScript">'; 
			print 'alert("No hay datos");'; 
			print '</script>'; 
			redirect(base_url().'consulta/dashboard','refresh');
     } else {
         /* foreach ($fields as $field) {
             $headers .= strtoupper ($field->name) . "\t";
          }*/
		  		  
		  $headers .="\nVIGENCIA\tNIT/CEDULA\tNOMBRE\tCTO_CONVENIO\tESTADO\tFECHA_GIRO\tPLANILLA\tORDEN_PAGO\tBRUTO\tVALOR_GIRADO\tDETALLE\tNOMBRE_BANCO";
		  $headers .="\tCUENTA_BANCO_RECEPTOR";          
 
          foreach ($query->result() as $row) {
               $line = '';
               foreach($row as $value) {                                            
                    if ((!isset($value)) OR ($value == "")) {
                         $value = "\t";
                    } else {
                         $value = str_replace('"', '""', $value);
                         $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
               }
               $data .= trim($line)."\n";
          }
 
			$data = str_replace("\r","",$data);
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$filename.".xls");
			echo mb_convert_encoding("$headers\n$data",'utf-16','utf-8');
     }
}
?>		