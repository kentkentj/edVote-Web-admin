<?php 
try{
	require "../../config.php";
    require "../../common.php"; 
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM candidatetable";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result_candidates = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>

<?php 
try{
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM campaigntable ORDER BY campaign_id DESC";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result_campaign_list = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>

<?php
if(isset($_POST["post_campaign"])){
	if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
	try{

        // File upload path
        $targetDir = "uploads/post/";
        $fileName = basename($_FILES["upload_image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $connection = new PDO($dsn, $username, $password, $options);

        $allowTypes = array('jpg','png','jpeg','gif');

        $candidate_info = explode(",", $_POST['candidate']);

        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["upload_image"]["tmp_name"], $targetFilePath)){
                // Insert image file name into database
                $new_user = array(
                    "election_id" => $candidate_info[0], 
                    "school_id" => $candidate_info[1], 
                    "department_id" => $candidate_info[2],
                    "candidate_name" => $candidate_info[3],
                    "candidate_party" => $candidate_info[6],
                    "candidate_position" => $candidate_info[4],
                    "profile_pic" => $candidate_info[5],
                    "campaign_post_title" => $_POST['campaign_title'], 
                    "caption" => $_POST['message'],
                    "images" => $fileName
                );

                $sql_insert_candidate = sprintf(
                        "INSERT INTO %s (%s) values (%s)",
                        "campaigntable",
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

<?php include 'templates/header.php' ?>

<script src="js/upload-image.js"></script>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <p>Upcomming elections</p>
                <div class="card">
                    <div class="card-body">
                        <div class="h5">@LeeCross</div>
                        <div class="h7 text-muted">Fullname : Miracles Lee Cross</div>
                        <div class="h7">Developer of web applications, JavaScript, PHP, Java, Python, Ruby, Java, Node.js,
                            etc.
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Followers</div>
                            <div class="h5">5.2342</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Following</div>
                            <div class="h5">6758</div>
                        </li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <form method="POST" enctype="multipart/form-data">
                    <div class="card gedf-card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                        a publication</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">

                                    <!--Post Title-->
                                    <div class="form-outline my-2">
                                        <input type="text" id="campaign_title" class="form-control" name="campaign_title" />
                                        <label class="form-label" for="campaign_title">Title</label>
                                    </div>

                                    <!--Text Area-->
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" id="message" rows="3" placeholder="What are you thinking?" name="message"></textarea>
                                    </div>
                                    
                                    <div class="row my-1">
                                        <div class="col my-1">
                                            <select class="form-select" name="candidate" style="height:37px;">
                                                <option disabled selected>Select Candidate</option>
                                                <?php foreach ($result_candidates as $row) : ?>
                                                    <option value="<?php echo escape($row["election_id"]);?>,<?php echo escape($row["school_id"]);?>,<?php echo escape($row["department_id"]);?>,<?php echo escape($row["candidate_name"]);?>,<?php echo escape($row["candidate_position"]);?>,<?php echo escape($row["profile_pic"]);?>,<?php echo escape($row["candidate_position"]); ?>">
                                                        <?php echo escape($row["candidate_name"]); ?> -
                                                        <?php echo escape($row["candidate_party"]); ?> -
                                                        <?php echo escape($row["candidate_position"]); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!--<div class="col my-1">
                                            <select class="form-select" name="party" style="height:37px;">
                                                <option disabled selected>Select Party</option>
                                                <?php foreach ($result_candidates as $row) : ?>
                                                    <option value="<?php echo escape($row["candidate_party"]);?> <?php escape($row["candidate_name"]); ?>">
                                                        <?php echo escape($row["candidate_party"]); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <!-- Upload image input-->
                                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                            <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0" name="upload_image">
                                            <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                                            <div class="input-group-append">
                                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                            </div>
                                        </div>

                                        <!-- Uploaded image area-->
                                        <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
                                        <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" style="width:300px;">
                                    </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between my-2">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary" name="post_campaign">post</button>
                                </div>
                                <div class="btn-group">
                                    <!--<button id="btnGroupDrop1" type="submit" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-globe"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                </form>
                <!-- Post /////-->

                <!--- \\\\\\\Post-->
                <?php foreach ($result_campaign_list as $row) : ?>
                    <div class="card gedf-card my-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="http://localhost/edVoteAdmin/public/School-admin/uploads/profile/<?php echo escape($row["profile_pic"]); ?>" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">@<?php echo escape($row["candidate_name"]); ?></div>
                                        <div class="h7 text-muted"><?php echo escape($row["candidate_party"]); ?></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="far fa-trash-alt text-danger"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">Configuration</div>
                                            <a class="dropdown-item" href="#">Save</a>
                                            <a class="dropdown-item" href="#">Hide</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
                            <a class="card-link" href="#">
                                <h5 class="card-title"><?php echo escape($row["campaign_post_title"]); ?></h5>
                            </a>
                            
                            <p class="card-text">
                                <?php echo escape($row["caption"]); ?>
                            </p>
                            <img src="http://localhost/edVoteAdmin/public/administrator/uploads/post/<?php echo escape($row["images"]); ?>" class="img-fluid rounded" alt="Wild Landscape" />
                        </div>
                        <!--<div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>-->
                    </div>
                <?php endforeach; ?>
                <!-- Post /////-->
            </div>
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
                <div class="card gedf-card my-3">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
</main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>