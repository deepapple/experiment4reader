<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/front/theme/css/normalize.css">
    <link rel="stylesheet" href="/front/theme/css/main.css">
</head>
<body>
  <nav>
  <a href="/front" class="home-link header-logo">Home</a> | 
  <a href="/front?q=rand">Random</a>
  </nav>
  <div class="wrapper">
    <?php print $messages; ?>
    <?php foreach($blocks as $block_name => $block_content) { ?>
        <div class="block block-<?php print $block_name; ?>">
            <?php if (is_array($block_content)) {
                print implode('', $block_content);
            } else {
                print $block_content;
            } ?>
        </div>
    <?php } ?>
    <div class="content">
        <?php print $content; ?>
    </div>
  </div>
</body>
</html>