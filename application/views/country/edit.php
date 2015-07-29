<form role="form" action="<?php echo site_url("country/edit/$id")?>" method="post">
  <div class="form-group">
    <label for="country_name">Country Name:</label>
    
    <?php if(form_error('country_name')):?>
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <?php echo form_error('country_name')?>
    </div>
    <?php endif?>
    
    <input type="text" value="<?php echo $country_name?>" class="form-control" id="country_name" name="country_name">
  </div>

  <div class="form-group">
    <label for="iso2">ISO2 Name:</label>

    <?php if(form_error('iso2')):?>
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <?php echo form_error('iso2')?>
    </div>
    <?php endif?>
    
    <input type="text" value="<?php echo $iso2?>" class="form-control" id="iso2" name="iso2">
  </div>
  <input type="hidden" name="country_id" value="<?php echo $id?>">
  <button type="submit" class="btn btn-default">Submit</button>
</form>