<?php
header('Content-Type: application/json');

$con = mysqli_connect("localhost", "root", "") or die('Connection error');
mysqli_select_db($con, "page_builder") or die('DB selection error');

$action = $_REQUEST["action"];

if ($action == "get_template") {
    $select_values = array($_REQUEST["id"]);
    $stmt = $con->prepare("SELECT html_code,css_code FROM multilingual_whitelabel_templates WHERE id=?");
    $stmt->bind_param("s", ...$select_values);
    $stmt->execute();
    $mwt_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $data = array("html_code" => "", "css_code" => "");
    if (count($mwt_results) > 0) {
        $data = array("html_code" => $mwt_results[0]["html_code"], "css_code" => $mwt_results[0]["css_code"]);
    }
    echo json_encode($data);
    die;
}

if ($action == "save_template") {
    $select_values = array($_REQUEST["id"]);
    $stmt = $con->prepare("SELECT * FROM multilingual_whitelabel_templates WHERE id=?");
    $stmt->bind_param("s", ...$select_values);
    $stmt->execute();
    $mwt_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $flag = 0;
    if (count($mwt_results) > 0) {
        $update_values = array("1", $mwt_results[0]["template_name"], $mwt_results[0]["lang_code"], $mwt_results[0]["pid"], $mwt_results[0]["page_slug"]);
        $stmt = $con->prepare("UPDATE multilingual_whitelabel_templates SET status_deleted=? WHERE template_name=? AND lang_code=? AND pid=? AND page_slug=?");
        $stmt->bind_param("sssss", ...$update_values);
        if ($stmt->execute()) $flag = 1;
        else $flag = 0;
        $stmt->close();

        if ($mwt_results[0]["id"]) {
            unset($mwt_results[0]["id"]);
        }
        if ($mwt_results[0]["published"]) {
            unset($mwt_results[0]["published"]);
        }
        if ($mwt_results[0]["status_deleted"]) {
            unset($mwt_results[0]["status_deleted"]);
        }
        if ($mwt_results[0]["last_updated"]) {
            unset($mwt_results[0]["last_updated"]);
        }
        if ($mwt_results[0]["date_time"]) {
            unset($mwt_results[0]["date_time"]);
        }

        $mwt_results[0]["html_code"] = $con->real_escape_string($_REQUEST["htmldata"]);
        $mwt_results[0]["css_code"] = $con->real_escape_string($_REQUEST["cssdata"]);
        $mwt_results[0]["analytic_scripts"] = $con->real_escape_string($mwt_results[0]["analytic_scripts"]);

        $mwt_columns = array_keys($mwt_results[0]);
        $mwt_query = "INSERT INTO multilingual_whitelabel_templates (" . implode(", ", $mwt_columns) . ") VALUES ('" . implode("','", $mwt_results[0]) . "')";
        if (mysqli_query($con, $mwt_query))
            $flag = 1;

        $update_values = array($_REQUEST["htmldata"], $_REQUEST["cssdata"], $_REQUEST["id"]);
        $stmt = $con->prepare("UPDATE multilingual_whitelabel_templates SET html_code=?,css_code=? WHERE id=?");
        $stmt->bind_param("sss", ...$update_values);
        if ($stmt->execute()) $flag = 1;
        else $flag = 0;
        $stmt->close();
    }

    echo json_encode(array("flag" => $flag));
}

function escapeHtmlTags($value)
{
    return htmlentities($value, ENT_QUOTES, 'UTF-8');
}
