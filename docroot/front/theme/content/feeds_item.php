<?php
//_d($variables);
?>
<div class="feeds-item-teaser">
  <h2><a href="<?php print url('feed/' . args(1) . '/' . $nid);?>"><?php print $title; ?></a></h2>
  <div class="feeds-item-description"><?php print $field_feed_item_description_value; ?></div>
</div>