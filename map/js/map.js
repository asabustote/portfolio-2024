function getQueryParam () {
  // 現在のURLを取得
  var urlParams = new URLSearchParams(window.location.search);
  // locationの値を取得
  var locationValue = urlParams.get('location');
  return locationValue;
}


  function generateMap(locationName) {
    fetch("https://www.orangefrog14.com/location/" + locationName)
    .then(response => {
      // レスポンスのステータスコードをログに表示
      console.log("Status code:", response.status);
      // JSON形式でレスポンスを解析してログに表示
      return response.json();
    })
    .then(data => {
      console.log("Response:", data);
      //マップに位置情報をセット
      setLocationInfo(data)
    })
    .catch(error => {
      console.error("Error:", error);
    });
  }

  function setLocationInfo(data) {
      // マップの生成
      var map = L.map('map').setView([data.latitude, data.longitude], 16);
      var marker = L.marker([data.latitude, data.longitude]).addTo(map);
      marker.bindPopup(data.name).openPopup();
  
      // OpenStreetMapタイルレイヤーの追加
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);
  }