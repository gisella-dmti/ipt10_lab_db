<?php
require_once 'config.php';
$id=trim($_GET['id']??$_POST['id']??'');if($id==='')die('Invalid student ID');
$stmt=$pdo->prepare('SELECT first_name,last_name FROM students WHERE id=?');$stmt->execute([$id]);$student=$stmt->fetch();
if(!$student)die('Student not found');
$message='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    try{
        $d=$pdo->prepare('DELETE FROM students WHERE id=?');$d->execute([$id]);
        if($d->rowCount()===1){$pdo->commit();$message='Student deleted successfully.';}
        else{$pdo->rollBack();$message='Failed to delete student.';}
    }catch(PDOException $e){if($pdo->inTransaction())$pdo->rollBack();$message='Failed to delete student.';}
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Delete Student - PDO</title><link rel="stylesheet" href="style.css"></head>
<body><div class="container"><div class="card">
<?php if($_SERVER['REQUEST_METHOD']==='POST'): ?>
<p class="<?= $message==='Student deleted successfully.'?'success':'error' ?>"><?=htmlspecialchars($message)?></p>
<a class="btn btn-primary" href="index.php">Return to Student List</a>
<?php else: ?>
<h1>Confirm Delete</h1><p>Are you sure you want to delete <strong><?=htmlspecialchars($student['first_name'].' '.$student['last_name'])?></strong>?</p>
<form method="POST"><input type="hidden" name="id" value="<?=htmlspecialchars($id)?>">
<div><button class="btn btn-danger" type="submit">Yes, Delete</button><a class="btn btn-secondary" href="index.php">Cancel</a></div></form>
<?php endif; ?>
</div></div></body></html>
