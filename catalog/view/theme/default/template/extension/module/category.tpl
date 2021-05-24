<div class="list-group">
  <?php foreach ($categories as $category) { ?>
  <?php 
    switch($category['category_id']){
        case 367:
            $fa = '<span class="fa fa-car"></span>';
            break;        
        case 368:
            $fa = '<span class="fa fa-wrench"></span>';
            break; 
        case 369:
            $fa = '<span class="fa fa-home"></span>';
            break; 
        case 519:
            $fa = '<span class="fa fa-laptop"></span>';
            break; 
        case 571:
            $fa = '<span class="fa fa-steam"></span>';
            break; 
        case 780:
            $fa = '<span class="fa fa-phone"></span>';
            break;   
        case 795:
            $fa = '<span class="fa fa-tablet"></span>';
            break;
        case 807:
            $fa = '<span class="fa fa-television"></span>';
            break;
        case 822:
            $fa = '<span class="fa fa-volume-up"></span>';
            break;
        case 863:
            $fa = '<span class="fa fa-video-camera"></span>';
            break;  
        case 886:
            $fa = '<span class="fa fa-shield"></span>';
            break;  
        case 917:
            $fa = '<span class="fa fa-phone-square"></span>';
            break;
        case 921:
            $fa = '<span class="fa fa-desktop"></span>';
            break;  
        case 937:
            $fa = '<span class="fa fa-database"></span>';
            break;
        case 109:
            $fa = '<span class="fa fa-money"></span>';
            break;                                                   
        default:
            $fa = '';
    }
  ?>
  <?php if ($category['category_id'] == $category_id) { ?>
  <a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $fa; ?><?php echo $category['name']; ?></a>
  <?php if ($category['children']) { ?>
  <?php foreach ($category['children'] as $child) { ?>
  <?php if ($child['category_id'] == $child_id) { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } else { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <a href="<?php echo $category['href']; ?>" class="list-group-item"><?php echo $fa; ?><?php echo $category['name']; ?></a>
  <?php } ?>
  <?php } ?>
</div>
