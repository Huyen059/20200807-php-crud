<?php
declare(strict_types=1);
use Model\TeacherLoader;ini_set('display_errors', "1");
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
        <h2 class="text-center"><?= $title ?></h2>
        <form method="post">
            <input type="hidden" name="action" value="<?= $action ?>">
            <input type="hidden" name="id" value="<?= $id ?? '' ?>">
            <div class="form-group">
                <label for="className">Class Name</label>
                <input name="className" value="<?= $className ?? '' ?>" type="text" class="form-control" id="className" aria-describedby="className" placeholder="Class name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input name="address" value="<?= $address ?? '' ?>" type="text" class="form-control" id="address" aria-describedby="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <label for="teacher">Teacher</label>
                <select class="form-control" id="teacher" name="teacherId">
                    <option selected value="0">No assigned teacher</option>
                    <?php
                    /**
                    * @var TeacherLoader $teacherLoader
                    */
                    foreach ($teacherLoader->getTeachers() as $teacher):
                    ?>
                    <option value="<?= $teacher->getId() ?>"><?= $teacher->getFullName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    <?php endif; ?>

</section>

<?php require 'includes/footer.php'; ?>

