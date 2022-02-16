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


if(isset($_POST["create_user"])){
	if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
	try{
		$connection = new PDO($dsn, $username, $password, $options);

        $dept = explode(",", $_POST['department']);

		$new_user = array(
            "user_password" => password_hash($_POST['student_id'], PASSWORD_DEFAULT),
            "student_id"  => $_POST['student_id'],
            "department_id"       => $dept[1],
            "firstname"  =>  strtoupper($_POST['firstname']),
            "lastname"  =>  strtoupper($_POST['lastname']),
            "middlename"  =>  strtoupper($_POST['middlename']),
            "suffix"  =>  strtoupper($_POST['suffix']),
            "profile_pic"  => '',
            "email"  => $_POST['email'],
            "phonenumber"  => $_POST['number'],
            "depatment_name"  => $dept[2],
            "department_name_abbreviation"  => $dept[0],
            "school_id"  => 'UC-BCF',
            "school_name"  => 'University of the Cordilleras',
            "course"  => $_POST['course'],
            "year_level"  => $_POST['year'],
            "account_status"  => 'active'
        );

        $sql_users = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "studentusertable",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql_users);
        $statement->execute($new_user);
	} catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


//read users
try{
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM studentusertable";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result_user = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}

//deactivate account
if (isset($_GET["deactivate_account"]) && isset($_GET["account_status"])) {
    try {
      $connection = new PDO($dsn, $username, $password, $options);
  
      $id = $_GET["deactivate_account"];
      $status_value = $_GET["account_status"];
  
      $sql_status;
      
      if($status_value == 'active'){
        $sql_status = "UPDATE studentusertable SET account_status = 'deactivate' WHERE student_id  = :deactivate_account";
      }
      if($status_value == 'deactivate'){
        $sql_status = "UPDATE studentusertable SET account_status = 'active' WHERE student_id  = :deactivate_account";
      }

      $statement_status_account = $connection->prepare($sql_status);

      //get ids
      $statement_status_account->bindValue(':deactivate_account', $id);
     

      $statement_status_account->execute();
      $success = "User successfully deleted";
    } catch(PDOException $error) {
      echo $sql_status . "<br>" . $error->getMessage();
    }
  }
?>
?>

<?php include 'templates/header.php' ?>
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
<script src="js/config.js"></script>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <h1 class="mb-3">Add New Student User</h1>

        <?php if (isset($_POST['create_user']) && $statement) { ?>
            <div class="toast show fade mx-auto show fade text-white bg-success" id="static-example" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-autohide="false">
                    <div class="toast-header text-white bg-success">
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close btn-close-white btn-exit" data-mdb-dismiss="toast" aria-label="Close"></button>
                    </div>
                <div class="toast-body"><?php echo $_POST['firstname'] . " " . $_POST['lastname']; ?> successfully added.</div>
            </div>
        <?php }?>
        <div id="user_create_info" class="card my-5">
            <div class="card-body">
                <h5 class="card-title">User Information</h5>
                <form method="POST">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col my-2">
                            <div class="form-outline">
                                <input type="text" id="form6Example1" class="form-control" name="firstname" />
                                <label class="form-label" for="form6Example1">First name</label>
                            </div>
                        </div>
                        <div class="col my-2">
                            <div class="form-outline">
                                <input type="text" id="form6Example2" class="form-control" name="lastname" />
                                <label class="form-label" for="form6Example2">Last name</label>
                            </div>
                        </div>
                        <div class="col my-2">
                            <div class="form-outline">
                                <input type="text" id="middleName" class="form-control" name="middlename" />
                                <label class="form-label" for="middleName">Middle Name</label>
                            </div>
                        </div>
                        <div class="col-sm-2 my-2">
                            <div class="form-outline">
                                <input type="text" id="suffix" class="form-control" name="suffix" />
                                <label class="form-label" for="suffix">Suffix</label>
                            </div>
                        </div>
                    </div>

                    <!-- id input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form6Example3" class="form-control" name="student_id" />
                        <label class="form-label" for="form6Example3">Student ID</label>
                    </div>

                    <!-- Text input -->
                    <!--<div class="form-outline mb-4">
                        <input type="text" id="form6Example4" class="form-control" />
                        <label class="form-label" for="form6Example4">Address</label>
                    </div>-->

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="email" class="form-control" name="email" />
                        <label class="form-label" for="email">Email</label>
                    </div>

                    <!-- Number input -->
                    <div class="form-outline mb-4">
                        <input type="number" id="form6Example6" class="form-control" name="number" />
                        <label class="form-label" for="form6Example6">Phone</label>
                    </div>

                    <!-- Message input -->
                <!-- <div class="form-outline mb-4">
                        <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                        <label class="form-label" for="form6Example7">Additional information</label>
                    </div>-->

                    <!-- Checkbox -->
                    <!--<div class="form-check d-flex justify-content-center mb-4">
                        <input
                        class="form-check-input me-2"
                        type="checkbox"
                        value=""
                        id="form6Example8"
                        checked
                        />
                        <label class="form-check-label" for="form6Example8"> Create an account? </label>
                    </div>-->
                    
                    <div class="row mb-4">
                        <div class="col">
                            <select class="form-select" aria-label="Default select example" name="department">
                                <option selected disabled>Department</option>
                                <?php foreach ($result as $row) : ?>
                                    <option value="<?php echo escape($row["depatment_name_abbreviation"]); ?>,<?php echo escape($row["department_id"]); ?>,<?php echo escape($row["depatment_name"]); ?>"><?php echo escape($row["depatment_name_abbreviation"]); ?></option>
                                <?php endforeach; ?>   
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select" aria-label="Default select example" name="course">
                                <option selected disbaled>Course</option>
                                <optgroup label="Tertiary">
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSCS">BSCS</option>
                                </optgroup>
                                <optgroup label="Senior High">
                                    <option value="ICT11TVL">ICT 11 - TVL</option>
                                    <option value="ICT12TVL">ICT 12 - TVL</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="col">
                            <select class="form-select" name="year">
                                <option selected disabled>Year</option>
                                <optgroup label="Tertiary">
                                    <option value="firstyear">1st Year</option>
                                    <option value="secondyear">2nd Year</option>
                                    <option value="thirdyear">3rd Year</option>
                                    <option value="fourthyear">4th Year</option>
                                </optgroup>
                                <optgroup label="Senior High">
                                    <option value="g12">Grade 12</option>
                                    <option value="g11">Grade 11</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-secondary bg-gradient btn-block mb-4" name="create_user">CREATE USER</button>

                    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Full Name</th>
                <th>School</th>
                <th>Department</th>
                <th>Year</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result_user as $row) : ?>
            <tr>
                <td><?php echo escape($row["student_id"]); ?></td>
                <td><?php echo escape($row["firstname"]) . " " . escape($row["middlename"]) . " " . escape($row["lastname"]) . " " . escape($row["suffix"]); ?></td>
                <td><?php echo escape($row["school_name"]); ?></td>
                <td><?php echo escape($row["department_name_abbreviation"]); ?></td>
                <td><?php echo escape($row["year_level"]); ?></td>
                <td>
                    <?php if(escape($row["account_status"]) == 'active'): ?>
                        <div class="badge bg-success text-wrap" style="width: 6rem;text-transform:uppercase">
                            <?php echo escape($row["account_status"]); ?></a>
                        </div>
                    <?php else: ?>
                        <div class="badge bg-danger text-wrap" style="width: 6rem;text-transform:uppercase">
                            <?php echo escape($row["account_status"]); ?>
                        </div>
                     <?php endif; ?>
                </td>
                <td>
                    <a href="?deactivate_account=<?php echo escape($row["student_id"]); ?>&account_status=<?php echo escape($row["account_status"]); ?>" class="call-btn btn btn-outline-primary btn-floating btn-sm" data-mdb-number="+48000000000" style=""><i class="fas fa-lock"></i></a>
                    <a href="userprofile?userprofile=<?php echo escape($row["student_id"]); ?>" class="message-btn btn ms-2 btn-primary btn-floating btn-sm" data-mdb-email="tiger.nixon@gmail.com" style=""><i class="fas fa-marker"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Student ID</th>
                <th>Full Name</th>
                <th>School</th>
                <th>Department</th>
                <th>Year</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
            </div>
        </div>
    </div>
  </main>

  <script>
    $(document).ready(function() {
        $('#example').dataTable();
    } );
  </script>
  <!--<script>
            firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                // User is signed in.

                document.getElementById("user_create_info").style.display = "block";
                document.getElementById("user_create_email").style.display = "none";

                var user = firebase.auth().currentUser;

                if(user != null){
                    var email_id = user.email;
                    var userId = user.uid
                    document.getElementById("user_id").value = userId;
                }

            } else {
                // No user is signed in.

                document.getElementById("user_create_info").style.display = "none";
                document.getElementById("user_create_email").style.display = "block";

            }
            });


            function signUP(){
                var email = document.getElementById("email_verify").value;
                var password = document.getElementById("studentid_verify").value;

                firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
                console.log(error.code);
                console.log(error.message);
            });
            }

            function logout(){
                firebase.auth().signOut();
            }

    </script>-->
  <!--Main layout-->
<?php include 'templates/footer.php' ?>