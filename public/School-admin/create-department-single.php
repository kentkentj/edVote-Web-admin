<?php include 'templates/header.php' ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4 w-50 p-3">
      <!-- Section: Add department -->
      <section class="mb-4">
        <div class="card">
            <div class="card-header py-3">
                <h5 class="mb-0 text-center"><strong>Add Department</strong></h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <!-- Depatment Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="departmentName" class="form-control" name="departmentName" />
                        <label class="form-label" for="departmentName">Department Name</label>
                    </div>

                    <!-- Depatment Abreviation input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="departmentNameAbreviation" class="form-control"  name="departmentAbbrevation"/>
                        <label class="form-label" for="departmentNameAbreviation">Department Abreviation</label>
                    </div>

                    
                    <div class="text-center">
                        <div class="row">
                            <div class="col pt-2">
                                <a href="department" type="button" class="btn btn-primary btn-rounded w-100">Back</a>
                            </div>
                            <div class="col pt-2">
                                <button type="submit" class="btn btn-secondary btn-rounded w-100" name="create_department">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </section>
      <!-- Section: Add department -->
    </div>
  </main>
  <!--Main layout-->
<?php include 'templates/footer.php' ?>