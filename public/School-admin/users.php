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
        <h1 class="mb-3">Add New Student User</h1>
        <form>
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="form6Example1" class="form-control" />
                        <label class="form-label" for="form6Example1">First name</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="form6Example2" class="form-control" />
                        <label class="form-label" for="form6Example2">Last name</label>
                    </div>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example3" class="form-control" />
                <label class="form-label" for="form6Example3">Student ID</label>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example4" class="form-control" />
                <label class="form-label" for="form6Example4">Address</label>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form6Example5" class="form-control" />
                <label class="form-label" for="form6Example5">Email</label>
            </div>

            <!-- Number input -->
            <div class="form-outline mb-4">
                <input type="number" id="form6Example6" class="form-control" />
                <label class="form-label" for="form6Example6">Phone</label>
            </div>

            <!-- Message input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                <label class="form-label" for="form6Example7">Additional information</label>
            </div>

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
                    <select class="form-select" aria-label="Default select example">
                        <option selected disabled>Department</option>
                        <?php foreach ($result as $row) : ?>
                            <option value="<?php echo escape($row["depatment_name"]); ?>"><?php echo escape($row["depatment_name"]); ?></option>
                        <?php endforeach; ?>   
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Default select example">
                        <option selected disbaled>Course</option>
                        <optgroup label="Tertiary">
                            <option value="BSIT"></option>
                        </optgroup>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select">
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
            <button type="submit" class="btn btn-secondary bg-gradient btn-block mb-4">CREATE USER</button>
        </form>
    </div>
  </main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>