<html>
<head>
  <title>PDF Pago</title>
  <meta charset="utf-8">
  <style type="text/css">

    body {
		background-color: #fff;
		font-family: Lucida Grande, Verdana, Sans-serif;
		font-size: 10px;
		color: #4F5155;
	}

	table {
		border: 1px solid #fff;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 16px;
		font-weight: bold;
		margin: 24px 0 2px 0;
		padding: 5px 0 6px 0;
	}
	
	h4 {
		color: #444;
		font-size: 12px;
		font-weight: bold;
	}

	.encabezados {
		color: #000000;
		border-bottom: 1px solid #D0D0D0;
		font-size: 16px;
		margin: 24px 0 2px 0;
		padding: 5px 0 6px 0;
	}

	h2 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 14px;
		font-weight: bold;
		margin: 5px 0 2px 0;
		padding: 5px 0 6px 0;
	}

	code {
		font-family: Monaco, Verdana, Sans-serif;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	.centro {
		text-align: center;
	}
	
	.justificado {
		text-align: justify;
	}

	.derecha {
		text-align: right;
	}

	.total {
		font-family: Monaco, Verdana, Sans-serif;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #000000;
		border-bottom: 1px solid #000000;
		border-top: 1px solid #000000;
		color: #002166;
	}

	.marca-de-agua {
		padding: 0;
		width: 100%;
		height: auto;
		opacity: 0.7;
		font-family: Monaco, Verdana, Sans-serif;
		font-size: 25px;
	}

	.contenido{
		margin-top: 60px;
		margin-bottom: 55px;
	} 

	.cursiva{
		font-style: italic;
	}	

	.continuacion{
		font-style: italic;
		font-size: 9px;
	}

	.elaboro{
		font-style: italic;
		font-size: 9px;
	}

    /*th,td,tr {
        border:1px solid black;
        border-collapse:collapse;
    }*/

    .conborde{
        border:1px solid black;
        border-collapse:collapse;
    }    

    .mt-5{
        margin-top: 2px;
    }

    .titulocampo {		
		background-color: #bec2c2;
	}

  </style>
</head>
<body>

    <?php
        setlocale(LC_MONETARY, 'es_CO');
        $imagenHeader = FCPATH."assets/imgs/logo_pdf_alcaldia.png";
    ?>
    <htmlpageheader name="firstpage" style="display:none">
       
    </htmlpageheader>




    <sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
    <sethtmlpageheader name="otherpages" value="on" />

    <div id="header">

    </div>
    <div style="width:100%;">
        <table width="100%" class="conborde">
            <tr>
                <td>                    
                    <img src='<?php echo $imagenHeader?>' width='100px'>
                </td>
                <td colspan="6" class="centro">
                    <h2>
                        FONDO FINANCIERO DISTRITAL DE SALUD
                    </h2>
                    <table width="100%">
                        <tr>
                            <td class="izquierda">
                                Vig Ppto: <?php echo $pago[0]->VIGENCIA?>
                            </td>
                            <td>
                                <h1>ORDEN DE PAGO</h1>
                            </td>
                            <td>
                                No: <?php echo $pago[0]->CONSECUTIVO?>
                            </td>
                            <td class="derecha">
                                <p>Usuario Dilig:</p>
                                <p>Fecha de Impresión:</p>
                                <p>Estado:</p>
                            </td>
                            <td class="derecha">
                                <p><?php echo $pago[0]->USUARIO_ELABORO?></p>
                                <p><?php echo date('d/m/Y')?></p>
                                <p><?php echo $pago[0]->ESTADO?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="conborde">
                <td class="conborde titulocampo">Entidad:</td>
                <td colspan="6" class="conborde">FONDO FINANCIERO DISTRITAL DE SALUD</td>
            </tr>
            <tr class="centro">
                <td class="conborde titulocampo">Código:</td>
                <td class="conborde"><?php echo $pago[0]->ENTIDAD?></td>
                <td class="conborde titulocampo">Unidad Eje:</td>
                <td class="conborde"><?php echo $pago[0]->UNIDAD_EJECUTORA?></td>
                <td class="conborde titulocampo">Fecha Diligenciamiento:</td>
                <td class="conborde"><?php echo $pago[0]->FECHA_DILIGENCIAMIENTO?></td>
            </tr>
            <tr class="centro conborde">
                <td class="centro titulocampo" colspan="6">
                    <p>1. DATOS DEL BENEFICIARIO</p>
                </td>
            </tr>
            <tr class="centro">
                <td class="centro conborde titulocampo">Nombre:</td>
                <td class="centro conborde"><?php echo $pago[0]->NOMBRE?></td>
                <td class="centro conborde titulocampo">Regimen:</td>
                <td class="centro conborde"><?php echo $pago[0]->REGIMEN; ?></td>
            </tr>                
            <tr>
                <td class="centro conborde titulocampo">Dirección:</td>
                <td class="centro conborde"><?php echo $pago[0]->DIR?></td>
                <td class="centro conborde titulocampo">Teléfono y Fax:</td>
                <td class="centro conborde"><?php echo $pago[0]->TEL?></td>
            </tr>
            <tr class="centro">               
                <td class="centro conborde titulocampo">C.C o NIT:</td>
                <td class="centro conborde"><?php echo $pago[0]->NIT_CEDULA?></td>
                <td class="centro conborde titulocampo">Banco/Sucursal:</td>
                <td class="centro conborde"><?php echo $pago[0]->NOMBRE_BANCO?></td>
                <td class="centro conborde titulocampo">Cuenta No/Clase:</td>
                <td class="centro conborde"><?php echo $pago[0]->NUMERO_CUENTA."/".$pago[0]->CLASE?></td>
            </tr>
            <tr class="centro conborde">
                <td class="centro titulocampo" colspan="6">
                    <p>2. DATOS DEL COMPROMISO</p>
                </td>
            </tr>
            <tr class="centro">               
                <td class="centro conborde titulocampo">Compromiso a Pagar:</td>
                <td class="centro conborde"><?php echo $pago[0]->DES_COMPROMISO?></td>
                <td class="centro conborde titulocampo">No:</td>
                <td class="centro conborde"><?php echo $pago[0]->CTO_CONVENIO?></td>
                <td class="centro conborde titulocampo">Interventor o responsable del recibo a satisfacción del bien o servicio:</td>
                <td class="centro conborde">TOTAL</td>
            </tr>
            <tr class="centro">               
                <td class="centro titulocampo">Acta de Recibo No:</td>
                <td class="centro conborde"></td>
                <td class="centro conborde titulocampo">Nombre del Interventor:</td>
                <td class="centro conborde"></td>
            </tr>
            <tr class="centro">               
                <td class="centro conborde titulocampo" colspan="6">
                    <p>Detalle</p>
                </td>
            </tr>
            <tr class="centro">               
                <td class="centro conborde" colspan="6">
                    <p><?php echo $pago[0]->DETALLE?></p>
                </td>
            </tr>
            <tr class="centro">               
                <td class="centro titulocampo">Tipo de Orden de Pago:</td>
                <td colspan="5" class="centro conborde"><?php echo $pago[0]->TIPO_VIGENCIA?></td>
            </tr>
            <tr class="centro conborde">
                <td class="centro titulocampo" colspan="6">
                    <p>3. MOVIMIENTO PRESUPUESTAL</p>
                </td>
            </tr>            
        </table>
        <table width="100%" class="conborde">
            <tr class="centro">               
                <td colspan="4" class="centro conborde titulocampo">
                    Fuente de financiación:                
                </td>
                <td colspan="5" class="centro conborde titulocampo">
                    IMPUTACIÓN PRESUPUESTAL
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table width="100%" class="conborde">
                        <tr>
                            <td class="centro conborde titulocampo">ID Rubro</td>
                            <td class="centro conborde titulocampo">Fuente</td>
                            <td class="centro conborde titulocampo">Detalle</td>
                            <td colspan="2" class="centro conborde titulocampo">Valor</td>
                        </tr>
                        <?php
                            for($i=0;$i<count($pago);$i++){
                                ?>
                                <tr>
                                    <td class="centro conborde"><?php echo $pago[$i]->RUBRO_FUENTES?></td>
                                    <td class="centro conborde"><?php echo $pago[$i]->CODIGO_FUENTE?></td>
                                    <td class="centro conborde"><?php echo $pago[$i]->CONSECUTIVO_FUENTE?></td>
                                    <td colspan="2" class="centro conborde"><?php echo "$".number_format($pago[$i]->VALOR_FUENTE, 2, ',', '.'); ?></td>                                
                                </tr>
                                <?php
                            }
                        ?>
                        <tr class="mt-5">
                            <td class="centro conborde titulocampo">Tipo</td>
                            <td class="centro conborde titulocampo">Com</td>
                            <td class="centro conborde titulocampo">Objeto</td>
                            <td class="centro conborde titulocampo">Ingreso</td>
                            <td class="centro conborde titulocampo">Banco</td>
                        </tr>
                        <?php
                            for($i=0;$i<count($pago);$i++){
                                ?>
                                <tr>
                                    <td class="centro conborde"><?php echo $pago[$i]->CODIGO_TIPO?></td>
                                    <td class="centro conborde"><?php echo $pago[$i]->CODIGO_COMPONENTE?></td>
                                    <td class="centro conborde"><?php echo $pago[$i]->CODIGO_OBJETO?></td>
                                    <td class="centro conborde"><?php echo $pago[$i]->DES_INGRESO?></td>                                
                                    <td class="centro conborde"><?php echo $pago[$i]->BANCOX?></td>                                
                                </tr>
                                <?php
                            }
                        ?>
                    </table>
                </td>
                <td colspan="5">
                    <table width="100%" class="conborde">
                        <tr>
                            <td class="centro conborde titulocampo">CDP</td>
                            <td class="centro conborde titulocampo">Código Rubro</td>
                            <td class="centro conborde titulocampo">Registro</td>
                            <td class="centro conborde titulocampo">Nombre</td>
                            <td class="centro conborde titulocampo">Valor Aplicación (Gasto)</td>        
                        </tr>                        
                        <tr>
                            <td class="centro conborde"><?php echo $pago[0]->CDP?></td>
                            <td class="centro conborde"><?php echo $pago[0]->RUBRO_FUENTES?></td>
                            <td class="centro conborde"><?php echo $pago[0]->RP?></td>
                            <td class="centro conborde"><?php echo $pago[0]->DES_RUBRO; ?></td>
                            <td class="centro conborde"><?php echo "$".number_format($pago[0]->BRUTO, 2, ',', '.'); ?></td>                                
                        </tr>
                    </table>
                    <table width="100%" class="conborde">
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                    <table width="100%" class="conborde">
                        <tr>
                            <td class="centro conborde titulocampo">VR BRUTO</td>
                            <td class="centro conborde"><?php echo $pago[0]->VALOR_LETRAS_BRUTO?></td>
                            <td class="centro conborde"><?php echo "$".number_format($pago[0]->BRUTO, 2, ',', '.'); ?></td>
                        </tr>   
                    </table>
                    <table width="100%" class="conborde">
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                    <table width="100%" class="conborde">
                        <tr>
                            <td colspan="5" class="centro titulocampo">4. MOVIMIENTO FINANCIERO Y CONTABLE</td>
                        </tr>
                        <tr>
                            <td class="centro conborde titulocampo">Descripción</td>
                            <td class="centro conborde titulocampo">% Descuento</td>
                            <td class="centro conborde titulocampo">Base de Retención</td>
                            <td class="centro conborde titulocampo">Código Contable</td>
                            <td class="centro conborde titulocampo">VALORES</td>
                        </tr>
                        <tr>
                            <td class="centro conborde">Valor Bruto</td>
                            <td class="centro conborde"></td>
                            <td class="centro conborde"></td>
                            <td class="centro conborde"><?php echo $pago[0]->CODIGO_CONTABLE_BRUTO; ?></td>
                            <td class="centro conborde"><?php echo "$".number_format($pago[0]->BRUTO, 2, ',', '.'); ?></td>
                        </tr>
                        <?php
                            for($i=0;$i<count($descuento);$i++){
                                ?>
                                <tr>
                                    <td class="centro conborde"><?php echo $descuento[$i]->DESCRIPCION_CODIGO; ?></td>
                                    <td class="centro conborde"><?php echo $descuento[$i]->PORCENTAJE; ?></td>
                                    <td class="derecha conborde"><?php echo "$".number_format($descuento[$i]->VALOR_BASE_RETENCION, 2, ',', '.'); ?></td>
                                    <td class="centro conborde"><?php echo $descuento[$i]->CUENTA_CONTABLE; ?></td>                                
                                    <td class="derecha conborde"><?php echo "$".number_format($descuento[$i]->VALOR_DESCUENTO, 2, ',', '.'); ?></td>                                
                                </tr>
                                <?php
                            }
                        ?> 
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table width="100%" class="conborde">
                        <tr>
                            <td>
                                Valor amortizaci&oacute;n:
                            </td>
                        </tr>
                        <tr>
                            <td class="centro conborde titulocampo">
                                Id fuente
                            </td>
                            <td class="centro conborde titulocampo">
                                Detalle
                            </td>
                        </tr>
                        <tr>
                            <td class="centro conborde titulocampo">
                                <?php echo $pago[0]->CODIGO_FUENTE; ?>
                            </td>
                            <td class="centro conborde titulocampo">
                                <?php echo $pago[0]->DESC_FUENTE; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="centro conborde titulocampo">
                                <?php echo $pago[0]->CONSECUTIVO_FUENTE; ?>
                            </td>
                            <td class="centro conborde titulocampo">
                                <?php echo $pago[0]->DESC_DETALLE_FUENTE; ?>
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="5">
                    <table width="100%" class="conborde">
                        <tr>
                            <td colspan="2" class="centro conborde">
                               TOTAL DESCUENTOS
                            </td>
                            <td class="centro conborde">
                                <?php echo "$".number_format($descuento[0]->TOTAL_DESCUENTO, 2, ',', '.'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="centro conborde titulocampo" width="15%">
                               VALOR NETO A GIRAR
                            </td>
                            <td class="centro conborde" width="45%">
                               <?php echo $pago[0]->VALOR_LETRAS_NETO; ?>
                            </td>
                            <td class="centro conborde">
                                <table width="100%" class="conborde">
                                    <tr>
                                        <td class="centro conborde">
                                            <?php echo "$".number_format($pago[0]->NETO, 2, ',', '.'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="centro conborde titulocampo">
                                            C&oacute;digo contable
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="centro conborde">
                                            <?php echo $pago[0]->CODIGO_CONTABLE_NETO; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <table width="100%" class="conborde">
                        <tr>
                            <td class="centro conborde titulocampo" colspan="3">
                                MOVIMIENTO TESORER&Iacute;A
                            </td>
                        </tr>
                        <tr>
                            <td class="centro">
                                Endosado a: <?php echo $pago[0]->NOMBRE_ENDOSO.' '.$pago[0]->CLASE_ENDOSO. ' '.$pago[0]->BANCO_ENDOSO; ?>
                            </td>
                            <td class="centro">
                                <?php echo $pago[0]->NUMERO_CUENTA_ENDOSO; ?>
                            </td>
                            <td class="centro">
                                <?php echo $pago[0]->VALOR_ENDOSO; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="conborde">
                    Observaciones
                </td>
                <td colspan="6" class="conborde">
                    Acreedor (Exclusivamente para transferencia de la administración)
                </td>
            </tr>
            <tr>
                <td colspan="6" class="conborde">
                    &nbsp;
                </td>
                <td>
                    Nombre _________________________________<br><br>
                    C&eacute;dula _______________________________   Firma__________________________<br><br>
                </td>
            </tr>
        </table>
        <table width="100%" class="conborde">
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
        <table width="100%" class="conborde">
            <tr>
                <td colspan="6" class="conborde">
                   <?php echo $pago[0]->NOMBRE_ELABORO?><br>
                   <?php echo $pago[0]->AREA_ELABORO?><br>
                </td>
                <td colspan="6" class="conborde">
                   <?php echo $pago[0]->RESPONSABLE_PRESUPUESTO?><br>
                   Responsable del Presupuesto
                </td>
            </tr>
        </table>
        <table width="100%" class="conborde">
            <tr>
                <td class="conborde" align="center">                    
                    <img src='<?php echo $img_qr ?>' width='100px'>
                </td>
            </tr>
        </table>
    </div>
        <div id="footer" style="margin-left:45px;margin-right:45px">
    </div>

</body>
</html>		  