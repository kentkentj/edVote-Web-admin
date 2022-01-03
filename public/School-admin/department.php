<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
    <!--Section: Sales Performance KPIs-->
        <button type="button" class="btn btn-secondary btn-rounded mb-4">ADD DEPARTMENT</button>
        <section class="mb-4">
            <div class="card">
            <div class="card-header text-center py-3">
                <h5 class="mb-0 text-center">
                <strong>Departments</strong>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Department ID</th>
                        <th scope="col">Number of Students</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Department Name</th>
                        <td>
                            -48.8%%
                        </td>
                        <td>
                            14.0%
                        </td>
                        <td>
                            <a href="#" class="link-danger">Delete</a>
                            <a href="#" class="link-info ps-2">Update</a>
                        </td>
                    </tr>
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