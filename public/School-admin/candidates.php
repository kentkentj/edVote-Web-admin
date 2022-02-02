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
	$position_list = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>

<?php
if(isset($_POST["done"])){
	if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
	try{

    // File upload path
    $targetDir = "uploads/profile/";
    $fileName = basename($_FILES["upload_profile"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		$connection = new PDO($dsn, $username, $password, $options);

        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["upload_profile"]["tmp_name"], $targetFilePath)){
                // Insert image file name into database
                $new_user = array(
                    "school_id" => 'UC-BCF',
                    "election_id" => implode("|",$user),
                    "department_id" => '1',
                    "candidate_name" => $_POST['candidate_name'],
                    "candidate_party" => $_POST['party'],
                    "candidate_position" => $_POST['position'],
                    "profile_pic" => $fileName
                );

                $sql_insert_candidate = sprintf(
                        "INSERT INTO %s (%s) values (%s)",
                        "candidatetable",
                        implode(", ", array_keys($new_user)),
                        ":" . implode(", :", array_keys($new_user))
                );
                
                $statement = $connection->prepare($sql_insert_candidate);
                $statement->execute($new_user); 
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
	} catch(PDOException $error) {
        echo $sql_insert_candidate . "<br>" . $error->getMessage();
    }
}
?>

<?php 
try{
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM candidatetable WHERE school_id = 'UC-BCF' AND election_id = '1'";

	$statement = $connection->prepare($sql);
  $statement->execute();
	$position_result = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>
<?php include 'templates/header.php' ?>
<script src="js/upload-image.js"></script>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4 w-50 my-5">
      <div id="row1" class="card">
            <div class="container pt-2 w-75 my-5">
              <h2 class="mb-0 text-center">
                <strong>Candidate</strong>
              </h2>
              <form method="POST" enctype="multipart/form-data">
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
                    <?php foreach ($position_list as $row) : ?>
                      <option value="<?php echo escape($row["position_name"]); ?>"><?php echo escape($row["position_name"]); ?></option>
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
       <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <?php foreach ($position_result as $row) : ?>
           <div class="col my-3">
              <div class="card radius-15">
                <div class="card-body text-center">
                  <div class="p-4 border radius-15">
                    <img src="uploads/profile/<?php echo escape($row["profile_pic"]); ?>" width="110" height="110" class="rounded-circle shadow" alt="">
                    <h5 class="mb-0 mt-5"><?php echo escape($row["candidate_name"]); ?></h5>
                    <p class="mb-3"><?php echo escape($row["candidate_position"]); ?></p>
                    <p class="small text-muted text-uppercase"><?php echo escape($row["candidate_party"]); ?></p>
                    <div class="list-inline contacts-social mt-3 mb-3"> <a href="javascript:;" class="list-inline-item bg-facebook text-white border-0"><i class="bx bxl-facebook"></i></a>
                      <a href="javascript:;" class="list-inline-item bg-twitter text-white border-0"><i class="bx bxl-twitter"></i></a>
                      <a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0"><i class="bx bxl-linkedin"></i></a>
                    </div>
                    <div class="d-grid">
                      <a href="candidate_info?candidate_id=<?php echo escape($row["candidate_id"]); ?>" class="btn btn-outline-primary radius-15">View</a>
                    </div>
                  </div>
                </div>
              </div>
	         </div>
        <?php endforeach; ?> 
        </div>
    </div>
</main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>