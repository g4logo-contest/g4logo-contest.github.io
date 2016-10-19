<?php
echo "1";
if(isset($_POST['email'])) {
 
echo "email ok";
echo $_POST['uploadLogo'];
print_r($_POST);  // array()
print_r($_FILES); // array()
 
  // EDIT THE 2 LINES BELOW AS REQUIRED
  
  $email_to1 = "laurent.garnier@univ-rennes1.fr";
  $email_to2 = "ahoward@mail.cern.ch";
  $from_name = "laurent.garnier";
  $from_mail = "laurent.garnier@univ-rennes1.fr";
  
  $email_subject = "G4 logo contest: Submission";
      
  function clean_string($string) {
 
    $bad = array("content-type","bcc:","to:","cc:","href");
 
    return str_replace($bad,"",$string);
 
  }
 
     
 
  $email_message .= "First Name: ".clean_string($_POST['firstName'])."\n";
  $email_message .= "Last Name: ".clean_string($_POST['lastName'])."\n";
  $email_message .= "Address: ".clean_string($_POST['address'])."\n";
  $email_message .= "Zip code: ".clean_string($_POST['zipCode'])."\n";
  $email_message .= "City: ".clean_string($_POST['city'])."\n";
  $email_message .= "Country: ".clean_string($_POST['country'])."\n";
  $email_message .= "Email: ".clean_string($_POST['email'])."\n";
  $email_message .= "AcceptTerm: ".clean_string($_POST['acceptTerms'])."\n";
  $email_message .= "Over18: ".clean_string($_POST['over18'])."\n";     

    $file = $_FILES['uploadLogo']['tmp_name'];
    $filename = $_FILES['uploadLogo']['name'];
    $content = file_get_contents( $file);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);

    // header
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$from_mail."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

    // message & attachment
    $nmessage = "--".$uid."\r\n";
    $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $nmessage .= $email_message."\r\n\r\n";
    $nmessage .= "--".$uid."\r\n";
    $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
    $nmessage .= "Content-Transfer-Encoding: base64\r\n";
    $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $nmessage .= $content."\r\n\r\n";
    $nmessage .= "--".$uid."--";

    if (mail($email_to1, $email_subject, $nmessage, $header)) {
      echo "mail to $email_to1 OK";
      //      return true; // Or do something here
    } else {
      echo "mail to $email_to1 NOK";
      //      return false;
    }
    /*
    if (mail($email_to2, $subject, $nmessage, $header)) {
      echo "mail to $email_to1 OK";
      return true; // Or do something here
    } else {
      return false;
    }
    */
    /*

       // create email headers
 
  $headers = 'From: '.$email_from."\r\n".
 
    'Reply-To: '.$email_from."\r\n" .
 
    'X-Mailer: PHP/' . phpversion();
 
  @mail($email_to1, $email_subject, $email_message, $headers);  
  //  @mail($email_to2, $email_subject, $email_message, $headers);  
  */
  ?>
 
 
 
  <!-- include your own success html here -->
 
 
 
     Thank you for contacting us. We will be in touch with you very soon.
 
 
 
				<?php
 
				}
 
?>