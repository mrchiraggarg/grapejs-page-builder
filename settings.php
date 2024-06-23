<?php
$con = mysqli_connect("localhost", "root", "") or die("Connection error");
mysqli_select_db($con, "page_builder") or die("DB selection error");

$page_id = $html_code = $css_code = $wl = "";

$wl = "superman";

if (!isset($_COOKIE["default_currency"])) {
    setcookie("default_currency", "Indian Rupee" . '|' . "INR", time() + (86400 * 365), "/");
}

if (!isset($_COOKIE["default_language"])) {
    setcookie("default_language", "en", time() + (86400 * 365), "/");
}

$currency = ($_COOKIE["default_currency"] ? $_COOKIE["default_currency"] : "Indian Rupee" . '|' . "INR");
$currency_code = explode("|", $_COOKIE["default_currency"])[1];
$lang = ($_COOKIE["default_language"] ? $_COOKIE["default_language"] : "en");

$base_slug = @$_REQUEST["pn"];
$html_code = $css_code = "";
$base_slug = ($base_slug ? $base_slug : "index");

$select_values = array($base_slug, $lang,"0", $wl);
$stmt = $con->prepare("SELECT * FROM multilingual_whitelabel_templates WHERE fix_page_title=? AND lang_code=? AND status_deleted=? AND template_name=? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("ssss", ...$select_values);
$stmt->execute();
$mwt_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if (count($mwt_results) ==  0) {
    $lang = ($_COOKIE["default_language"] ? $_COOKIE["default_language"] : "en");
    $select_values = array($base_slug, $lang, "0", $wl);
    $stmt = $con->prepare("SELECT * FROM multilingual_whitelabel_templates WHERE fix_page_title=? AND lang_code=? AND status_deleted=? AND template_name=? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("ssss", ...$select_values);
    $stmt->execute();
    $mwt_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

if (count($mwt_results) > 0) {
    $request_type = $mwt_results[0]["fix_page_title"];
    $html_code = $mwt_results[0]["html_code"];

    $_REQUEST["lang"] = $lang;
    require_once "multilingual.php";
    require_once "multicurrency.php";

    $html_code = str_replace('[chirag_multilingual]', $multiLingualContents, $html_code);
    $html_code = str_replace('[chirag_multicurrency]', $multicurrencyContents, $html_code);

    $css_code = $mwt_results[0]["css_code"];
    $page_seo_tags = $mwt_results[0]["page_seo_tags"] ?? "";
    $analytic_script_tags = $mwt_results[0]["analytic_scripts"] ?? "";
}
