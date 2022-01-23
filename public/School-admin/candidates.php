<?php 
require "../../config.php";
require "../../common.php"; 

if (isset($_GET['electionid']))
{
    try
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['electionid'];
        $sql = "SELECT election_id FROM electionevent WHERE election_id  = :electionid";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':electionid', $id);
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
}
?>

<?php 
try{
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT position_id,position_name FROM positiontable WHERE school_id = 'UC-BCF'";

	$statement = $connection->prepare($sql);
  $statement->execute();
	$position_result = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>

<?php
if(isset($_POST["done"])){
	if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
	try{
		$connection = new PDO($dsn, $username, $password, $options);

		$new_user = array(
            "school_id" => 'UC-BCF',
            "election_id" => implode("|",$user),
            "department_id" => '1',
            "candidate_name" => $_POST['candidate_name'],
            "candidate_party" => $_POST['party'],
            "candidate_position" => $_POST['position'],
            "profile_pic" => ''
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "electionevent",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
	} catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4 w-50 my-5">
      <div id="row1" class="card">
            <div class="container pt-2 w-75 my-5">
              <h2 class="mb-0 text-center">
                <strong>Candidate</strong>
              </h2>
              <form method="POST">
                <div class="container my-4">
                  <?php /*echo implode("|",$user);*/ ?>
                  <div class="form-outline mb-4">
                    <input id="candidate-name" type="text" class="form-control" name="candidate_name" />
                    <label class="form-label" for="candidate-name">Candidate Name</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input id="party" type="text" class="form-control" name="party" />
                    <label class="form-label" for="party-name">Party</label>
                  </div>

                  <select class="form-select" name="position">
                    <?php foreach ($position_result as $row) : ?>
                      <option value="<?php echo escape($row["position_id"]); ?>"><?php echo escape($row["position_name"]); ?></option>
                    <?php endforeach; ?>
                  </select>

                  <!-- Upload image input-->
                  <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm my-5">
                      <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0" name="upload_profile">
                      <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                      <div class="input-group-append">
                          <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                      </div>
                  </div>

                  <!-- Uploaded image area-->
                  <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
                  <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" style="width:300px;"></div>

                  <button type="submit" class="btn btn-primary w-100" name="done">Done</button>
                  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                </div>
              </form>
            </div>
       </div>
    </div>
    
    <div class="container pt-2 my-5">
        <div class="row">
          <div class="col">
              <div class="card">
                 <div class="row" style="padding:20px;">
                   <div class="col-sm-3">
                      <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="80"
                alt="" loading="lazy" />
                   </div>

                   <div class="col-8">
                     <strong class="fw-normal">Candidate Name</strong><br>
                     <strong class="fw-lighter">Party</strong><br>
                     <strong class="fw-bolder">President</strong><br>
                   </div>
                 </div>
              </div>
           </div>
           
        </div>
    </div>
</main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>