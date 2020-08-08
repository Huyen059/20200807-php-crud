<?php
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section class="container">
    <?php if(isset($_POST['id'])): ?>
        <div class="alert alert-success my-4 text-center" role="alert">
            The data is saved!
        </div>
        <div class="d-flex justify-content-center">
            <a href="?page=class" class="btn btn-primary">Back to overview</a>
        </div>

    <?php else: ?>
        <h2 class="text-center">Add a new class</h2>
        <form method="post">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <label for="className">Class Name</label>
                <input name="className" type="text" class="form-control" id="className" aria-describedby="className" placeholder="Class name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input name="address" type="text" class="form-control" id="address" aria-describedby="address" placeholder="Address" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    <?php endif; ?>

</section>

<?php require 'includes/footer.php'; ?>

