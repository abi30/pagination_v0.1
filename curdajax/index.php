<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <div class="container">
    <center>
      <h2>Add Record</h2>
    </center>

    <form id="insert_form" method="post" class="form-horizontal">

      <div class="form-group">
        <label class="col-sm-3 control-label">Firstname</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="txt_firstname" placeholder="enter firstname" />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Lastname</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="txt_lastname" placeholder="enter lastname" />
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6 m-t-15">
          <button type="submit" id="btn_create" class="btn btn-success">Insert</button>
        </div>
      </div>

    </form>

    <br />

    <div class="col-lg-12">
      <div id="message"></div>
      <div id="fetch"></div>
    </div>
  </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>


  <?php include_once "footerjquery.php" ; ?>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


  <script src="myjs.js"></script>

  <script>
  $(document).on("click", "#btn_create", function(e) {
    e.preventDefault();

    var firstname = $("#txt_firstname").val();
    var lastname = $("#txt_lastname").val();
    var create = $("#btn_create").val();

    $.ajax({
      url: "create.php",
      type: "post",
      data: {
        studentfirstname: firstname,
        studentlastname: lastname,
        insertbutton: create,
      },
      success: function(response) {
        fetch();
        $("#message").html(response);
      },
    });

    $("#insert_form")[0].reset();

    //Fetch All Records

    function fetch() {
      $.ajax({
        url: "read.php",
        type: "get",
        success: function(response) {
          $("#fetch").html(response);
        },
      });
    }

    fetch();
  });
  </script>




</body>

</html>

<div class="modal fade" id="updateModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div id="update_data"></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id="btn_update" class="btn btn-primary">Update</button>
      </div>

    </div>
  </div>
</div>

<script>
//Get Specific Id record or Edit Record 

$(document).on('click', '#edit', function(e) {

  e.preventDefault();

  var update_id = $(this).attr('value');

  $.ajax({
    url: 'edit.php',
    type: 'post',
    data: {
      studentupdate_id: update_id
    },
    success: function(response) {
      $('#update_data').html(response);
    }
  });

});
</script>