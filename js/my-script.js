//$.noConflict();
jQuery(document).ready(function($) {
	//$('.current-menu-item').addClass('active');
	console.log('hi!');
	$('.tabs').tabs();
	$('.tablesorter').tablesorter({sortList: [[0,0],[1,0]] });
	console.log('ho!');

	//Slider
        $('div#slider').cycle({
                fx: 'scrollHorz',
                prev: 'a.slider-prev',
                next: 'a.slider-next',
                //pause: 1,
                timeout: 8000,
                delay: -8000,
                speed: 2000
            });

    // Pause the slider
        $('a.slider-pause').click(
            function() {
                $('div#slider').cycle('pause');
                $('a.slider-pause').addClass('paused');
            }
        );

    // Resume slider when previous is clicked, remove pause
        $('a.slider-prev').click(
            function() {
                $('div#slider').cycle('resume');
                $('a.slider-pause').removeClass('paused');
            }
        );

    // Resume slider when next is clicked, remove pause
        $('a.slider-next').click(
            function() {
                $('div#slider').cycle('resume');
                $('a.slider-pause').removeClass('paused');
            }
        );

});
