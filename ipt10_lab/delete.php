<?php
require_once 'db_connect.php';
$id = trim($_GET['id'] ?? $_POST['id'] ?? '');
if ($id === '') die('Invalid student ID');

$s = $conn->prepare('SELECT first_name, last_name FROM students WHERE id = ?');
$s->bind_param('s', $id);
$s->execute();
$r = $s->get_result()->fetch_assoc();
$s->close();

if (!$r) {
    echo '<p>Student not found.</p>';
    $conn->close();
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = $conn->prepare('DELETE FROM students WHERE id = ?');
    $d->bind_param('s', $id);
    $d->execute();
    if ($d->affected_rows === 1) {
        $message = 'Student deleted successfully.';
    } else {
        $message = 'Failed to delete student.';
    }
    $d->close();
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Delete Student - mysqli</title><link rel="stylesheet" href="style.css"></head>
<body><div class="container"><div class="card">
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<p class="<?= $message === 'Student deleted successfully.' ? 'success' : 'error' ?>"><?= htmlspecialchars($message) ?></p>
<a class="btn btn-primary" href="index.php">Return to Student List</a>
<?php else: ?>
<h1>Confirm Delete</h1>
<p>Are you sure you want to delete <strong><?= htmlspecialchars($r['first_name'].' '.$r['last_name']) ?></strong>?</p>
<form method="POST">
<input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
<div><button class="btn btn-danger" type="submit">Yes, Delete</button>
<a class="btn btn-secondary" href="index.php">Cancel</a></div>
</form>
<?php endif; ?>
</div></div></body></html>
<?php $conn->close(); ?>
