<?php
require "settings.php";
?>

<!DOCTYPE html>
<html>

<head>
  <?= $analytic_script_tags ?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <?php
  if (isset($_REQUEST["e"])) {
  ?>

    <link rel="stylesheet" href="asset/css/demos.css">
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <script src="https://unpkg.com/grapesjs"></script>
    <link href="asset/css/grapick.min.css" rel="stylesheet">
    <script src="asset/js/grapesjs-preset-webpage@1.0.2"></script>
    <script src="asset/js/grapesjs-blocks-basic@1.0.1"></script>
    <script src="asset/js/grapesjs-plugin-forms@2.0.5"></script>
    <script src="asset/js/grapesjs-component-countdown@1.0.1"></script>
    <script src="asset/js/grapesjs-plugin-export@1.0.11"></script>
    <script src="asset/js/grapesjs-tabs@1.0.6"></script>
    <script src="asset/js/grapesjs-custom-code@1.0.1"></script>
    <script src="asset/js/grapesjs-touch@0.1.1"></script>
    <script src="asset/js/grapesjs-parser-postcss@1.0.1"></script>
    <script src="asset/js/grapesjs-tooltip@0.1.7"></script>
    <script src="asset/js/grapesjs-tui-image-editor@0.1.3"></script>
    <script src="asset/js/grapesjs-typed@1.0.5"></script>
    <script src="asset/js/grapesjs-style-bg@2.0.1"></script>

  <?php
  }
  ?>

    <title>Page Builder</title>
    <meta name="description" content="Page Builder">
  <?= $page_seo_tags ?>

  <style>
    body {
      overflow: auto !important;
    }

    .header-text-right {
      float: left
    }

    .chirag_currency_list {
      position: relative;
      display: inline;
    }

    .chirag_currency {
      position: relative;
    }

    .activated_chirag_currency {
      color: #fff;
    }

    .all_chirag_currency_list>p {
      margin: 0px 0px 13px;
      color: #607D8B;
      border-bottom: 1px solid #cccccc96;
      padding-bottom: 11px;
      font-weight: 500;
      font-size: 17px;
    }

    .all_chirag_currency_list span {
      text-transform: capitalize;
      margin-right: 10px;
      color: #607D8B;
      font-weight: 600;
    }

    .chirag_language {
      position: relative;
    }

    .all_chirag_currency_list {
      display: none;
      position: absolute;
      background: #fff;
      width: 800px;
      right: 0em;
      top: 100%;
      margin: 0px;
      padding: 20px;
      list-style: none;
      text-align: left;
      border-radius: 10px;
      box-shadow: 0 0 24px 2px rgba(0, 0, 0, .08);
      transform: translateY(6px);
      z-index: 9999;
      float: left;
    }

    .all_chirag_language_list>p {
      margin: 0px 0px 13px;
      color: #607D8B;
      border-bottom: 1px solid #cccccc96;
      padding-bottom: 11px;
      font-weight: 500;
      font-size: 17px;
    }

    .all_chirag_language_list span {
      text-transform: capitalize;
      margin-right: 10px;
      color: #607D8B;
      font-weight: 600;
    }

    .all_chirag_currency_list span {
      text-transform: capitalize;
      margin-right: 10px;
      color: #607D8B;
      font-weight: 600;
    }

    .all_chirag_currency_list li {
      padding: 5px 7px;
      font-size: 15px;
      color: #777;
      width: 33.3%;
      float: left;
      display: block;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      font-weight: 400;
      cursor: pointer;
    }

    .chirag_currency:hover .all_chirag_currency_list {
      display: block
    }

    .chirag_language_list {
      position: relative;
      display: inline;
    }

    .activated_chirag_language {
      color: #fff;
    }

    .all_chirag_language_list {
      display: none;
      position: absolute;
      background: #fff;
      width: 385px;
      left: -5em;
      top: 100%;
      margin: 0px;
      padding: 20px;
      list-style: none;
      text-align: left;
      border-radius: 10px;
      box-shadow: 0 0 24px 2px rgba(0, 0, 0, .08);
      transform: translateY(6px);
      z-index: 9999;
      float: left;
      cursor: pointer;
    }

    .all_chirag_language_list li {
      padding: 5px 7px;
      font-size: 15px;
      color: #777;
      width: 33.3%;
      float: left;
      display: block;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      font-weight: 400;
    }

    .chirag_language:hover .all_chirag_language_list {
      display: block
    }

    .abe-language-ar .all_chirag_language_list {
      left: 0;
      right: 0;
      float: right;
      text-align: right;
    }

    .abe-language-ar .all_chirag_currency_list {
      left: 0;
      right: 0;
      float: right;
      text-align: right;
    }

    .abe-language-ar .all_chirag_language_list>p {
      text-align: right;
    }

    .abe-language-ar .all_chirag_currency_list>p {
      text-align: right;
    }

    .abe-language-ar .all_chirag_language_list li {
      float: right
    }

    .abe-language-ar .all_chirag_language_list span {
      margin-left: 10px;
      float: right;
      margin-right: 0px;
    }

    .abe-language-ar .all_chirag_currency_list span {
      margin-left: 10px;
      float: right;
      margin-right: 0px;
    }

    @media (max-width: 789px) {

      .chirag_language:hover .all_chirag_language_list,
      .chirag_currency:hover .all_chirag_currency_list {
        width: 150px;
        right: 0;
        padding: 10px;
        left: 0;
      }

      .all_chirag_language_list li,
      .all_chirag_currency_list li {
        width: 100%
      }

      .all_chirag_language_list {}
    }


    <?= $css_code ?>
  </style>

</head>

<?= $html_code ?>

<?php
if (isset($_REQUEST["e"])) {
?>

  <body>
    <div id="gjs" style="height:0px; overflow:hidden;">
    </div>
  </body>
<?php
}
?>
