<?php
if(isset($_POST['email'])) {
 
 
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
     
 
  $email_message .= "Pseudo: ".clean_string($_POST['pseudo'])."\n";
  $email_message .= "Web site: ".clean_string($_POST['website'])."\n";
  $email_message .= "First Name: ".clean_string($_POST['firstName'])."\n";
  $email_message .= "Last Name: ".clean_string($_POST['lastName'])."\n";
  $email_message .= "Address: ".clean_string($_POST['address'])."\n";
  $email_message .= "Zip code: ".clean_string($_POST['zipCode'])."\n";
  $email_message .= "City: ".clean_string($_POST['city'])."\n";
  $email_message .= "Country: ".clean_string($_POST['country'])."\n";
  $email_message .= "Email: ".clean_string($_POST['email'])."\n";
  $email_message .= "AcceptTerm: ".clean_string($_POST['acceptTerms'])."\n";
  $email_message .= "Over18: ".clean_string($_POST['over18'])."\n";
  $email_message .= "Logo: ".clean_string($_FILES['uploadLogo1']['name'])."\n";
  $email_message .= "Banner: ".clean_string($_FILES['uploadBanner1']['name'])."\n";
  $email_message .= "Comments: ".clean_string($_POST['comments'])."\n";

  $fileLogo1 = $_FILES['uploadLogo1']['tmp_name'];
  $filenameLogo1 = $_FILES['uploadLogo1']['name'];
  $contentLogo1 = file_get_contents( $fileLogo1);
  $contentLogo1 = chunk_split(base64_encode($contentLogo1));
  $nameLogo1 = basename($fileLogo1);

  $fileBanner1 = $_FILES['uploadBanner1']['tmp_name'];
  $filenameBanner1 = $_FILES['uploadBanner1']['name'];
  $contentBanner1 = file_get_contents( $fileBanner1);
  $contentBanner1 = chunk_split(base64_encode($contentBanner1));
  $nameBanner1 = basename($fileBanner1);

  $uid = md5(uniqid(time()));

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
  $nmessage .= "Content-Type: application/octet-stream; name=\"".$filenameLogo1."\"\r\n";
  $nmessage .= "Content-Transfer-Encoding: base64\r\n";
  $nmessage .= "Content-Disposition: attachment; filename=\"".$filenameLogo1."\"\r\n\r\n";
  $nmessage .= $contentLogo1."\r\n\r\n";
  $nmessage .= "--".$uid."\r\n";
  $nmessage .= "Content-Type: application/octet-stream; name=\"".$filenameBanner1."\"\r\n";
  $nmessage .= "Content-Transfer-Encoding: base64\r\n";
  $nmessage .= "Content-Disposition: attachment; filename=\"".$filenameBanner1."\"\r\n\r\n";
  $nmessage .= $contentBanner1."\r\n\r\n";
  $nmessage .= "--".$uid."--";
  
  if (mail($email_to1, $email_subject, $nmessage, $header)) {
    //      return true; // Or do something here
  } else {
    //      return false;
  }
    
  if (mail($email_to2, $subject, $nmessage, $header)) {
    //    return true; // Or do something here
  } else {
    //   return false;
  }
   
  ?>
 
 <!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Geant4 logo contest</title>
    <meta content="laurent.garnier@univ-rennes1.fr" name="author">
    <meta content="Geant4 logo contest" name="keywords">
    <meta content="BlueGriffon wysiwyg editor" name="generator">
    <link href="geant4.css" rel="stylesheet" type="text/css">
    <style>
body {
    background-color: white;
}

h1 {
    color: #33a4c9;
    margin-left: 40px;
}
h2 {
    border-bottom: 2px solid #33a4c9;
    padding: 0 0 15px 60px;
    margin-top: 0px;
    position: relative;
}
p, ul {
    margin-left: 80px;
}
      form {
    margin-left: 80px;
    margin-right: 80px;
      }
    </style>
  </head>
  <body>
    <h1>Geant4 Logo contest</h1>
    <br>
    <div style="text-align: left;"><br>
    </div>
	<h2>Thank you <?php echo $_POST['pseudo']; ?>! </h2>
    <p> </p>
    <div style="text-align: left;">
      <p>You have sumitted the following files:</p>
	<ul>
							   <li>Logo: <?php echo $_FILES['uploadLogo1']['name']; ?> </li>
														       <li>Banner: <?php echo $_FILES['uploadBanner1']['name']; ?></li>
	</ul>  
	<p>You will see your logo/banner <a href="https://g4logo-contest.github.io/Designs.html">on
	this page</a><a href="Geant4LogoContest.html"></a></p>
	<br>
    </div>
  </body>
</html>
				<?php
 
				}
 
?>