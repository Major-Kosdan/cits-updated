<?php
require "config/database.php"; // Include database connection

// Check if the form is submitted
if(isset($_POST['apply_button'])) {

    // Collect form data
    $first_name = trim(mysqli_real_escape_string($conn, $_POST['first_name']));
    $middle_name = trim(mysqli_real_escape_string($conn, $_POST['middle_name']));
    $last_name = trim(mysqli_real_escape_string($conn, $_POST['last_name']));
    $address = trim(mysqli_real_escape_string($conn, $_POST['address']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $phone_number = trim(mysqli_real_escape_string($conn, $_POST['phone_number']));
    $course = trim(mysqli_real_escape_string($conn, $_POST['course']));
    
    date_default_timezone_set("Africa/Lagos");
    $date = date('1 M d, Y');
    $time = date('h:ia');

    // Check if the user is already registered
    $select = mysqli_query($conn, "SELECT * FROM course_application where email='$email'");
    if(mysqli_num_rows($select) > 0) {
        echo "<button class='message_error'>Email Already Registered!</button>";
    } else {
        // Insert data into the database
        $insert = mysqli_query($conn, "INSERT INTO course_application (first_name, middle_name, last_name, address, email, phone_number, course) VALUES('$first_name','$middle_name','$last_name','$address','$email','$phone_number','$course')");
        
        if($insert) {
            echo "<button class='message_success' id='success_message'>Successfully Registered!</button>";

            // Create a text file with the form data
            $file_content = "First Name: $first_name\nMiddle Name: $middle_name\nLast Name: $last_name\nAddress: $address\nEmail: $email\nPhone Number: $phone_number\nCourse: $course\n";
            $file_name = "submission_" . time() . ".txt"; // Unique file name based on the current time
            
            // Save the file to the server
            file_put_contents($file_name, $file_content);

            // Provide a download link for the file (hidden by default)
            echo "<a href='$file_name' class='download-link' id='download_link' style='display:none' download>Download Your Submission</a>";

            // Trigger the download after a slight delay (to display the success message)
            echo "<script>
                    setTimeout(function() {
                        document.getElementById('download_link').click();
                    }, 2000); // Delay the download by 2 seconds
                  </script>";
        }
    }
}

// Retrieve the course from the query parameter
$selectedCourse = isset($_GET['course']) ? rawurldecode($_GET['course']) : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT Course Form</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<div class="form-container">
    <div class="form-header">
        <img src="logoo..png" alt="Logo" class="logo">
        <h2>Apply by entering your details and selecting your courses to proceed!</h2>
    </div>

    <form action="#" method="POST" class="form">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="middle_name" placeholder="Middle Name">
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="address" placeholder="Address (Street, City, State)" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="tel" name="phone_number" placeholder="Phone Number" required>
        <select name="course" required>
            <option value="">Select Your Desired Course</option>
            <option value="Artificial Intelligence" <?php if ($selectedCourse == 'Artificial Intelligence') echo 'selected'; ?>>Artificial Intelligence</option>
            <option value="AUTOCAD/REVIT" <?php if ($selectedCourse == 'AUTOCAD/REVIT') echo 'selected'; ?>>AUTOCAD/REVIT</option>
            <option value="App Development" <?php if ($selectedCourse == 'App Development') echo 'selected'; ?>>App Development</option>
            <option value="Back-End Programming" <?php if ($selectedCourse == 'Back-End Programming') echo 'selected'; ?>>Back-End Programming</option>
            <option value="Basics of Computer" <?php if ($selectedCourse == 'Basics of Computer') echo 'selected'; ?>>Basics of Computer</option>
            <option value="Programming Essentials in C" <?php if ($selectedCourse == 'Programming Essentials in C') echo 'selected'; ?>>Programming Essentials in C</option>
            <option value="Programming Essentials in C++" <?php if ($selectedCourse == 'Programming Essentials in C++') echo 'selected'; ?>>Programming Essentials in C++</option>
            <option value="CCTV Training" <?php if ($selectedCourse == 'CCTV Training') echo 'selected'; ?>>CCTV Training</option>
            <option value="Coding/Programming" <?php if ($selectedCourse == 'Coding/Programming') echo 'selected'; ?>>Coding/Programming</option>
            <option value="Cyber Security" <?php if ($selectedCourse == 'Cyber Security') echo 'selected'; ?>>Cyber Security</option>
            <option value="Data Analytics" <?php if ($selectedCourse == 'Data Analytics') echo 'selected'; ?>>Data Analytics</option>
            <option value="Fiber Optics" <?php if ($selectedCourse == 'Fiber Optics') echo 'selected'; ?>>Fiber Optics</option>
            <option value="NDG in Linux Essentials" <?php if ($selectedCourse == 'NDG in Linux Essentials') echo 'selected'; ?>>NDG in Linux Essentials</option>
            <option value="Graphic Design" <?php if ($selectedCourse == 'Graphic Design') echo 'selected'; ?>>Graphic Design</option>
            <option value="Programming Essentials in Python" <?php if ($selectedCourse == 'Programming Essentials in Python') echo 'selected'; ?>>Programming Essentials in Python</option>
            <option value="UI/UX Design" <?php if ($selectedCourse == 'UI/UX Design') echo 'selected'; ?>>UI/UX Design</option>
            <option value="Video Editing" <?php if ($selectedCourse == 'Video Editing') echo 'selected'; ?>>Video Editing</option>
            <option value="Website Design" <?php if ($selectedCourse == 'Website Design') echo 'selected'; ?>>Website Design</option>
        </select>
        <button type="submit" name="apply_button" value="apply_now">Apply Now</button>
    </form>
    <p class="reminder_message">Please make sure to review all your details before applying.</p>
    <a href="academy.html" class="back-link">Go back to Academy Page &#8594;</a>
</div>
</body>
</html>
