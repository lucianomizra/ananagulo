<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <!-- This is a simple example template that you can edit to create your own custom templates -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="Su cuenta Privilegio">
        
        <title>Su cuenta Privilegio</title>
		
	<style type="text/css">
		#outlook a{
			padding:0;
		}
		body{
			width:100% !important;
		}
		body{
			-webkit-text-size-adjust:none;
		}
		body{
			margin:0;
			padding:0;
		}
    table{
    border-spacing:0
    }
		img{
			border:none;
			font-size:14px;
			font-weight:bold;
			height:auto;
			line-height:100%;
			outline:none;
			text-decoration:none;
			text-transform:capitalize;
		}
		#backgroundTable{
			height:100% !important;
			margin:0;
			padding:0;
		}
	/*
	@tab Page
	@section background color
	@tip Set the background color for your email. You may want to choose one that matches your company's branding.
	@theme page
	*/
		body,.backgroundTable{
			/*@editable*/background-color:#FFF;
		}
	/*
	@tab Page
	@section email border
	@tip Set the border for your email.
	*/
		#templateContainer{
			/*@editable*/border:1px solid #DDDDDD;
		}
	/*
	@tab Page
	@section heading 1
	@tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
	@theme heading1
	*/
		h1,.h1{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:60px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-bottom:10px;
			/*@editable*/text-align:left;
		}
	/*
	@tab Page
	@section heading 2
	@tip Set the styling for all second-level headings in your emails.
	@theme heading2
	*/
		h2,.h2{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:30px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-bottom:10px;
			/*@editable*/text-align:left;
		}
	/*
	@tab Page
	@section heading 3
	@tip Set the styling for all third-level headings in your emails.
	@theme heading3
	*/
		h3,.h3{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:26px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-bottom:10px;
			/*@editable*/text-align:left;
		}
	/*
	@tab Page
	@section heading 4
	@tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
	@theme heading4
	*/
		h4,.h4{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:22px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-bottom:10px;
			/*@editable*/text-align:left;
		}
	/*
	@tab Header
	@section preheader style
	@tip Set the background color for your email's preheader area.
	@theme page
	*/
		#templatePreheader{
			/*@editable*/background-color:#fdfefe;
		}
	/*
	@tab Header
	@section preheader text
	@tip Set the styling for your email's preheader text. Choose a size and color that is easy to read.
	*/
		.preheaderContent div{
			/*@editable*/color:#505050;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:10px;
			/*@editable*/line-height:100%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Header
	@section preheader link
	@tip Set the styling for your email's preheader links. Choose a color that helps them stand out from your text.
	*/
		.preheaderContent div a:link,.preheaderContent div a:visited{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		.preheaderContent div img{
			height:auto;
			max-width:600px;
		}
	/*
	@tab Header
	@section header style
	@tip Set the background color and border for your email's header area.
	@theme header
	*/
		#templateHeader{
			/*@editable*/background-color:#FFFFFF;
			/*@editable*/border-bottom:0;
		}
	/*
	@tab Header
	@section header text
	@tip Set the styling for your email's header text. Choose a size and color that is easy to read.
	*/
		.headerContent{
			/*@editable*/color:#202020;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:34px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			/*@editable*/padding:0;
			/*@editable*/text-align:center;
			/*@editable*/vertical-align:middle;
		}
	/*
	@tab Header
	@section header link
	@tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
	*/
		.headerContent a:link,.headerContent a:visited{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		#headerImage{
			height:auto;
			max-width:600px !important;
		}
	/*
	@tab Body
	@section body text
	@tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
	@theme main
	*/
		.bodyContent div{
			/*@editable*/color:#505050;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:14px;
			/*@editable*/line-height:150%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Body
	@section body link
	@tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
	*/
		.bodyContent div a:link,.bodyContent div a:visited{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		.bodyContent img{
			display:inline;
			margin-bottom:10px;
		}
	/*
	@tab Footer
	@section footer style
	@tip Set the background color and top border for your email's footer area.
	@theme footer
	*/
		#templateFooter{
			/*@editable*/border-top:0;
		}
	/*
	@tab Footer
	@section footer text
	@tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
	@theme footer
	*/
		.footerContent div{
			/*@editable*/color:#707070;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:12px;
			/*@editable*/line-height:125%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Footer
	@section footer link
	@tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
	*/
		.footerContent div a:link,.footerContent div a:visited{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		.footerContent img{
			display:inline;
		}
	/*
	@tab Footer
	@section social bar style
	@tip Set the background color and border for your email's footer social bar.
	*/
		#social{
			/*@editable*/background-color:#FFF;
			/*@editable*/border:1px solid #F5F5F5;
		}
	/*
	@tab Footer
	@section social bar style
	@tip Set the background color and border for your email's footer social bar.
	*/
		#social div{
			/*@editable*/text-align:center;
		}
	/*
	@tab Footer
	@section utility bar style
	@tip Set the background color and border for your email's footer utility bar.
	*/
		#utility{
			/*@editable*/background-color:#FFF;
			/*@editable*/border-top:1px solid #F5F5F5;
		}
	/*
	@tab Footer
	@section utility bar style
	@tip Set the background color and border for your email's footer utility bar.
	*/
		#utility div{
			/*@editable*/text-align:center;
		}
		#monkeyRewards img{
			max-width:160px;
		}
</style></head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<center>
        	<table bgcolor="#4a9a9b" style="width:600px;margin:auto; background:#4a9a9b no-repeat top center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
            	<tr>
                	<td align="center" valign="top">
                        
                        <!-- // End Template Preheader \\ -->
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="">
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Header \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
                                        <tr>
                                            <td class="headerContent">
                                            
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Header \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td style="" align="center" valign="top">
                                    <!-- // Begin Template Body \\ -->
                                	
                                     <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top"> 
                                                        <img src="http://static.identty.com/cemaco/clients/state/header.png" />
                                                    </td>
                                                    </tr>
                                                        <tr>
                                                        <td valign="top">
                                                        <?/*
                                                        <center>
        	<table bgcolor="#34478f" style="width:470px;margin:35px auto 0; border:6px solid #b7c949; background:#34478f no-repeat top center" border="5" bordercolor="#b7c949" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
            	<tr>
                	<td align="center" valign="top">
                  <div style="font-family:Futura,Myriad Pro,Arial,sans-serif;padding:22px 0; color:#FFF;font-size:19px"><strong style="font-weight:bold">Estimado cliente</strong>, con el fin de mejorar <br/>nuestro servicio y facilitarle sus compras, <br/>hemos modificado la política de vencimiento <br/>de Cemacolones. Ahora, los Cemacolones no <br/>utilizados en el periodo anual vencerán <br/>el 31 de enero del año siguiente.</div>
                  </td>
              </tr>
          </table>
</center>
                                                        */?>
<center>
<div class="bodyContent" style="margin:auto;padding-top:15px;width:550px;color:#FFF;font-size:18px;text-align:center;font-family:Futura,Myriad Pro,Arial,sans-serif;">
<p style="margin-bottom:35px;font-size:18px">Estimado <strong style="font-weight:bold">*|UNAME|* *|ULASTNAME|*</strong>,<br>a continuación le presentamos al detalle su <br>actualización de Cemacolones</p>

<p style="margin-bottom:5px;color:#b7c949;font-weight:bold">CEMACOLONES ACUMULADOS EN<br> LA ÚLTIMA COMPRA</p>
<p style="margin-top:0;margin-bottom:25px;color:#FFF;font-weight:bold;font-size:26px">*|ULAST|*</p>

<p style="margin-bottom:5px;color:#b7c949;font-weight:bold">CEMACOLONES ACUMULADOS</p>
<p style="margin-top:0;margin-bottom:25px;color:#FFF;font-weight:bold;font-size:26px">*|UACCUMULATED|*</p>

<p style="margin-bottom:5px;color:#b7c949;font-weight:bold">CEMACOLONES CONSUMIDOS</p>
<p style="margin-top:0;margin-bottom:25px;color:#FFF;font-weight:bold;font-size:26px">*|UREDEEMED|*</p>

<p style="margin-bottom:5px;color:#b7c949;font-weight:bold">CEMACOLONES VENCIDOS</p>
<p style="margin-top:0;margin-bottom:35px;color:#FFF;font-weight:bold;font-size:26px">*|VENCIDO|*</p>

<p style="margin-bottom:15px;color:#34488f;font-size:20px;font-weight:bold">SALDO DE CEMACOLONES:</p>
<p style="margin-top:0;margin-bottom:15px;color:#FFF;font-size:14px">Estimado cliente, le informamos que el saldo actual de Cemacolones <br/>de su tarjeta Cliente Privilegio en la fecha de este envio es de:</p>
<p style="margin-top:0;margin-bottom:35px;color:#FFF;font-weight:bold;font-size:29px"><span style="font-size:37px">*|UBALANCE|*</span> Cemacolones</p>

<p style="margin-bottom:15px;color:#34488f;font-size:20px;font-weight:bold">SALDO DE COLONES:</p>
<p style="margin-top:0;color:#FFF;margin-bottom:15px;font-size:14px">Estimado cliente le informamos que el saldo actual acreditado en<br/> Colones en su cuenta en la fecha de este envío es de:</p>
<p style="margin-top:0;color:#FFF;margin-bottom:35px;font-weight:bold;font-size:29px"><span style="font-size:37px">*|CBALANCE|*</span> Colones</p>

<p style="margin-bottom:25px;color:#5e417d;font-size:17px;font-weight:bold">FECHA DEL ENVÍO: 31-<?= $this->Data->getMonthString(5) ?>-<?= date('Y') ?></p>
</div></center>
														</td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Content \\ -->
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td style="background:#34478f" cellpadding="0" cellspacing="0" align="center" valign="top">
                              <center>
                              <div class="bodyContent" style="margin:0 auto 35px;padding-top:30px;width:450px;color:#FFF;font-size:18px;text-align:center;font-family:Futura,Myriad Pro,Arial,sans-serif;">
                              <p style="margin-bottom:20px;">APROVECHAMOS PARA RECORDARLE QUE SEGÚN LAS NUEVAS CONDICIONES VIGENTES DESDE ENERO DE 2015 LOS CEMACOLONES NO UTILIZADOS EN EL PERIODO ANUAL VENCERÁN EL 31 DE ENERO DEL AÑO SIGUIENTE.</p>
                              <p style="margin-bottom:20px;"><img src="http://static.identty.com/cemaco/clients/state/conditions-2015.png" /></p>
                              <p style="margin-bottom:20px;color:#b7ca4a;font-size:14px; font-weight:bold">ADEMÁS, PRÓXIMAMENTE CONTAREMOS <br>CON LA NUEVA TARJETA SOY.</p>
                              <p style="margin-bottom:30px;color:#FFF;font-size:13px;"><span style="border-bottom:1px solid #FFF;width:75px;display:inline-block;height:10px;margin-bottom: 4px; margin-right:10px"></span>PUEDE CONSULTAR CONDICIONES<span style="border-bottom:1px solid #FFF;width:75px;display:inline-block;height:10px;margin-bottom: 4px; margin-left:10px"></span></p>
                              <p style="margin-bottom:15px"><a href="https://www.facebook.com/Cemacocr/app_302356833262695" style="text-decoration:none;padding:10px 35px 8px;background:#4b9a9b;color:#34488f;letter-spacing:2px;font-size:30px;font-weight:bold" target="_blank">AQU&Iacute;</a></p>
                            </div></center>
                            </td>
                        	</tr>
                              <tr>
                            	<td cellpadding="0" cellspacing="0" align="center" valign="top">
                                    <!-- // Begin Template Footer \\ -->
                                	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="templateFooter">
                                    	<tr>
                                        	<td style="background:#FFF" cellpadding="0" cellspacing="0"  valign="top" class="footerContent">
                                            
                                    <!-- // Begin Template Footer \\ -->
                                	<table style="width:600px;margin:auto" border="0" cellpadding="0" cellspacing="0" id="templateFooter">
                                    	<tr>
                                        	<td style="background:#FFF" cellpadding="0" cellspacing="0" valign="top" class="footerContent">
                                            
                                                <!-- // Begin Module: Standard Footer \\ -->
                                                <table style="margin-top:20px" border="0" cellpadding="8" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td colspan="2" valign="middle" id="social">
                                                            <div mc:edit="std_social">
Web: <a href="http://www.cemaco.co.cr">www.cemaco.co.cr</a>&nbsp; |&nbsp; Email: <a href="mailto:contactenos@cemaco.co.cr">contactenos@cemaco.co.cr</a>&nbsp; |&nbsp; Facebook: <a href="http://fb.com/Cemacocr">fb.com/Cemacocr</a></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" valign="top" width="370">
                                                           
                                                            <div mc:edit="std_footer"><div style="text-align: center;"><em>Copyright © <?= date('Y') ?> Cemaco, Todos los derechos reservados.</em><br><img align="none" height="42" src="http://static.identty.com/cemaco/clients/logo.png" style="
                                                            " width="108"></div>
<!-- *|IFNOT:ARCHIVE_PAGE|* --></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Footer \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer \\ --><table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#ffffff;border-top:1px solid #e5e5e5">
        <tbody><tr>
            <td align="center" valign="top" style="padding-top:20px;padding-bottom:20px">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td align="center" valign="top" style="color:#606060;font-family:Helvetica,Arial,sans-serif;font-size:11px;line-height:150%;padding-right:20px;padding-bottom:5px;padding-left:20px;text-align:center">
                            Este mensaje fue enviado a <a href="mailto:*|EMAIL|*" style="color:#404040!important" target="_blank">*|EMAIL|*</a>
                            &nbsp;&nbsp;
                            <a href="*|UNSUB:http://cemaco.co.cr/unsuscribe|*" style="color:#404040!important" target="_blank">Darse de baja</a>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
                                </td>
                            </tr>
                        </table>
            
        </center>
    </body>
</html>
