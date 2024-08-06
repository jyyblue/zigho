<!DOCTYPE html>
<html lang="en">
<head>
    <?php _widget('head');?>
    
    <?php if(config_db_item('map_version') !='open_street'):?>
        <script src='assets/js/gmap3/gmap3.min.js'></script>
    <?php endif;?> 
</head>

<body class="<?php _widget('custom_paletteclass');?>">
    <div class="container container-wrapper">
    <header class="header">
        <div class="top-box" data-toggle="sticky-onscroll">
            <div class="container">
                <?php _widget('header_loginmenu');?>
                <?php _widget('header_mainmenu');?>
            </div> 
        </div>
    </header><!-- /.header--> 
    
    <main class="main main-container section-color-primary" id="main">
        <div class="container">
            <div class="row">
                <div class="h-side clearfix">
                    <div class="float-sm-left">
                    </div>
                </div> <!-- /. content-header --> 

                <div class="col-md-8 affix-parent">
                    <div class="widget widget-box box-container widget-overview" id="content">
                        <div class="widget-header text-uppercase">
                            <h2><?php _l('Quick add listing'); ?></h2>
                        </div>
                        <div class="property_content">
                            <div class="box-body box-alert">
                                <?php if($this->user_m->loggedin()): ?>
                                <?php else: ?>                                                               
                                <p class="alert alert-info"><?php echo lang_check('Already registered?');?> <a href="{front_login_url}#content" style="color: inherit;"> <?php echo lang_check('Then login here');?></a></p>                                                          
                                <?php endif;?>    
                                <?php echo validation_errors()?>
                                <?php if($this->session->flashdata('message')):?>
                                <?php echo $this->session->flashdata('message')?>
                                <?php endif;?>
                                <?php if($this->session->flashdata('error')):?>
                                <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                                <?php endif;?>
                            </div>
                            <!-- Form starts.  -->
                            <?php echo form_open(NULL, array('class' => 'form-horizontal form-estate form-editproperty', 'role'=>'form'))?>                              
                                <?php if($this->user_m->loggedin()): ?>
                                    <div class="control-group">
                                      <label class="control-label"><?php _l('Your login')?></label>
                                      <div class="controls">
                                        <?php echo form_input('login', $this->session->userdata('username'), 'class="form-control" id="input_login" readonly placeholder="'.lang_check('Your login').'"')?>
                                      </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(!$this->user_m->loggedin()): ?>

                                    <div class="control-group">
                                      <label for="input_mail" class="control-label">*<?php _l('Your email')?></label>
                                      <div class="controls">
                                        <?php echo form_input('mail', set_value('mail', ''), 'class="form-control" id="input_mail" placeholder="'.lang_check('Your email').'"')?>
                                      </div>
                                    </div>

                                <?php endif; ?>

                                    <div class="control-group">
                                      <label for="input_address" class="control-label"><?php if(config_db_item('address_not_required') !== TRUE):?>*<?php endif;?><?php _l('Listing address')?></label>
                                      <div class="controls">
                                        <?php echo form_input('address', set_value('address', ''), 'class="form-control" id="input_address" placeholder="'.lang_check('Listing address').'"')?>
                                      </div>
                                    </div>

                                    <div class="control-group hidden">
                                      <label for="inputGps" class="control-label"><?php if(config_db_item('address_not_required') !== TRUE):?>*<?php endif;?><?php  _l('Gps')?></label>
                                      <div class="controls">
                                        <?php echo form_input('gps', set_value('gps', ''), 'class="form-control" id="inputGps" placeholder="'.lang_check('Gps').'"  readonly')?>
                                      </div>
                                    </div>

                                    <div class="control-group hidden">
                                      <label for="repository_id" class="control-label"><?php _l('Repository')?></label>
                                      <div class="controls">
                                        <?php echo form_input('repository_id', set_value('repository_id', $repository_id), 'class="form-control" id="repository_id" placeholder="'.lang_check('Repository').'"  readonly')?>
                                      </div>
                                    </div>

                                <h5><?php echo lang('Translation data') ?></h5>
                                <div role="tabpanel" style="margin-bottom: 0px;" class="tabbable">
                                    <ul class="nav nav-tabs lang-tabs" data-toggle="affix">
                                        <?php $i=0;foreach($this->option_m->languages as $key=>$val):$i++;

                                        if(config_db_item('multilang_on_qs') == 0 && $this->language_m->get_default() != $this->language_m->get_code($key))
                                            continue;

                                        ?>
                                        <li class="nav-item lang rtab"><a data-toggle="tab" href="#lang_id_<?php echo $key?>" class="nav-link <?php echo $i==1?'active':''?>"><?php echo $val?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                    
                                    <div style="padding-top: 9px;" class="tab-content">
                                        <?php $i = 0;
                                        foreach ($this->option_m->languages as $key => $val):$i++; ?>
                                            <div id="lang_id_<?php echo $key ?>" role="tabpanel" class="tab-pane <?php echo $i == 1 ? 'active' : '' ?>">

                                            <?php if (config_db_item('slug_enabled') === TRUE): ?>
                                                <div class="control-group form-group hidden">
                                                    <label class="col-xl-3 control-label"><?php echo lang_check('URI slug') ?></label>
                                                    <div class="col-xl-9 controls">
                                                        <?php echo form_input('slug_' . $key, set_value('slug_' . $key, $estate['slug_' . $key]), 'class="form-control" id="inputOption_' . $key . '_slug" placeholder="' . lang_check('URI slug') . '"') ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php foreach($options as $key_option=>$val_option):?>
                                            <?php
                

                                            if(isset(${'parent_field_is_hidden'.$val_option['parent_id']}) && ${'parent_field_is_hidden'.$val_option['parent_id']} == TRUE) {
                                                $val_option['is_quickvisible'] = 0;
                                            }

                                            if($val_option['type'] == 'CATEGORY') {
                                                if(!$val_option['is_quickvisible'])
                                                    ${'parent_field_is_hidden'.$val_option['id']} = TRUE;
                                            }
                                            
                                            //if($val_option['type'] != 'TREE')
                                            if(empty($val_option['is_required']) && empty($val_option['is_quickvisible']))
                                                continue;

                                            $required_text = '';
                                            $required_notice = '';
                                            if($val_option['is_required'] == 1 && $val_option['is_quickvisible'] != 0)
                                            {
                                                $required_text = 'required';
                                                $required_notice = '*';
                                            }

                                            $max_length_text = '';
                                            if($val_option['max_length'] > 0)
                                            {
                                                $max_length_text = 'maxlength="'.$val_option['max_length'].'"';
                                            }

                                            $is_not_translatable = false;

                                            if($key != $this->language_m->get_default_id() && isset($val_option['is_not_translatable']) && $val_option['is_not_translatable']==1) {
                                                $is_not_translatable = true;
                                            }

                                            ?>
                                                
                                            <?php if($val_option['type'] == 'CATEGORY'):?>

                                            <h5 class="<?php echo ($val_option['is_frontend'] ? '' : ' hidden') ?>"><hr /><?php echo $val_option['option']?> <span class="checkbox-visible"><?php echo form_checkbox('option'.$val_option['id'].'_'.$key, 'true', set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'id="inputOption_'.$key.'_'.$val_option['id'].'"')?> <?php echo lang_check('Hidden on preview page'); ?></span><hr /></h5>

                                            <?php elseif($val_option['type'] == 'INPUTBOX' || $val_option['type'] == 'DECIMAL' || $val_option['type'] == 'INTEGER'):?>
                                                <div class="control-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                                    <label for="inputOption_<?php echo $key;?>_<?php echo $val_option['id'];?>" class="control-label"><?php echo $required_notice.$val_option['option']?><?php if(!empty($val_option['hint'])):?><i class="icon-question-sign hint" data-hint="<?php echo $val_option['hint'];?>"></i><?php endif;?></label>
                                                <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                                    <div class="controls">
                                                        <?php echo form_input('option'.$val_option['id'].'_'.$key, set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'class="form-control '.$val_option['type'].'" id="inputOption_'.$key.'_'.$val_option['id'].'" placeholder="'.$val_option['option'].'" '.$required_text.' '.$max_length_text)?>
                                                        <?php if(!empty($options_lang[$key][$key_option]->prefix) || !empty($options_lang[$key][$key_option]->suffix)): ?>
                                                            <?php echo $options_lang[$key][$key_option]->prefix.$options_lang[$key][$key_option]->suffix?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php elseif($val_option['type'] == 'DROPDOWN'):?>
                                                <div class="control-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                                    <label for="inputOption_<?php echo $key;?>_<?php echo $val_option['id'];?>" class="control-label"><?php echo $required_notice.$val_option['option']?><?php if(!empty($val_option['hint'])):?><i class="icon-question-sign hint" data-hint="<?php echo $val_option['hint'];?>"></i><?php endif;?></label>
                                                <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                                    <div class="controls">
                                                        <?php
                                                        if(isset($options_lang[$key][$key_option]))
                                                        {
                                                            $drop_options = array_combine(explode(',',check_combine_set(isset($options_lang[$key])?$options_lang[$key][$key_option]->values:'', $val_option['values'], '')),explode(',',check_combine_set($val_option['values'], isset($options_lang[$key])?$options_lang[$key][$key_option]->values:'', '')));
                                                        }
                                                        else
                                                        {
                                                            $drop_options = array();
                                                        }

                                                        // If you don't want translation to website langauge uncomment this 1 line below:
                                                        // $drop_options = array_combine(explode(',', $options_lang[$key][$key_option]->values), explode(',', $options_lang[$key][$key_option]->values));

                                                        $drop_selected = set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:'');

                                                        echo form_dropdown('option'.$val_option['id'].'_'.$key, $drop_options, $drop_selected, 'class="form-control" id="inputOption_'.$key.'_'.$val_option['id'].'" placeholder="'.$val_option['option'].'" '.$required_text)

                                                        ?>
                                                    </div>
                                                    <?php endif;?>
                                                </div>
                                            <?php elseif($val_option['type'] == 'DROPDOWN_MULTIPLE' && config_item('field_dropdown_multiple_enabled') === TRUE):?>
                                            <div class="control-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                              <label for="inputOption_<?php echo $key;?>_<?php echo $val_option['id'];?>" class="control-label"><?php echo $required_notice.$val_option['option']?><?php if(!empty($val_option['hint'])):?><i class="icon-question-sign hint" data-hint="<?php echo $val_option['hint'];?>"></i><?php endif;?></label>
                                                <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                              <div class="controls">
                                                <?php
                                                if(isset($options_lang[$key][$key_option]))
                                                {
                                                    $drop_options = array_combine(explode(',',check_combine_set(isset($options_lang[$key])?$options_lang[$key][$key_option]->values:'', $val_option['values'], '')),explode(',',check_combine_set($val_option['values'], isset($options_lang[$key])?$options_lang[$key][$key_option]->values:'', '')));
                                                }
                                                else
                                                {
                                                    $drop_options = array();
                                                }
                                                
                                                // If you don't want translation to website langauge uncomment this 1 line below:
                                                // $drop_options = array_combine(explode(',', $options_lang[$key][$key_option]->values), explode(',', $options_lang[$key][$key_option]->values));
                                                
                                                $drop_selected = set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:'');

                                                echo form_dropdown('option'.$val_option['id'].'_'.$key, $drop_options, $drop_selected, 'class="form-control" id="inputOption_'.$key.'_'.$val_option['id'].'" placeholder="'.$val_option['option'].'" '.$required_text)
                                                
                                                ?>
                                              </div>
                                              <?php endif;?>
                                            </div>
                                            <?php elseif($val_option['type'] == 'TEXTAREA'):?>
                                                <div class="control-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                                    <label for="inputOption_<?php echo $key;?>_<?php echo $val_option['id'];?>" class="control-label"><?php echo $required_notice.$val_option['option']?><?php if(!empty($val_option['hint'])):?><i class="icon-question-sign hint" data-hint="<?php echo $val_option['hint'];?>"></i><?php endif;?></label>
                                                      <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                                    <div class="controls">
                                                        <?php echo form_textarea('option'.$val_option['id'].'_'.$key, set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'class="ckeditor form-control" id="inputOption_'.$key.'_'.$val_option['id'].'" placeholder="'.$val_option['option'].'" '.$required_text)?>
                                                    </div>
                                                    <?php endif;?>
                                                </div>
                                            <?php elseif($val_option['type'] == 'TREE' && config_item('tree_field_enabled') === TRUE):?>
                                                <div class="control-group TREE-GENERATOR">
                                                    <label class="control-label">
                                                        <?php echo $val_option['option']?>
                                                        <div class="ajax_loading"> </div>
                                                    </label>
                                                <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                                    <div class="controls">
                                                        <?php
                                                        $drop_options = $this->treefield_m->get_level_values($key, $val_option['id']);
                                                        $drop_selected = array();

                                                        echo '<div class="field-row">';
                                                        echo form_dropdown('option'.$val_option['id'].'_'.$key.'_level_0', $drop_options, $drop_selected, 'class="form-control" id="inputOption_'.$key.'_'.$val_option['id'].'_level_0'.'" placeholder="'.$val_option['option'].'"');
                                                        echo '</div>';

                                                        $levels_num = $this->treefield_m->get_max_level($val_option['id']);

                                                        if($levels_num>0)
                                                        for($ti=1;$ti<=$levels_num;$ti++)
                                                        {
                                                            echo '<div class="field-row">';
                                                            echo form_dropdown('option'.$val_option['id'].'_'.$key.'_level_'.$ti, array(''=>lang_check('Please select parent')), array(), 'class="form-control" id="inputOption_'.$key.'_'.$val_option['id'].'_level_'.$ti.'" placeholder="'.$val_option['option'].'"');
                                                            echo '</div>';
                                                        }
                                                        ?>
                                                        <div class="field-row hidden">
                                                            <?php echo form_input('option'.$val_option['id'].'_'.$key, set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'class="form-control tree-input-value" rel="" id="inputOption_'.$key.'_'.$val_option['id'].'" placeholder="'.$val_option['option'].'"')?>
                                                        </div>
                                                    </div>
                                                    <?php endif;?>
                                                </div>
                                            <?php elseif($val_option['type'] == 'CHECKBOX'):?>
                                                <div class="control-group<?php echo ($val_option['is_frontend']?'':' hidden') ?>">
                                                    <label for="inputOption_<?php echo $key;?>_<?php echo $val_option['id'];?>" class="control-label"><?php echo $required_notice.$val_option['option']?><?php if(!empty($val_option['hint'])):?><i class="icon-question-sign hint" data-hint="<?php echo $val_option['hint'];?>"></i><?php endif;?></label>
                                                       <?php if($is_not_translatable):?>
                                                <div class="controls">
                                                    <div class="alert alert-warning non-translatable" role="alert"><?php echo lang_Check('Not translatable');?></div>
                                                 </div>
                                                <?php else:?>
                                                    <div class="controls">
                                                      <?php echo form_checkbox('option'.$val_option['id'].'_'.$key, 'true', set_value('option'.$val_option['id'].'_'.$key, isset($estate['option'.$val_option['id'].'_'.$key])?$estate['option'.$val_option['id'].'_'.$key]:''), 'id="inputOption_'.$key.'_'.$val_option['id'].'" class="valid_parent" '.$required_text)?>
                                                      <?php
                                                          if(file_exists(FCPATH.'templates/'.$settings_template.'/assets/img/icons/option_id/'.$val_option['id'].'.png'))
                                                          {
                                                              echo '<img class="results-icon" src="assets/img/icons/option_id/'.$val_option['id'].'.png" alt="'.$val_option['option'].'"/>';
                                                          }
                                                      ?>
                                                    </div>
                                                    <?php endif;?>
                                                </div>
                                            <?php endif;?>
                                            <?php endforeach;?>
                                        </div>
                                        <?php endforeach;?>
                                      </div>
                                    </div>

                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                <div class="control-group">
                                    <label class="control-label"><a target="_blank" href="<?php echo config_db_item('terms_link'); ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a></label>
                                    <div class="controls">
                                        <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="ezdisabled" id="inputOption_terms"')?>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                                                                           <?php

                                $site_url = site_url();
                                $urlparts = parse_url($site_url);
                                $basic_domain = $urlparts['host'];
                                $privacy_url = config_db_item('privacy_link');
                                $urlparts = parse_url($privacy_url);
                                $privacy_domain ='';
                                if(isset($urlparts['host']))
                                    $privacy_domain = $urlparts['host'];

                                if($privacy_domain == $basic_domain) {
                                    $privacy_url = str_replace('en', $lang_code, $privacy_url);
                                }
                            ?>
                                
                                
                                
                                <div class="control-group">
                                    <label class="control-label"> <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a></label>
                                    <div class="controls">
                                        <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(sw_count($not_logged)>0): ?>
                                    <?php if(config_item('captcha_disabled') === FALSE): ?>
                                    <div class="control-group" >
                                        <label class="control-label captcha"><?php echo $captcha['image']; ?></label>
                                        <div class="controls">
                                            <input class="captcha" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                                            <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(config_item('recaptcha_site_key') !== FALSE): ?>
                                    <div class="control-group" >
                                        <label class="control-label captcha"></label>
                                        <div class="controls">
                                            <?php _recaptcha(true); ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="control-group">
                                    <div class="controls">
                                        <?php echo form_submit('submit', lang('Save'), 'class="btn btn-primary"')?>
                                        </div>
                                </div>
                                
                            <?php echo form_close()?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget widget-box box-container">
                        <div class="widget-header text-uppercase"> 
                            <h2>{lang_Location}</h2>
                        </div>
                        <div class="property_content">
                            <div class="gmap" id="mapsAddress_nondefault"></div>
                        </div>
                    </div>
                    <div class="widget widget-box box-container">
                        <div class="widget-header text-uppercase"> 
                            <h2><?php echo _l('Sell or Rent quickly'); ?></h2>
                        </div>
                        <form method="get" action="#" id="mortgage_calculator">
                            <div class="property_content">
                                <ul>
                                    <li><?php _l('Populate address, title and description'); ?></li>
                                    <li><?php _l('Make sure you select right type and map marker icon'); ?></li>
                                    <li><?php _l('Put a good price'); ?></li>
                                    <li><?php _l('Add nice looking photos to your listing'); ?></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="box-container widget widget-box">
                        <?php if(!isset($repository_id)):?>
                        <span class="label label-danger label-important"><?php _l('Repository ID not available');?></span>
                        <?php else:?>
                        <div id="page-files-<?php echo $repository_id?>" rel="repository_m">
                            <!-- The file upload form used as target for the file upload widget -->
                            <form class="fileupload" action="<?php echo site_url('files/upload_repository/'.$repository_id);?>" method="POST" enctype="multipart/form-data">
                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                <noscript><input type="hidden" name="redirect" value="<?php echo site_url('fquick/submission/'.$lang_code)?>"></noscript>
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="fileupload-buttonbar row">
                                    <div class="col-lg-6">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <i class="icon-plus icon-white"></i>
                                            <span><?php echo lang_check('Addfiles')?></span>
                                            <input type="file" name="files[]" multiple>
                                        </span>
                                        <button type="reset" class="btn btn-warning cancel">
                                            <i class="icon-ban-circle icon-white"></i>
                                            <span><?php echo lang_check('Cancelupload')?></span>
                                        </button>
                                        <button type="button" class="btn btn-danger delete">
                                            <i class="icon-trash icon-white"></i>
                                            <span><?php echo lang_check('Deleteselection')?></span>
                                        </button>
                                        <input type="checkbox" class="toggle" />
                                    </div>
                                    <!-- The global progress information -->
                                    <div class="col-lg-6 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="bar" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress information -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The loading indicator is shown during file processing -->
                                <div class="fileupload-loading"></div>
                                <br />
                                <!-- The table listing the files available for upload/download -->
                                <!--<table role="presentation" class="table table-striped">
                                <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">-->

                                  <div role="presentation" class="fieldset-content">
                                    <?php if(config_item('onmouse_gallery_enabled') === TRUE): ?>
                                        <div class="onmouse_gallery-notice clearfix"> <?php echo lang_check('Please order images as described');?>:</div> 
                                        <ul class="onmouse_gallery-title-files clearfix"> 
                                            <li class="item text-center">
                                            <div class="img-rounded-title text-center"><?php echo lang_check('Main image');?></div>
                                            </li>
                                            <li class="item text-center">
                                            <div class="img-rounded-title text-center"><?php echo lang_check('Apartment').' 1' ;?></div>
                                            </li>
                                            <li class="item text-center">
                                            <div class="img-rounded-title text-center"><?php echo lang_check('Apartment').' 2' ;?></div>
                                            </li>
                                            <li class="item text-center">
                                            <div class="img-rounded-title text-center"><?php echo lang_check('Apartment').' 3' ;?></div>
                                            </li>
                                            <li class="item text-center">
                                            <div class="img-rounded-title text-center"><?php echo lang_check('...Other') ;?></div>
                                            </li>
                                        </ul>  
                                    <?php endif;?>
                                    <ul class="files files-list-u" data-toggle="modal-gallery" data-target="#modal-gallery">      
                                    <?php if(isset($files[$repository_id]))foreach($files[$repository_id] as $key=>$file ):?>
                                        <li class="img-rounded template-download fade in">   
                                        <div class="preview">
                                            <img class="img-rounded" alt="<?php echo $file->filename?>" data-src="<?php echo $file->thumbnail_url?>" src="<?php echo $file->thumbnail_url?>">
                                        </div>
                                        <div class="filename">
                                            <code><?php echo character_hard_limiter($file->filename, 20)?></code>
                                        </div>
                                        <div class="options-container">
                                            <?php if($file->zoom_enabled):?>
                                            <a data-gallery="gallery" href="<?php echo $file->download_url?>" title="<?php echo $file->filename?>" download="<?php echo $file->filename?>" class="zoom-button btn btn-mini btn-success"><i class="icon-search icon-white"></i></a>                  
                                            <a class="btn btn-mini btn-info iedit visible-inline-block-lg" rel="<?php echo $file->filename?>" href="#<?php echo $file->filename?>"><i class="icon-pencil icon-white"></i></a>
                                            <?php else:?>
                                            <a target="_blank" href="<?php echo $file->download_url?>" title="<?php echo $file->filename?>" download="<?php echo $file->filename?>" class="btn btn-mini btn-success"><i class="icon-search icon-white"></i></a>
                                            <?php endif;?>
                                            <span class="delete">
                                                <button class="btn btn-mini btn-danger" data-type="POST" data-url="<?php echo $file->delete_url?>"><i class="icon-trash icon-white"></i></button>
                                                <input type="checkbox" value="1" name="delete">
                                            </span>
                                        </div>
                                    </li>
                                     <?php endforeach;?>
                                    </ul>
                                    <br style="clear:both;"/>
                                  </div>
                            </form>

                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- /.main-part--> 

    <!-- footer -->
    <?php _widget('custom_footer');?>
    <!-- /.footer --> 
</div>
<?php _widget('custom_palette');?>
<?php _widget('custom_javascript');?>
<script src="assets/libraries/ckeditor_4.6.2_standard/ckeditor/ckeditor.js"></script>
<script>
    /* [START] TreeField */
    
    $(function() {
        $(".TREE-GENERATOR select").change(function(){
            var s_value = $(this).val();
            var s_name_splited = $(this).attr('name').split("_"); 
            var s_level = parseInt(s_name_splited[3]);
            var s_lang_id = s_name_splited[1];
            var s_field_id = s_name_splited[0].substr(6);
            // console.log(s_value); console.log(s_level); console.log(s_field_id);
            
            load_by_field($(this));
            
            // Reset child selection and value generator
            var generated_val = '';
            var last_selected_numeric = '';
            $(this).parent().parent()
            .find('select').each(function(index){
                // console.log($(this).attr('name'));
                if(index > s_level)
                {
                    $(this).html('<option value=""><?php echo lang_check('No values found'); ?></option>');
                    $(this).val('');
                }
                else if($(this).val() != '')
                {
                    last_selected_numeric = $(this).val();
                    generated_val+=$(this).find("option:selected").text()+" - ";
                }
                    
            });

            $("#inputOption_"+s_lang_id+"_"+s_field_id).attr('rel', last_selected_numeric);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).trigger("change");

        });
        
        // Autoload selects
        $(".TREE-GENERATOR input.tree-input-value").each(function(index_1){
            var s_values_splited = ($(this).val()+" ").split(" - "); 
//            $.each(s_values_splited, function( index, value ) {
//                alert( index + ": " + value );
//            });
            if(s_values_splited[0] != '')
            {
                var first_select = $(this).parent().parent().find('select:first');
                var find_selected = first_select.find('option').filter(function () { return $(this).html() == s_values_splited[0]; });
                find_selected.attr('selected', 'selected');
                
                var index_tree = find_selected.val();
                if (typeof index_tree !== typeof undefined && index_tree !== false)
                {
                    if($(this).attr('rel') != index_tree)
                    {
                        $(this).attr('rel', index_tree);
                        $(this).trigger("change");
                    }
                }

                load_by_field(first_select, true, s_values_splited);
            }
            
            //console.log('value: '+s_values_splited[0]);
        });

    });
    
    function load_by_field(field_element, autoselect_next, s_values_splited)
    {
        if (typeof autoselect_next === 'undefined') autoselect_next = false;
        if (typeof s_values_splited === 'undefined') s_values_splited = [];

        var s_value = field_element.val();
        var s_name_splited = field_element.attr('name').split("_"); 
        var s_level = parseInt(s_name_splited[3]);
        var s_lang_id = s_name_splited[1];
        var s_field_id = s_name_splited[0].substr(6);
        // console.log(s_value); console.log(s_level); console.log(s_field_id);
        
        // Load values for next select
        var ajax_indicator = field_element.parent().parent().parent().find('.ajax_loading');
        var select_element = $("select[name=option"+s_field_id+"_"+s_lang_id+"_level_"+parseInt(s_level+1)+"]");
        if(select_element.length > 0 && s_value != '')
        {
            ajax_indicator.css('display', 'block');
            $.getJSON( "<?php echo site_url('api/get_level_values_select'); ?>/"+s_lang_id+"/"+s_field_id+"/"+s_value+"/"+parseInt(s_level+1), function( data ) {
                //console.log(data.generate_select);
                //console.log("select[name=option"+s_field_id+"_"+s_lang_id+"_level_"+parseInt(s_level+1)+"]");
                ajax_indicator.css('display', 'none');
                
                select_element.html(data.generate_select);
                
                if(autoselect_next)
                {
                    if(s_values_splited[s_level+1] != '')
                    {
                        var find_selected = select_element.find('option').filter(function () { return $(this).html() == s_values_splited[s_level+1]; });
                        
                        find_selected.attr('selected', 'selected');
                        var index_tree = find_selected.val();
                        if (typeof index_tree !== typeof undefined && index_tree !== false)
                        {
                            var input_element = field_element.parent().parent().find("input.tree-input-value");

                            if(input_element.attr('rel') != index_tree)
                            {
                                input_element.attr('rel', index_tree);
                                $(input_element).trigger("change");
                            }
                        }
                        
                        load_by_field(select_element, true, s_values_splited);
                    }
                }
            });
        }
    }
    
    function load_and_select_index(field_element, field_select_id, field_parent_select_id)
    {
        var s_name_splited = field_element.attr('name').split("_"); 
        var s_level = parseInt(s_name_splited[3]);
        var s_lang_id = s_name_splited[1];
        var s_field_id = s_name_splited[0].substr(6);
        
        // Load values for current select
        var ajax_indicator = field_element.parent().parent().parent().find('.ajax_loading');
        if(s_level == 0)$("#inputOption_"+s_lang_id+"_"+s_field_id).attr('value', '');

        ajax_indicator.css('display', 'block');
        $.getJSON( "<?php echo site_url('api/get_level_values_select'); ?>/"+s_lang_id+"/"+s_field_id+"/"+field_parent_select_id+"/"+parseInt(s_level), function( data ) {
            ajax_indicator.css('display', 'none');
            
            field_element.html(data.generate_select);
            //console.log(field_select_id);
            if(isNumber(field_select_id))
                field_element.val(field_select_id);
            else
                field_element.val('');
            
            var generated_val = '';
            var last_selected_val = '';
            
            field_element.parent().parent()
            .find('select').each(function(index){
                if($(this).val() != '' && $(this).val() != null)
                {
                    last_selected_val = $(this).val();
                    generated_val+=$(this).find("option:selected").text()+" - ";
                }
            });

            if(generated_val.length > $("#inputOption_"+s_lang_id+"_"+s_field_id).val().length)
            {
                
                //alert(generated_val);
                //console.log(generated_val);
                $("#inputOption_"+s_lang_id+"_"+s_field_id).attr('rel', last_selected_val);
                $("#inputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
                $("#inputOption_"+s_lang_id+"_"+s_field_id).trigger('change');
            }

        });

    }
    
    function isNumber(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    }
    
    /* [END] TreeField */
</script>   
    
    
<script >
    // init copy features
$(document).ready(function(){
    
    $('#copy-lang').click(function(){
        $('.tabbable .tab-pane.active select, '+
          '.tabbable .tab-pane.active input[type=checkbox], '+
          '.tabbable .tab-pane.active input[type=text], '+
          '.tabbable .tab-pane.active textarea').each(function(){
            
            if($(this).attr('id') == null)return;
            
            var option_id = $(this).attr('id').substr($(this).attr('id').lastIndexOf('_')+1);
            var lang_active_id = $(this).attr('name').substr($(this).attr('name').lastIndexOf('_')+1);
            var option_val = $(this).val();
            var is_input = $(this).is('input');
            var is_input_text = $(this).is('input[type=text]');
            var is_area = $(this).is('textarea');
            var r_id = $(this).attr('id');
            var is_level = false;
            var is_tree_input = $(this).hasClass('tree-input-value');
            var is_level_splited;
            var is_level_parent_id;
            var is_HTMLTABLE = $(this).hasClass('HTMLTABLE');
            var is_PEDIGREE = $(this).hasClass('PEDIGREE');
            var curr_level = 0;
            
            if($(this).hasClass('skip-input'))
                return;

            if(!$(this).attr('id'))return;
            
            //if(is_tree_input)
            //    console.log('test: '+r_id);
            
            if(r_id.indexOf("level") > 0)
            {
                is_level_splited = r_id.split("_"); 
                is_level = true;
                option_id = is_level_splited[2];
            }
            
            if(is_input)
            {
                if($(this).attr('type') == 'checkbox')
                {
                    option_val = $(this).is(':checked');
                }
                else
                {
                    
                }
            }
            else if(is_HTMLTABLE)
            {
                option_val = $(this).parent().find('table > tbody').clone();
            }
            else if(is_PEDIGREE)
            {
                option_val = $(this).parent().find('ul.tree');
            }
            else if(is_area)
            {
                option_val = $(this).val();
                if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances[r_id] !== 'undefined') {
                    option_val = CKEDITOR.instances[r_id].getData();
                }
            }
            else if(is_level)
            {
                curr_level = parseInt(is_level_splited[4]);
                is_level_parent_id = 0;
                if(curr_level > 0)
                {
                    is_level_parent_id = $('.controls #inputOption_'+is_level_splited[1]+'_'+option_id+'_level_'+parseInt(curr_level-1)).val();
                }

                option_val = $(this).val();
            }
            else
            {
                option_val = $(this).prop('selectedIndex');
            }
            
//            console.log('option_id: '+option_id);
//            console.log('lang_active_id: '+lang_active_id);
//            console.log('option_val: '+option_val);
//            console.log('is_input: '+is_input);
            
            $('.nav.nav-tabs li.lang a').each(function(){
                if(!$(this).parent().hasClass('active'))
                {
                    var lang_key = $(this).attr('href').substr(1);
                    
//                    console.log('lang_key: '+lang_key);
//                    console.log('#inputOption_'+lang_key+'_'+option_id);
                    
                    if(is_input)
                    {
                        if(is_tree_input)
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).parent().parent().find('select').val('');
                            $('#inputOption_'+lang_key+'_'+option_id).val('');
                            
//                            console.log('#inputOption_'+lang_key+'_'+option_id);
//                            console.log($('#inputOption_'+lang_key+'_'+option_id).val());
                        }
                        else if(is_input_text)
                        {
                            if($('#inputOption_'+lang_key+'_'+option_id).val() == '' ||
                               $.isNumeric(option_val))
                                $('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                        }
                        else
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).prop('checked', option_val);
                        }
                    }
                    else if(is_PEDIGREE)
                    {
                        //$('#inputOption_'+lang_key+'_'+option_id).parent().find('ul.tree').html(option_val.html());
                    }
                    else if(is_HTMLTABLE)
                    {
                        // replace based on dropdown translation
                        // console.log('lang_from_id: '+lang_active_id);
                        // console.log('lang_to_id: '+lang_key);
                        // console.log(option_id);
                        
                        //col_1_76_0
                        var option_val_clone = option_val.clone();
                        option_val_clone.find('tr td').each(function( index ) {
                            var col_index = $(this).index();
                            var row_index = $(this).parent().index();
                            var cur_content = $(this).html();
                            var lang_col_from = $('#col_'+lang_active_id+'_'+option_id+'_'+col_index);
                            var lang_col_to = $('#col_'+lang_key+'_'+option_id+'_'+col_index);
                            
                            if(lang_col_to.length == 1 && cur_content != '')
                            {
                                var dropdown_index = lang_col_from.find("span:contains('"+cur_content+"')").index();
                                var rep_text = lang_col_to.find('span').eq(dropdown_index).html();
                                option_val_clone.find('tr').eq(row_index).find('td').eq(col_index).html(rep_text);
                                
                                //console.log(dropdown_index + '|' + $( this ).html() );
                                //console.log(rep_text);
                            }
                        });
                        
                        $('#inputOption_'+lang_key+'_'+option_id).parent().find('table > tbody').html(option_val_clone.html());
                        
                        table_add_events(option_id+'_'+lang_key);
                        save_changes_table(option_id+'_'+lang_key);
                    }
                    else if(is_area)
                    {
                        var option_val_lang = $('#inputOption_'+lang_key+'_'+option_id).val();

                        if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                            option_val_lang = CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].getData();
                        }
                        
                        if(option_val_lang == '' ||
                           option_val_lang == '<br>' )
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).val(option_val).blur();
                            if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                                CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].setData(option_val);
                            }
                        }
                    }
                    else if(is_level)
                    {
                        if (typeof load_and_select_index === 'function') {
                            load_and_select_index($('#inputOption_'+lang_key+'_'+option_id+'_level_'+is_level_splited[4]), option_val, is_level_parent_id);
                        }
                    }
                    else
                    {
                        //console.log('#inputOption_'+lang_key+'_'+option_id);
                        //console.log(option_val);
                        $('#inputOption_'+lang_key+'_'+option_id).prop('selectedIndex', parseInt(option_val)); 
                        $('#inputOption_'+lang_key+'_'+option_id).trigger('change');
                    }
                }
            });
        });
        
        return false;
    });
    
    $('#translate-lang').click(function(){
        $('.tabbable .tab-pane.active select, '+
          '.tabbable .tab-pane.active input[type=checkbox], '+
          '.tabbable .tab-pane.active input[type=text], '+
          '.tabbable .tab-pane.active textarea').each(function(){

            if($(this).attr('id') == null)return;
            
            var option_id = $(this).attr('id').substr($(this).attr('id').lastIndexOf('_')+1);
            var lang_active_id = $(this).attr('name').substr($(this).attr('name').lastIndexOf('_')+1);
            var option_val = $(this).val();
            var is_input = $(this).is('input');
            var is_input_text = $(this).is('input[type=text]');
            var is_area = $(this).is('textarea');
            var r_id = $(this).attr('id');
            var is_level = false;
            var is_tree_input = $(this).hasClass('tree-input-value');
            var is_level_splited;
            var is_level_parent_id;
            var is_HTMLTABLE = $(this).hasClass('HTMLTABLE');
            var is_PEDIGREE = $(this).hasClass('PEDIGREE');
            var curr_level = 0;
            
            if($(this).hasClass('skip-input'))
                return;

            if(!$(this).attr('id'))return;
            
            if(r_id.indexOf("level") > 0)
            {
                is_level_splited = r_id.split("_"); 
                is_level = true;
                option_id = is_level_splited[2];
            }
            
            if(is_input)
            {
                if($(this).attr('type') == 'checkbox')
                {
                    option_val = $(this).is(':checked');
                }
                else
                {
                    
                }
            }
            else if(is_HTMLTABLE)
            {
                option_val = $(this).parent().find('table > tbody').clone();
            }
            else if(is_PEDIGREE)
            {
                option_val = $(this).parent().find('ul.tree');
            }
            else if(is_area)
            {
                option_val = $(this).val();
                if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances[r_id] !== 'undefined') {
                    option_val = CKEDITOR.instances[r_id].getData();
                }
            }
            else if(is_level)
            {
                curr_level = parseInt(is_level_splited[4]);
                is_level_parent_id = 0;
                if(curr_level > 0)
                {
                    is_level_parent_id = $('.controls #inputOption_'+is_level_splited[1]+'_'+option_id+'_level_'+parseInt(curr_level-1)).val();
                }

                option_val = $(this).val();
            }
            else
            {
                option_val = $(this).prop('selectedIndex');
            }
            
            $('.nav.nav-tabs li.lang a').each(function(){
                if(!$(this).parent().hasClass('active'))
                {
                    var lang_key = $(this).attr('href').substr(1);
                    //console.log('lang_key: '+lang_key);
                    
                    if(is_input)
                    {
                        if(is_tree_input)
                        {
                            $('#inputOption_'+lang_key+'_'+option_id).parent().parent().find('select').val('');
                            $('#inputOption_'+lang_key+'_'+option_id).val('');
                            
//                            console.log('#inputOption_'+lang_key+'_'+option_id);
//                            console.log($('#inputOption_'+lang_key+'_'+option_id).val());
                        }
                        else if(is_input_text)
                        {
                            if($.isNumeric(option_val))
                            {
                                $('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                            }
                            else if($('#inputOption_'+lang_key+'_'+option_id).val() == '' && option_val != '')
                            {
                                $.getJSON($('#translate-lang').attr('rel'), {from: lang_active_id, to: lang_key, value: option_val}, function( data ) {
                                    if(data.result != '')
                                    {
                                        $('#inputOption_'+lang_key+'_'+option_id).val(data.result);
                                    }
                                    else
                                    {
                                        $('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                                    }
                                });
                            }  
                        }
                        else
                        {
                            //console.log('#inputOption_'+lang_key+'_'+option_id);
                            //console.log(option_val);
                            //$('#inputOption_'+lang_key+'_'+option_id).val(option_val);
                            $('#inputOption_'+lang_key+'_'+option_id).prop('checked', option_val);
                        }
                    }
                    else if(is_PEDIGREE)
                    {
                        
                    }
                    else if(is_HTMLTABLE)
                    {
                        // replace based on dropdown translation
                        //console.log('lang_from_id: '+lang_active_id);
                        //console.log('lang_to_id: '+lang_key);
                        //col_1_76_0
                        var option_val_clone = option_val.clone();
                        option_val_clone.find('tr td').each(function( index ) {
                            var col_index = $(this).index();
                            var row_index = $(this).parent().index();
                            var cur_content = $(this).html();
                            var lang_col_from = $('#col_'+lang_active_id+'_'+option_id+'_'+col_index);
                            var lang_col_to = $('#col_'+lang_key+'_'+option_id+'_'+col_index);
                            
                            if(lang_col_to.length == 1 && cur_content != '')
                            {
                                var dropdown_index = lang_col_from.find("span:contains('"+cur_content+"')").index();
                                var rep_text = lang_col_to.find('span').eq(dropdown_index).html();
                                option_val_clone.find('tr').eq(row_index).find('td').eq(col_index).html(rep_text);
                                
                                //console.log(dropdown_index + '|' + $( this ).html() );
                                //console.log(rep_text);
                            }
                        });
                        
                        $('#inputOption_'+lang_key+'_'+option_id).parent().find('table > tbody').html(option_val_clone.html());
                        
                        table_add_events(option_id+'_'+lang_key);
                        save_changes_table(option_id+'_'+lang_key);
                    }
                    else if(is_area)
                    {
                        
                        var option_val_lang = $('#inputOption_'+lang_key+'_'+option_id).val();

                        if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                            option_val_lang = CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].getData();
                        }
                        if(option_val_lang == '' ||
                           option_val_lang == '<br>' )
                        {
                            $.getJSON($('#translate-lang').attr('rel'), {from: lang_active_id, to: lang_key, value: option_val}, function( data ) {
                                if(data.result != '')
                                {
                                    $('#inputOption_'+lang_key+'_'+option_id).val(data.result).blur();
                                    if(typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id] !== 'undefined') {
                                        CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].setData(data.result);
                                    }
                                }
                                else
                                {
                                    $('#inputOption_'+lang_key+'_'+option_id).val(option_val).blur();
                                    CKEDITOR.instances['inputOption_'+lang_key+'_'+option_id].setData(option_val);
                                }
                            });
                        }
                    }
                    else if(is_level)
                    {
                        if (typeof load_and_select_index === 'function') {
                            load_and_select_index($('#inputOption_'+lang_key+'_'+option_id+'_level_'+is_level_splited[4]), option_val, is_level_parent_id);
                        }
                    }
                    else
                    {
                        //console.log('#inputOption_'+lang_key+'_'+option_id);
                        //console.log(option_val);
                        $('#inputOption_'+lang_key+'_'+option_id).prop('selectedIndex', parseInt(option_val)); 
                        $('#inputOption_'+lang_key+'_'+option_id).trigger('change');
                    }
                }
            });
        });
        
        return false;
    });
        
});

    <?php if (isset($package_num_amenities_limit)): ?>
        $(document).ready(function () {

            $('.control-group .controls input[type=checkbox]').change(function (event) {
                var selected_checkboxes = $('.tab-pane.active .control-group .controls input[type=checkbox]:checked').length;

                if (selected_checkboxes > <?php echo $package_num_amenities_limit; ?>)
                {
                    $(this).prop('checked', false);
                    ShowStatus.show('<?php echo lang_check('Limitation by package'); ?>: ' + '<?php echo $package_num_amenities_limit; ?>');
                }
            });

        });
    <?php endif; ?>
</script> 

<script>  
   $(document).ready(function(){    
})   
        
</script>  

<link rel="stylesheet" href="assets/js/zebra/css/flat/zebra_dialog.css" />
<script src="assets/js/zebra/javascript/zebra_dialog.src.js"></script>
<script>

    /* CL Editor */
    $(document).ready(function () {
        $('.files a.iedit').click(function (event) {
            new $.Zebra_Dialog('', {
                source: {'iframe': {
                        'src': '<?php echo site_url('admin/imageeditor/edit'); ?>/' + $(this).attr('rel'),
                        'height': 700
                    }},
                width: 950,
                title: '<?php _jse(lang_check('Edit image')); ?>',
                type: false,
                buttons: false
            });
            return false;
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('body').append('<div id="blueimp-gallery" class="blueimp-gallery">\n\
                            <div class="slides"></div>\n\
                            <h3 class="title"></h3>\n\
                            <a class="prev">&lsaquo;</a>\n\
                            <a class="next">&rsaquo;</a>\n\
                            <a class="close">&times;</a>\n\
                            <a class="play-pause"></a>\n\
                            <ol class="indicator"></ol>\n\
                            </div>')
    })
</script>

<script type="text/javascript">
/* hint */
$(document).ready(function(){

    $('.hint').on({
      "click": function(e) {
            e.preventDefault();
            if(!$(this).find('.hint-notice').length){
                //$(this).append('<span class="hint-notice"> '+$(this).attr("data-hint")+' </span>') 
                $(this).append('<div class="hint-notice"><span class="hint-message"> '+$(this).attr("data-hint")+' </span> \n\
                    </div><i class="hint-arrow"></i>\n\
                ')
              
              // if small message
                if($(this).find('.hint-message').width() < 60) {
                    $(this).find('.hint-notice').css('left','-10px')
                }
              
                $('.hint-notice').animate({
                    opacity:1, bottom: '16px'
                }, 300);
                
                $('.hint .hint-arrow').animate({
                    opacity:1, bottom: '11px'
                }, 300);
            
          }
      },
      "mouseover": function(e) {
            e.preventDefault();
          if(!$(this).find('.hint-notice').length){
                //$(this).append('<span class="hint-notice"> '+$(this).attr("data-hint")+' </span>') 
                $(this).append('<div class="hint-notice"><span class="hint-message"> '+$(this).attr("data-hint")+' </span> \n\
                    </div><i class="hint-arrow"></i>\n\
                ')
              
              // if small message
                if($(this).find('.hint-message').width() < 60) {
                    $(this).find('.hint-notice').css('left','-10px')
                }
              
                $('.hint-notice').animate({
                    opacity:1, bottom: '16px'
                }, 300);
                
                $('.hint .hint-arrow').animate({
                    opacity:1, bottom: '11px'
                }, 300);
            
          }
      },
    "mouseout": function() {      
       $('.hint-notice', this).remove();   
       $('.hint-arrow', this).remove();   
    }
    });
})

/* end hint */
</script> 


<script>  
    $(document).ready(function(){
        
        <?php if(config_db_item('map_version') =='open_street'):?>

            var edit_map_marker;
            var edit_map
            if($('#mapsAddress_nondefault').length){
                if($('#inputGps').length && $('#inputGps').val() != '')
                {
                    savedGpsData = $('#inputGps').val().split(", ");

                    edit_map = L.map('mapsAddress_nondefault', {
                        center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        zoom: {settings_zoom},
                    });     
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(edit_map);
                    var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(edit_map);
                    edit_map_marker = L.marker(
                        [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
                        {draggable: true}
                    ).addTo(edit_map);

                    edit_map_marker.on('dragend', function(event){
                        var marker = event.target;
                        var location = marker.getLatLng();
                        var lat = location.lat;
                        var lon = location.lng;
                        $('#inputGps').val(lat+', '+lon);
                        //retrieved the position
                      });

                    firstSet = true;
                }
                else
                {

                    edit_map = L.map('mapsAddress_nondefault', {
                        center: [{settings_gps}],
                        zoom: {settings_zoom},
                    });     
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(edit_map);
                    var positron = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png').addTo(edit_map);
                    edit_map_marker = L.marker(
                        [{settings_gps}],
                        {draggable: true}
                    ).addTo(edit_map);

                    edit_map_marker.on('dragend', function(event){
                        var marker = event.target;
                        var location = marker.getLatLng();
                        var lat = location.lat;
                        var lon = location.lng;
                        $('#inputGps').val(lat+', '+lon);
                        //retrieved the position
                    });

                    firstSet = true;
                }

                $('#input_address').on('change keyup', function (e) {
                    clearTimeout(timerMap);
                    timerMap = setTimeout(function () {
                        $.get('https://nominatim.openstreetmap.org/search?format=json&q='+$('#input_address').val(), function(data){
                            if(data.length && typeof data[0]) {
                                edit_map_marker.setLatLng([data[0].lat, data[0].lon]).update(); 
                                edit_map.panTo(new L.LatLng(data[0].lat, data[0].lon));
                                $('#inputGps').val(data[0].lat+', '+data[0].lon);
                            } else {
                                ShowStatus.show('<?php echo str_replace("'", "\'", lang_check('Address not found!')); ?>');
                                return;
                            }
                        });
                    }, 1000);

                });
            }

        <?php else:?>
        
        $("#mapsAddress_nondefault").gmap3({
            map:{
              options:{
                center: [<?php _che($settings_gps); ?>],
                zoom: 12
              },
            }
          });
          
            $('#input_address').on('change keyup', function (e) {
                clearTimeout(timerMap);
                timerMap = setTimeout(function () {
                    
                    $("#mapsAddress_nondefault").gmap3({
                      getlatlng:{
                        address:  $('#input_address').val(),
                        callback: function(results){
                          if ( !results ){
                            ShowStatus.show('<?php _l('Address not found'); ?>');
                            return;
                          } 
                          
                            if(firstSet){
                                $(this).gmap3({
                                    clear: {
                                      name:["marker"],
                                      last: true
                                    }
                                });
                            }
                          
                          // Add marker
                          $(this).gmap3({
                            marker:{
                              latLng:results[0].geometry.location,
                               options: {
                                  id:'searchMarker',
                                  draggable: true
                              },
                              events: {
                                dragend: function(marker){
                                  $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                                }
                              }
                            }
                          });
                          
                          // Center map
                          $(this).gmap3('get').setCenter( results[0].geometry.location );
                          
                          $('#inputGps').val(results[0].geometry.location.lat()+', '+results[0].geometry.location.lng());
                          
                          firstSet = true;
    
                        }
                      }
                    });
                }, 2000);
                
            });
          
        <?php endif;?>
            /* hint */
            
            $('.hint').on({
              "click": function(e) {
                    e.preventDefault();
                    if( !$(this).find('.hint-notice').length ){
                        
                        
                        $(this).append('<div class="hint-notice"><span class="hint-message"> '+$(this).attr("data-hint")+' </span> \n\
                            </div><i class="hint-arrow"></i>\n\
                        ');

                      // if small message
                        if($(this).find('.hint-message').width() < 60) {
                            $(this).find('.hint-notice').css('left','-10px')
                        }
                      
                        $('.hint-notice').animate({
                            opacity:1, bottom: '16px'
                        }, 300, "easeInOutCubic");
                        
                        $('.hint .hint-arrow').animate({
                            opacity:1, bottom: '11px'
                        }, 300, "easeInOutCubic");
                    
                  }
                  else
                  {
                    alert('not');
                  }
              },
              "hover": function(e) {
                    e.preventDefault();
                  if(!$(this).find('.hint-notice').length){
                        $(this).append('<div class="hint-notice"><span class="hint-message"> '+$(this).attr("data-hint")+' </span> \n\
                            </div><i class="hint-arrow"></i>\n\
                        ')

                      // if small message
                        if($(this).find('.hint-message').width() < 60) {
                            $(this).find('.hint-notice').css('left','-10px')
                        }
                      
                        $('.hint-notice').animate({
                            opacity:1, bottom: '16px'
                        }, 300, "easeInOutCubic");
                        
                        $('.hint .hint-arrow').animate({
                            opacity:1, bottom: '11px'
                        }, 300, "easeInOutCubic");
                    
                  }
              },
            "mouseout": function() {      
               $('.hint-notice', this).remove();   
               $('.hint-arrow', this).remove();   
            }
            });
            
            /* end hint */
          
          
    });   
    
</script>   

<script>
/* Fixed lang bar */
$(function(){
 /*   $('.lang-tabs').affix({
      offset: {
        top: function(){
            return (this.top = $('.lang-tabs').offset().top);
        }
      }
    })
    
    // first load
    if($('.lang-tabs').hasClass('affix')) {
        $('.lang-tabs').css('width', $('.lang-tabs').closest('.affix-parent').width());
    }

    $(window).scroll(function() {
        if($('.lang-tabs').hasClass('affix')) {
           $('.lang-tabs').css('width', $('.lang-tabs').closest('.affix-parent').width());
        } else {
            $('.lang-tabs').css('width', '100%'); 
        }
    })*/
})
/* end Fixed lang bar */

$(document).ready(function() {
  // Custom 
  var stickyToggle = function(sticky, stickyWrapper, scrollElement) {
    var stickyHeight = sticky.outerHeight();
    var stickyTop = stickyWrapper.offset().top+300;
    if (scrollElement.scrollTop() >= stickyTop){
      stickyWrapper.height(stickyHeight);
      sticky.addClass("affix");
      sticky.css('left',$('.lang-tabs').closest('.affix-parent').find('.widget-overview').offset().left)
    }
    else{
      sticky.removeClass("affix");
      stickyWrapper.height('auto');
      sticky.css('left', 'inherit')
    }
  };
  
  // Find all data-toggle="sticky-onscroll" elements
  $('[data-toggle="affix"]').each(function() {
    var sticky = $(this);
    var stickyWrapper = $('<div>').addClass('sticky-wrapper2'); // insert hidden element to maintain actual top offset on page
    sticky.before(stickyWrapper);
    sticky.addClass('sticky');
    
    // Scroll & resize events
    $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function() {
        stickyToggle(sticky, stickyWrapper, $(this));
      
        if($(window).scrollTop() == 0) {
            sticky.removeClass("affix");
            stickyWrapper.height('auto');
        }
    });
    
    // On page load
    stickyToggle(sticky, stickyWrapper, $(window));
  });
  
    // first load
    if($('.lang-tabs').hasClass('affix')) {
        $('.lang-tabs').css('width', $('.lang-tabs').closest('.affix-parent').width());
        if($(window).width()> 768) {
            $('.lang-tabs').css('top', $('.top-box.is-sticky').outerHeight());
        }
    }

    var _t = function() { 
            if($(window).width()> 768) {
                $('.lang-tabs').css('top', $('.top-box.is-sticky').outerHeight())
                    if(parseInt($('.lang-tabs').css('top')) !=  parseInt($('.top-box.is-sticky').outerHeight()))
                        setTimeout(function(){_t()}, 100);
            } else {
                $('.lang-tabs').css('top', '0'); 
            }      
        }
            
    $(window).on('scroll resize',function() {
        
        if($('.affix').length){
            if($(window).width()> 768) {
                $('.lang-tabs').css('top', $('.top-box.is-sticky').outerHeight());
            } else {
                $('.lang-tabs').css('top', '0'); 
            }   
            setTimeout(function(){_t()}, 200);
        }
        else {
            $('.lang-tabs').css('top', '0');
        }
        
        if($('.lang-tabs').hasClass('affix')) {
           $('.lang-tabs').css('width', $('.lang-tabs').closest('.affix-parent').width());
           $('.lang-tabs').css('width', $('.lang-tabs').closest('.affix-parent').width());
        } else {
            $('.lang-tabs').css('width', '100%'); 
        }
    })
  
});
</script>

</body>
</html>
