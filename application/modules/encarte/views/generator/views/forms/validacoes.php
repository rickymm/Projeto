<?php 

echo form_open();
$data = array(
    'name' => 'mestre_ualid',
    'value' => '3700,00'
);
echo form_input($data);
$data = array(
    'class' => 'btn btn-default',
    'value' => 'enviar'
);
echo form_submit($data);
echo form_close();
