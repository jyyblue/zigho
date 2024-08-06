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
        <div class="top-box-mask"></div>
    </header><!-- /.header--> 
    <?php _widget('top_titlebreadcrumb2');?>
    <main class="main main-container section-color-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    
                    <section class="widget widget-blog-listing widget-overflow widget-ask">
                    
                        <div class="box-overflow-container box-container">
                            <div class="box-contai">
                                 <h2 class="title">{page_title}</h2> 
                                <span class="sub-title"></span>
                            </div> <!-- /. content-header --> 
                            
                        <div class="box-body" >
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="agent-detail-picture">
                                        <img src="{agent_image_url}" alt="" class="img-responsive">
                                    </div><!-- /.agent-detail-picture -->
                                </div>

                                <div class="col-md-8">
                                    <p>
                                        <?php
                                        if(!empty($agent_profile['embed_video_code']))
                                        {
                                            echo $agent_profile['embed_video_code'];
                                            echo '<br />';
                                        }
                                        ?>
                                        <?php echo $agent_profile['description']; ?>
                                     </p>
                                    <p>
                                    <!-- Example to print all custom fields in list -->
                                    <?php //profile_cf_li(); ?>

                                    <!-- Example to print specific custom field with label -->
                                    <?php //profile_cf_single(1, TRUE); ?>

                                    </p>
                                {has_agent}
                                <div class="agent">
                                  <div class="phone">{agent_phone}</div>
                                  <div class="mail"><a href="mailto:{agent_mail}?subject=<?php echo urlencode(lang_check('Estateinqueryfor'));?>:{estate_data_id},<?php echo urlencode($page_title);?>">{agent_mail}</a></div>
                                </div>
                                {/has_agent}
                                    <ul class="clearfix sharing-buttons">
                                        <?php if(!empty($agent_profile['facebook_link'])): ?>
                                            <li><a class="facebook"  href="<?php echo $agent_profile['facebook_link']; ?>"><i class="fa fa-facebook facebook"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty($agent_profile['youtube_link'])): ?>
                                            <li><a class="twitter" href="<?php echo $agent_profile['youtube_link']; ?>"><i class="fa fa-youtube youtube"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty($agent_profile['gplus_link'])): ?>
                                            <li><a class="google-plus" href="<?php echo $agent_profile['gplus_link']; ?>"><i class="fa fa-google-plus google"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty($agent_profile['twitter_link'])): ?>
                                            <li><a class="twitter" href="<?php echo $agent_profile['twitter_link']; ?>"><i class="fa fa-twitter twitter"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty($agent_profile['linkedin_link'])): ?>
                                            <li><a class="google-plus" href="<?php echo $agent_profile['linkedin_link']; ?>"><i class="fa fa-linkedin linkedin"></i></a></li>
                                        <?php endif; ?>
                                    </ul><!-- /.social-->
                                </div>
                            </div><!-- /.row -->
                        </div>
                        </div>
                    </section>
                    
                    <div class="widget widget-profilelisting">
                        <div class="widget-body">
                            <div class="widget-header text-uppercase">
                               <?php _l('Assigned Properties'); ?>
                            </div>
                        </div>
                        <div id="ajax_results">    
                            <div class="properties">
                                <div class="row">
                                    <!-- PROPERTY LISTING -->
                                    <?php foreach($agent_estates as $key=>$item): ?>
                                    <?php
                                        //if($key==0)echo '<div class="row">';
                                    ?>
                                        <?php _generate_results_item(array('key'=>$key, 'item'=>$item)); ?>
                                    <?php
                                        if( ($key+1)%3==0 )
                                        {
                                            //echo '</div><div class="row">';
                                        }
                                        //if( ($key+1)==sw_count($agent_estates) ) echo '</div>';
                                        endforeach;
                                    ?>
                                </div>
                                <nav class="text-center">
                                    <div class="pagination-ajax-results pagination  wp-block default product-list-filters light-gray pagination" rel="ajax_results">
                                        <?php echo $pagination_links_agent; ?>
                                    </div>
                                </nav>
                            </div><!-- /.properties -->
                        </div>
                    </div>  <!-- /. widget-properties -->    
                </div><!-- /.center-content -->
                <div class="col-lg-3 sidebar">

                    <div class="widget widget-form" id="form">
                        <form action="{page_current_url}#form" method="post">
                            <div class="box-container widget-box">
                                <div class="widget-header text-uppercaser">{lang_Enquireform}</div>
                                {validation_errors} {form_sent_message}
                                <div class="form-additional">
                                    <!-- The form name must be set so the tags identify it -->
                                    <input type="hidden" name="form" value="contact" />
                                    
                                    <div class="form-group {form_error_firstname}">
                                        <input class="form-control" id="firstname" name="firstname" type="text" placeholder="{lang_FirstLast}" value="{form_value_firstname}" />
                                    </div>
                                    <div class="form-group {form_error_email}">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="{lang_Email}" value="{form_value_email}" />
                                    </div>
                                    <div class="form-group {form_error_phone}">
                                        <input class="form-control" id="phone" name="phone" type="text" placeholder="{lang_Phone}" value="{form_value_phone}" />
                                    </div>
                                     <div class="form-group {form_error_address}">
                                        <input class="form-control" id="address" name="address" type="text" placeholder="{lang_Address}" value="{form_value_address}" />
                                    </div>
                                    
                                    <div class="form-group {form_error_message}">
                                        <textarea id="message" name="message" rows="3" class="form-control" type="text" placeholder="{lang_Message}">{form_value_message}</textarea>
                                    </div>
                                    
                                    <?php if(config_item( 'captcha_disabled')===FALSE): ?>
                                    <div class="form-group {form_error_captcha}">
                                        <div class="row">
                                            <div class="col-xl-6" style="padding-top:1px;">
                                                <?php echo $captcha['image']; ?>
                                            </div>
                                            <div class="col-xl-6">
                                                <input class="captcha form-control {form_error_captcha}" name="captcha" type="text" placeholder="{lang_Captcha}" value="" />
                                                <input class="hidden" name="captcha_hash" type="text" value="<?php echo $captcha_hash; ?>" />
                                            </div>
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
                                                     
                                <?php if(config_db_item('terms_link') !== FALSE): ?>
                                <?php
                                    $site_url = site_url();
                                    $urlparts = parse_url($site_url);
                                    $basic_domain = $urlparts['host'];
                                    $terms_url = config_db_item('terms_link');
                                    $urlparts = parse_url($terms_url);
                                    $terms_domain ='';
                                    if(isset($urlparts['host']))
                                        $terms_domain = $urlparts['host'];

                                    if($terms_domain == $basic_domain) {
                                        $terms_url = str_replace('en', $lang_code, $terms_url);
                                    }
                                ?>
                                <div class="control-group control-gt-terms">
                                  <label
                                  <div class="controls">
                                    <?php echo form_checkbox('option_agree_terms', 'true', set_value('option_agree_terms', false), 'class="ezdisabled" id="inputOption_terms"')?>
                                  <a target="_blank" href="<?php echo $terms_url; ?>"><?php echo lang_check('I Agree To The Terms & Conditions'); ?></a>
</div>
                                </div>
                                <?php endif; ?>
                                



                                <?php if(config_db_item('privacy_link') !== FALSE && sw_count($not_logged)>0): ?>
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
                                <div class="control-group control-gt-terms">
                                  
                                  <div class="controls">
                                    <?php echo form_checkbox('option_privacy_link', 'true', set_value('option_privacy_link', false), 'class="novalidate" required="required" id="inputOption_privacy_link"')?>
                                 <a target="_blank" href="<?php echo $privacy_url; ?>"><?php echo lang_check('I Agree The Privacy'); ?></a>
 </div>
                                </div>
                                <?php endif; ?>
                                    <div class="form-group form-group-submit">
                                          <input type="submit" class="btn btn-primary btn-wide color-primary btn-property" value="{lang_Send}" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.widget-form--> 
                    <?php _widget('right_lastproperties');?>
                </div>
                <!-- /.right side bar -->
            </div>
        </div>
    </main><!-- /.main-part--> 

    <!-- footer -->
    <?php _widget('custom_footer');?>
    <!-- /.footer --> 
</div>
<?php _widget('custom_palette');?>
<?php _widget('custom_javascript');?>
</body>
</html>