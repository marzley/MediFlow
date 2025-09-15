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
  $insertSQL = sprintf("INSERT INTO appointments (full_name, email, phone, dob, doctor_id, appointment_date, appointment_time, reason) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['full_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['dob'], "date"),
                       GetSQLValueString($_POST['doctor_id'], "text"),
                       GetSQLValueString($_POST['appointment_date'], "date"),
                       GetSQLValueString($_POST['appointment_time'], "date"),
                       GetSQLValueString($_POST['reason'], "text"));

  mysql_select_db($database_MEDIC, $MEDIC);
  $Result1 = mysql_query($insertSQL, $MEDIC) or die(mysql_error());

  $insertGoTo = "Success.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html>
<html lang="en">
<head>
<title>booking appointment</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="CareMed demo project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" type="text/css" href="plugins/greensock/animate.css">
<link rel="stylesheet" type="text/css" href="styles/about.css">
<link rel="stylesheet" type="text/css" href="styles/about_responsive.css">
</head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>


    	<header class="header trans_200">
		
			<!-- Top Bar -->
			<div class="top_bar">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<div class="top_bar_item"><a href="about.html">FAQ</a></div>
								<div class="top_bar_item"><a href="appointment.php">Request an Appointment</a></div>
								<div class="top_bar_item"><a href="contact.php">Emergency</a></div>
								<div class="top_bar_item"><a href="contact.php">Support</a></div>
								<div
									class="emergencies d-flex flex-row align-items-center justify-content-start ml-auto">
									<i class="fa fa-phone" aria-hidden="true" style="margin-right:6px;"></i>
									<span>For Emergencies: +254 712345678</span>
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
										<div
											class="logo_content d-flex flex-column align-items-start justify-content-center">
											<div class="logo_line"></div>
											<div class="logo d-flex flex-row align-items-center justify-content-center">
												<div class="logo_text">Medi<span>Flow</span></div>
												<div class="logo_box">
													<i class="fa-solid fa-plus" style="color:#ffffff;"></i>
												</div>
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
					<li class="menu_item menu_mm"><a href="about.html">About us</a></li>
					<li class="menu_item menu_mm"><a href="services.html">Services</a></li>
					<li class="menu_item menu_mm"><a href="news.html">News</a></li>
					<li class="menu_item menu_mm"><a href="contact.html">Contact</a></li>
				</ul>
			</div>
			<div class="menu_extra">
				<div class="menu_appointment"><a href="#">Request an Appointment</a></div>
				<div class="menu_emergencies">For Emergencies: +563 47558 623</div>
			</div>

		</div>

	</div>

    <div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/about.jpg" data-speed="0.8"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">Bookings<span> Appointments</span></div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="#">Home</a></li>
									<li>Book Appointment</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<style>
/* Enhanced Responsive Card Style for Appointment Form */
#appointmentForm {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
    padding: 2.5rem 2rem 2rem 2rem;
    margin: 40px auto 40px auto;
    max-width: 700px;
    animation: fadeInUp 1s cubic-bezier(.39,.575,.565,1.000);
    position: relative;
    z-index: 2;
}
#appointmentForm label {
    font-weight: 600;
    color: #1e3557;
    letter-spacing: 0.5px;
    margin-bottom: 0.3rem;
}
#appointmentForm input, #appointmentForm select, #appointmentForm textarea {
    border-radius: 8px;
    border: 1px solid #e0e6ed;
    background: #f8fafc;
    transition: border-color 0.2s;
    margin-bottom: 0.8rem;
}
#appointmentForm input:focus, #appointmentForm select:focus, #appointmentForm textarea:focus {
    border-color: #3eb7ff;
    background: #fff;
    box-shadow: 0 0 0 2px #3eb7ff22;
}
#appointmentForm button[type="submit"] {
    background: linear-gradient(90deg, #3eb7ff 0%, #1e3557 100%);
    border: none;
    color: #fff;
    font-weight: 600;
    border-radius: 25px;
    padding: 0.75rem 2.5rem;
    font-size: 1.1rem;
    box-shadow: 0 4px 16px 0 rgba(62,183,255,0.12);
    transition: background 0.3s, transform 0.2s;
    margin-top: 0.5rem;
}
#appointmentForm button[type="submit"]:hover {
    background: linear-gradient(90deg, #1e3557 0%, #3eb7ff 100%);
    transform: translateY(-2px) scale(1.03);
}
#formMessage .alert {
    animation: fadeIn 0.7s;
}
@media (max-width: 900px) {
    #appointmentForm {
        max-width: 98vw;
        padding: 1.2rem 0.7rem;
    }
}
@media (max-width: 600px) {
    .form-row {
        flex-direction: column !important;
    }
    .form-row > div {
        width: 100% !important;
    }
}
@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(40px);}
    100% { opacity: 1; transform: translateY(0);}
}
@keyframes fadeIn {
    from { opacity: 0;}
    to { opacity: 1;}
}
/* Decorative background shapes */
.form-bg-anim {
    position: absolute;
    top: -60px;
    left: -60px;
    width: 180px;
    height: 180px;
    background: radial-gradient(circle at 60% 40%, #3eb7ff33 60%, transparent 100%);
    border-radius: 50%;
    z-index: 1;
    animation: float1 6s ease-in-out infinite alternate;
}
.form-bg-anim2 {
    position: absolute;
    bottom: -60px;
    right: -60px;
    width: 140px;
    height: 140px;
    background: radial-gradient(circle at 40% 60%, #1e355733 60%, transparent 100%);
    border-radius: 50%;
    z-index: 1;
    animation: float2 7s ease-in-out infinite alternate;
}
@keyframes float1 {
    0% { transform: translateY(0) scale(1);}
    100% { transform: translateY(20px) scale(1.08);}
}
@keyframes float2 {
    0% { transform: translateY(0) scale(1);}
    100% { transform: translateY(-18px) scale(1.04);}
}
</style>

<div class="container py-5 position-relative" style="z-index:2;">
    <div class="form-bg-anim"></div>
    <div class="form-bg-anim2"></div>
    <h2 class="mb-4 text-center" style="font-weight:700; color:#1e3557; letter-spacing:1px; animation: fadeIn 1.2s;">Book an Appointment</h2>
    <form method="POST" action="<?php echo $editFormAction; ?>" name="form1" id="appointmentForm" class="needs-validation shadow-lg" novalidate>
        <div class="d-flex flex-row gap-3 form-row">
            <div class="flex-fill">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" id="fullName" name="full_name" class="form-control" required autocomplete="name">
            </div>
            <div class="flex-fill">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required autocomplete="email">
            </div>
            <div class="flex-fill">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-control" required pattern="^\+?\d{7,15}$" autocomplete="tel">
            </div>
        </div>
        <div class="d-flex flex-row gap-3 form-row">
            <div class="flex-fill">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" required>
            </div>
            <div class="flex-fill">
                <label for="doctor" class="form-label">Doctor (by Specialty)</label>
                <select id="doctor" name="doctor_id" class="form-select" required>
                    <option value="">Select Doctor...</option>
                    <!-- Populated by JS -->
                </select>
            </div>
        </div>
        <div class="d-flex flex-row gap-3 form-row">
            <div class="flex-fill">
                <label for="date" class="form-label">Appointment Date</label>
                <input type="date" id="date" name="appointment_date" class="form-control" required min="<?= date('Y-m-d') ?>">
            </div>
            <div class="flex-fill">
                <label for="time" class="form-label">Time Slot</label>
                <select id="time" name="appointment_time" class="form-select" required>
                    <option value="">Select Time...</option>
                    <!-- Populated by JS -->
                </select>
            </div>
        </div>
        <div>
            <label for="reason" class="form-label">Reason for Appointment</label>
            <textarea id="reason" name="reason" class="form-control" rows="2" required></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5 shadow"><i class="fa fa-calendar-check"></i> Book Appointment</button>
        </div>
        <input type="hidden" name="MM_insert" value="form1">
    </form>
    <div id="formMessage" class="mt-4"></div>
</div>

<!-- Bootstrap JS & Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
// --- Static Doctor List & Time Slots ---
const doctors = [
    { id: 1, name: "Dr. Kelvin Wanyoike", specialty: "Cardiology" },
    { id: 2, name: "Dr. Sarah Kenya", specialty: "Pediatrics" },
    { id: 3, name: "Dr. Michael Pixel", specialty: "Orthopedics" }
];

// Static available times for all doctors (could be customized per doctor)
const availableTimes = [
    "09:00 AM", "09:30 AM", "10:00 AM", "10:30 AM",
    "11:00 AM", "11:30 AM", "02:00 PM", "02:30 PM",
    "03:00 PM", "03:30 PM", "04:00 PM"
];

// Populate doctor dropdown from static list
function populateDoctors() {
    const $doctor = $('#doctor');
    $doctor.empty().append('<option value="">Select Doctor...</option>');
    doctors.forEach(d => {
        $doctor.append(`<option value="${d.id}">${d.name} (${d.specialty})</option>`);
    });
}

// Populate available time slots from static list
function populateTimes() {
    const doctorId = $('#doctor').val();
    const date = $('#date').val();
    const $time = $('#time');
    if (!doctorId || !date) {
        $time.empty().append('<option value="">Select Time...</option>');
        return;
    }
    $time.empty().append('<option value="">Select Time...</option>');
    availableTimes.forEach(t => {
        $time.append(`<option value="${t}">${t}</option>`);
    });
}

// Validate date > today
$('#date').on('change', function() {
    const today = new Date().toISOString().split('T')[0];
    if ($(this).val() < today) {
        this.setCustomValidity('Date must be today or in the future.');
    } else {
        this.setCustomValidity('');
    }
});

// Doctor/date change triggers time slot update
$('#doctor, #date').on('change', populateTimes);

// Initial load
$(function() {
    populateDoctors();
    $('#date').trigger('change'); // Trigger change to populate times for the first doctor
});
</script>
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
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/progressbar/progressbar.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/about.js"></script>
</body>
</html>