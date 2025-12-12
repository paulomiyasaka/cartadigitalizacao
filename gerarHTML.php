<?php
require 'controle/auto_load.class.php';
new auto_load();

$editor = new HtmlTemplateEditor('carta_modelo.html');
$editor->replacePlaceholder('{{imageLogotipo}}', '../img/NCorreios_hori_cor_pos.png');
$editor->replacePlaceholder('{{enderecoUnidade}}', );
$editor->replacePlaceholder('{{nomeUnidade}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );
$editor->replacePlaceholder('{{username}}', );


$editor->saveAs('output/result.html');

?>