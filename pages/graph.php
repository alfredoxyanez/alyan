<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<style>
.container {
  margin: 20px;
  width: 200px;
  height: 200px;
  position: relative;
}
.container > svg {
  height: 100%;
  display: block;
}
</style>
<script src="../node_modules/progressbar.js/dist/progressbar.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
<script type="text/javascript">

window.onload = function onLoad() {
  var circle = new ProgressBar.Circle('#container', {
    color: '#aaa',
    // This has to be the same size as the maximum width to
    // prevent clipping
    strokeWidth: 4,
    trailWidth: 1,
    easing: 'easeInOut',
    duration: 1400,
    text: {
      autoStyleContainer: false
    },
    from: { color: '#f9f9f9', width: 1 },
    to: { color: '#5cb85c', width: 4 },
    // Set default step function for all animate calls
    step: function(state, circle) {
      circle.path.setAttribute('stroke', state.color);
      circle.path.setAttribute('stroke-width', state.width);

      var value = Math.round(circle.value() * 100);
      if (value === 0) {
        circle.setText('');
      } else {
        circle.setText(value);
      }

    }
  });
  circle.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
  circle.text.style.fontSize = '2rem';

  circle.animate(1);
};


</script>


<body>
  <div class="container" id="container"></div>

</body>
</html>
