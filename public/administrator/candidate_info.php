<?php
/** * Use an HTML form to edit an entry in the * users table. * */
require "../../config.php";
require "../../common.php"; 

if (isset($_POST['update']))
{
	if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['candidate_id'];
        $user = ["candidate_name" => $_POST['candidate_name'], "candidate_party" => $_POST['candidate_party'], "candidate_position" => $_POST['candidate_position'],"profile_pic" => $_POST['profile_pic']];
        $sql = "UPDATE candidatetable SET candidate_name = :candidate_name, candidate_party = :candidate_party, candidate_position = :candidate_position, profile_pic = :profile_pic WHERE candidate_id  = " . $id;
        $statement = $connection->prepare($sql);
        $statement->execute($user);
    }
    catch(PDOException $error)
    {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_GET['candidate_id']))
{
    try
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['candidate_id'];
        $sql = "SELECT candidate_name,candidate_party,candidate_position,profile_pic FROM candidatetable WHERE candidate_id = :candidate_id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':candidate_id', $id);
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
    <?php if (isset($_POST['update']) && $statement): ?> 
	    <?php echo escape($_POST['candidate_name']); ?> successfully updated. 
    <?php endif; ?>
      <div class="card">
        <div class="card-body">
          <h2 class="card-title text-center">Candidate</h2>
          <form class="mb-4 my-5" method="POST">
            <div class="row">
            <?php foreach ($user as $key => $value): ?>
            <div class="col-md-6">
            <div class="form-outline mb-4">
              <input type="text" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'profile_pic' ? 'readonly' : null); ?>/>
              <label class="form-label" for="<?php echo $key; ?>"><?php echo  ucwords(str_replace("_", " ", $key)); ?></label>
            </div>
            </div>
            <?php endforeach; ?>
            </div> 
            <button type="submit" class="btn btn-secondary btn-rounded w-100" name="update">Update</button>
            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
          </form>
        </div>
      </div>
    </div>
</main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>