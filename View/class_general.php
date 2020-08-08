<?php
declare(strict_types=1);

use Model\ClassLoader;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section class="container">
    <h1 class="text-center mb-5">Class Data</h1>

    <div class="mb-5">
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="action" value="add">
            <button class="btn btn-primary" name="add" type="submit">Create new</button>
        </form>
    </div>

    <?php if(isset($errorMessage)): ?>
        <div class='alert alert-success my-4 text-center' role='alert'>
            <?= $errorMessage ?>
        </div>
    <?php else: ?>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Teacher</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                /**
                 * @var ClassLoader $loader
                 */
                foreach ($loader->getClasses() as $class):
                    ?>
                    <tr>
                        <th scope="row" class="align-middle"><?php
                            echo $count;
                            $count++;
                            ?>
                        </th>
                        <td class="align-middle"><?= $class->getName() ?></td>
                        <td class="align-middle"><?= $class->getAddress() ?></td>
                        <td class="align-middle"><?php if ($class->getTeacher() !== null) {
                            $teacherFullName = $class->getTeacher()->getFirstName() . " " . $class->getTeacher()->getLastName();
                                echo "<a href='#'>{$teacherFullName}</a>";
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td class="align-middle"><a href="?page=class&id=<?php echo $class->getId(); ?>" class="btn btn-success">Details</a></td>
                        <td><a href="#" class="btn btn-warning">Update</a></td>
                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php require 'includes/footer.php'; ?>
