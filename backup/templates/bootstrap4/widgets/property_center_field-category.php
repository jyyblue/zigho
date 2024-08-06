<?php

    $category_id = 1;

?>

<?php if(isset(${"category_options_$category_id"}) && ${"category_options_count_$category_id"}>0): ?>
  <div class="widget widget-box box-container widget-overview">
    <div class="widget-header text-uppercase">
        <?php echo ${"options_name_$category_id"} ?>
    </div>
    <ul class="list-overview">
        <?php foreach(${"category_options_$category_id"} as $key=>$row): ?>
        <?php if(!empty($row['option_value'])): ?>
            <?php if(sw_count($row['is_text']) > 0): ?>
        
            <div class="panel-row"> 
                <p class="bottom-border"><strong><?php _che($row['option_name']); ?>:</strong> <span><?php echo _che($row['option_prefix']); ?> <?php echo _che($row['option_value']); ?> <?php echo _che($row['option_suffix']); ?></span><br style="clear: both;" /></p>
            </div>
            
            <?php elseif(sw_count($row['is_dropdown']) > 0): ?>
            
            <div class="panel-row"> 
                <p class="bottom-border"><strong><?php _che($row['option_name']); ?>:</strong> <span class="label label-success"><?php echo _che($row['option_prefix']); ?> <?php echo _che($row['option_value']); ?> <?php echo _che($row['option_suffix']); ?></span><br style="clear: both;" /></p>
            </div>
            
            <?php endif; ?>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div><!-- /. widget-center_field -->   
<?php endif; ?>

