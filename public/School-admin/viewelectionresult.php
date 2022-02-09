
<?php
/** * Use an HTML form to edit an entry in the * users table. * */
require "../../config.php";
require "../../common.php";

if (isset($_GET['electionid']))
{
    try{

        $connection=new PDO($dsn, $username, $password, $options);
        $id = $_GET['electionid'];
        $sql="SELECT COUNT(voters_vote_id) AS 'votes', candidate_name, candidate_position,candidate_party ,position_id FROM balot_counting_table WHERE election_id = :electionid GROUP BY candidate_position ORDER BY position_id";
    
        $statement = $connection->prepare($sql);
        $statement->bindValue(':electionid', $id);
        $statement->execute();
        $result = $statement->fetchAll();
    
    } catch(PDOException $error){
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
      <!--Section: Sales Performance KPIs-->
      <section class="mb-4">
        <div class="card">
          <div class="card-header text-center py-3">
            <h5 class="mb-0 text-center">
              <strong>Results of Election</strong>
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
                <tbody>
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
      <!--Section: Sales Performance KPIs-->
    </div>
  </main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>