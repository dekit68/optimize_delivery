<?php
if (isset($_SESSION['error'])) {
?>
<div class="alert alert-danger mt-3">
    <?= $_SESSION['error']; ?>
</div>
<?php
unset($_SESSION['error']);
}

?>
<?php
if (isset($_SESSION['success'])) {
?>
<div class="alert alert-success mt-3">
    <?= $_SESSION['success']; ?>
</div>
<?php
unset($_SESSION['success']);
}
?>
