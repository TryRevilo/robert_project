<style type="text/css">

  .navbar-right {
    float: right!important;
    margin-right: 0 !important;
  }

  .navbar {
    width: inherit !important;
    margin: 0 auto;
    border-radius: 0;
  }

  .navbar-default {
    background-color: #f8f8f8;
    border-color: #e7e7e7;
    padding: 0 32px 0 5px;
  }

  .navbar-nav {
    margin: 7.5px 0 !important;
  }

  .navbar>.container-fluid .navbar-brand {
    margin-left: 0 !important;
  }

  .navbar-brand {
    font-size: 150% !important;
    float: left;
    height: auto !important;
    padding: 15px 15px;
    padding-top: 17px !important;
    line-height: normal !important;
  }

  .nav > li > a {
    position: relative;
    display: block;
    padding: 10px 15px;
  }

  .navbar-fixed-bottom, .navbar-fixed-top {
    position: fixed;
    right: auto !important;
    left: auto !important;
    z-index: 650;
  }

  .fix-search-right {
    margin-top: 14px;
  }

  #bs-example-navbar-collapse-1 > form {
    width: 455px !important;
  }

  .navbar-form {
    padding: 0 !important;
    margin: 0 !important;
    border: none !important;
    -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.1),0 1px 0 rgba(255,255,255,.1);
    box-shadow: inset 0 1px 0 rgba(255,255,255,.1),0 1px 0 rgba(255,255,255,.1);
  }

  #bs-example-navbar-collapse-1 > ul:nth-child(1) > li.active > a > span.elgg-icon-square-o.elgg-icon.fa.fa-square-o {
    color: #31DE0D !important;
    font-size: 150% !important;
    margin-right: -5px;
  }

  #bs-example-navbar-collapse-1 > ul:nth-child(1) > li.active > a > span.elgg-icon-plus-square.elgg-icon.fa.fa-plus-square {
    color: #31DE0D !important;
    font-size: 190% !important;
  }

  #bs-example-navbar-collapse-1 > ul:nth-child(1) > li.active > a > span.elgg-icon-level-up.elgg-icon.fa.fa-level-up {
    color: #31DE0D !important;
    font-size: 150% !important;
    padding-right: 10px;
    margin-left: -2px;
  }

</style>

<?php

$value = "";
if (array_key_exists('value', $vars)) {
  $value = $vars['value'];
} elseif ($value = get_input('q', get_input('tag', NULL))) {
  $value = $value;
}

$class = "form-control";
if (isset($vars['class'])) {
  $class = "$class {$vars['class']}";
}

// @todo - create function for sanitization of strings for display in 1.8
// encode <,>,&, quotes and characters above 127
if (function_exists('mb_convert_encoding')) {
  $display_query = mb_convert_encoding($value, 'HTML-ENTITIES', 'UTF-8');
} else {
  // if no mbstring extension, we just strip characters
  $display_query = preg_replace("/[^\x01-\x7F]/", "", $value);
}

// render placeholder separately so it will double-encode if needed
$placeholder = htmlspecialchars(elgg_echo('search'), ENT_QUOTES, 'UTF-8');

$search_attrs = elgg_format_attributes(array(
  'type' => 'text',
  'class' => 'form-control',
  'size' => '21',
  'name' => 'q',
  'autocapitalize' => 'off',
  'autocorrect' => 'off',
  'required' => true,
  'value' => $display_query,
  ));
  ?>

  <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <?php echo elgg_view_icon('university'); ?>
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="<?php echo elgg_get_site_url(); ?>rooms/add_room">
                <?php echo elgg_view_icon('square-o') . elgg_view_icon('plus-square') . elgg_view_icon('level-up'); ?>
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
          <form class="navbar-form navbar-left" action="<?php echo elgg_get_site_url(); ?>search" method="get">
            <div class="form-group input-group input-group-sm fix-search-right">
              <fieldset>
                <input placeholder="<?php echo $placeholder; ?>" <?php echo $search_attrs; ?> />
                <input type="hidden" name="search_type" value="all" />
                <input type="submit" value="<?php echo elgg_echo('search:go'); ?>" class="form-control" />
              </fieldset>
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<?php echo elgg_get_site_url(); ?>action/logout">
                <?php echo elgg_view_icon('sign-out') . 'Log out'; ?>
              </a>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>