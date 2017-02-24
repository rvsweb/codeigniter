<!-- Vista : FORMULARIO -->

<!-- Carga el css desde el directorio indicado -->
<link rel="stylesheet" type="text/css" href ="<?php echo base_url(); ?>css/style.css">
<link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet">

<?php
//Mensaje de texto enviado desde metodo index() del Controlador
if (isset($texto)) {
  echo "<h2>$texto</h2>"; // Muestra el mensaje
}

//Mensaje de texto enviado desde metodo check_login() del Controlador
if (isset($error)) {
  echo "<h2>$error</h2>";
}

// Carga el formulario "es una funcion" no necesita objeto
$this->load->helper("form");

$atributos = array('class' => 'checklogin', 'id' => 'michecklogin');
echo form_open("login_seguro/check_login", $atributos); // Abre la funcion 'check_login' del Controlador
echo form_label("Nombre de Usuario : ", "usr"); //crea Titulo Formulario
// parametros para el input
$data = array(
    'name' => 'usr',
    'value' => '',
    'maxlength' => '20',
    'size' => '10');

echo form_input($data); // crea etiqueta elemento relacionado 
echo form_error("usr"); // recoge mensaje requerido
echo form_label("Password : ", "pass"); // crea etiqueta elemento relacionado 'pass'
echo form_password('pass'); // crea etiqueta elemento relacionado
echo form_error("pass"); // recoge mensaje requerido
echo form_submit("enviar", "Entrar"); // crea elemento enviar
echo form_close();
