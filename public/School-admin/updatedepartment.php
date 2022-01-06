<?php
    /** * Use an HTML form to edit an entry in the * users table. * */
    require "../../config.php";
    require "../../common.php";
    if (isset($_POST['update_department']))
    {
        if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
        try
        {
            $connection = new PDO($dsn, $username, $password, $options);
            $user = ["department_id" => $_POST['department_id'], "depatment_name" => $_POST['depatment_name'], "depatment_name_abbreviation" => $_POST['depatment_name_abbreviation'], "school_id" => $_POST['school_id'], "school_name" => $_POST['school_name']];
            $sql = "UPDATE depatment_table SET department_id = :department_id, depatment_name = :depatment_name, depatment_name_abbreviation = :depatment_name_abbreviation, school_id = :school_id, school_name = :school_name WHERE department_id = :department_id";
            $statement = $connection->prepare($sql);
            $statement->execute($user);
        }
        catch(PDOException $error)
        {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    
    if (isset($_GET['department_id']))
    {
        try
        {
            $connection = new PDO($dsn, $username, $password, $options);
            $id = $_GET['department_id'];
            $sql = "SELECT * FROM depatment_table WHERE department_id  = :department_id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':department_id', $id);
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
    <div class="container pt-4 w-50 p-3">
    <?php if (isset($_POST['update_department']) && $statement): ?> 
	        <?php echo escape($_POST['depatment_name']); ?> successfully updated. 
    <?php endif; ?> 
      <!-- Section: Add department -->
      <section class="mb-4">
        <div class="card">
            <div class="card-header py-3">
                <h5 class="mb-0 text-center"><strong>Add Department</strong></h5>
            </div>
            <div class="card-body">
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
                                <a href="department" type="button" class="btn btn-primary btn-rounded w-100">Back</a>
                            </div>
                            <div class="col pt-2">
                                <button type="submit" class="btn btn-secondary btn-rounded w-100" name="update_department">Create</button>
                            </div>
                        </div>
                    </div>
                    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                </form>
            </div>
        </div>
      </section>
      <!-- Section: Add department -->
    </div>
  </main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>