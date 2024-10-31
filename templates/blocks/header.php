<?php
$content = get_field('main_text');
$sub = get_field('sub_text');
$btnA = get_field('button_a');
$btnB = get_field('button_b');
$headerbg = get_field('background_image');
$bg = wp_get_attachment_image_url($headerbg,'full');
$toggle = get_field('section_toggle');
if($toggle == 'On'): ?>
<div class="section header-section">

	
	<div class="header-image" style="background-image: url('<?php echo $bg; ?>');background-size:cover;">
		<div class="overlay"></div>
		
        <div class="welcome">
        	<div class="grid-wide">
            <div class="welcome-text col-9-12">
           			<?php if(!empty($content)) { 
           				echo '<h1>'.$content.'</h1>';
           				
           				} if(!empty($sub)) { 
           				echo '<h2>'.$sub.'</h2>';
           			}?>                   
           			<div class="header-buttons">
            		<?php if(!empty($btnA)){
            			echo '<a class="button" href="'.$btnA["url"].'">'.$btnA["title"].'</a>';
            		}
            			if(!empty($btnB)){
            			echo '<a class="button-b" href="'.$btnB["url"].'">'.$btnB["title"].'</a>';
            		}?>
            	   </div>
             
           </div>
       	   </div>	
       
          
   		</div>
	</div>
</div>
<?php  endif; //end Toggle Section