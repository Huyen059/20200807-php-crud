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
            <a href="?page=student" class="btn btn-primary">Back to overview</a>
        </div>

    <?php else: ?>
        <h2>Add a new student</h2>
        <form method="post">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="id" value="">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input name="firstName" type="text" class="form-control" id="firstName" aria-describedby="firstName" placeholder="First name" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input name="lastName" type="text" class="form-control" id="lastName" aria-describedby="lastName" placeholder="Last name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input name="address" type="text" class="form-control" id="address" aria-describedby="address" placeholder="Address" required>
        </div>
        <div class="form-group">
            <label for="class">Class</label>
            <select class="form-control" id="class">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
    <?php endif; ?>

</section>

<?php require 'includes/footer.php'; ?>