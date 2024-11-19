<?php
require_once 'models.php';

$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $response = searchApplicants($searchQuery);
} else {
    $response = readApplicants();
}

$applicants = $response['querySet'] ?? [];

if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id'])) {
    deleteApplicant($_POST['id']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Application System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Application System</h1>

    <form method="get" action="index.php">
    <input type="text" name="search" placeholder="Search applicants..." value="<?= htmlspecialchars($searchQuery) ?>">
    <button type="submit">Search</button>
</form>

<div class="add-applicant-container">
    <a href="insert.php">Add New Applicant</a>
</div>


    <?php if ($response['statusCode'] !== 200): ?>
        <p style="color: red;">Error: <?= htmlspecialchars($response['message']) ?></p>
    <?php elseif (empty($applicants)): ?>
        <p>No applicants found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Address</th>
                    <th>Qualifications</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applicants as $applicant): ?>
                    <tr>
                        <td><?= htmlspecialchars($applicant['first_name'] . ' ' . $applicant['last_name']) ?></td>
                        <td><?= htmlspecialchars($applicant['email']) ?></td>
                        <td><?= htmlspecialchars($applicant['phone']) ?></td>
                        <td><?= htmlspecialchars($applicant['address']) ?></td>
                        <td><?= htmlspecialchars($applicant['qualifications']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $applicant['id'] ?>">Edit</a>
                            <form method="post" action="index.php" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $applicant['id'] ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
