<?php require_once('Connections/MEDIC.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO contact (name, email, subject, message) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['subject'], "text"),
                       GetSQLValueString($_POST['message'], "text"));

  mysql_select_db($database_MEDIC, $MEDIC);
  $Result1 = mysql_query($insertSQL, $MEDIC) or die(mysql_error());

  $insertGoTo = "Contact_success.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="CareMed demo project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/greensock/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/parallax-js-master/parallax.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
</head>
<body>

	<div class="super_container">
	
	<!-- Header -->

	<header class="header trans_200">
		
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
							<div class="top_bar_item"><a href="admin_login.php">Admin</a></div>
							<div class="top_bar_item"><a href="appointments.php">Request an Appointment</a></div>
							<div class="emergencies  d-flex flex-row align-items-center justify-content-start ml-auto">For Emergencies: +25412345678</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<nav class="main_nav ml-auto">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li><a href="appointments.php">Appointments</a></li>
									<li><a href="admin_login.php">admin login</a></li>
									<li><a href="about.html">About us</a></li>
									<li><a href="services.html">Services</a></li>
									<li><a href="news.html">News</a></li>
									<li><a href="contact.php">Contact</a></li>
								</ul>
							</nav>
							<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Logo -->
		<div class="logo_container_outer">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="logo_container">
							<a href="#">
								<div class="logo_content d-flex flex-column align-items-start justify-content-center">
									<div class="logo_line"></div>
									<div class="logo d-flex flex-row align-items-center justify-content-center">
										<div class="logo_text">Med<span>Flow</span></div>
										<div class="logo_box">+</div>
									</div>
									<div class="logo_sub">Smart Health System</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>	
		</div>

	</header>

	<!-- Menu -->

	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<ul class="menu_list menu_mm">
					<li class="menu_item menu_mm"><a href="index.html">Home</a></li>
					<li class="menu_item menu_mm"><a href="appointments.php">Appointments</a></li>
					<li class="menu_item menu_mm"><a href="admin_login.php">Admin Login</a></li>
					<li class="menu_item menu_mm"><a href="about.html">About us</a></li>
					<li class="menu_item menu_mm"><a href="services.html">Services</a></li>
					<li class="menu_item menu_mm"><a href="news.html">News</a></li>
					<li class="menu_item menu_mm"><a href="contact.php">Contact</a></li>
				</ul>
			</div>
			<div class="menu_extra">
				<div class="menu_appointment"><a href="appointments.php">Request an Appointment</a></div>
				<div class="menu_emergencies">For Emergencies: +25412345678</div>
			</div>

		</div>

	</div>

	<!-- Menu -->

	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<ul class="menu_list menu_mm">
					<li class="menu_item menu_mm"><a href="index.html">Home</a></li>
					<li class="menu_item menu_mm"><a href="about.html">About us</a></li>
					<li class="menu_item menu_mm"><a href="services.html">Services</a></li>
					<li class="menu_item menu_mm"><a href="news.html">News</a></li>
					<li class="menu_item menu_mm"><a href="contact.html">Contact</a></li>
				</ul>
			</div>
			<div class="menu_extra">
				<div class="menu_appointment"><a href="appointments.php">Request an Appointment</a></div>
				<div class="menu_emergencies">For Emergencies: 254 712345678</div>
			</div>

		</div>

	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/contact.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title"><span>MediFlow</span> News</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li>Contact</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->
<div class="contact">
    <div class="container">
        <div class="row">

            <!-- Contact Info -->
            <div class="col-lg-6">
                <div class="section_title"><h2>Get in touch</h2></div>
                <div class="contact_text">
                    <p>We are here to answer your questions and provide the support you need. Reach out to us for appointments, inquiries, or any assistance regarding our hospital services.</p>
                </div>
                <ul class="contact_about_list">
                    <li><div class="contact_about_icon"><img src="images/phone-call.svg" alt=""></div><span>+254 712345678</span></li>
                    <li><div class="contact_about_icon"><img src="images/envelope.svg" alt=""></div><span>info@mediflow.com</span></li>
                    <li><div class="contact_about_icon"><img src="images/placeholder.svg" alt=""></div><span>Main St. 45-46, Nairobi, Kenya</span></li>
                </ul>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6 form_col">
                <div class="contact_form_container">
                    <form method="POST" name="form1" action="<?php echo $editFormAction; ?>" id="contact_form" class="contact_form">
                        <div class="row">
                            <div class="col-md-6 input_col">
                                <div class="input_container input_name"><input type="text" name="name" class="contact_input" placeholder="Name" required="required"></div>
                            </div>
                            <div class="col-md-6 input_col">
                                <div class="input_container"><input type="email" class="contact_input" name="email" placeholder="E-mail" required="required"></div>
                            </div>
                        </div>
                        <div class="input_container"><input type="text" class="contact_input" name="subject" placeholder="Subject" required="required"></div>
                        <div class="input_container"><textarea class="contact_input contact_text_area" name="message" placeholder="Message" required="required"></textarea></div>
						
                        <button class="button contact_button">Submit Message</a>
                        <input type="hidden" name="MM_insert" value="form1">
                        </button>
                  </form>
                </div>
            </div>
        </div>
        <div class="row map_row">
            <div class="col">

                <!-- Contact Map -->
                <div class="contact_map">
                    <!-- Google Map -->
                    <div class="map">
                        <div id="google_map" class="google_map">
                            <div class="map_container">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="box working_hours">
                        <div class="box_icon d-flex flex-column align-items-start justify-content-center"><div style="width:29px; height:29px;"><img src="images/alarm-clock.svg" alt=""></div></div>
                        <div class="box_title">Working Hours</div>
                        <div class="working_hours_list">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div>Monday – Friday</div>
                                    <div class="ml-auto">8.00 – 19.00</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div>Saturday</div>
                                    <div class="ml-auto">9.30 – 17.00</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div>Sunday</div>
                                    <div class="ml-auto">9.30 – 15.00</div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer_container">
        <div class="container">
            <div class="row">
                
                <!-- Footer - About -->
                <div class="col-lg-4 footer_col">
                    <div class="footer_about">
                        <div class="footer_logo_container">
                            <a href="#" class="d-flex flex-column align-items-center justify-content-center">
                                <div class="logo_content">
                                    <div class="logo d-flex flex-row align-items-center justify-content-center">
                                        <div class="logo_text">Medi<span>Flow</span></div>
                                        <div class="logo_box"><i class="fa-solid fa-plus" style="color:#ffffff;"></i></div>
                                    </div>
                                    <div class="logo_sub">Smart Health System</div>
                                </div>
                            </a>
                        </div>
                        <div class="footer_about_text">
                            <p>MediFlow Hospital is dedicated to providing quality healthcare with compassion and innovation. Your health and well-being are our mission.</p>
                        </div>
                        <ul class="footer_about_list">
                            <li><div class="footer_about_icon"><img src="images/phone-call.svg" alt=""></div><span>+254 712345678</span></li>
                            <li><div class="footer_about_icon"><img src="images/envelope.svg" alt=""></div><span>info@mediflow.com</span></li>
                            <li><div class="footer_about_icon"><img src="images/placeholder.svg" alt=""></div><span>Main St. 45-46, Nairobi, Kenya</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Footer - Links -->
                <div class="col-lg-4 footer_col">
                    <div class="footer_links footer_column">
                        <div class="footer_title">Useful Links</div>
                        <ul>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Our Partners</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Footer - News -->
                <div class="col-lg-4 footer_col">
                    <div class="footer_news footer_column">
                        <div class="footer_title">Latest News</div>
                        <ul>
                            <li>
                                <div class="footer_news_title"><a href="news.html">New Pediatric Wing Opened</a></div>
                                <div class="footer_news_date">September 2025</div>
                            </li>
                            <li>
                                <div class="footer_news_title"><a href="news.html">Free Health Checkup Camp</a></div>
                                <div class="footer_news_date">August 2025</div>
                            </li>
                            <li>
                                <div class="footer_news_title"><a href="news.html">Awarded Best Hospital 2025</a></div>
                                <div class="footer_news_date">July 2025</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="copyright_content d-flex flex-lg-row flex-column align-items-lg-center justify-content-start">
                        <div class="cr">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            MediFlow Hospital. All rights reserved.
                        </div>
                      <div class="footer_social ml-lg-auto">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                      </div>
                    </div>
                </div>
            </div>			
        </div>
    </div>
</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="js/contact.js"></script>
</body>
</html>