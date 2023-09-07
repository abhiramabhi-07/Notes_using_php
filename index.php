<?php
//connect to the database]
$insert=false;
$update=false;
$delete=false;
$servername="localhost";
$username="root";
$pass="";
$db="notes";

$conn=mysqli_connect($servername,$username,$pass,$db);
if(!$conn){
  die ("sorry,not connected");
}

if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $sql="DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
  $result=mysqli_query($conn,$sql);
  if($result){
    $delete=true;
  }
}
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['snoEdit'])){
    $sno=$_POST["snoEdit"];
    $title2=$_POST["titleedit"];
    $description2=$_POST["descriptionedit"];
    $sql="UPDATE `notes` SET `title`='$title2' ,`description` = '$description2' WHERE `notes`.`sno` = $sno";
    $result=mysqli_query($conn,$sql);
    if($result){
      $update=true;
    }
  }
  else{
  $title1=$_POST["title"];
  $description1=$_POST["description"];
  $sql="Insert into `notes`(`title`,`description`) values ('$title1','$description1')";
  $result=mysqli_query($conn,$sql);
  if($result){
    $insert=true;
  }
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>project-k</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
       });
    </script>
   
  </head>
  <body>
       <!-- Button trigger modal
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit modal
        </button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModal">Update the Notes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/php_pratice/index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
        <label for="titleedit" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="titleedit" name="titleedit" >
        </div>
        <div class="form-floating my-3">
        <textarea class="form-control" name="descriptionedit" id="descriptionedit"></textarea>
        <label for="descriptionedit">Enter your text here!</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Note</button>
      </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="notes.png" alt style="height:35px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">About</a></li>
              <li><a class="dropdown-item" href="#">Description</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">More</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Successful.</strong> You note has been Inserted into the database.
      <button type='button' class='tn-close' data-bs-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span></button></div>";
  }?>
   <?php
    if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Updated Successfully. </strong> You note has been updated into the database.
      <button type='button' class='tn-close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>";
    }?>
     <?php
    if($delete){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Deleted Successfully. </strong> You note has been Deleted from the database.
      <button type='button' class='tn-close' data-bs-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>";
    }
  ?>
  
    
  <div class="container my-3" >
    <h3>Add Your Note Here!</h3>
    <form action="/php_pratice/index.php" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" >
      </div>
      <div class="form-floating my-3">
        <textarea class="form-control" placeholder="Leave a comment here" name="description" id="description"></textarea>
        <label for="description">Enter your text here!</label>
      </div>
      <button type="submit" class="btn btn-primary">Add note</button>
    </form>
    <table class="table table-striped" id="myTable">
    <thead>
      <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $sqlQuery="Select * from `notes`";
      $result1=mysqli_query($conn,$sqlQuery);
      $sno=0;
      while($row=mysqli_fetch_assoc($result1)){
        $sno=$sno+1;
        echo "<tr>
        <th scope='row'>".$sno."</th>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
        <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>  <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
        </tr>";
        echo "<br>";
      }
      
      ?>
      </tbody>
      </table>
  </div>
  <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach(element => {
        element.addEventListener("click",(e)=>{
          console.log("edit ",);
          tr=e.target.parentNode.parentNode;
          title=tr.getElementsByTagName("td")[0].innerText;
          description=tr.getElementsByTagName("td")[1].innerText;
          console.log(title,description);
          titleedit.value=title;
          descriptionedit.value=description;
          snoEdit.value=e.target.id;
          console.log(e.target.id); 
          $('#editModal').modal('toggle');
        })
      });

      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach(element => {
        element.addEventListener("click",(e)=>{
          console.log("delete ",);
          sno = e.target.id.substr(1);
          if (confirm("Are you sure you want to delete this note!")) {
            console.log("yes");
            window.location = `/php_pratice/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
          }
          else {
            console.log("no");
          }
        })
      });
      
      </script>

</body>
</html> 