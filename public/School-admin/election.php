<?php include 'templates/header.php' ?>

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
            <h5 class="card-title">TITLE</h5>
            <div class="form-outline">
              <input type="text" id="title" class="form-control" name="firstname" />
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

            <button class="btn btn-primary btn-rounded w-100 ripple-surface">CREATE ELECTION</button>
          </div>
        </div>
        <!--end Create Election Event-->
      </div>

      <div class="col-sm-6 my-4">
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
                      <th scope="col">Product Detail Views</th>
                      <th scope="col">Unique Purchases</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Product Revenue</th>
                      <th scope="col">Avg. Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">Election Name</th>
                      <td>18,492</td>
                      <td>228</td>
                      <td>350</td>
                      <td>$4,787.64</td>
                      <td>$13.68</td>
                    </tr>
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