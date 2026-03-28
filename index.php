<?php
$submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $description = $_POST['description'];

    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir);
    }

    $imageName = basename($_FILES["profile"]["name"]);
    $targetFile = $targetDir . time() . "_" . $imageName;
    move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFile);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Personal Information</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="header">
    Personal Information
</div>

<?php if(!$submitted): ?>

<div class="container">
<h2>Fill Out the Form</h2>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" required>

<label>Age</label>
<input type="number" name="age" required>

<label>Address</label>
<input type="text" name="address" required>

<label>Simple Description About Yourself</label>
<textarea name="description" rows="4" required></textarea>

<label>Profile Picture</label>
<input type="file" name="profile" accept="image/*" required>

<button type="submit">Submit</button>

</form>

</div>

<?php else: ?>

<div class="container">

<div class="profile">
<img src="<?php echo $targetFile; ?>">
</div>

<div class="name">
<?php echo htmlspecialchars($name); ?>
</div>

<div class="info">
Age: <?php echo htmlspecialchars($age); ?> |
Address: <?php echo htmlspecialchars($address); ?>
</div>

<div class="description">
<?php echo nl2br(htmlspecialchars($description)); ?>
</div>

</div>

<?php endif; ?>

</body>
</html>