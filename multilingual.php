<?php
$multiLingualContents = '<li class="chirag_language_list">
<span class="activated_chirag_language">';

$multiLingualContents .= $_COOKIE["default_language"];

$multiLingualContents .= '</span>
<ul class="all_chirag_language_list">
    <p>Language</p>';

    if($_COOKIE["default_language"] == "en") {
        $multiLingualContents .= '<li data-value="ar"><span>ar</span>Arabic</li>';
    } else if($_COOKIE["default_language"] == "ar") {
        $multiLingualContents .= '<li data-value="en"><span>en</span>English</li>';
    }

    $multiLingualContents .= '</ul>
</li>';
?>