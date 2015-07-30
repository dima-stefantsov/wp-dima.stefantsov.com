(function($) {
	
	var quote = [
	    'Воздух - в воздухе. Уходя возьми с собой воздух.'
	    ,'А ты представь, что ты эльфик... :)'
	    ,'Зашел я, как-то, в мавзолей с бутылочкой пива очаково....И тут он попер на меня!'
	    ,'Не надо очеловечивать компьютеры, они этого страсть как не любят!..'
	    ,'Люди, которые думают, что они знают всё на свете, раздражают нас, людей, которые действительно всё на свете знают.'
	    ,'We are what we repeatedly do. Excellence is not an act, but a habit.'
	    ,'Глаз за глаз сделает весь мир слепым.'
	    ,'Live as if you were to die tomorrow. Learn as if you were to live forever.'
	    ,'You must be the change you wish to see in the world.'
	    ,'Выберите себе работу по душе, и вам не придётся работать ни одного дня в своей жизни.'
	    ,'Non-cooperation with evil is as much a duty as is cooperation with good.'
	    ,'Keep your subconscious starved.'
	    ,'Если есть понимание - будет и результат.'
	    ,'Fool me once - shame on you. Fool me twice - shame on me.'
	];  

	function changeQuote(){
	    $("h2.site-description").fadeOut("slow", function(){
	        $("h2.site-description").text(quote[Math.floor(Math.random()*quote.length)]);
	        $("h2.site-description").fadeIn("slow");
	    });
	};

	$(document).ready(function() {

		$("h2.site-description").click(changeQuote);

		$(document.links).filter(function() {
	        return this.hostname !== window.location.hostname;
	    }).attr('target', '_blank');
	    $(document.links).filter(function() {
	        return this.hostname === window.location.hostname;
	    }).attr('target', '');

	});
}(jQuery));