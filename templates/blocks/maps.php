<?php
    $location = get_field('google_maps');
    $title = get_field('maps_title');
    $address = get_field('address');
    $link = get_field('contact_page');
    $toggle = get_field('maps_toggle');
    if(!empty($location) ):
?>
<div class="sections neptune-maps clear">

    <div class="grid-wide">
    <div class="address col-3-12">
       <?php 
        echo '<h2>'.$title.'</h2>';
        echo $address;
    if($link){?>
        <a class="button" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
    <?php } ?>
    </div>
    </div>
    <div class="neptune-maps-item">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div>
</div>
<?php endif;
