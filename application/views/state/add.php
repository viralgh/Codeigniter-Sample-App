<form role="form" action="<?php echo site_url("state/add")?>" method="post">
  <div class="form-group">
    <label for="country_name">State Name:</label>
    
    <?php if(form_error('state_name')):?>
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <?php echo form_error('state_name')?>
    </div>
    <?php endif?>
    
    <input type="text" value="<?php echo $state_name?>" class="form-control" id="state_name" name="state_name">
  </div>

<div class="form-group">
  <label for="country">State Belongs to:</label>

  <?php if(form_error('country_id')):?>
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <?php echo form_error('country_id')?>
    </div>
    <?php endif?>

  <select name="country_id" id="country_id">
    <option value=""> --- select from countries below --- </option>
    <?php echo generate_country_options($country_id); // function defined in custom_helper.php ?>
  </select>
</div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>