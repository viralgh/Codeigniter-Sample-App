<form role="form" action="<?php echo site_url("city/add")?>" method="post">
  
  <div class="form-group">
  <label for="country_id">City Belongs to [Country]:</label>

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

<div class="form-group">
  <label for="state_id">City Belongs to [State]:</label>

  <?php if(form_error('state_id')):?>
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <?php echo form_error('state_id')?>
    </div>
    <?php endif?>

  <select name="state_id" id="state_id" disabled>
    <option value=""> --- select country first --- </option>
  </select>
</div>

<div class="form-group">
    <label for="city_name">City Name:</label>
    
    <?php if(form_error('city_name')):?>
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
      <?php echo form_error('city_name')?>
    </div>
    <?php endif?>
    
    <input type="text" value="<?php echo $city_name?>" class="form-control" id="city_name" name="city_name">
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>

<script>
$(function(){

    $('#country_id').on('change',function(){

        $("#country_id option[value='']").remove();

        $country_id = $(this).val();
        $url = <?php echo json_encode(site_url('city/state_ajax'))?>;

        $.post($url, {country_id: $country_id}, 
            function(html){
                $('#state_id').html(html).removeAttr('disabled');
            }, 'html');

    });

    if($('#country_id').val() != '')
    {
        $("#country_id option[value='']").remove();

        $state_id = <?php echo $state_id ? $state_id : 0?>;
        $country_id = $('#country_id').val();
        $url = <?php echo json_encode(site_url('city/state_ajax'))?>;
        
        $.post($url, {country_id: $country_id, selected: $state_id}, 
            function(html){

                $('#state_id').html(html).removeAttr('disabled');
            }, 'html');
    }

});
</script>