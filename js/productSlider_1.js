window.onload = function() {
    window.toggleControl = {}

    var toggler = window.toggleControl;
    toggler.currentGryz = document.getElementsByClassName('active_gryz')[0].dataset.toggler;
    toggler.currentProlet = document.getElementsByClassName('active_prolet')[0].dataset.toggler;

//get params

  function doItNow(subject, callback) {

    var params = window
    .location
    .search
    .replace('?','')
    .split('&')
    .reduce(
        function(p,e){
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );
    console.log(params['id']);
    if(params['id'] != undefined){
        var gryzi = $('.gryz_id');
        var proleti = $('.prolet_id');

        console.log(gryzi);
        console.log(proleti);

        var ids = params['id'].split('|');
        console.log(ids);

        var act_gryz = gryzi[ids[0]-1];
        var act_prolet = proleti[ids[1]-1];

        console.log(act_gryz);
        console.log(act_prolet);
        $(act_gryz).addClass("activate_it");
        $(act_prolet).addClass("activate_it");
    var activated;
    $.each( gryzi, function( key, value ) {
        if($(value).data("toggler") == params['id']){
            activated = value;
            $(value).addClass("activate_it");
        }
      });
      console.log(activated);
        callback();
      }

    }
    doItNow('math', function() {
        console.log('asd');
        setTimeout(function(){$('.activate_it').click();}, 200)

      });

  //do_it();
//get params


console.log(toggler);

$('.gryz_id').click(function(){
    toggler.currentGryz = $(this).data("toggler");
    $('.gryz_id').removeClass('active_gryz');
    $(this).addClass('active_gryz');
    checkActive();
});

$('.prolet_id').click(function(){
    toggler.currentProlet = $(this).data("toggler");
    $('.prolet_id').removeClass('active_prolet');
    $(this).addClass('active_prolet');
    checkActive();
});

/* Bolgariya Hack */

$('.gryz_id_e').click(function(){

    toggler.currentGryz = $(this).data("toggler");
    $('.polispast ul').css("display", "none");
    $('.gryz_id_e').removeClass('active_gryz');
    $(this).addClass('active_gryz');
    let param = 'ul.' + toggler.currentGryz;
    $(param).css("display", "flex");

    let child_ul = $(param);
    child_ul = child_ul.find('li');
    child_ul = $(child_ul[0]);
    toggler.currentProlet = child_ul.data("toggler");
    $('.prolet_id_e').removeClass('active_prolet');
    child_ul.addClass('active_prolet');

    //console.log(child_ul.data("toggler"));
    console.log(toggler);
    checkActive_bolg();
});
$('.prolet_id_e').click(function(){
    toggler.currentProlet = $(this).data("toggler");
    $('.prolet_id_e').removeClass('active_prolet');
    $(this).addClass('active_prolet');

    console.log(toggler);
    checkActive_bolg();
});

function checkActive_bolg(){
    $('.articul span').css("display", "none");
    $('.price span').css("display", "none");
    $('.images-cont a').css("display","none");
    $('.opisaniya div').css("display","none");
    $('.gabariti_var .item').css("display","none");
    $('.dop_opcii .item').css("display","none");
    $('.opisaniya div#description').css("display","block");

    let str = '.' + toggler.currentGryz + toggler.currentProlet;
    console.log(str);
    $(str).css("display", "inline");
}
/* ./Bolgariya Hack */

function checkActive(){
    $('.articul span').css("display", "none");
    $('.price span').css("display", "none");
    $('.images-cont a').css("display","none");
    $('.opisaniya div').css("display","none");
    $('.gabariti_var .item').css("display","none");
    $('.dop_opcii .item').css("display","none");
    $('.opisaniya div#description').css("display","block");

    let str = '.' + toggler.currentGryz + 'x' + toggler.currentProlet;
    console.log(str);
    $(str).css("display", "inline");
}
//  checkActive();

  $('.sm-gallery-item').click(function() {
      let url = $(this).find('img').attr("src");
      let currentThumb = 'a.' + toggler.currentGryz + 'x' + toggler.currentProlet;
      let subject = $(currentThumb).find('img');
      subject.attr('src', url);
  });

};//onload

