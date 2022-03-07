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
			redirect(base_url(),'refresh');
     } else {
         /* foreach ($fields as $field) {
             $headers .= strtoupper ($field->name) . "\t";
          }*/
		  		  
		  $headers .= "\n* Sin firma Autógrafa según Artículo 7 del Decreto 380 de 1996 y artículo 10 del Decreto 836 de 1991";
            $headers .="\nAÑO_GRAVABLE\tTIPO_IDENTIFICACION\tNUM_IDENTIFICACION\tNOMBRE/RAZON_SOCIAL\tBASE_GRAVABLE_NETA\tTOTAL_INGRESOS_BRUTOS_OBTENIDOS_EN_EL_DISTRITO_CAPITAL_(BA)\tDEDUCCIONES,_EXENCIONES_Y_ACTIVIDADES_NO_SUJETAS_(BD)\tVALOR_RETENIDO_A_TITULO_DE_INDUSTRIA_Y_COMERCIO";     

 
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