<!DOCTYPE HTML>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>

    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9; /* Color sobrio de fondo */
        color: #333;
        margin: 0;
        padding: 0;
      }

      .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
      }

      h1 {
        text-align: center;
        color: #4A4E69;
      }

      form {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
      }

      input[type="text"] {
        flex: 1;
        padding: 10px;
        font-size: 16px;
        border: 2px solid #9A8C98;
        border-radius: 4px;
      }

      input[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #C9ADA7;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
      }

      input[type="submit"]:hover {
        background-color: #9A8C98;
      }

      ol {
        padding-left: 20px;
      }

      li {
        padding: 10px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        margin-bottom: 10px;
        border-radius: 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      li input[type="checkbox"] {
        margin-right: 10px;
      }
    </style>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('#new-task').onsubmit = () => {
          const cb = document.createElement("INPUT");
          cb.setAttribute("type", "checkbox");

          const li = document.createElement('li');
          li.appendChild(cb);
          li.innerHTML += document.querySelector('#task').value;

          document.querySelector('#tasks').append(li);

          document.querySelector('#task').value = '';

          return false;
        };
      });
    </script>
  </head>
  <body>
    <div class="container">
      <h1>Lista de Tareas</h1>

      <form id="new-task" method="post" action="">
        <input id="task" name="task" autocomplete="off" autofocus placeholder="Nueva Tarea" type="text" required>
        <input type="submit" value="Agregar Tarea">
      </form>

      <ol id="tasks">
        <?php
          // Verifica si se ha enviado el formulario
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              // Toma la tarea desde el formulario
              $tarea = $_POST['task'];
              $fecha = date("Y-m-d H:i:s"); // Obtiene la fecha actual

              // Guarda la tarea y la fecha en un archivo de texto
              $archivo = fopen("tareas.txt", "a");
              fwrite($archivo, "$tarea - $fecha\n");
              fclose($archivo);
          }

          // Lee las tareas almacenadas y las muestra
          if (file_exists("tareas.txt")) {
              $tareas = file("tareas.txt");
              foreach ($tareas as $linea) {
                  echo "<li>$linea</li>";
              }
          }
        ?>
      </ol>
    </div>
  </body>
</html>
