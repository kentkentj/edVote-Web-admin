<?php 
try{
	require "../../config.php";
    require "../../common.php";
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM depatment_table";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>
<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
    <!--Section: Department-->
        <a href="create-department-single" class="btn btn-secondary btn-rounded mb-4">ADD DEPARTMENT</a>
        <section class="mb-4">
            <div class="card">
            <div class="card-header text-center py-3">
                <h5 class="mb-0 text-center">
                <strong>Departments</strong>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Department ID</th>
                        <th scope="col">Department Abbreviation</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $row) : ?>
                    <tr>
                        <th scope="row"><?php echo escape($row["depatment_name"]); ?></th>
                        <td><?php echo escape($row["department_id"]); ?></td>
                        <td><?php echo escape($row["depatment_name_abbreviation"]); ?></td>
                        <td>
                            <a href="#" class="link-danger">Delete</a>
                            <a href="<?php echo escape($row["department_id"]); ?>" class="link-info ps-2">Update</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </section>
      <!--Section: Department-->
    </div>
  </main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>