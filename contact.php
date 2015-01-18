<?  
	require_once("classes/class.ocrcaptcha.php");
	$captcha = new ocr_captcha();

    if(isset($_POST['submitBtn']) && $_POST['submitBtn']=="Trimite mesajul") {   

		require_once("classes/auxiliary.php");
		require_once("classes/class.htmlMimeMail.php");
	  
		$contactErrorMessage = "";    
		if($captcha->check_captcha($_POST['public_key'],$_POST['private_key']))	 { 
				$contactErrorMessage = checkContactForm($_POST); 
				if($contactErrorMessage=="") {
					$nume          = $_POST['nume'];
					$prenume       = $_POST['prenume'];
					$telefon       = $_POST['telefon'];
					$informatii    = $_POST['informatii'];
					$email         = $_POST['email'];
					$mesaj         = $_POST['mesaj'];

					$htmlText="";
					$htmlText .=   '<table align="center" width="99%" style="font-weight:bold;" border="1">';
					$htmlText .=   '<tr style="font-weight:bold">';
					$htmlText .=   '    <td colspan="2">Cerere Contact</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';
					$htmlText .=   '    <td width="200">Nume:&nbsp;</td>';
					$htmlText .=   '    <td>'.$nume.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';
					$htmlText .=   '    <td width="200">Prenume:&nbsp;</td>';
					$htmlText .=   '    <td>'.$prenume.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';
					$htmlText .=   '    <td width="200">Telefon:&nbsp;</td>';
					$htmlText .=   '    <td>'.$telefon.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';                                        
					$htmlText .=   '    <td>Email:&nbsp;</td>';
					$htmlText .=   '    <td>'.$email.'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '<tr>';
					$htmlText .=   '    <td width="200">Informatii:&nbsp;</td>';
					$htmlText .=   '    <td>'.$informatii.'</td>';
					$htmlText .=   '</tr>';					
					$htmlText .=   '<tr>';
					$htmlText .=   '    <td>Mesaj:&nbsp;</td>';
					$htmlText .=   '    <td>'.nl2br($mesaj).'</td>';
					$htmlText .=   '</tr>';
					$htmlText .=   '</table>';
					
					$text  =   'Cerere Contact\r\n';
					$text .=   'Nume:'.$nume.'\r\n';
					$text .=   'Prenume:'.$prenume.'\r\n';
					$text .=   'Telefon:'.$telefon.'\r\n';
					$text .=   'Email:'.$email.'\r\n';
					$text .=   'Informatii:'.$informatii.'\r\n';
					$text .=   'Mesaj:'.nl2br($mesaj).'\r\n';
		
					$to="fildumexpert@yahoo.com";                                                            
					$from = "vizitator@fildumexpert.ro";
					$subject = "Cerere Contact";    
					$html = "<HTML><HEAD></HEAD><BODY>".$htmlText."</BODY></HTML>";
		
					$mail=new htmlMimeMail();
					$mail->setHtml($htmlText, $text);
					$mail->setReturnPath($to);
					$mail->setFrom($from);
					$mail->setSubject($subject);
					$mail->setHeader("X-Mailer","fildumexpert.ro");
					$mail->setHeader("X-Priority","1");
					$mail->setHeader("X-Sender","<www.fildumexpert.ro>");
					
					$result = @$mail->send(array($to));
					
					if (!$result){
						  $contactErrorMessage .= "Eroarea in cadrul operatiunii de trimitere a mesajului. Va rugam reveniti mai tarziu. Va multumim!";	  
					}
					else {
						  $contactErrorMessage .= "Mesajul dumneavoastra a fost trimis. Va multumim!";	  
					}  
				} 
		} else {  // else captcha
			$contactErrorMessage .= "Codul din imagine nu corespunde cu cel introdus de dumneavoastra";		
		}
    }                                                           
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/fildum.css" media="screen"/>
<script type="text/javascript" language="javascript" src="lytebox/lytebox.js"></script>
<link rel="stylesheet" href="lytebox/lytebox.css" type="text/css" media="screen" />
<title>Fildum Expert - Doors Experts - Contact</title>
</head>
<!--[if lte IE 6]>
<link rel="stylesheet" href="css/fildum_ie6.css" type="text/css" media="screen" />
<![endif]-->
<body>
<div id="containerHeaders">
  <div id="headerTop">
    <div id="containerLogo"> <a href="index.html" target="_self"><img src="images/pic_logo/logo_fildum.jpg" alt="Fildum Expert - Doors Experts" border="0" width="378" height="96"/></a> </div>
    <!--ends containerLogo div-->
  </div>
  <!--ends headerTop-->
  <div id="containerHeaderMeniu">
    <div id="meniu"> 
    	<a href="index.html"><img src="images/buttons/btn_usi_yellow.jpg" alt="usi de interior" border="0" width="112" height="36"/></a> 
        <a href="rulouri.html"><img src="images/buttons/btn_rulouri_background.jpg" alt="rulouri" border="0" width="112" height="36"/></a> 
        <a href="porti_garaj.html"><img src="images/buttons/btn_porti_garaj_background.jpg" alt="porti de garaj" border="0" width="112" height="36"/></a>
        <a href="mobilier_secondhand_germania.html" target="_self"> <img src="images/buttons/btn_mobilier_import_yellow.jpg" alt="mobilier import" border="0" width="210" height="36"/> </a> 
    	<a href="mobilier_la_comanda.html" target="_self"><img src="images/buttons/btn_mobilier_la_comanda_yellow.jpg" alt="mobilier la comanda" border="0" width="160" height="36"/></a>
    	<a href="tamplarie_PVC.html" target="_self"><img src="images/buttons/btn_tamplarie_pvc_yellow.jpg" alt="tamplarie PVC" border="0" width="120" height="36"/></a> 
        <img src="images/buttons/btn_contact_white.jpg" alt="contact" border="0" width="112" height="36"/>
      <div class="clearFloats">
        <!--comment-->
      </div>
      <!--ends clearFloats div-->
    </div>
    <!--ends meniu div-->
  </div>
  <!--ends containerHeaderMeniu-->
</div>
<!--ends containerHeaders-->
<div id="mainBox">
  <div class="containerContentLeftColumn" style="border:none; margin-left:auto; margin-right:auto;">
    <form id="formularContact" method="post" action="contact.php" style="width:540px; padding-top:20px;">
      <fieldset>
        <legend>Formular de contact</legend>
        <table width="100%">
          <?
									if(isset($contactErrorMessage)) {
								?>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><span style="color:#f00; font-weight:bold; text-transform:uppercase;">
              <?
											echo $contactErrorMessage;
										?>
              </span></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <?
								}
								?>
          <tr>
            <td colspan="2" align="center"> Nume* </td>
          <tr/>
          <tr>
            <td colspan="2" align="center"><input name="nume" type="text" tabindex="1" size="30"/></td>
          </tr>
          <tr>
            <td colspan="2" align="center"> Prenume* </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="prenume" type="text" tabindex="2" size="30"/></td>
          </tr>
          <tr>
            <td colspan="2" align="center"> Adresa e-mail* </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="email" type="text" tabindex="3" size="30"/></td>
          </tr>
          <tr>
            <td colspan="2" align="center"> Numar de telefon* </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="telefon" type="text" tabindex="4" size="30"/></td>
          </tr>
          <tr>
            <td><br/></td>
          </tr>
          <tr>
            <td align="right"> As dori informatii despre: </td>
            <td><select name="informatii" style="width:210px;" tabindex="5">
                <option>usi din pal celular</option>
                <option>usi din sticla</option>
                <option>usi din lemn stratificat</option>
                <option>usi metalice</option>
                <option>tipuri de decupaje</option>
                <option>jaluzele</option>
                <option>rulouri</option>
                <option>copertine</option>
                <option>porti de garaj</option>
              </select></td>
          </tr>
          <tr>
            <td><br/></td>
          </tr>
          <tr>
            <td colspan="2" align="center"> Mesajul dumneavoastra* </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><textarea name="mesaj" cols="40" rows="7" tabindex="6"></textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><table cellpadding="0" cellspacing="2" border="0" width="95%">
                <tr>
                  <td colspan="2" align="center"><a href="contact.php"> Daca nu vedeti imaginea de mai jos da-ti click aici </a> <br/>
                    <span class="greenText"> Va rugam introduceti codul din imagine </span><br/></td>
                </tr>
                <tr>
                  <td align="center" colspan="2" valign="middle"><?
                                                echo $captcha->display_captcha(true);
                                                                    
                                            ?></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="submitBtn" value="Trimite mesajul"  tabindex="11"/></td>
          </tr>
          <tr>
            <td colspan="2" align="center"> campurile marcate cu * sunt obligatorii </td>
          </tr>
          <tr>
            <td><br/></td>
          </tr>
        </table>
      </fieldset>
    </form>
  </div>
  <!--ends containerContentLeftColumn-->
</div>
<!--ends mainBox div-->
<div id="footerBackground">
  <div id="containerFooterContent">
    <div class="footerContent">
      <h3> Despre noi </h3>
      <p> <b>Fildum Expert, membra a Fil Group</b>, a fost infiintata in anul 2006. A urmat o dezvoltare rapida si eficienta si, tot in acel an a achizitionat pachetul majoritar al firmei <b>S.C. Ban - Import S.R.L.</b> <br/>
        <br/>
        Bazandu-se pe valoroasa experienta a expertilor si pe traditia deja adusa pe piata usilor de interior adusa de renumita firma Ban - Import, Fildum Expert a mizat pe calitatea germana cu care deja era obijnuita clientela si, rapid si-a imbogatit oferta. <br/>
        <br/>
        Pe langa usi de interior, societatea noastra va mai ofera <b>Rulouri, Porti de garaj, Rolete, Jaluzele textile si Copertine</b>, astfel incercand sa acopere o gama cat mai larga din necesarul confortului locuintei dumneavoastra. </p>
    </div>
    <!--ends footerContent-->
    <div class="footerContent">
      <h3> Locatii magazine </h3>
      <img src="images/pics_birouri/pic_birou_3.jpg" alt="" border="0" width="90" height="90"/>
      <p> loc. Dumbravita nr.117 <br/>
        Fix/fax:0256.243.545 <br/>
        mobil: 0746.196.602 <br/>
        0749.206.938 </p>
    </div>
    <!--ends footerContent-->
    <div class="footerContent">
      <h3> Contact </h3>
      <p> Dumbravita <br/>
        Adresa: Str. Petofi Sandor  nr.117
        Mobil:0746.196.602 / 0749.206.938 <br/>
        Fix/fax:0256.243.545 <br/>
        e-mail: fildumexpert@yahoo.com
        web: www.fildumexpert.ro </p>
    </div>
    <!--ends footerContent-->
    <div class="clearFloats">
      <!--comment-->
    </div>
    <!--ends clearFloats-->
  </div>
  <!--ends containerFooterContent-->
</div>
<!--ends footerBackground-->
<div id="backgroundContainerDevelopedBy">
  <div id="containerDevelopedBy">
    <ul>
      <li> <a href="index.html" target="_self">usi</a> </li>
        | &nbsp;
      <li> <a href="rulouri.html" target="_self">rulouri</a> </li>
        | &nbsp;
      <li> <a href="porti_garaj.html" target="_self">porti de garaj</a> </li>
        | &nbsp;
      <li><a href="mobilier_secondhand_germania.html" target="_self">mobilier second hand Germania</a></li>
      	| &nbsp;
      <li><a href="mobilier_la_comanda.html" target="_self">mobilier la comanda</a></li>
      	| &nbsp;
      <li><a href="tamplarie_PVC.html" target="_self">tamplarie PVC</a></li>
      	| &nbsp;
      <li> <a href="contact.php" target="_self">contact</a> </li>
    </ul>
    <br/>
    <a href="http://www.globe-studios.com" target="_blank"> <img src="images/developed_by/developed_by.jpg" alt="Globe-Studios" border="0" width="200" height="44"/> </a> </div>
  <!--ends containerDevelopedBy-->
</div>
<!--ends containerDevelopedBy-->
</body>
</html>
