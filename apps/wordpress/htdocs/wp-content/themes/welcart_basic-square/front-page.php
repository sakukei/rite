<?php
/**
 * Front Page
 *
 * @package WordPress
 */

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="./favicon.ico">
  <title>Rite</title>
</head>

<body>
  <div id="root"></div>
  <script src="<?php echo get_stylesheet_directory_uri() . '/js/index.js?' . explode(".", microtime(true))[0] ?>"></script>
</html>
