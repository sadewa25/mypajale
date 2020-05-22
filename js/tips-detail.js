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
                <img class="img-fluid" src="${url}/tips/img/${data.gambar_tips}" alt="">
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
                      <span>${data.nama_kategori_tips}
                          <i class="lnr lnr-list"></i>
                      </span>
                  </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 blog_details">
            <h2>${data.judul_tips}</h2>
            <p class="excert text-justify">
                ${data.deskripsi_tips}
            </p>
        </div>
    </div>`
  }

  $.ajax({
    url: `${url}/tips/selectone.php?id_tips=${id}`,
    type: 'GET',
    beforeSend: function(){
      let html = `<div class="alert alert-success mx-auto w-100">
        Memuat tips . . .
      </div>`
      $('#tips-detil').html(html);
    }
  }).done(function(response){
    $('#tips-detil').html(template(response.result[0]))
  })

  let tipsBaru = function(data){
    let html = '';
    for (var i = 0; i < 3; i++) {
      html += `<div class="media post_item">
          <img src="${url}/tips/img/${data[i].gambar_tips}" alt="post" class="w-50">
          <div class="media-body">
              <a href="tips-details.html?id=${data[i].id_tips}">
                  <h3>${data[i].judul_tips}</h3>
              </a>
              <p>${data[i].nama_kategori_tips}</p>
          </div>
      </div>`
    }
    return html;
  }
  $.ajax({
    url: `${url}/tips/select.php`,
    type: 'GET',
    beforeSend: function(){
      let html = `<div class="alert alert-success mx-auto w-100">
        Memuat tips . . .
      </div>`
      $('#tips-baru').html(html);
    }
  }).done(function(response){
    $('#tips-baru').html(tipsBaru(response.result))
  })


});
