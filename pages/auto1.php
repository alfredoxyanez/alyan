<!DOCTYPE html>
<html>
  <head>
    <title>$.geocomplete()</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css" />
  </head>
  <body>

    <form>
      <input id="geocomplete" type="text" placeholder="Type in an address" size="90" />
      <input id="find" type="button" value="find" />
    </form>

    <div class="map_canvas"></div>

    Call:
    <input type="text" id="steest" >
    <button id="search">.geocomplete("find", "32 hereford st")</button>
    <button id="center">.geocomplete("map").setCenter()</button>


    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD6RsQuot1EGNW89-uIU70htIbLaGy_Gb8&libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script src="../js/jquery.geocomplete.js"></script>
    <script src="logger.js"></script>

    <script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas"
        });
        $("#steest").geocomplete({
        });

        $("#search").click(function(){
          place= $("#steest").val();
          alert(place);

          $("#geocomplete").geocomplete("find", place);
        });

        $("#center").click(function(){
          var map = $("#geocomplete").geocomplete("map"),
            center = new google.maps.LatLng(10, 0);

          map.setCenter(center);
          map.setZoom(3);
        });
      });
    </script>
  </body>
</html>
