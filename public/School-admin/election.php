<?php
require "../../config.php";
require "../../common.php"; 
if(isset($_POST["make_election"])){
	if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
	try{
		$connection = new PDO($dsn, $username, $password, $options);

		$new_election = array(
            "election_name" => $_POST['election_title'],
            "start_election_date"  => $_POST['start_date'],
            "end_election_date"     => $_POST['end_date'],
            "department_id"       => '1',
            "depatment_name"  => 'CITCS',
            "school_id"  => 'UC-BCF',
            "school_name"  => 'University of the Cordilleras'
        );

        $sql_electionevent = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "electionevent",
                implode(", ", array_keys($new_election)),
                ":" . implode(", :", array_keys($new_election))
        );
        
        $statement = $connection->prepare($sql_electionevent);
        $statement->execute($new_election);
	} catch(PDOException $error) {
        echo $sql_electionevent . "<br>" . $error->getMessage();
    }
}
 
try{
	$connection=new PDO($dsn, $username, $password, $options);

	$sql_read_electionevent="SELECT * FROM electionevent";

	$statement_read = $connection->prepare($sql_read_electionevent);
  	$statement_read->execute();
	$result = $statement_read->fetchAll();

} catch(PDOException $error){
	echo $sql_read_electionevent . "<br>" . $error->getMessage();
}

?>
<?php include 'templates/header.php' ?>

<?php 
    if (isset($_POST['make_election']) && $statement) { 
      header("Location: edVoteAdmin/public/School-admin/election");
    }
?>

<?php 
    //min date
    $date = date('Y-m-d');
?>
<!--Main layout-->
<main style="margin-top: 58px">
  <div class="container pt-4">
    <h1 class="mb-3">Create Election Event</h1>
    <div class="row">
      <div class="col my-4">
        <!--Create Election Event-->
        <div class="card">
          <div class="card-body" style="margin:5%;">
          <form method="POST">
            <h5 class="card-title">TITLE</h5>
            <div class="form-outline">
              <input type="text" id="title" class="form-control" name="election_title" />
              <label class="form-label" for="title">Election Name</label>
            </div>

            <div class="row my-4">
              <div class="col">
                <h5 class="card-title">START</h5>
                <div class="form-outline">
                  <input type="date" id="date_start" class="form-control" name="start_date"  min="<?php echo $date?>"  value="<?php echo $date?>"/>
                </div>
              </div>

              <div class="col">
                <h5 class="card-title">END</h5>
                <div class="form-outline">
                  <input type="date" id="date_end" class="form-control" name="end_date" min="<?php echo $date;?>"  value="<?php echo $date?>"/>
                </div>
              </div>
            </div>

            <button type="submit" name="make_election" class="btn btn-primary btn-rounded w-100 ripple-surface">CREATE ELECTION</button>

            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
          </form>
          </div>
        </div>
        <!--end Create Election Event-->
      </div>

      <div class="col-sm-7 my-4">
        <!--Section: Election Manage KPIs-->
        <section class="mb-4">
          <div class="card">
            <div class="card-header text-center py-3">
              <h5 class="mb-0 text-center">
                <strong>Manage Election</strong>
              </h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Start Date</th>
                      <th scope="col">Due Date</th>
                      <th scope="col">Department</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($result as $row) : ?>
                    <tr>
                      <th scope="row"><?php echo escape($row["election_name"]); ?></th>
                      <td><?php echo escape($row["start_election_date"]); ?></td>
                      <td><?php echo escape($row["end_election_date"]); ?></td>
                      <td><?php echo escape($row["depatment_name"]); ?></td>
                      <td>
                        <a class="btn btn-danger"  href="#!" role="button">
                          <i class="far fa-trash-alt"></i>
                        </a>

                        <a class="btn btn-primary" href="#!" role="button">
                          <i class="far fa-edit"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
        <!--Section: Election Manage-->
      </div>
    </div>
  </div>
</main>
<!--Main layout-->
<?php include 'templates/footer.php' ?>