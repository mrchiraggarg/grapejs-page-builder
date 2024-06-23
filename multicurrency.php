<?php
$stmt = $con->prepare("SELECT DISTINCT code,currency FROM currency");
$stmt->execute();
$ccpc_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$multicurrencyContents = '<li class="chirag_currency_list">';
$multicurrencyContents .= '<span class="activated_chirag_currency">Indian Rupee (INR)</span>';
$multicurrencyContents .= '<ul class="all_chirag_currency_list"><p>Currency</p>';
for ($r = 0; $r < count($ccpc_results); $r++) {
    $multicurrencyContents .= '<li data-value="' . $ccpc_results[$r]['currency'] . '|' . $ccpc_results[$r]['code'] . '"><span>' . $ccpc_results[$r]['code'] . '</span>' . $ccpc_results[$r]['currency'] . '</li>';
}
$multicurrencyContents .= '</ul>';
$multicurrencyContents .= '</li>';
?>