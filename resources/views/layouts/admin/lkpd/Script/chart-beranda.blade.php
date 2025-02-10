<script>
    var Script = function () {

//morris chart

$(function () {

  Morris.Bar({
    element: 'hero-bar',
    data: [
      {jenisapbd: 'PAD', nilaiapbd: PadAnggaran, },
      {jenisapbd: 'BELANJA', nilaiapbd: BelanjaAnggaran},
      {jenisapbd: 'PEMBIAYAAN', nilaiapbd: BiayaAnggaran},
    ],
    xkey: 'jenisapbd',
    ykeys: ['nilaiapbd'],
    labels: ['Total'],
    barRatio: 0.4,
    xLabelAngle: 35,
    hideHover: 'auto',
    barColors: ['#a8a8a8']
  });

  Morris.Bar({
    element: 'pad-bar',
    data: [
      {jenisapbd: 'ANGGARAN', nilaiapbd: PadAnggaran, },
      {jenisapbd: 'SELISIH', nilaiapbd: PadSelisih},
      {jenisapbd: 'PERUBAHAN', nilaiapbd: PadPerubahan},
    ],
    xkey: 'jenisapbd',
    ykeys: ['nilaiapbd'],
    labels: ['Total'],
    barRatio: 0.4,
    xLabelAngle: 35,
    hideHover: 'auto',
    barColors: ['#2a74c2']
  });

  Morris.Bar({
    element: 'belanja-bar',
    data: [
      {jenisapbd: 'ANGGARAN', nilaiapbd: BelanjaAnggaran, },
      {jenisapbd: 'SELISIH', nilaiapbd: BelanjaSelisih},
      {jenisapbd: 'PERUBAHAN', nilaiapbd: BelanjaPerubahan},
    ],
    xkey: 'jenisapbd',
    ykeys: ['nilaiapbd'],
    labels: ['Total'],
    barRatio: 0.4,
    xLabelAngle: 35,
    hideHover: 'auto',
    barColors: ['#e41c1c']
  });

  Morris.Bar({
    element: 'biaya-bar',
    data: [
      {jenisapbd: 'ANGGARAN', nilaiapbd: BiayaAnggaran, },
      {jenisapbd: 'SELISIH', nilaiapbd: BiayaSelisih},
      {jenisapbd: 'PERUBAHAN', nilaiapbd: BiayaPerubahan},
    ],
    xkey: 'jenisapbd',
    ykeys: ['nilaiapbd'],
    labels: ['Total'],
    barRatio: 0.4,
    xLabelAngle: 35,
    hideHover: 'auto',
    barColors: ['#63e4a9']
  });

  $('.code-example').each(function (index, el) {
    eval($(el).text());
  });
});

}();

</script>
