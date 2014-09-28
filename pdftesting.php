<?php
$mypdf = PDF_new();
PDF_open_file($mypdf, "");
PDF_begin_page($mypdf, 595, 842);
$myfont = PDF_findfont($mypdf, "Times-Roman", "host", 0);
PDF_setfont($mypdf, $myfont, 10);
PDF_show_xy($mypdf, "Sample PDF, constructed by PHP in real-time.", 50, 750);
PDF_show_xy($mypdf, "Made with the PDF libraries for PHP.", 50, 500);
PDF_end_page($mypdf);
PDF_close($mypdf);

$mybuf = PDF_get_buffer($mypdf);
$mylen = strlen($mybuf);
header("Content-type: application/pdf");
header("Content-Length: $mylen");
header("Content-Disposition: inline; filename=gen01.pdf");
print $mybuf;

PDF_save($mypdf);

?>