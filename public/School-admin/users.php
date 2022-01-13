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

		$new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "age"       => $_POST['age'],
            "location"  => $_POST['location']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
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
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
<script src="js/config.js"></script>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <h1 class="mb-3">Add New Student User</h1>
        <div class="toast show fade mx-auto show fade text-white bg-success" id="static-example" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-autohide="false">
                <div class="toast-header text-white bg-success">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close btn-close-white btn-exit" data-mdb-dismiss="toast" aria-label="Close"></button>
                </div>
            <div class="toast-body"><?php echo $_POST['fname']; ?> successfully added.</div>
        </div>
        <div id="user_create_info" class="card my-5">
            <div class="card-body">
                <h5 class="card-title">User Information</h5>
                <div class="form-outline">
                    <input disabled type="text" id="user_id" class="form-control" name="firstname" />
                </div>
                <form>
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
                        <input type="email" id="email" class="form-control" />
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
                                    <option value="<?php echo escape($row["depatment_name_abbreviation "]); ?>"><?php echo escape($row["depatment_name_abbreviation"]); ?></option>
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
                </form>
            </div>
        </div>
        


        <div id="user_create_email" class="card my-5">
            <div class="card-body">
                <h5 class="card-title">Signup User Email</h5>
                <div class="row">
                    <div class="col my-2">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email_verify" class="form-control" />
                            <label class="form-label" for="email_verify">Email</label>
                        </div>
                    </div>
                    <div class="col my-2">
                        <!-- student-id input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="studentid_verify" class="form-control" />
                            <label class="form-label" for="studentid_verify">Student ID</label>
                        </div>
                    </div>
                    <div class="col-sm-5 my-2">
                        <div class="form-outline">
                        <button type="button" class="btn btn-secondary bg-gradient btn-block mb-4" onclick="signUP()">ADD USER EMAIL</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>


  <script>
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

    </script>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>