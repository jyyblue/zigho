{has_agent}
<?php
/*
 * 
 * Hidden and encoding string (for robots), add decoding btn for user
 * 
 * @param $str (string)  string for hiden
 * @param $class (string) css class`es
 * @param $preview_length (int), max preview character
 * 
 * return html string  (<div id="%id%" class="%$class%">
                            <span class="val_protected_mask">%$str%xxxxxxx</span> 
                            <a href="#" class="val_protected_spoiler">show</a>
                        </div>)
 */
if ( ! function_exists('anti_spam_field'))
{
    function anti_spam_field($str=NULL, $class='', $preview_length=2)
    { 
      if($str === NULL) return false;  
      $type ='';

      // set type mail if mail
      if(filter_var($str, FILTER_VALIDATE_EMAIL))
        $type = 'mail';

      $character_set = "+-.,0123456789@() ~!#$%^&*?ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz";

      $key = str_shuffle($character_set); 
      $cipher_text = ''; $id = 'e'.rand(1,999999999);
      for ($i=0;$i<strlen($str);$i+=1) {
        //check string and skip, if not avaible character
        if(strpos($character_set, $str[$i]) !== FALSE )
            $cipher_text.= $key[strpos($character_set,$str[$i])];
      }

      $script = '$("#'.$id.' .val_protected_spoiler").click(function(e){e.preventDefault();';
      $script.= 'var str = "'.$key.'";var length="'.$cipher_text.'";';
      $script.= 'var character_un = "'.$character_set.'";var r="";';
      $script.= 'for(var e=0;e<length.length;e++)r+=character_un.charAt(str.indexOf(length.charAt(e)));';
      $script.= '$(this).parent().find(".val_protected_mask").remove();';

      if($type == 'mail')
        $script.= 'var x = "<a href=\\"mailto:"+r+"\\" class=\"defaul-hover-primary\">"+r+"</a>";';
      else 
        $script.= 'var x = "<span>"+r+"</span>";';

      $script.= '$(this).parent().prepend(x);$(this).remove();})';
      $script = '<script>'.$script.'</script>';

      return '<span id="'.$id.'" class="'.$class.'"><span class="val_protected_mask">'.substr($str, 0, $preview_length).'xxxxxx</span> <a href="#" class="val_protected_spoiler">'.lang_check('unhide').'</a></span>'.$script;
    }
}
?>
<div class="widget widget-box box-container widget-agent">
    <div class=" media">
        <div class="agent-logo media-left media-middle" >
            <a href="{agent_url}" class='img-circle-cover'>
                <img src="{agent_image_url}" alt="<?php  _che($agent_name_surname);?>" class="img-circle">
            </a>
        </div>
        <div class="agent-details media-right media-top">
            <a href="{agent_url}" class="agent-name"><?php _che($agent_name_surname);?></a>
            <span class="phone"><?php  _che($agent_phone);?></span>
            <?php echo anti_spam_field($agent_mail, '');?>
            
            <!-- Example to print all custom fields in list -->
            <?php //profile_cf_li(); ?>
            <!-- Example to print specific custom field with label -->
            <?php //profile_cf_single(1, TRUE); ?>
        </div>
    </div><!-- /.agent-card--> 
</div><!-- /. widget-agent -->  
{/has_agent}