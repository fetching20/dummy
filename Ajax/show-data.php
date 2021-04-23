<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

    <table id="main" border="0" cellspacing="0">
      <td>
        <tr id="header">
        <h1>PHP with Ajax</h1>
        </tr>
      </td>
      <tr>
      <td id="table-load">
        <input type="button" id="load-button" value="Load Data">
      </td>
    </tr>
      <tr>
        <td id="table-data"></td>
      </tr>
    </table>

<script type="text/javascript" src="JS/jquery.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){

        $("#load-button").on("click", function(e){
          $.ajax({
            url : "ajax-load.php",
            type : "POST",
            success : function(data){
              $("#table-data").html(data);
            }
          })
        });

      });
  </script>


</body>
</html>