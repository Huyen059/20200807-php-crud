<?php
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

    <section>
        <h1 class="text-center mb-5">Teacher Data</h1>

        <div>
            <form method="post" class="d-flex justify-content-center">
                <button class="btn btn-primary" name="add" type="submit">Create new</button>
            </form>
        </div>
    </section>

<?php require 'includes/footer.php'; ?>