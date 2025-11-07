<?php
// Minimal font definition for helvetica (fallback to core font mapping)
$name='Helvetica';
$type='Core';
$desc=array('Ascent'=>718,'Descent'=>-207,'CapHeight'=>718,'Flags'=>32,'FontBBox'=>'-166 -225 1000 931','ItalicAngle'=>0,'StemV'=>0,'MissingWidth'=>0);
$up=-100;
$ut=50;
$cw=array();
for($i=0;$i<256;$i++) $cw[chr($i)]=600/1000*1000; // dummy widths
?>