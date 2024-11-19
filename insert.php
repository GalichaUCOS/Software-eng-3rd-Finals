<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'models.php';
    $response = insertApplicant($_POST);
    if ($response['statusCode'] === 200) {
        header('Location:index.php');
        exit;
    } else {
        $error = $response['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Applicant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add New Applicant</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="insert.php" method="post">
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
    </div>
    
    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="phone">Telephone:</label>
        <input type="text" id="phone" name="phone" required>
    </div>

    <div class="form-group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
    </div>

    <div class="form-group">
        <label for="qualifications">Qualifications:</label>
        <textarea id="qualifications" name="qualifications" required></textarea>
    </div>

    <button type="submit">Submit</button>
</form>

</body>
</html>
