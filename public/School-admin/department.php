<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
    <!--Section: Sales Performance KPIs-->
        <button type="button" class="btn btn-secondary btn-rounded mb-4" data-mdb-toggle="modal" data-mdb-target="#exampleModal">ADD DEPARTMENT</button>
        <!--Add Department-->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                Close
                </button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>

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