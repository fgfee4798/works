$(function () {
  // 便當區數量
  let r, r2, r3, r4, r5, r6;

  $('#pl').click(function () {
    r = parseInt($('#show').val()) + 1;
    $('#show').val(r);
  });

  $('#mi').click(function () {
    r = parseInt($('#show').val()) - 1;
    if (r < 0) {
      r = 0;
    }
    $('#show').val(r);
  });

  $('#pl2').click(function () {
    r2 = parseInt($('#show2').val()) + 1;
    $('#show2').val(r2);
  });
  $('#mi2').click(function () {
    r2 = parseInt($('#show2').val()) - 1;
    if (r2 < 0) {
      r2 = 0;
    }
    $('#show2').val(r2);
  });

  $('#pl3').click(function () {
    r3 = parseInt($('#show3').val()) + 1;
    $('#show3').val(r3);
  });
  $('#mi3').click(function () {
    r3 = parseInt($('#show3').val()) - 1;
    if (r3 < 0) {
      r3 = 0;
    }
    $('#show3').val(r3);
  });

  $('#pl4').click(function () {
    r4 = parseInt($('#show4').val()) + 1;
    $('#show4').val(r4);
  });
  $('#mi4').click(function () {
    r4 = parseInt($('#show4').val()) - 1;
    if (r4 < 0) {
      r4 = 0;
    }
    $('#show4').val(r4);
  });

  $('#pl5').click(function () {
    r5 = parseInt($('#show5').val()) + 1;
    $('#show5').val(r5);
  });
  $('#mi5').click(function () {
    r5 = parseInt($('#show5').val()) - 1;
    if (r5 < 0) {
      r5 = 0;
    }
    $('#show5').val(r5);
  });

  $('#pl6').click(function () {
    r6 = parseInt($('#show6').val()) + 1;
    $('#show6').val(r6);
  });
  $('#mi6').click(function () {
    r6 = parseInt($('#show6').val()) - 1;
    if (r6 < 0) {
      r6 = 0;
    }
    $('#show6').val(r6);
  });

  // 加購區數量
  let ar, ar2, ar3, ar4;

  $('#adpl').click(function () {
    ar = parseInt($('#adshow').val()) + 1;
    $('#adshow').val(ar);
  });
  $('#admi').click(function () {
    ar = parseInt($('#adshow').val()) - 1;
    if (ar < 0) {
      ar = 0;
    }
    $('#adshow').val(ar);
  });

  $('#adpl2').click(function () {
    ar2 = parseInt($('#adshow2').val()) + 1;
    $('#adshow2').val(ar2);
  });
  $('#admi2').click(function () {
    ar2 = parseInt($('#adshow2').val()) - 1;
    if (ar2 < 0) {
      ar2 = 0;
    }
    $('#adshow2').val(ar2);
  });

  $('#adpl3').click(function () {
    ar3 = parseInt($('#adshow3').val()) + 1;
    $('#adshow3').val(ar3);
  });
  $('#admi3').click(function () {
    ar3 = parseInt($('#adshow3').val()) - 1;
    if (ar3 < 0) {
      ar3 = 0;
    }
    $('#adshow3').val(ar3);
  });

  $('#adpl4').click(function () {
    ar4 = parseInt($('#adshow4').val()) + 1;
    $('#adshow4').val(ar4);
  });
  $('#admi4').click(function () {
    ar4 = parseInt($('#adshow4').val()) - 1;
    if (ar4 < 0) {
      ar4 = 0;
    }
    $('#adshow4').val(ar4);
  });

  // 去除hidden
  if ($('.modal *, .topbtn').hasClass('hidden')) {
    $('.modal *, .topbtn').removeClass('hidden');
  }

  // topbtn
  $('[data-toggle="tooltip"]').tooltip()
  $('.topbtn').hide();
  let a, b, c;
  a = $(window).height();    //瀏覽器視窗高度  
  let group = $('#image1-o');
  $(window).scroll(function () {
    b = $(this).scrollTop();   //頁面滾動的高度  
    c = group.offset().top;    //元素距離文件(document)頂部的高度  
    if (a + b > c) {
      $('.topbtn').fadeIn(200);
    } else {
      $('.topbtn').fadeOut();
    }
  });
  $('.topbtn').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 1000);
  });

  // 購物車商品數量
  $('.circle').hide();

  const vals = [];

  $('.add').click(function () {
    let count = 0;
    $('input[type=text]').each(function (index) {
      vals[index] = parseInt($(this).val());
    })
    vals.forEach(function (e) {
      count += e;
    })
    $('#shop').text(count);
    $('.circle').show();
  })

  $('.modal-title').css('font-weight', '600')
})