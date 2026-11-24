<?php
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['biodata_form'])) {
    exit("Invalid access.");
}

$valid_universities = ["UPM", "UKM", "UM", "USM", "UTM"];
 
$data = [
    "name"       => trim($_POST['name'] ?? ''),
    "age"        => trim($_POST['age'] ?? ''),
    "gender"     => trim($_POST['gender'] ?? ''),
    "address"    => trim($_POST['address'] ?? ''),
    "email"      => trim($_POST['email'] ?? ''),
    "dob"        => trim($_POST['dob'] ?? ''),
    "height"     => trim($_POST['height'] ?? ''),
    "phone"      => trim($_POST['phone'] ?? ''),
    "color"      => trim($_POST['color'] ?? ''),
    "fbtwig"     => trim($_POST['fbtwig'] ?? ''),
    "photo"      => $_FILES['photo']['name'] ?? null,
    "university" => $_POST['university'] ?? '',
    "matricnum"  => trim($_POST['matricnum'] ?? ''),
    "biodata_form" => $_POST['biodata_form'] ?? ''
];
 
$errors = [];
if ($data['name'] == '') {
    $errors[] = "Please insert your name.";
}

if ($data['age'] == '') {
  $errors[] = "Age must be an integer between 0 and 100.";
}

if (!in_array($data['gender'], ['male', 'female'], true)) {
  $errors[] = "Please select a valid sex.";
}

if ($data['address'] == '') {
  $errors[] = "Please insert your address.";
} elseif (strlen($data['address']) > 255) {
  $errors[] = "Address cannot exceed 255 characters.";
}

if (!preg_match('/.+@.*[Uu][Kk][Mm].*/', $data['email'])) {
  $errors[] = "Please enter a valid email address.";
}

$date = date('Y-m-d', strtotime($data['dob']));
 
if (!$date) {
  $errors[] = "Please enter a valid date of birth.";
}

if ($data['height'] == '' ) {
  $errors[] = "Height must be between 100 and 200 cm.";
} elseif ($data['height'] < 100 || $data['height'] > 200) {
  $errors[] = "Height must be between 100 and 200 cm.";
}

if (!preg_match('/^\+60\d{2}-\d{7}$/', $data['phone'])) {
  $errors[] = "Phone number must follow +60##-####### format.";
}

if (!preg_match('/^#[A-Fa-f0-9]{6}$/', $data['color'])) {
  $errors[] = "Please select a valid colour.";
}

if ($data['fbtwig'] == '') {
  $errors[] = "Please enter a valid URL.";
}

if ($data['photo'] == '') {
  $errors[] = "Select a valid photo.";
}

if (!in_array($data['university'], $valid_universities, true)) {
    $errors[] = "Please select a valid university.";
}

if ($data['matricnum'] == '') {
    $errors[] = "Please insert your matric number.";
}

if (!empty($errors)) {
  echo "<h2>Validation Errors</h2>";
  echo "<ul>";
 
  foreach ($errors as $error) {
      echo "<li>" . $error . "</li>";
  }
 
  echo "</ul>";
 
  echo count($errors) . " error(s) detected.";
  exit();
}
//var_dump($data); exit; // Debugging purposes only. Comment out or remove when done.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate Biodata</title>
</head>
<body>
    <h1>Validate Biodata</h1>

    <p>Please review your information before saving.</p>

    <form action="save_biodata.php" method="post">
        <table border="1" cellpadding="10">

        <tr>
            <td>Name:</td>
            <td><?= $data['name']; ?></td>
        </tr>

        <tr>
            <td>Age:</td>
            <td><?= $data['age']; ?></td>
        </tr>

        <tr>
            <td>Gender:</td>
            <td><?= $data['gender']; ?></td>
        </tr>

        <tr>
            <td>Address:</td>
            <td><?= $data['address']; ?></td>
        </tr>

        <tr>
            <td>Email:</td>
            <td><?= $data['email']; ?></td>
        </tr>

        <tr>
            <td>Date of Birth:</td>
            <td><?= date("d-m-Y", strtotime($data['dob'])); ?></td>
        </tr>

        <tr>
            <td>Height:</td>
            <td><?= $data['height']; ?></td>
        </tr>

        <tr>
            <td>Tel:</td>
            <td><?= $data['phone']; ?></td>
        </tr>

        <tr>
            <td>My Favorite Color:</td>
            <td><?= $data['color']; ?></td>
        </tr>

        <tr>
            <td>Fb/TW/IG:</td>
            <td><?= $data['fbtwig']; ?></td>
        </tr>

        <tr>
            <td>Photo:</td>
            <td><?= $data['photo']; ?></td>
        </tr>

        <tr>
            <td>My University:</td>
            <td><?= $data['university']; ?></td>
        </tr>

        <tr>
            <td>My Matric Number:</td>
            <td><?= $data['matricnum']; ?></td>
        </tr>
    </table>

    <input type="hidden" name="matricnum" value="<?= $data['matricnum']; ?>">
    <input type="hidden" name="name" value="<?= $data['name']; ?>">
    <input type="hidden" name="age" value="<?= $data['age']; ?>">
    <input type="hidden" name="gender" value="<?= $data['gender']; ?>">
    <input type="hidden" name="address" value="<?= $data['address']; ?>">
    <input type="hidden" name="email" value="<?= $data['email']; ?>">
    <input type="hidden" name="dob" value="<?= $data['dob']; ?>">
    <input type="hidden" name="height" value="<?= $data['height']; ?>">
    <input type="hidden" name="phone" value="<?= $data['phone']; ?>">
    <input type="hidden" name="color" value="<?= $data['color']; ?>">
    <input type="hidden" name="fbtwig" value="<?= $data['fbtwig']; ?>">
    <input type="hidden" name="photo" value="<?= $data['photo']; ?>">
    <input type="hidden" name="university" value="<?= $data['university']; ?>">
    <input type="hidden" name="biodata_validate" value="1">
    <hr>
    <input type="button" value="Back" onclick="history.back();">
    <input type="submit" value="Save My Biodata">
    </form>

</body>
</html>