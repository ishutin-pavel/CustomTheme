<?php wp_footer(); ?>
<div class="container-fluid textedfooter">
		<div class="row textextex">
				<div class="col-lg-12 wtf">
						<ul>
								<li>Информация, предоставленная на сайте не является публичной офертой</li>
								<li>© ЗГПО "АТЛАНТ" 2012-2018</li>
						</ul>
				</div>
		</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="/wp-content/themes/CustomTheme/js/majs.js"></script>

<!-- Gallery from old site -->
<div id="picvwrap" style="display:none;">
	<div id="picvshade"></div>
	<img id="picv" src="/img/logo.png" alt="Завод кранов Атлант">
	<div id="piccontrprev" class="piccontr" onclick="prevpic();">&lt;</div>
	<div class="piccontr" onclick="closepic();">X</div>
	<div id="piccontrnext" class="piccontr" onclick="nextpic();">&gt;</div>
</div>

<script>
	var curprom=1;
	var promoauto=true;
	var curpic;
	function listpromo(i) {
		document.getElementById('promo'+curprom).className="promo promo-hide";
		curprom+=i;
		if (curprom>4) {curprom=1;}
		if (curprom<1) {curprom=4;}
		document.getElementById('promo'+curprom).className="promo promo-show";
		if (promoauto) {setTimeout(promoautolist,7000);}
	}

	function promoautolist() {if (promoauto) {listpromo(1);}}
	

	function showpic(id) {
		curpic=id;
		var pic1=id.getAttribute('src');
		if (pic1==null) {
			pic1=id.style.background;
			pic1=pic1.replace('url("','');
			pic1=pic1.replace('")','');
		}
		picvwrap.style.display="flex";
		var pic2=pic1.replace('small','big');
		picv.src=pic2;
		document.body.style.cssText="overflow-y:hidden";

		var prId=curpic.previousElementSibling;
		var neId=curpic.nextElementSibling;
		if (prId==null) {piccontrprev.style.display='none';}
		else {
			pic1=prId.getAttribute('src');
			if (pic1==null) {
				piccontrprev.style.display='none';
				pic1=prId.style.background;
				if (pic1!=null && pic1!='') {piccontrprev.style.display='block';}
			}
			else {piccontrprev.style.display='block';}
		}
		if (neId==null) {piccontrnext.style.display='none';}
		else {
			pic1=neId.getAttribute('src');
			if (pic1==null) {
				piccontrnext.style.display='none';
				pic1=neId.style.background;
				if (pic1!=null && pic1!='') {piccontrnext.style.display='block';}
			}
			else {piccontrnext.style.display='block';}
		}
	}


	window.addEventListener('keydown', handler, false);

	function handler(event) {if (event.keyCode==27) {closepic();}}

	function closepic() {picvwrap.style.display="none";document.body.style.cssText="overflow-y:scroll";}
	function nextpic() {if (curpic.nextElementSibling!=null) {showpic(curpic.nextElementSibling);}}
	function prevpic() {if (curpic.previousElementSibling!=null) {showpic(curpic.previousElementSibling);}}

	function ppicSwith(id) {
		if (id.className=='ppicsel' || id.className=='textPic textPicB') {showpic(id); return;}
		var arr=document.getElementsByClassName('ppicsel');
		arr[0].className="";
		id.className="ppicsel";
	}
</script>

<script src="/wp-content/themes/CustomTheme/js/copyright.min.js"></script>

<script>
$(document).ready(function(){
	$('.tab-content').copyright();
	$('.seo-current-cut-text').copyright();
	$('.page-container p').copyright();
});
</script>

<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter16379320 = new Ya.Metrika({ id:16379320, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/16379320" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<!-- Top100 (Kraken) Counter -->
<script>
		(function (w, d, c) {
		(w[c] = w[c] || []).push(function() {
				var options = {
						project: 4514865,
				};
				try {
						w.top100Counter = new top100(options);
				} catch(e) { }
		});
		var n = d.getElementsByTagName("script")[0],
		s = d.createElement("script"),
		f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src =
		(d.location.protocol == "https:" ? "https:" : "http:") +
		"//st.top100.ru/top100/top100.js";

		if (w.opera == "[object Opera]") {
		d.addEventListener("DOMContentLoaded", f, false);
} else { f(); }
})(window, document, "_top100q");
</script>
<noscript>
	<img src="//counter.rambler.ru/top100.cnt?pid=4514865" alt="Топ-100" />
</noscript>
<!-- END Top100 (Kraken) Counter -->

<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "2943199", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
	if (d.getElementById(id)) return;
	var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
	ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
	var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
	if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="//top-fwz1.mail.ru/counter?id=2943199;js=na" style="border:0;position:absolute;left:-9999px;" alt="" />
</div></noscript>
<!-- //Rating@Mail.ru counter -->
<script>
(function(w, d, s, h, id) {
    w.roistatProjectId = id; w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
    var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
})(window, document, 'script', 'cloud.roistat.com', '6caeb59f9e1d3055f8200f2beeacc465');
</script>
</body>
</html>