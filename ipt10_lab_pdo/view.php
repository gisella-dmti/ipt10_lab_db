<?php
require_once 'config.php';
$id = trim($_GET['id'] ?? '');
if ($id === '') die('Invalid student ID');
$stmt = $pdo->prepare('SELECT * FROM students WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Student Details - PDO</title><link rel="stylesheet" href="style.css"></head>
<body><div class="container"><div class="nav"><h1>Student Details — PDO</h1><a class="btn btn-secondary" href="index.php">Back</a></div>
<div class="card">
<?php if (!$row): ?><p>Student not found.</p><?php else: ?>
<p><strong>Student ID:</strong> <?= htmlspecialchars($row['id']) ?></p>
<p><strong>Full Name:</strong> <?= htmlspecialchars(trim($row['first_name'].' '.$row['middle_name'].' '.$row['last_name'])) ?></p>
<p><strong>Birthday:</strong> <?= htmlspecialchars($row['birthday']) ?></p>
<p><strong>Sex:</strong> <?= htmlspecialchars($row['sex']) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
<p><strong>Student Number:</strong> <?= htmlspecialchars($row['student_number']) ?></p>
<p><strong>Program:</strong> <?= htmlspecialchars($row['program']) ?></p>
<p><strong>Enrolment Date:</strong> <?= htmlspecialchars($row['enrolment_date']) ?></p>
<p><strong>Created At:</strong> <?= htmlspecialchars($row['created_at']) ?></p>
<p><strong>Updated At:</strong> <?= htmlspecialchars($row['updated_at']) ?></p>
<?php endif; ?></div></div></body></html>
