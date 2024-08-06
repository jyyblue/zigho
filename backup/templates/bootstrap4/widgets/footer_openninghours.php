<?php
/*
Widget-title: Opening hours
Widget-preview-image: /assets/img/widgets_preview/footer_openninghours.jpg
*/
?>
<div class="col-lg-3 col-md-6">
    <div class="title">
        <div class="title"><?php echo lang_check('Opening hours');?></div>
    </div>
    <ul class="list list-hours">
        <li>
            <a href="page_gallery.html" class="title"><?php echo lang_check('cal_mon');?>-<?php echo lang_check('cal_tue');?>:</a>
            <span class="description"> 
                6.30 am - 18.00pm
            </span>
        </li>                       
        <li>
            <a href="page_gallery.html" class="title"><?php echo lang_check('cal_wed');?> - <?php echo lang_check('cal_thu');?>:</a>
            <span class="description"> 
                10.00 am - 11.30pm
            </span>
        </li>                       
        <li>
            <a href="page_gallery.html" class="title"><?php echo lang_check('cal_fri');?>:</a>
            <span class="description"> 
                2.30 pm - 10.00pm
            </span>
        </li>                       
        <li>
            <a href="page_gallery.html" class="title"><?php echo lang_check('cal_sun');?>:</a>
            <span class="description"> 
                <?php echo lang_check('Closed');?>
            </span>
        </li>                       
    </ul>
</div>