<?php
$data = [];

if(!empty($_POST)) {

  /* Check for any errors */
  $required_fields = ['user_agent'];
  foreach($required_fields as $field) {
      if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
          Alerts::add_field_error($field, l('global.error_message.empty_field'));
      }
  }
  
  if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

    $whichbrowser = new \WhichBrowser\Parser($_POST['user_agent']);

    $data['result']['browser_name'] = $whichbrowser->browser->name ?? null;
    $data['result']['browser_version'] = $whichbrowser->browser->version->value ?? null;
    $data['result']['os_name'] = $whichbrowser->os->name ?? null;
    $data['result']['os_version'] = $whichbrowser->os->version->value ?? null;
    $data['result']['device_type'] = $whichbrowser->device->type ?? null;
    $data['result']['rendering_engine_name'] = $whichbrowser->engine->name ?? null;
    $data['result']['rendering_engine_version'] = $whichbrowser->engine->version->value ?? null;
    $data['result']['camouflaged'] = ($whichbrowser->camouflage ? 'Yes' : 'No') ?? null;

  }
}

$values = [
    'user_agent' => $_POST['user_agent'] ?? $_SERVER['HTTP_USER_AGENT'] ?? null,
];

?>
