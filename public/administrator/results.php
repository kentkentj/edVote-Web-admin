<?php 
try{
	require "../../config.php";
    require "../../common.php"; 
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT COUNT(voters_vote_id) AS 'votes', candidate_name, candidate_position,candidate_party ,position_id FROM balot_counting_table GROUP BY candidate_position ORDER BY position_id;";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>

<?php 
try{
	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM electionevent";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result_event = $statement->fetchAll();

} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>
<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
      <!--Section: table results-->
      <section class="mb-4">
        <div class="card">
          <div class="card-header text-center py-3">
            <h5 class="mb-0 text-center">
              <strong>Current Election Results</strong>
            </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Candidate Position</th>
                    <th scope="col">Candidate Party</th>
                    <th scope="col">Votes</th>
                  </tr>
                </thead>
                <tbody id="search_table_body">
                  <?php foreach ($result as $row) : ?>
                  <tr>
                    <th scope="row"><?php echo escape($row["candidate_name"]); ?></th>
                    <td><?php echo escape($row["candidate_position"]); ?></td>
                    <td><?php echo escape($row["candidate_party"]); ?></td>
                    <td><?php echo escape($row["votes"]); ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
      <!--Section: table results-->

    <!--Section: Election List-->
    <section class="mb-4 my-5">
        <h2 class="text-center">
            <strong>ELECTIONS</strong>
        </h2>
        <?php foreach ($result_event as $row) : ?>
        <div class="card">
            <div class="card-body">
                <div class="card text-center">
                    <div class="card-header">Start: <?php echo escape($row["start_election_date"]); ?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo escape($row["election_name"]); ?></h5>
                        <p class="card-text">
                            School: <?php echo escape($row["school_name"]); ?><br>
                            Department: <?php echo escape($row["depatment_name"]); ?>
                        </p>
                        <a href="viewelectionresult?electionid=<?php echo escape($row["election_id"]); ?>" class="btn btn-primary">View</a>
                    </div>
                    <div class="card-footer text-muted">Due: <?php echo escape($row["end_election_date"]); ?></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
    <!--Section: end Election List-->
    </div>
</main>
<!--Main layout-->
<?php include 'templates/footer.php' ?>