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
	    ,'Тот, кто что хочет, то и делает :)'
	    ,'Whether you think you can, or you think you can\'t - you\'re right.'
	    ,'You can\'t build a reputation on what you are going to do.'
	    ,'The only real mistake is the one from which we learn nothing.'
	    ,'Obstacles are those frightful things you see when you take your eyes off your goal.'
	    ,'If I had asked people what they wanted, they would have said a faster horse. - Henry Ford'
	    ,'The man who thinks he can and the man who thinks he can\'t are both right. Which one are you?'
	    ,'Vision without execution is just hallucination.'
	    ,'Thinking is the hardest work there is, which is probably the reason so few engage in it.'
	    ,'When everything seems to be going against you, remember that the airplane takes off against the wind, not with it.'
	    ,'It has been my observation that most people get ahead during the time that others waste.'
	    ,'Nothing is particularly hard if you divide it into small jobs.'
	    ,'If money is your hope for independence, you will never have it. The only real security that a man can have in this world is a reserve of knowledge, experience and ability.'
	    ,'If you say you can or you can\'t you are right either way.'
	    ,'I see no advantage in these new clocks. They run no faster than the ones made 100 years ago.'
	    ,'A business that makes nothing but money is a poor business.'
	    ,'The way to learn to do things is to do things. The way to learn a trade is to work at it. Success teaches how to succeed. Begin with the determination to succeed, and the work is half done already.'
	    ,'You don\'t have to hold a position in order to be a leader.'
	    ,'Genius is seldom recognized for what it is: a great capacity for hard work.'
	    ,'If you tell the truth, you don\'t have to remember anything.'
	    ,'Insanity is doing the same thing, over and over again, but expecting different results.'
	    ,'It is better to be hated for what you are than to be loved for what you are not.'
	    ,'The man who does not read has no advantage over the man who cannot read.'
	    ,'I have not failed. I\'ve just found 10,000 ways that won\'t work.'
	    ,'I\'m not upset that you lied to me, I\'m upset that from now on I can\'t believe you.'
	    ,'If you can\'t explain it to a six year old, you don\'t understand it yourself.'
	    ,'Мы не прекращаем играть когда стареем, мы стареем когда прекращаем играть.'
	    ,'I find television very educating. Every time somebody turns on the set, I go into the other room and read a book.'
	    ,'Life isn\'t about finding yourself. Life is about creating yourself.'
	    ,'Knowing yourself is the beginning of all wisdom.'
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

	});
}(jQuery));