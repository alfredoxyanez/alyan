<!DOCTYPE html>
<html>
  <head>
    <title>$.geocomplete()</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" type="text/css" href="styles.css" />
    <style type="text/css" media="screen">
      .map_canvas { float: left; }
      form { width: 300px; float: left; }
      fieldset { width: 320px; margin-top: 20px}
      fieldset label { display: block; margin: 0.5em 0 0em; }
      fieldset input { width: 95%; }
    </style> -->
  </head>
  <body>

    <div class="map_canvas"></div>

    <form>
      <input id="geocomplete" type="text" placeholder="Type in an address" value="Empire State Bldg" />
      <input id="find" type="button" value="find" />

      <fieldset>
        <h3>Address-Details</h3>

        <label>Latitude</label>
        <input name="lat" type="text" value="">

        <label>Longitude</label>
        <input name="lng" type="text" value="">



      </fieldset>
    </form>


  </body>

  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD6RsQuot1EGNW89-uIU70htIbLaGy_Gb8&libraries=places"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

  <script src="../js/jquery.geocomplete.js"></script>

  <script>
    $(function(){
      $("#geocomplete").geocomplete({
        map: ".map_canvas",
        details: "form",
        types: ["geocode", "establishment"],
      });
      $("#find").click(function(){
        $("#geocomplete").trigger("geocode");
      });
    });
  </script>
</html>
