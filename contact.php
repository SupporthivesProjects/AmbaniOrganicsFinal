<?php require 'header.php'; ?>

<!-- Add custom styles for the alert -->
<style>
    .success-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        background-color: #28a745;
        color: white;
        transform: translateX(120%);
        transition: transform 0.4s ease-in-out;
        opacity: 0;
    }
    
    .success-alert.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .success-alert h4 {
        margin-top: 0;
        font-weight: 600;
    }
    
    .success-alert .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: transparent;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }
    
    .success-alert .icon {
        display: inline-block;
        width: 30px;
        height: 30px;
        background-color: white;
        border-radius: 50%;
        color: #28a745;
        text-align: center;
        line-height: 30px;
        margin-right: 10px;
        font-size: 16px;
    }
    
    .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background-color: rgba(255,255,255,0.7);
        width: 100%;
        border-radius: 0 0 8px 8px;
        transform-origin: left;
        animation: progress 3s linear forwards;
    }
    
    @keyframes progress {
        0% {
            transform: scaleX(1);
        }
        100% {
            transform: scaleX(0);
        }
    }
</style>

<!-- Contact -->
<section id="contact" class="section-6 odd form contact">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 pr-md-5 align-self-center text">
                <div class="row intro">
                    <div class="col-12 p-0">
                        <span class="pre-title m-0" style="color: #058283;font-size: 24px;">Send a message</span>
                        <h2>CONTACT US</h2>
                        <p style="color: #058283;font-size: 1.2rem;">We welcome you to contact us for more information about any of our products or services.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-0">
                        <?php
                        // Initialize variables
                        $messageSent = false;
                        $errorMessage = '';

                        // Process form submission
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Get form data
                            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
                            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
                            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
                            $info = isset($_POST['info']) ? trim($_POST['info']) : '';
                            $message = isset($_POST['message']) ? trim($_POST['message']) : '';

                            // Validate form data
                            if (empty($name) || empty($email) || empty($message)) {
                                $errorMessage = 'Please fill in all required fields (Name, Email, and Message).';
                            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $errorMessage = 'Please enter a valid email address.';
                            } else {
                                // Set up email to company
                                $to_company = 'info@ambaniorgochem.com';
                                $subject_company = 'New Contact Form Submission from ' . $name;
                                
                                // Company email template
                                $message_company = '
                                <!DOCTYPE html>
                                <html>
                                <head>
                                    <style>
                                        body {
                                            font-family: Arial, sans-serif;
                                            line-height: 1.6;
                                            color: #333;
                                        }
                                        .container {
                                            max-width: 600px;
                                            margin: 0 auto;
                                            padding: 20px;
                                            border: 1px solid #ddd;
                                            border-radius: 5px;
                                        }
                                        .header {
                                            background-color: #343a40;
                                            color: white;
                                            padding: 15px;
                                            text-align: center;
                                            border-radius: 5px 5px 0 0;
                                        }
                                        .content {
                                            padding: 20px;
                                            background-color: #f9f9f9;
                                        }
                                        .footer {
                                            text-align: center;
                                            padding: 10px;
                                            font-size: 12px;
                                            color: #777;
                                        }
                                        .info-item {
                                            margin-bottom: 10px;
                                        }
                                        .label {
                                            font-weight: bold;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <div class="header">
                                            <h2>New Contact Form Submission</h2>
                                        </div>
                                        <div class="content">
                                            <p>You have received a new message from your website contact form.</p>
                                            
                                            <div class="info-item">
                                                <span class="label">Name:</span> ' . htmlspecialchars($name) . '
                                            </div>
                                            
                                            <div class="info-item">
                                                <span class="label">Email:</span> ' . htmlspecialchars($email) . '
                                            </div>
                                            
                                            <div class="info-item">
                                                <span class="label">Phone:</span> ' . htmlspecialchars($phone) . '
                                            </div>
                                            
                                            <div class="info-item">
                                                <span class="label">Inquiry About:</span> ' . htmlspecialchars($info) . '
                                            </div>
                                            
                                            <div class="info-item">
                                                <span class="label">Message:</span>
                                                <p>' . nl2br(htmlspecialchars($message)) . '</p>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <p>This email was sent from your website contact form.</p>
                                        </div>
                                    </div>
                                </body>
                                </html>';
                                
                                // Set up email to user (confirmation)
                                $to_user = $email;
                                $subject_user = 'Thank you for contacting Ambani Organics';
                                
                                // User email template
                                $message_user = '
                                <!DOCTYPE html>
                                <html>
                                <head>
                                    <style>
                                        body {
                                            font-family: Arial, sans-serif;
                                            line-height: 1.6;
                                            color: #333;
                                        }
                                        .container {
                                            max-width: 600px;
                                            margin: 0 auto;
                                            padding: 20px;
                                            border: 1px solid #ddd;
                                            border-radius: 5px;
                                        }
                                        .header {
                                            background-color: #28a745;
                                            color: white;
                                            padding: 15px;
                                            text-align: center;
                                            border-radius: 5px 5px 0 0;
                                        }
                                        .content {
                                            padding: 20px;
                                            background-color: #f9f9f9;
                                        }
                                        .footer {
                                            text-align: center;
                                            padding: 10px;
                                            font-size: 12px;
                                            color: #777;
                                        }
                                        .contact-info {
                                            margin-top: 20px;
                                            padding: 15px;
                                            background-color: #f0f0f0;
                                            border-radius: 5px;
                                        }
                                        .contact-item {
                                            margin-bottom: 8px;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <div class="header">
                                            <h2>Thank You for Contacting Us</h2>
                                        </div>
                                        <div class="content">
                                            <p>Dear ' . htmlspecialchars($name) . ',</p>
                                            
                                            <p>Thank you for reaching out to Ambani Organics. We have received your inquiry and will get back to you as soon as possible.</p>
                                            
                                            <p>Here\'s a summary of the information you provided:</p>
                                            <ul>
                                                <li><strong>Name:</strong> ' . htmlspecialchars($name) . '</li>
                                                <li><strong>Email:</strong> ' . htmlspecialchars($email) . '</li>
                                                <li><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</li>
                                                <li><strong>Inquiry About:</strong> ' . htmlspecialchars($info) . '</li>
                                                <li><strong>Message:</strong> ' . nl2br(htmlspecialchars($message)) . '</li>
                                            </ul>
                                            
                                            <div class="contact-info">
                                                <p><strong>Our Contact Information:</strong></p>
                                                <div class="contact-item">
                                                    <strong>Phone:</strong> 022 2682 7541, 022-26822027 / 28 / 29
                                                </div>
                                                <div class="contact-item">
                                                    <strong>Email:</strong> info@ambaniorgochem.com
                                                </div>
                                                <div class="contact-item">
                                                    <strong>Address:</strong> 801, 8th Floor, 351 - ICON, Next to Natraj Rustomji, Western Express Highway, Andheri East, Mumbai, Maharashtra 400006
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <p>&copy; ' . date('Y') . ' Ambani Organics. All rights reserved.</p>
                                        </div>
                                    </div>
                                </body>
                                </html>';
                                
                                // Set headers for HTML emails
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                $headers .= 'From: Ambani Organics <info@ambaniorgochem.com>' . "\r\n";
                                $headers .= 'Reply-To: ' . $email . "\r\n";
                                
                                // Send email to company
                                $mail_company = mail($to_company, $subject_company, $message_company, $headers);
                                
                                // Set headers for user confirmation email
                                $headers_user = "MIME-Version: 1.0" . "\r\n";
                                $headers_user .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                $headers_user .= 'From: Ambani Organics <info@ambaniorgochem.com>' . "\r\n";
                                
                                // Send confirmation email to user
                                $mail_user = mail($to_user, $subject_user, $message_user, $headers_user);
                                
                                if ($mail_company && $mail_user) {
                                    $messageSent = true;
                                } else {
                                    $errorMessage = 'Sorry, there was an error sending your message. Please try again later.';
                                }
                            }
                        }
                        ?>

                        <!-- Floating success alert -->
                        <?php if ($messageSent): ?>
                        <div id="successAlert" class="success-alert">
                            <button type="button" class="close-btn" onclick="closeAlert()">&times;</button>
                            <div class="icon"><i class="fas fa-check"></i></div>
                            <h4>Message Sent Successfully!</h4>
                            <p>Thank you for contacting us. We have received your message and will get back to you shortly.</p>
                            <div class="progress-bar"></div>
                        </div>
                        
                        <script>
                            // Show the alert
                            document.addEventListener('DOMContentLoaded', function() {
                                setTimeout(function() {
                                    document.getElementById('successAlert').classList.add('show');
                                }, 100);
                                
                                // Hide the alert after 3 seconds
                                setTimeout(function() {
                                    closeAlert();
                                }, 3000);
                            });
                            
                            function closeAlert() {
                                var alert = document.getElementById('successAlert');
                                alert.classList.remove('show');
                                setTimeout(function() {
                                    alert.style.display = 'none';
                                }, 400);
                            }
                        </script>
                        <?php endif; ?>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="nexgen-simple-form" class="nexgen-simple-form">
                            <?php if (!empty($errorMessage)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $errorMessage; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="row form-group-margin">
                                <div class="col-12 col-md-6 m-0 p-2 input-group">
                                    <input type="text" name="name" class="form-control field-name" placeholder="Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                                </div>
                                <div class="col-12 col-md-6 m-0 p-2 input-group">
                                    <input type="email" name="email" class="form-control field-email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                </div>
                                <div class="col-12 col-md-6 m-0 p-2 input-group">
                                    <input type="text" name="phone" class="form-control field-phone" placeholder="Phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                                </div>
                                <div class="col-12 col-md-6 m-0 p-2 input-group">
                                    <i class="fa-solid fa-chevron-down icon-arrow-down mr-3"></i>
                                    <select name="info" class="form-control field-info">
                                        <option value="" <?php echo !isset($_POST['info']) || empty($_POST['info']) ? 'selected' : ''; ?> disabled="">More Info</option>
                                        <option <?php echo isset($_POST['info']) && $_POST['info'] == 'Organic Peroxides' ? 'selected' : ''; ?>>Organic Peroxides</option>
                                        <option <?php echo isset($_POST['info']) && $_POST['info'] == 'Paint Drivers' ? 'selected' : ''; ?>>Paint Drivers</option>
                                        <option <?php echo isset($_POST['info']) && $_POST['info'] == 'Accelerators' ? 'selected' : ''; ?>>Accelerators</option>
                                        <option <?php echo isset($_POST['info']) && $_POST['info'] == 'Acrylic Emulsion' ? 'selected' : ''; ?>>Acrylic Emulsion</option>
                                        <option <?php echo isset($_POST['info']) && $_POST['info'] == 'Silver-Ion Disinfectants' ? 'selected' : ''; ?>>Silver-Ion Disinfectants</option>
                                        <option <?php echo isset($_POST['info']) && $_POST['info'] == 'Pharmacetical Industry' ? 'selected' : ''; ?>>Pharmacetical Industry</option>
                                        <option <?php echo isset($_POST['info']) && $_POST['info'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                                <div class="col-12 m-0 p-2 input-group">
                                    <textarea name="message" class="form-control field-message" placeholder="Message"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                                </div>
                                <div class="col-12 col-12 m-0 p-2 input-group">
                                    <span class="form-alert" style="display: none;"></span>
                                </div>
                                <div class="col-12 input-group m-0 p-2">
                                    <button type="submit" class="btn primary-button">SEND</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="contacts">
                    <h4>VISIT OUR OFFICE</h4>
                    
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="tel:02226827541" class="nav-link">
                                <i class="fa-solid fa-phone mr-2"></i>
                                <b>Phone:</b> <br> 022 2682 7541, 022-26822027 / 28 / 29
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mailto:info@ambaniorgochem.com" class="nav-link">
                                <i class="fas fa-envelope mr-2"></i>
                                <b>Email:</b> info@ambaniorgochem.com
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <b>Address:</b> <br> 801, 8th Floor, 351 - ICON, Next to Natraj Rustomji, Western Express Highway, Andheri East, Mumbai, Maharashtra 400006
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="mt-2 btn outline-button" data-toggle="modal" data-target="#map">VIEW MAP</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Add a custom script for form validation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('nexgen-simple-form');
    
    if (form) {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const name = form.querySelector('.field-name');
            const email = form.querySelector('.field-email');
            const message = form.querySelector('.field-message');
            const formAlert = form.querySelector('.form-alert');
            
            // Reset previous error messages
            formAlert.style.display = 'none';
            formAlert.textContent = '';
            
            // Remove previous error classes
            [name, email, message].forEach(field => {
                if (field) field.classList.remove('is-invalid');
            });
            
            // Validate name
            if (!name.value.trim()) {
                name.classList.add('is-invalid');
                isValid = false;
            }
            
            // Validate email
            if (!email.value.trim()) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email.value.trim())) {
                    email.classList.add('is-invalid');
                    isValid = false;
                }
            }
            
            // Validate message
            if (!message.value.trim()) {
                message.classList.add('is-invalid');
                isValid = false;
            }
            
            // Show error message if validation fails
            if (!isValid) {
                event.preventDefault();
                formAlert.textContent = 'Please fill in all required fields correctly.';
                formAlert.style.display = 'block';
                formAlert.classList.add('text-danger');
            }
        });
    }
    
    // If form was successfully submitted, reset the form
    <?php if ($messageSent): ?>
    if (form) {
        form.reset();
    }
    <?php endif; ?>
});
</script>

<?php require 'footer.php'; ?>

