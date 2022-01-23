<?php 
require "../../config.php";
require "../../common.php"; 

if (isset($_GET['id']))
{
    try
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
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
<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4 w-50 my-5">
        <!--<form method="post" action="store_detail.php">
      <table id="employee_table" align=center>
      <tr id="row1">
        <td><input type="text" name="name[]" placeholder="Enter Name"></td>
        <td><input type="text" name="age[]" placeholder="Enter Age"></td>
        <td><input type="text" name="job[]" placeholder="Enter Job"></td>
      </tr>
      </table>
      <input type="button" onclick="add_row();" value="ADD ROW">
      <input type="submit" name="submit_row" value="SUBMIT">
    </form>-->
      <div id="row1" class="card">
            <div class="container pt-2 w-75 my-5">
              <h2 class="mb-0 text-center">
                <strong>Candidate</strong>
              </h2>
              <div class="container my-4">
                <div class="form-outline mb-4">
                  <input id="candidate-name" type="text" class="form-control" name="" value=""/>
                  <label class="form-label" for="candidate-name" ?>Candidate Name</label>
                </div>

                <div class="form-outline mb-4">
                  <input id="party" type="text" class="form-control" name="" value=""/>
                  <label class="form-label" for="party-name" ?>Party</label>
                </div>

                <select class="form-select" name="year">
                  <option value="">President</option>
                </select>

                <!-- Upload image input-->
                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm my-5">
                    <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                    </div>
                </div>

                <!-- Uploaded image area-->
                <p class="font-italic text-white text-center">The image uploaded will be rendered inside the box below.</p>
                <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" style="width:300px;"></div>

                <button type="button" class="btn btn-primary w-100">Done</button>
              </div>
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