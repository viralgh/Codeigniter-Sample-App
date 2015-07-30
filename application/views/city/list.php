<?php if($this->session->flashdata('data')):?>
<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> <?php echo $this->session->flashdata('data')?>
</div>
<?php endif?>

<table id="country_list" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>City Name</th>
                <th>State Name</th>
                <th>Country Name</th>
                <th>ISO2</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>ID</th>
                <th>City Name</th>
                <th>State Name</th>
                <th>Country Name</th>
                <th>ISO2</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </tfoot>
 
        <tbody>
            <?php

            if($city_data){
                foreach($city_data as $single){
                ?>
            <tr>
                <td><?php echo $single->city_id?></td>
                <td><?php echo $single->city_name?></td>
                <td><?php echo $single->state_name?></td>
                <td><?php echo $single->country_name?></td>
                <td><?php echo $single->iso2?></td>
                <td><a data-id="<?php echo $single->city_id?>" class="delete btn btn-danger btn-sm">Delete</a></td>
                <td><a data-id="<?php echo $single->city_id?>" class="edit btn btn-warning btn-sm">Edit</a></td>
            </tr>
            <?php 

                }
            }

            ?>
        </tbody>
    </table>

<script>
$(document).ready(function() {
    $('#country_list').DataTable({
       'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': [-1,-2] /* 1st one, start by the right */
        }],
        'fnDrawCallback': function(){
            $('.edit').click(function(){
                $id = $(this).data('id');
                location.href = <?php echo json_encode(site_url('city/edit'))?>+'/'+$id;
            });

            $('.delete').click(function(){
                $id = $(this).data('id');
                sure = confirm('Are you sure?');
                if(sure)
                {
                    location.href = <?php echo json_encode(site_url('city/delete'))?>+'/'+$id;
                }
            });
        }
    });

   
});
</script>