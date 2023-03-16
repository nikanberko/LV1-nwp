<!DOCTYPE html>
<html lang="en-us">
<head>
</head>

<body>
<?php

include('simple_html_dom.php');
include('DiplomskiRad.php');



$url = 'http://stup.ferit.hr/index.php/zavrsni-radovi/page/2';

$fp  = fopen($url, 'r');

$read = fgetcsv($fp);

$read = file_get_html($url);
foreach($read->find('article') as $article) {

    foreach($article->find('ul.slides img') as $img) {
    }
    foreach($article->find('h2.entry-title a') as $link) {
        $html = file_get_html($link->href);
        foreach($html->find('.post-content') as $text) {
        }
    }
    $rad = array(
        'naziv_rada' => $link->plaintext,
        'tekst_rada' => $text->plaintext,
        'link_rada' => $link->href,
        'oib_tvrtke' => preg_replace('/[^0-9]/', '', $img->src)
    );
    $diplomskiRad = new DiplomskiRad($rad);
    $diplomskiRad->save();
}
    fclose($fp);

?>
</body>
</html>