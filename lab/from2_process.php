<?php
// --- Declarations ---
$nameErr = $postalErr = $dobErr = $emailErr = $passwordErr = $countryErr = "";
$name = $postal = $dob = $email = $password = $country = "";
$isValid = false;

$countries = ["United States", "United Kingdom", "Canada", "Australia", "Bangladesh"];

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name Validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = cleanInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters, spaces, hyphens, and apostrophes allowed";
        } elseif (strlen($name) < 3) {
            $nameErr = "Name must be at least 3 characters";
        }
    }

    // Postal Code Validation
    if (empty($_POST["postal"])) {
        $postalErr = "Enter your postal code";
    } else {
        $postal = cleanInput($_POST["postal"]);
        if (!preg_match("/^[0-9]{4,10}$/", $postal)) {
            $postalErr = "Postal code must be 4-10 digits";
        }
    }
   
    // Date of Birth Validation
    if (empty($_POST["dob"])) {
        $dobErr = "Enter your date of birth";
    } else {
        $dob = cleanInput($_POST["dob"]);
        $today = new DateTime();
        $birth = DateTime::createFromFormat("Y-m-d", $dob);
        
        if (!$birth || $birth->format("Y-m-d") !== $dob) {
            $dobErr = "Enter a valid date in YYYY-MM-DD format";
        } elseif ($birth > $today) {
            $dobErr = "Date of birth cannot be in the future";
        }
    }

    // Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Password Validation
    if (empty($_POST["password"])) {
        $passwordErr = "Enter a password";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters";
        } elseif (!preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", $password)) {
            $passwordErr = "Password must contain at least 1 letter and 1 number";
        }
    }

    // Country Validation
    if (empty($_POST["country"])) {
        $countryErr = "Select a country";
    } else {
        $country = cleanInput($_POST["country"]);
        if (!in_array($country, $countries, true)) {
            $countryErr = "Invalid country selected";
        }
    }

    // Final Check
    $isValid = empty($nameErr) && empty($postalErr) && empty($dobErr) 
            && empty($emailErr) && empty($passwordErr) && empty($countryErr);
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Student Registration</h2>
<p><span style="color:red">* required field</span></p>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $isValid): ?>
    <div style="color: green; font-weight: bold;">
        <h3>Registration Successful!</h3>
        <p>Name: <?= $name ?></p>
        <p>Postal Code: <?= $postal ?></p>
        <p>Date of Birth: <?= $dob ?></p>
        <p>Email: <?= $email ?></p>
        <p>Country: <?= $country ?></p>
    </div>
<?php else: ?>

<form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?= $name ?>">
    <span style="color:red">* <?= $nameErr ?></span><br><br>

    Postal Code: <input type="text" name="postal" value="<?= $postal ?>">
    <span style="color:red">* <?= $postalErr ?></span><br><br>

    Date of Birth: <input type="date" name="dob" value="<?= $dob ?>">
    <span style="color:red">* <?= $dobErr ?></span><br><br>

    Email: <input type="text" name="email" value="<?= $email ?>">
    <span style="color:red">* <?= $emailErr ?></span><br><br>

    Password: <input type="password" name="password" value="">
    <span style="color:red">* <?= $passwordErr ?></span><br><br>

    Country: 
    <select name="country">
        <option value="">-- Select Country --</option>
        <?php foreach ($countries as $c): ?>
            <option value="<?= $c ?>" <?= ($country === $c) ? "selected" : "" ?>><?= $c ?></option>
        <?php endforeach; ?>
    </select>
    <span style="color:red">* <?= $countryErr ?></span><br><br>

    <input type="submit" value="Register">
</form>

<?php endif; ?>

</body>
</html>