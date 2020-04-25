$(document).ready(function(){
  function countdowntimes() {
    var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    var livedt = new Date();
    var d = days[livedt.getDay()];
    var mon = month[livedt.getMonth()];
    var y = livedt.getFullYear()
    var h = livedt.getHours();
    var m = livedt.getMinutes();
    var s = livedt.getSeconds();
    m = latestTime(m);
    s = latestTime(s);
    document.getElementById('date').innerHTML =
    d + " / " + mon + ' / ' + y+ ' | ' + h + ":" + m + ":" + s;
    var t = setTimeout(countdowntimes, 500);
  }
  function latestTime(i) {
      if (i < 10) {i = "0" + i};  // include a zero in front of real clock numbers < 10
      return i;
  }
  countdowntimes()

  const getData = (url, html, title) => {
    $.get(url,
      function(json){
        $(`#${html}`).text(`${json.result.length} ${title}`)
    })
  }

  getData('http://mypajale.sahabatj.com/apimypajale/api/berita/select.php', 'data-berita', 'Berita')
  getData('http://mypajale.sahabatj.com/apimypajale/api/gejala/select.php', 'data-gejala', 'Gejala')
  getData('http://mypajale.sahabatj.com/apimypajale/api/opt/select.php', 'data-opt', 'OPT')
  getData('http://mypajale.sahabatj.com/apimypajale/api/produk/select.php', 'data-produk', 'Produk')
  getData('http://mypajale.sahabatj.com/apimypajale/api/tips/select.php', 'data-tips', 'Tips')
  getData('http://mypajale.sahabatj.com/apimypajale/api/users/select.php', 'data-users', 'User')
})
