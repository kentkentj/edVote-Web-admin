<?php 
try{
	require "../../config.php";
    require "../../common.php"; 
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM admin_account";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result = $statement->fetchAll();

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
        $sql_status = "UPDATE admin_account SET account_status = 'deactivate' WHERE admin_user_id  = :deactivate_account";
      }
      if($status_value == 'deactivate'){
        $sql_status = "UPDATE admin_account SET account_status = 'active' WHERE admin_user_id  = :deactivate_account";
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

<?php include 'templates/header.php' ?>
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
<script src="js/config.js"></script>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <div class="card">
            <div class="card-body">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Full Name</th>
                <th>School</th>
                <th>Department</th>
                <th>Admin Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
 
        <!--<tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>-->
 
        <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["admin_employee_id"]); ?></td>
                <td><?php echo escape($row["full_name"]); ?></td>
                <td><?php echo escape($row["school_name"]); ?></td>
                <td><?php echo escape($row["depatment_name_abbreviation"]); ?></td>
                <td><?php echo escape($row["admin_type"]); ?></td>
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
                    <a href="?deactivate_account=<?php echo escape($row["admin_user_id"]); ?>&account_status=<?php echo escape($row["account_status"]); ?>" class="call-btn btn btn-outline-primary btn-floating btn-sm" data-mdb-number="+48000000000" style=""><i class="fas fa-lock"></i></a>
                    <a href="#" class="message-btn btn ms-2 btn-primary btn-floating btn-sm" data-mdb-email="tiger.nixon@gmail.com" style=""><i class="fas fa-marker"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
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
<!--
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
-->
  <!--Main layout-->

  
<?php include 'templates/footer.php' ?>