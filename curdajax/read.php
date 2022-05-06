<?php

require_once 'model.class.php';

$model = new Model();

$rows = $model->fetchAllRecords();

?>


<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php

$i = 1;

if ( !empty( $rows ) ) {
    foreach ( $rows as $row ) {
        ?>
    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['lastname']; ?></td>
      <td><a id="edit" value="<?php echo $row['student_id'];?>" class="btn btn-warning" data-toggle="modal"
          data-target="#updateModal"> Edit </a>
      </td>
      <td><a id="delete" value="<?php echo $row['student_id'];?>" class="btn btn-danger">Delete </a></td>
    </tr>
    <?php
}
}
?>
  </tbody>
</table>
<!-- Update Modal Start-->



<!-- Update Modal End-->







<script>
//Delete Record

$(document).on('click', '#delete', function(e) {

  e.preventDefault();

  if (window.confirm('are you sure to delete data')) {
    var delete_id = $(this).attr('value');

    $.ajax({
      url: 'delete.php',
      type: 'post',
      data: {
        studentdelete_id: delete_id
      },
      success: function(response) {
        fetch();
        $('#message').html(response);
      }
    });
  } else {
    return false;
  }
});
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