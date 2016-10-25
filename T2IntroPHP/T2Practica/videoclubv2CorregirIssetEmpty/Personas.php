<!--
    @Created on : 20-oct-2016, 23:46:08
    @Author     : RVS - N.F.N.D
    @Pag        :
    @version    :
                  Después escribe un programa en PHP para mantener la tabla Personas. 

                  El programa debe permitir:

                  *Añadir nuevos registros, introduciendo todos los campos de la tabla.

                  - Eliminar registros existentes, introduciendo el código de la película.

                  Modificar los registros existentes, mostrando antes la información que haya en la BD.

                  También debe ser posible hacer un mantenimiento de la tabla Películas 
                  (Añadir, eliminar y modificar), pero ten cuidado, porque en este caso 
                  hay que enlazarla con la tabla Actúan para especificar los actores que trabajan en la película.

                  Escribe también el código PHP necesario para buscar una película 
                  cualquiera introduciendo su título, su género, el país o el nombre de cualquiera de sus actores.

                  El acceso a la aplicación tiene que estar controlado mediante 
                  una pantalla de login que solo permita acceder al programa a los usuarios registrados.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <form name="form1" method="get" action ="<?php echo $_SERVER['PHP_SELF'] ?>">
      <label><h3>Formulario</h3></label>
      Cod_persona : <input type="text" name="cod_persona" value="">
      <br>
      Nombre :  <input type="text" name="nombre" value="">
      <br>
      Apellidos :  <input type="text" name="apellidos" value="">
      <br>
      Pais :  <input type="text" name="pais" value="">
      <br>
      <br>
      <input type="submit" name="enviar" value="Enviar">
    </form> 
  </body>
</html>
<br>
<hr>

<?php

class Personas {

//   Atributos : Almacenan los valores del formulario cuando estos se envian
  public $cod_persona;
  public $nombre;
  public $apellidos;
  public $pais;

  /**
   * ♥ SELECT
   *  Funciona : Muestra todos los resultados automaticamente
   */
  public function consultar_personas() {
    $mysqli = new mysqli("localhost", "root", "", "videoclubprueba");
    if ($mysqli->connect_errno) {
      die("Error : No se establecido la conexion . " . $mysqli->connect_error);
    }
    if (isset($_REQUEST['cod_persona'])) {
      if (empty($_REQUEST['cod_persona'])) {
        echo "<em>No hay ningun <strong>cod_persona</strong> seleccionado.</em><br><br>";
      } else {
        $resultado = $mysqli->query("SELECT * FROM Personas WHERE cod_persona LIKE '" . $this->cod_persona . "';");
        $numeroRegistros = $resultado->num_rows;
        if ($resultado->num_rows > 0) {
          echo '<br><em>Total de Numeros de Registros</em> = ' . $numeroRegistros . '';
          echo '<hr>';
          echo "<br><table border='1'>"
          . "<tr>"
          . "<th> cod_persona </th>"
          . "<th> nombre </th>"
          . "<th> apellidos </th>"
          . "<th> pais </th>"
          . "</tr>";
        } else {
          echo "<strong>- No hay registros <br> - Comprueba los datos introducidos<br></strong>";
        }
        while ($registro = $resultado->fetch_assoc()) {
          echo '<tr>'
          . '<td>' . $registro['cod_persona'] . '</td>'
          . '<td>' . $registro['nombre'] . '</td>'
          . '<td>' . $registro['apellidos'] . '</td>'
          . '<td>' . $registro['pais'] . '</td>'
          . '</tr>';
        }
      }
      $mysqli->close();
    }
  }

  /**
   * ♥ INSERT
   * Añadir peliculas
   */
  public function aniadir_personas() {
    $mysqli = new mysqli("localhost", "root", "", "videoclubprueba"); //crea conexion
    if ($mysqli->connect_errno) {
      die("Error : No se establecido la conexion . " . $mysqli->connect_error);
    }
    if ((isset($_REQUEST['cod_persona']) && isset($_REQUEST['nombre'])) && (isset($_REQUEST['apellidos']) && isset($_REQUEST['pais']))) {
      if ((!empty($_REQUEST['cod_persona']) && !empty($_REQUEST['nombre'])) && (!empty($_REQUEST['apellidos']) && !empty($_REQUEST['pais']))) {
        $sql = "INSERT INTO Personas (cod_persona,nombre,apellidos,pais) VALUES ('" . $this->cod_persona . "','" . $this->nombre . "','" . $this->apellidos . "','" . $this->pais . "');";
        $mysqli->query($sql);
        echo ("<em> Nueva Inserccion del Registro</em><br>");
        $resultado = $mysqli->query("SELECT * FROM Personas WHERE cod_persona LIKE '" . $this->cod_persona . "';");
        echo "<br><table border='1'>"
        . "<tr>"
        . "<th> cod_persona </th>"
        . "<th> nombre </th>"
        . "<th> apellidos </th>"
        . "<th> pais </th>"
        . "</tr>";
        while ($registro = $resultado->fetch_assoc()) {
          echo '<tr>'
          . '<td>' . $registro['cod_persona'] . '</td>'
          . '<td>' . $registro['nombre'] . '</td>'
          . '<td>' . $registro['apellidos'] . '</td>'
          . '<td>' . $registro['pais'] . '</td>'
          . '</tr>';
        }
      } else {
        echo "<em>Atencion : No se pueden añadir campos <strong>vacios o nulos</strong></em><br>";

        $mysqli->close();
      }
    }
  }

  /**
   * ♥ UPDATE
   */
  public function modificar_personas() {
    $p = new Personas();
    $p->consultar_personas();
    echo "<br>";
    echo "<hr>";
    $mysqli = new mysqli("localhost", "root", "", "videoclubprueba");
    if ($mysqli->connect_errno) {
      die("Error : No se establecido la conexion . " . $mysqli->connect_error);
    }
    $registro = $mysqli->query("UPDATE Personas SET nombre = '" . $this->nombre . "' , apellidos = '" . $this->apellidos . "' , pais = '" . $this->pais . "' WHERE cod_persona = '" . $this->cod_persona . "' ;");
    if ($registro == true) {
      echo "<strong><br> Consulta realizada</strong>";
      echo "<br>";
      while ($registro = $resultado->fetch_assoc()) {
        echo '<tr>'
        . '<td>' . $registro['cod_persona'] . '</td>'
        . '<td>' . $registro['nombre'] . '</td>'
        . '<td>' . $registro['apellidos'] . '</td>'
        . '<td>' . $registro['pais'] . '</td>'
        . '</tr>';
      }
    }
    $mysqli->close();
  }

  /**
   * ♥ DELETE
   * Funciona 
   */
  public function borrar_personas() {
    $mysqli = new mysqli("localhost", "root", "", "videoclubprueba");
    if ($mysqli->connect_errno) {
      die(" <br> Error : No se ha establecio la conexion . " . $mysqli->connect_error);
    }
    echo " ♦ Valor de la variable cod_persona :  " . $this->cod_persona;
    if (isset($_REQUEST['enviar'])) {
      $resultado = $mysqli->query("DELETE FROM Personas WHERE cod_persona LIKE '" . $this->cod_persona . "';");
      if ($resultado == true) {
        echo "<br> <strong> Registro Borrado CON EXITO </strong>";
        while ($registro = $resultado->fetch_assoc()) {
          echo '<tr>'
          . '<td>' . $registro['cod_persona'] . '</td>'
          . '<td>' . $registro['nombre'] . '</td>'
          . '<td>' . $registro['apellidos'] . '</td>'
          . '<td>' . $registro['pais'] . '</td>'
          . '</tr>';
        }
        $mysqli->close();
      } else {
        echo "<br> <strong> Registro NO Borrado </strong><br>";
        echo "<br>  Comprueba <strong>cod_persona</strong> es correcto <br>";
        while ($registro = $resultado->fetch_assoc()) {
          echo '<tr>'
          . '<td>' . $registro['cod_persona'] . '</td>'
          . '<td>' . $registro['nombre'] . '</td>'
          . '<td>' . $registro['apellidos'] . '</td>'
          . '<td>' . $registro['pais'] . '</td>'
          . '</tr>';
        }
        $mysqli->close();
      }
    } else {
      echo " <br> Sin Accceso al Registro <br> Introduce el <strong>cod_persona</strong> en el campo <strong>Cod_Persona</strong> ";
    }
  }

}

// Objeto para añadir los datos del formulario a los atributos de clase 
$per = new Personas();

if (isset($_REQUEST['enviar'])) {
// Datos se envian formulario se almacenan atributos clase
  $per->cod_persona = $_REQUEST['cod_persona'];
  $per->nombre = $_REQUEST['nombre'];
  $per->apellidos = $_REQUEST['apellidos'];
  $per->pais = $_REQUEST['pais'];
//  $per->consultar_personas();
//  $per->aniadir_personas();
  $per->modificar_personas();
//  $per->borrar_personas();
}
?>

