<?php
/** * Use an HTML form to edit an entry in the * users table. * */
require "../../config.php";
require "../../common.php"; 
if (isset($_POST['submit']))
{
	if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $user = ["id" => $_POST['id'], "full_name" => $_POST['full_name'], "admin_employee_id" => $_POST['admin_employee_id'], "email" => $_POST['email'], "age" => $_POST['age'], "location" => $_POST['location'], "date" => $_POST['date']];
        $sql = "UPDATE admin_account SET id = :id, firstname = :firstname, lastname = :lastname, email = :email, age = :age, location = :location, date = :date WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute($user);
    }
    catch(PDOException $error)
    {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['userprofile']))
{
    try
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['userprofile'];
        $sql = "SELECT full_name,admin_employee_id,depatment_name,depatment_name_abbreviation,school_id,school_name FROM admin_account WHERE admin_user_id  = :userprofile";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userprofile', $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $error)
    {
        echo $sql . "<br>" . $error->getMessage();
    }
}
else
{
    echo "Something went wrong!";
    exit;
} ?> 
<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <form method="POST">
            <?php foreach ($user as $key => $value): ?>
                <!-- Depatment Name input -->
                <div class="form-outline mb-4">
                    <input type="text" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'department_id' ? 'readonly' : null); ?>/>
                    <label class="form-label" for="<?php echo $key; ?>"><?php echo  ucwords(str_replace("_", " ", $key)); ?></label>
                </div>
            <?php endforeach; ?> 
                <div class="text-center">
                    <div class="row">
                        <div class="col pt-2">
                            <a href="users" type="button" class="btn btn-primary btn-rounded w-100">Back</a>
                        </div>
                        <div class="col pt-2">
                            <button type="submit" class="btn btn-secondary btn-rounded w-100" name="update_department">Create</button>
                        </div>
                    </div>
                </div>
            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        </form>
    </div>
</main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>