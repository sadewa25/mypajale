$(document).ready(function(){
  const url = 'http://mypajale.id/apimypajale/api/';

  function $_GET(q,s) {
    s = (s) ? s : window.location.search;
    var re = new RegExp('&amp;'+q+'=([^&amp;]*)','i');
    return (s=s.replace(/^\?/,'&amp;').match(re)) ?s=s[1] :s='';
  }

  let id = $_GET('id');
  let template = function(data){
    return `<div class="single-post row">
        <div class="col-lg-12">
            <div class="feature-img">
                <img class="img-fluid" src="${url}/berita/img/${data.gambar_berita}" alt="">
            </div>
        </div>
        <div class="col-lg-3  col-md-3">
            <div class="blog_info text-right">
                <div class="post_tag">
                  <span>${data.tanaman}</span>
                </div>
                <ul class="blog_meta list">
                  <li>
                      <span>${data.nama_lengkap}
                          <i class="lnr lnr-user"></i>
                      </span>
                  </li>
                  <li>
                      <span>${data.tgl_berita}
                          <i class="lnr lnr-calendar-full"></i>
                      </span>
                  </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 blog_details">
            <h2>${data.judul_berita}</h2>
            <p class="excert text-justify">
                ${data.deskripsi_berita}
            </p>
        </div>
    </div>`
  }

  $.ajax({
    url: `${url}/berita/selectone.php?id_berita=${id}`,
    type: 'GET',
    beforeSend: function(){
      let html = `<div class="alert alert-success mx-auto w-100">
        Memuat berita . . .
      </div>`
      $('#berita-detil').html(html);
    }
  }).done(function(response){
    $('#berita-detil').html(template(response.result[0]))
  })

  let beritaBaru = function(data){
    let html = '';
    for (var i = 0; i < 3; i++) {
      html += `<div class="media post_item">
          <img src="${url}/berita/img/${data[i].gambar_berita}" alt="post" class="w-50">
          <div class="media-body">
              <a href="berita-details.html?id=${data[i].id_berita}">
                  <h3>${data[i].judul_berita}</h3>
              </a>
              <p>${data[i].tgl_berita}</p>
          </div>
      </div>`
    }
    return html;
  }
  $.ajax({
    url: `${url}/berita/select.php`,
    type: 'GET',
    beforeSend: function(){
      let html = `<div class="alert alert-success mx-auto w-100">
        Memuat berita . . .
      </div>`
      $('#berita-baru').html(html);
    }
  }).done(function(response){
    $('#berita-baru').html(beritaBaru(response.result))
  })


});
