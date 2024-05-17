<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>map</title>
  <!-- btnに関するcss -->
  <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
  <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/7-1-34/css/7-1-34.css">
  <link rel="stylesheet" href="css/btn.css">
  <!-- 背景に関するcss  -->
  <link rel="stylesheet" media="screen" href="css/particles.css">
  <!-- mapに関するcssとjs -->
  <link rel="stylesheet" href="css/map.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
          integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
          crossorigin=""></script>

  <style> 
  </style>
  </head>
  <body>

    <div id="map"></div>

    <div id="particles-js">
      <a href="/index.php#location" class="btn03 pushright"><span>戻る</span></a>
    </div><!-- .particles-js -->
    <script src="js/map.js"></script>
    <script>
      //クエリパラメータの取得
      var locationValue = getQueryParam();
      //mapの生成
      generateMap(locationValue);
    </script>


  <!-- 背景に関するjs  -->
  <script src="js/particles.min.js"></script>
  <script src="js/app.js"></script>
  <script src="js/lib/stats.js"></script>
  </body>
</html>