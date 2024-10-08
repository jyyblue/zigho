<?php
    if(config_item('field_dropdown_multiple_enabled') !== TRUE) {
        echo '<div style="padding: 8px 12px;color: #fff;margin-bottom: 10px;">';
        echo lang_check('Please add config "field_dropdown_multiple_enabled"');
        echo '</div>';
        return false;
    }

    $col=6;
    $f_id = $field->id;
    $placeholder = _ch(${'options_name_'.$f_id});
    $direction = $field->direction;
    if($direction == 'NONE'){
        $col=12;
        $direction = '';
    }
    else
    {
        $placeholder = lang_check($direction);
        $direction=strtolower('_'.$direction);
    }
    
    $f_id = $field->id;
    $class_add = $field->class;
    if(empty($class_add))
        $class_add = ' col-md-3';
    
?>
<div class=" <?php echo $class_add; ?>" style="<?php _che($field->style); ?>">
    <div class="form-group form-group-lg field_select">
        <select id="search_option_<?php echo $f_id; ?>_multi" multiple="multiple" name="search_option_<?php echo $f_id; ?>" class="form-control select_styled base no-padding color-secondary">
            <?php _che(${'options_values_'.$f_id}); ?>
        </select>
    </div><!-- /.select-wrapper -->
</div><!-- /.form-group -->