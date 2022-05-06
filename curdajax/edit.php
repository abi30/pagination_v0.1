<?php

require_once 'model.class.php';

$update_id = $_POST['studentupdate_id'];

$model = new Model();

$row = $model->edit( $update_id );

if ( !empty( $row ) ) {
    ?>

<form id="edit_form" method="post" class="form-horizontal">

  <div class="form-group">
    <label class="col-sm-3 control-label">Firstname</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="edit_firstname" value="<?php echo $row['firstname']; ?>"
        placeholder="enter firstname" />
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Lastname</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="edit_lastname" value="<?php echo $row['lastname']; ?> "
        placeholder="enter lastname" />
    </div>
  </div>

  <input type="hidden" id="edit_id" value="<?php echo $row['student_id']; ?>">

</form>

<?php
}

?>