jQuery(document).ready(function() {

  jQuery('.sm-gallery-item img').click(function() {
    var link = $(this).attr('src');
    console.log(link);
    jQuery(".images-cont").html("<a href='" + link + "' data-rel='lightbox'> <img src='" + link + "'> </a>")
  });

});//ready