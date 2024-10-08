<?php
  // Connecting to database   
  $database = connectToDB();


// 3. get students data from the database
  // 3.1 - SQL command (recipe)
  $sql = "SELECT * FROM students";
  // 3.2 - prepare SQL query (prepare your material)
  $query = $database->prepare($sql); 
  // 3.3 - execute SQL query (to cook)
  $query->execute();
  // 3.4 - fetch all the results (eat)
  $students = $query->fetchAll();


?>
<?php require 'parts/header.php';?>
    <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">My Classroom</h3>

      <?php if( isset( $_SESSION["user"])):?>
        <h4>Welcome Back,<?= $_SESSION["user"]["name"];?></h4>
        <a href="/logout"><button class="btn btn-sm btn-danger">Log Out</button></a>
          <form method="POST" action="/student/add">
            <div class="mt-4 d-flex justify-content-between align-items-center">
              <input
                type="text"
                class="form-control"
                placeholder="Add new student..."
                name="student_name"
              />
              <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
            </div>
          </form>
        <?php else:?>
        <p>Please login to continue</p>
        <a href="/login"><button class="btn btn-sm btn-primary">Login</button></a>
        <a href="/signup"><button class="btn btn-sm btn-primary">Sign Up</button></a>
        <?php endif;?>
      </div>
    </div>
    
    <?php if(isset( $_SESSION["user"])): ?>
    <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">Students</h3>
        <?php foreach ($students as $index => $student) : ?>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="me-1"><?= $index+1; ?>.</h5>
            <div class="d-flex gap-1 w-100">
              <!-- UPDATE -->
              <form
                method="POST"
                action="/student/edit"
                >
                <input type="text" name="updated_name" value="<?= $student["name"]; ?>" style="width: 300px;" />
                <input type="hidden" name="student_id" value="<?= $student["id"]; ?>" />
                <button class="btn btn-success btn-sm">Update</button>
              </form>
              <!-- DELETE -->
              <form
                method="POST"
                action="/student/delete"
                >
                <input type="hidden" name="student_id" value="<?= $student["id"]; ?>" />
                <button class="btn btn-danger btn-sm">Delete</button>
              </form>  
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif;?>
    

<?php require 'parts/footer.php';?>