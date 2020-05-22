$(document).ready(function(){
  const url = 'http://mypajale.id/apimypajale/api/';
  let template = function(data){
    let html = ''
    for (var i = 0; i < data.length; i++) {
      html += `<article class="row blog_item" id="article-berita">
          <div class="col-md-4">
              <div class="blog_info text-right">
                  <div class="post_tag">
                      <span>${data[i].tanaman}</span>
                  </div>
                  <ul class="blog_meta list">
                      <li>
                          <span>${data[i].nama_lengkap}
                              <i class="lnr lnr-user"></i>
                          </span>
                      </li>
                      <li>
                          <span>${data[i].tgl_berita}
                              <i class="lnr lnr-calendar-full"></i>
                          </span>
                      </li>
                  </ul>
              </div>
          </div>
          <div class="col-md-8">
              <div class="blog_post">
                  <img src="${url}/berita/img/${data[i].gambar_berita}" alt="">
                  <div class="blog_details">
                      <a href="single-blog.html">
                          <h2 id="judul-berita">${data[i].judul_berita}</h2>
                      </a>
                      <p id="deskripsi-berita" class="text-justify">${data[i].deskripsi_berita.substring(0,455)}.....</p>
                      <a class="button button-blog" href="berita-details.html?id=${data[i].id_berita}">Selengkapnya</a>
                  </div>
              </div>
          </div>
      </article>`;
    }
    return html;
  }

  let searchBerita = function(filter){
    let textJudul, textDeskripsi;
    let count = 0;
    for (let i = 0; i < $('article').length; i++) {
      let article = $('article')[i.toString()];
      // console.log($('article')[i.toString()])
      textJudul = $("article").find('#judul-berita')[i.toString()].innerText.toLowerCase();
      textDeskripsi = $("article").find('#deskripsi-berita')[i.toString()].innerText.toLowerCase();
      if (textJudul.indexOf(filter) > -1 || textDeskripsi.indexOf(filter) > -1) {
        article.style.display = ''
        count--;
      }else {
        article.style.display = 'none';
        count++
      }
      if (count >= $('article').length) {
        $('#no-result').removeClass('d-none')
        $('#pages').addClass('d-none');
      }else {
        $('#no-result').addClass('d-none');
        $('#pages').removeClass('d-none')
      }
      // count = 0;
      // console.log(count)
    }
  }

  $('#pages').pagination({
      dataSource: function(done) {
        let html = `<div class="alert alert-success mx-auto w-100 text-center">
          Memuat berita . . .
        </div>`
        $('#content-berita').html(html);
        $.ajax({
            type: 'GET',
            url: `${url}/berita/select.php`,
            success: function(response) {
                done(response.result);
            }
        });
       },
      locator: 'result',
      pageSize: 5,
      classPrefix: 'page-item',
      ulClassName: 'pagination blog-pagination justify-content-center d-flex',
      callback: function(data, pagination) {
          let html = template(data);
          $('#content-berita').html(html);
      }
  })

  $('.kategori-berita').each(function(){
    // console.log($(this).attr('data'))
    $(this).on('click', function(){
      searchBerita($(this).attr('data'));
      $('#hapus-kategori').removeClass('d-none');
    })
  })

  $('#hapus-kategori').on('click', function(){
    searchBerita($(this).attr('data'));
    $(this).addClass('d-none');
  })

  var observer = new MutationObserver(function(mutations) {
	// For the sake of...observation...let's output the mutation to console to see how this all works
    $('#cari-berita').on('input', function(e){
      e.preventDefault();
      // console.log($('article'))
      let filter = $(this).val().toLowerCase();
      searchBerita(filter);
    });
  });

  // Notify me of everything!
  var observerConfig = {
  	attributes: true,
  	childList: true,
  	characterData: true
  };

  // Node, config
  // In this case we'll listen to all changes to body and child nodes
  var targetNode = $('#content-berita')[0];
  observer.observe(targetNode, observerConfig);

});
