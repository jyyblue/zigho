<!DOCTYPE html>
<html lang="en">
<head>
    <?php _widget('head');?>
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
                <div class="col-lg-12">
                    <div class="widget widget-box box-container">
                        <div class="widget-header text-uppercase">
                        <?php if(!empty($rate->id)):?>
                            <?php echo lang_check('Edit rate'); ?>, #<?php echo $rate->id; ?>
                        <?php else: ?>
                            <?php echo lang_check('Add rate'); ?>
                        <?php endif; ?>
                            <?php echo anchor('rates/index/'.$lang_code.'#content', '<i class="icon-book"></i>&nbsp;&nbsp;'.lang_check('View rates'), 'class="btn pull-right"')?>
                        </div>
                        <div class="widget-content">
                           <div class="box-body">
                                <?php echo validation_errors()?>
                                <?php if($this->session->flashdata('message')):?>
                                <?php echo $this->session->flashdata('message')?>
                                <?php endif;?>
                                <?php if($this->session->flashdata('error')):?>
                                <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                                <?php endif;?>
                                <!-- Form starts.  -->
                            </div>
                            <?php echo form_open(current_url().'#form-block', array('class' => 'form-horizontal form-estate ', 'role'=>'form'))?>                              
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang_check('Property')?></label>
                                  <div class="controls">
                                    <?php echo form_dropdown('property_id', $properties, $this->input->post('property_id') ? $this->input->post('property_id') : $rate->property_id, 'class="form-control"')?>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang_check('From date')?></label>
                                  <div class="controls">
                                  <div class="input-append">
                                    <?php echo form_input('date_from', $this->input->post('date_from') ? $this->input->post('date_from') : $rate->date_from, 'data-format="yyyy-MM-dd hh:mm:ss" id="booking_date_from"'); ?>
                                  </div>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang_check('To date')?></label>
                                  <div class="controls">
                                  <div class="input-append">
                                    <?php echo form_input('date_to', $this->input->post('date_to') ? $this->input->post('date_to') : $rate->date_to, 'data-format="yyyy-MM-dd hh:mm:ss" id="booking_date_to"'); ?>

                                  </div>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label for="inputMinStay" class="control-label"><?php echo lang_check('Min stay')?></label>
                                  <div class="controls">
                                    <?php echo form_input('min_stay', set_value('min_stay', $rate->min_stay), 'class="form-control" id="inputMinStay" placeholder="'.lang_check('Min stay').'"')?>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang_check('Changeover day')?></label>
                                  <div class="controls">
                                    <?php echo form_dropdown('changeover_day', $changeover_days, set_value('changeover_day', $rate->changeover_day), 'class="form-control" id="inputChangeoverDay" placeholder="'.lang_check('Changeover day').'"')?>
                                  </div>
                                </div>

                               <div style="margin-bottom: 0px;" class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <?php $i=0;foreach($this->rates_m->languages as $key_lang=>$val_lang):$i++;?>
                                            <li class="nav-item"><a class="nav-link <?php echo $i == 1 ? 'active' : '' ?>" data-toggle="tab" href="#lang_id_<?php echo $key_lang?>"><?php echo $val_lang?></a></li>
                                         <?php endforeach;?>
                                    </ul>
                                    <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                                        <?php $i=0;foreach($this->rates_m->languages as $key_lang=>$val_lang):$i++;?>
                                        <div id="lang_id_<?php echo $key_lang?>" class="tab-pane fade <?php echo $i == 1 ? 'in active' : '' ?>">
                                            <div class="control-group">
                                              <label  class="control-label"><?php echo lang_check('Rate nightly')?></label>
                                              <div class="controls">
                                                <?php echo form_input('rate_nightly_'.$key_lang, set_value('rate_nightly_'.$key_lang, $rate->{'rate_nightly_'.$key_lang}), 'class="form-control" id="inputRateNightly'.$key_lang.'" placeholder="'.lang_check('Rate nightly').'"')?>
                                              </div>
                                            </div>

                                            <div class="control-group">
                                              <label class="control-label"><?php echo lang_check('Rate weekly')?></label>
                                              <div class="controls">
                                                <?php echo form_input('rate_weekly_'.$key_lang, set_value('rate_weekly_'.$key_lang, $rate->{'rate_weekly_'.$key_lang}), 'class="form-control" id="inputRateWeekly'.$key_lang.'" placeholder="'.lang_check('Rate weekly').'"')?>
                                              </div>
                                            </div>

                                            <div class="control-group">
                                              <label class="control-label"><?php echo lang_check('Rate monthly')?></label>
                                              <div class="controls">
                                                <?php echo form_input('rate_monthly_'.$key_lang, set_value('rate_monthly_'.$key_lang, $rate->{'rate_monthly_'.$key_lang}), 'class="form-control" id="inputRateMonthly'.$key_lang.'" placeholder="'.lang_check('Rate monthly').'"')?>
                                              </div>
                                            </div>

                                            <div class="control-group">
                                              <label class="control-label"><?php echo lang_check('Currency code')?></label>
                                              <div class="controls">
                                                <?php 
                                                // get all langauge data to fetch default paypal currency
                                                $lang_data = $this->language_m->get($key_lang);
                                                echo form_input('currency_code_'.$key_lang, set_value('currency_code_'.$key_lang, $lang_data->currency_default), 
                                                                   'class="form-control" id="inputCurrencyCode'.$key_lang.'" placeholder="'.lang_check('Currency code').'" readonly');

                                                ?>
                                              </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                  </div>
                                </div>
                                <br style="clear: both;" />
                                <div class="control-group">
                                  <div class="controls">
                                    <?php echo form_submit('submit', lang_check('Save'), 'class="btn btn-primary"')?>
                                    <a href="<?php echo site_url('rates/index/'.$lang_code)?>#content" class="btn btn-default" type="button"><?php echo lang_check('Cancel')?></a>
                                  </div>
                                </div>
                            <?php echo form_close()?>
                        </div>
                    </div> <!-- /. widget-table-->   
                </div><!-- /.center-content -->
            </div>
        </div>
    </main><!-- /.main-part--> 

    <!-- footer -->
    <?php _widget('custom_footer');?>
    <!-- /.footer --> 
</div>
<?php _widget('custom_palette');?>
<?php _widget('custom_javascript');?>
<script>
    /*
     * http://fooplugins.github.io/FooTable/docs/getting-started.html
     */    
    
    $('document').ready(function () {
        $('.footable').footable({
            "filtering": {
            "enabled": false
                  },
        });
    })
        
</script>
</body>
</html>
