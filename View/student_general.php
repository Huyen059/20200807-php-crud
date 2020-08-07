<?php
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section>
    <h1 class="text-center mb-5">Student Data</h1>

    <div>
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="action" value="add">
            <button class="btn btn-primary" name="add" type="submit">Create new</button>
        </form>
    </div>

    <div>
        <?php if(isset($errorMessage)) {
            echo "
            <div class='alert alert-success my-4 text-center' role='alert'>
            {$errorMessage}
        </div>
            ";
        } ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
