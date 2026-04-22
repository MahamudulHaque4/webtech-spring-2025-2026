<?php
$nameErr = $emailErr = $websiteErr = $genderErr = "";
$name = $email = $website = $gender = $comment = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Name  Part
    if(empty($_POST["name"])) {
        $nameErr = "Name is Required";
    }
    else{
        $name = cleanInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Email Part
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Website Part
    $website = cleanInput($_POST["website"] ?? "");
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
        $websiteErr = "Invalid URL";
    }

    // Gender Part
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = cleanInput($_POST["gender"]);
    }

    // Comment Part 
    $comment = cleanInput($_POST["comment"] ?? "");
    
}
    // $hasError = $nameErr || $emailErr || $websiteErr || $genderErr;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Mahamudul Haque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="index.html" class="logo">Mahamudul's <span>Portfolio</span></a>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="aboutme.html">About Me</a></li>
                    <li><a href="education.html">Education</a></li>
                    <li><a href="info.html">Personal Info</a></li>
                    <li><a href="achivement.html">Achievements</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2>Get in Touch</h2>
        <p>If you'd like to reach out, please fill out the form below or check out my <a href="https://github.com" target="_blank">GitHub profile</a>.</p>
        
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="contact-form">

            <!-- Name Part -->
            <div class="form-group">
                <label for="name">Name: *</label>
                <input 
                    type="text" 
                    name="name" 
                    value="<?= htmlspecialchars($name) ?>" 
                    placeholder="Your Full Name"
                    required
                     >
                <span class="error"><?=$nameErr?></span>
            </div>

            <!-- Email Part -->
            <div class="form-group">
                <label for="email">Email: *</label>
                <input 
                    type="email"  
                    name="email" 
                    value= "<?= htmlspecialchars($email) ?>"
                    placeholder="your.email@example.com" 
                    required
                    >
                <span class="error">
                    <?= $emailErr ?>
                </span>
            </div>

            <!-- Website Part (Optional)-->
            <div class="form-group">
                <label for="website">Website:</label>
                <input 
                     type="text" 
                     name="website" 
                     value="<?= htmlspecialchars($website) ?>"
                     placeholder="https://yourwebsite.com"
                     >
                <span class="error">
                    <?= $websiteErr ?>
                </span>
            </div>

            <!-- Gender Part Optional -->
            <fieldset class="gender-group">
                <legend>Gender: *</legend>
                <label>
                    <input type="radio" name="gender" value="male" <?=($gender == "male") ? "checked" : "" ?> required > Male
                </label>
                <label>
                    <input type="radio" name="gender" value="female" <?=($gender == "female") ? "checked" : "" ?>> Female
                </label>
                <label>
                    <input type="radio" name="gender" value="other" <?=($gender == "other") ? "checked" : "" ?>> Other
                </label>
                <span class="error">
                  <?= $genderErr ?>
                </span>
            </fieldset>

            <!-- Comment Part -->
            <div class="form-group">
                <label for="comment">Comment: </label>
                <textarea 
                    name="comment" 
                    placeholder="Write your message here..." 
                    rows="4" 
                    >
                    <?= htmlspecialchars($comment) ?>
                </textarea>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && 
              !$nameErr || !$emailErr || !$websiteErr || !$genderErr): ?>

           <!-- <script>
             console.log("Form Submitted Data:");
             console.log("Name: <?= htmlspecialchars($name) ?>");
             console.log("Email: <?= htmlspecialchars($email) ?>");
             console.log("Website: <?= htmlspecialchars($website) ?>");
             console.log("Comment: <?= htmlspecialchars($comment) ?>");
             console.log("Gender: <?= htmlspecialchars($gender) ?>");
           </script> -->

           <div class="result-box">
             <h3>Submitted Values</h3>
               <p><strong>Name:</strong> <?= htmlspecialchars($name) ?> </p>
               <p><strong>Email:</strong> <?= htmlspecialchars($email) ?> </p>
               <p><strong>Website:</strong> <?= htmlspecialchars($website) ?> </p>
               <p><strong>Comment:</strong> <?= htmlspecialchars($comment) ?> </p>
               <p><strong>Gender:</strong> <?= htmlspecialchars($gender) ?> </p> 
            </div>

        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 Mahamudul Haque. All rights reserved.</p>
    </footer>
</body>
</html>