// General
// var timerInterval;
//var trackNameSpan = $(".player_song_name");
//var minutesLabel = $(".player_timer_minutes");
//var secondsLabel = $(".player_timer_seconds");
//var minutesEndLabel = $(".player_timer_end_minutes");
//var secondsEndLabel = $(".player_timer_end_seconds");
// var totalSeconds = -1;
// var timerActive = false;
// var timerPaused = false;

var currentTrack = 0;
var isPlaying = false;

// Pre loader
$(window).load(function() {
    $('#status').fadeOut();
    $('#preloader').delay(10).fadeOut('slow');
    $('body').delay(10).css({'overflow-y':'auto'});
});

$(document).ready(function(){
	
  // Newsletter
  ajaxMailChimpForm($("#subscribe-form"), $("#subscribe-result"));
  ajaxMailChimpForm($("#subscribe-form-2"), $("#subscribe--result"));

  // Infinite Scroll
  var ias = jQuery.ias({
    container:  '#posts',
    item:       '.post',
    pagination: '#pagination',
    next:       '.prev-post'
  });

  ias.extension(new IASSpinnerExtension({
    src: 'https://lamixtape.fr/wp-content/themes/lamixtape/img/loading-playlists.png',
  }));

window.allowLoadMore = true;
// Menu Toggle
  $("#toggle").click(function() {
        var $this = $(this);
        var $page = $('#page');
        var $menu = $('#menu');
        if($this.hasClass('open_info')){
            $this.removeClass('open_info on');
            $menu.slideUp();
            $page.slideDown();
            window.allowLoadMore = true;
        }else{
            $this.addClass('open_info on');
            $menu.slideDown();
            $page.slideDown();
            window.allowLoadMore = false;
        }


    //$("#menu").slideToggle();
  });

    $('.site__logo').on('click', function () {
        if(!window.allowLoadMore){
            $("#toggle").trigger('click');
        }
    });

// Search
  $("#toggle-search").click(function() {
    $(this).toggleClass("on");
    $("#search").slideToggle();
  });
  $('form:first *:input[type!=hidden]:first').focus();

// Display contact form
  $("#contact").click(function() {
    $(this).toggleClass("on");
    $("#chat").slideToggle();
  });

// Hide contact form
  $("#close").click(function() {
    $(this).toggleClass("on");
    $("#chat").slideToggle();
  });

// Dismiss 'message sent' confirmation message
  $('#dismiss').click(function(){
    $(".success").hide();
    $(".detail").hide();
    $(".sent").hide();
  });
 
// Subscription Form
// Submit the form with an ajax/jsonp request.
// Based on http://stackoverflow.com/a/15120409/215821
function submitSubscribeForm($form, $resultElement) {
    $.ajax({
        type: "GET",
        url: $form.attr("action"),
        data: $form.serialize(),
        cache: false,
        dataType: "jsonp",
        jsonp: "c", // trigger MailChimp to return a JSONP response
        contentType: "application/json; charset=utf-8",

        error: function(error){
            // According to jquery docs, this is never called for cross-domain JSONP requests
        },

        success: function(data){
            if (data.result != "success") {
                var message = data.msg || "Sorry. Unable to subscribe. Please try again later.";
                $resultElement.css("color", "white");

                if (data.msg && data.msg.indexOf("already subscribed") >= 0) {
                    message = "You're already subscribed. Thank you.";
                    $resultElement.css("color", "white");
                }

                $resultElement.html(message);

            } else {
                $resultElement.css("color", "white");
                $resultElement.html("Thanks for subscribing!&nbsp;✌🏼");
            }
        }
    });
}

function ajaxMailChimpForm($form, $resultElement){

    // Hijack the submission. We'll submit the form manually.
    $form.submit(function(e) {
        e.preventDefault();

        if (!isValidEmail($form)) {
            var error =  "A valid email address must be provided.";
            $resultElement.html(error);
            $resultElement.css("color", "white");
        } else {
            $resultElement.css("color", "white");
            $resultElement.html("Subscribing...");
            submitSubscribeForm($form, $resultElement);
        }
    });
}

// Validate the email address in the form
function isValidEmail($form) {
    // If email is empty, show error message.
    // contains just one @
    var email = $form.find("input[type='email']").val();
    if (!email || !email.length) {
        return false;
    } else if (email.indexOf("@") == -1) {
        return false;
    }

    return true;
}

//============================Player , Ajax loading & Emojis==========================================



// AJAX
var initSpa = function(){
        var isBusy = false;
        var nothingToLoad = false;

        $.ajaxSetup({ cache: false });


        var loadingNow = function(show,duration){
            duration = duration || 100;
            if(show){
                $('#loader').fadeIn(duration);
            }else{
                isBusy = false;
                $('#loader').fadeOut(duration);
            }
        };

        $('body').on('click','a.ajax-link',function(e){
            e.preventDefault();
            var $this = $(this);
            if($this.attr('href') === ''){
                return false;
            }

            if(isBusy){
                return false;
            }

            var title = document.title;
            var url = $this.attr('href');
            var googleanalyticsurl = url;
            // Added for ajax track of google analytics for load more, starts
            ga('set', { page: googleanalyticsurl});
            ga('set', { title: $this.data("title")});
            ga('send', 'pageview');
            // Added for ajax track of google analytics for load more, ends
            History.pushState({date:((new Date())*1),"url":url,"title":title},title,url);

        }).on('submit','form.ajax-form',function(e){
            e.preventDefault();
            var $this = $(this);
            var method = $this.attr('method') || 'get';
            var url = $this.attr('action') || document.location.pathname;

            if(isBusy){
                return false;
            }

            if(method.toLowerCase() == 'get'){
                url += ((url.indexOf('?')==-1)?'?':'&') + $this.serialize();
                var title = document.title;
                History.pushState({date:((new Date())*1),"url":url,"title":title},title,url);
            }else{
                loadingNow(true);
                $.post(url,$this.serialize(),function(res){
                    loadingNow(false,50);
                    if(res.staus = 'ok'){
                        $("#chat").slideToggle();
                        $this.find('input,textarea').each(function(){
                            $t = $(this);
                            var type = $t.attr('type') || '';

                            if( type.toLowerCase() == 'submit' ||
                                type.toLowerCase() == 'button'){
                                return;
                            }
                            $t.val('');
                        });
                    }

                },'json').fail(function(){
                    loadingNow(false,50);
                });
            }

        });



        History.Adapter.bind(window,'statechange',function(){
            var state = History.getState();
            var url = state.url;
            loadingNow(true);

            isBusy = true;

            $.get(url,function(res){
                var $page = $('#page');
                $page.css('display','none');
                $page.empty().html(res);
                resetEmojis();
                $page.css('display','block');
                loadingNow(false,50);

                $page.ScrollTo({
                    offsetTop : 700,
                    duration: 300,
                    callback:function(){
                        nothingToLoad = false;
                        resetPlayer();

                    }
                });


            },'html').fail(function(res) {
                loadingNow(false,50);
            });

        });


        var loadMore = function(){
            var $loadMore = $('.load-more:first');
            if($loadMore.size()==0){
                return;
            }
            var page = $loadMore.data('page') || 1;
            var url = $loadMore.data('url') || document.location.pathname;
            var appendTo = $loadMore.data('append-to') || ':first';

            isBusy = true;
            loadingNow(true);

            var googleanalyticsurl = url+"?page="+(page+1)+"&load_more=1";
            // Vikram: Added for ajax track of google analytics for load more, starts
            ga('set', { page: googleanalyticsurl});
            ga('send', 'pageview');
            // Vikram: Added for ajax track of google analytics for load more, ends
            $.get(url,{page:(page+1),load_more:1}, function (res) {
                if($.trim(res) == ''){
                    nothingToLoad = true;
                }
                $loadMore.find(appendTo).append(res);
                $loadMore.data('page',(page+1));
                loadingNow(false,50);
            },'html').fail(function(){
                loadingNow(false,50);
            });

        };

        $(window).scroll(function()
        {
            if(window.allowLoadMore && ($(window).scrollTop() >= ($(document).height() - $(window).height() - 700)) && !isBusy && !nothingToLoad)
            {

                loadMore();

            }
        });




    };

var resetEmojis = function(){
      $('.emoji').each(function(){
          var $this = $(this);


          var $this = $(this);
          var icons = $this.html();
          icons = $.trim(icons).split(' ');
          $this.empty();
          for(var i=0;i<icons.length;++i){
              var icon = icons[i];
              var parsed = twemoji.parse(icon,{
                  className : 'em-icon',
                  folder: 'svg',
                  ext : '.svg'
              });

              if(icon == parsed){
                  parsed = '<span class="em-icon" alt="'+icon+'" >'+icon+'</span>';
              }

              $this.append(parsed);
          }

      });
  };

/*
var resetPlayer = function(){
    if(window.$tracklist){
        window.$tracklist.off('click');
    }
    window.$tracklist = $('.tracklist');
    if(typeof window.lmPlayer == 'undefined'){
        return;
    }

    var plItems = [];

    window.$tracklist.find('a').each(function (k,e) {
        var uId = window.lmPlayer.uniqueIdGenHelper(k);
        $(this).attr('id',uId);
        plItems.push(
            {
                "url" : ($(this).data('url')),
                "DOMId" : uId
            }
        )
    });


    window.lmPlayer.setPlaylistElements(plItems);

    window.$tracklist.find('a').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        if(e.which != 1){
            return false;
        }

        if(window.lmPlayer.playerStatus() == LMPlayer.Status.PLAYING &&
            window.lmPlayer.currentTrack().DOMId == this.id){
            window.lmPlayer.pause();
            timerPaused = true;
        }else{
            window.lmPlayer.play(this.id);
            timerPaused = false;
            startTrackTimer();
        }
    });
};

function setTime() {
    ++totalSeconds;
    $(".player_timer_seconds").html(pad(totalSeconds%60));
    $(".player_timer_minutes").html(pad(parseInt(totalSeconds/60)));
}

function startTrackTimer() {
  if(!timerActive) {
      timerActive = true;
    timerInterval = setInterval(setTime, 1000);
  }
}

function stopTrackTimer() {
  clearInterval(timerInterval);
  timerActive = false;

  if(!timerPaused) {
    $(".player_timer_minutes").html("00");
    $(".player_timer_seconds").html("00");
    totalSeconds = 0;
    timerPaused = true;
  }
}

function updateTrackTimer(percent) {
  var currentTrack = lmPlayer.currentTrack();
  var currentTrackDuration = currentTrack.duration.toString();
  var currentTrackDuration = currentTrackDuration.substring(0, 7).split('.').join('');

  var newDuration = ((currentTrackDuration / 100) * percent) / 1000
  totalSeconds = Math.round(newDuration);
}

function updateTrackInfo() {
  // Check if timer is working
  if(!timerActive) {
    startTrackTimer();
  }

  var currentTrack = lmPlayer.currentTrack();
  var currentTrackName = $("#" + currentTrack.DOMId).find('span').html();
  $(".player_song_name").html(currentTrackName);

  setTimeout(function(){
    var currentTrackDuration = currentTrack.duration.toString();
    var currentTrackDuration = currentTrackDuration.substring(0, 7).split('.').join('');
    $(".player_timer_end_seconds").html(pad(Math.round((currentTrackDuration / 1000)%60)));
    $(".player_timer_end_minutes").html(pad(parseInt((currentTrackDuration / 1000)/60)));
    $('.player_btn_tweet').attr('href', "https://twitter.com/intent/tweet?text=" + currentTrackName + "on @lamixtape " + window.location.href);
    $('.player_btn_like').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.href);
        $('.player_btn_download').attr('href', "https://itunes.apple.com/search?term=" + currentTrackName.replace(/\s+/g, "+") + "&media=music");
    $('.player_btn_info').attr('href', "https://www.discogs.com/search/?q=" + currentTrackName.replace(/\s+/g, "+") + "&type=all");
  }, 1000);
}

function pad(val) {
    var valString = val + "";
    if(valString.length < 2)
    {
        return "0" + valString;
    }

    else {
        return valString;
    }
}
*/

var initPlayers = function () {

/*
    window.lmPlayerWidget = function () {
        var inited = false;
        var init = function (lmPlayer) {
            if(inited){return}
            inited = true;
            $('body').on('click','.musicPlayer button', function (e) {
                var $this = $(this);
                if($this.hasClass('player_btn_play_pause')){
                    if(lmPlayer.playerStatus() == LMPlayer.Status.PLAYING){
                        $('.musicPlayer:first').removeClass('player_playing');
                        timerPaused = true;
                        lmPlayer.pause();
                    } else{
                        $('.musicPlayer:first').addClass('player_playing');
                        if(lmPlayer.playerStatus() == LMPlayer.Status.WAITING){
                            lmPlayer.play(0);
                        }else{
              startTrackTimer();
                            lmPlayer.play();
                        }
                    }
                }else if($this.hasClass('player_btn_forward')){
                  timerPaused = false;
                  stopTrackTimer();
                    updateProgressBar(0);
                    lmPlayer.playNext(true);
                }else if($this.hasClass('player_btn_backward')){
                  timerPaused = false;
                  stopTrackTimer();
                    updateProgressBar(0);
                    lmPlayer.playPrev(true);
                }
            }).on('click','.musicPlayer .player_progress_bar', function (e) {
                var $this = $(this);
                var posX = $this.offset().left;
                var headPosition = ( (e.pageX - posX) / $this.width() ) * 100;
              updateTrackTimer(headPosition);
                $this.find('.player_progress_bar_head:first').css('width',headPosition +'%');
                lmPlayer.seekTo(headPosition);
            });

            $(lmPlayer).on(LMPlayer.Events.Progress, function (e,d) {
              startTrackTimer();
                updateProgressBar(d.progress);
            }).on(LMPlayer.Events.Playing, function (e, d) {
              updateTrackInfo();
                $('.musicPlayer:first').addClass('player_playing');
            }).on(LMPlayer.Events.Paused, function (e, d) {
        stopTrackTimer();
                $('.musicPlayer:first').removeClass('player_playing');
            }).on(LMPlayer.Events.Ended, function (e, d) {
              timerPaused = false;
              stopTrackTimer();
                $('.musicPlayer:first').removeClass('player_playing');
                updateProgressBar(0);
            }).on(LMPlayer.Events.Loading, function (e, d) {
                updateProgressBar(0);
            }).on(LMPlayer.Events.Error, function (e, d) {
                updateProgressBar(0);
            }).on(LMPlayer.Events.Broken, function (e, d) {
                $('.musicPlayer:first').removeClass('player_playing');
                updateProgressBar(0);
                //lmPlayer.playNext();
            }).on(LMPlayer.Events.Reset, function (e, d) {
                $('.musicPlayer:first').removeClass('player_playing');
                updateProgressBar(0);
            });
        };
        var updateProgressBar = function (val) {
            val = val || 0;
            val = (val*1).toFixed(6);
            $('.musicPlayer .player_progress_bar_head:first').css('width', val + '%');
        };



        return {
            init : init,
            updateProgressBar : updateProgressBar
        }
    }();


    var brokenTrack = function(DOMId){
        var $elem = $('#' + DOMId);

        if($elem.size()>0) {
            if($elem.hasClass('broken-track')){return;}
            $elem.addClass('broken-track show-broken-track-msg');
            $elem.append('<span class="broken-track-msg" >Morceau non disponible</span>');

            setTimeout(function(){
                $elem.removeClass('show-broken-track-msg');
            },300);
        }
    };
*/

/*
    window.lmPlayer = new LMPlayer({},false);
    window.lmPlayer.init();
    window.lmPlayerWidget.init(window.lmPlayer);

    $(window.lmPlayer).on(LMPlayer.Events.Ended,function(e,d){
        window.$tracklist.find('a#'+ d.track.DOMId).removeClass('playing_now current_track');
        window.lmPlayer.playNext();
    }).on(LMPlayer.Events.Loading,function(e,d){
        window.$tracklist.find('a').removeClass('playing_now current_track loading_track');
        window.$tracklist.find('a#'+ d.loadingTrack.DOMId).addClass('current_track loading_track');
    }).on(LMPlayer.Events.Playing,function(e,d){
        window.$tracklist.find('a').removeClass('playing_now current_track loading_track');
        window.$tracklist.find('a#'+ d.track.DOMId).addClass('playing_now current_track');
    }).on(LMPlayer.Events.Paused,function(e,d){
        window.$tracklist.find('a.playing_now#'+d.track.DOMId).removeClass('playing_now');
    }).on(LMPlayer.Events.Broken,function(e,d){
        window.$tracklist.find('a').removeClass('playing_now loading_track');
        window.$tracklist.find('a#'+d.track.DOMId).addClass('broken_track');
        brokenTrack(d.track.DOMId);
        window.lmPlayer.playNext();
    }).on(LMPlayer.Events.Next,function(e,d){
        if(d.nextTrack.broken){
            window.lmPlayer.playNext();
        }
    }).on(LMPlayer.Events.Prev,function(e,d){
        if(d.prevTrack.broken){
            window.lmPlayer.playPrev();
            startTrackTimer();
        }
    });

    resetPlayer();
*/
};
/*

  initSpa();
  initPlayers();
  resetEmojis();
*/
});

function createCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

if(readCookie('closed') == 'yes')
{

}
else
{
    $('#MobileFail').show();
}

$('#closeit').click(function () {
    createCookie('closed','yes',30)
})

if(readCookie('alertclosed') == 'yes'){

}
else
{
    $('#alert').show();
}

$('#close').click(function () {
    createCookie('alertclosed','yes',30)
})

$(document).on("click", ".articlepost" , function() {
    createCookie('count',$(this).data('count'),30);
});

// MediaElement Player
var clientID = '95f22ed54a5c297b1c41f72d713623ef';
var trackID = 0;
var requestURL = '';

// Set source of player when SoundCloud request is finished
$( document ).ajaxComplete(function( event, xhr, settings ) {
  if ( settings.url === requestURL) {
    var url = 'https://api.soundcloud.com/tracks/' + trackID + '/stream?client_id=' + clientID;
    setPlayerSource(url);
  }
});

$('a.track-url').on('click',function(e){
  e.preventDefault();
  
  isPlaying = false;
  
  // Set selected li index as currentTrack
  currentTrack = $(this).parent('li').index() + 1;
  
  // Remove all active states and add active state to selected track
  $('a.track-url').removeClass("current_track");
  $(this).addClass('current_track');
  
  // Set track name and discogs url
  var trackName = $(this).find('span').html();
  $('.track-player-name').html(trackName);
  $('.player_btn_info').attr('href', "https://www.discogs.com/search/?q=" + trackName.replace(/\s+/g, "+") + "&type=all");

  // Get source of selected track
  var url = $(this).attr('href');
  getTrackSource(url);
});

$('body').on('click', '.mejs__play', function() {	
	// If play button is clicked and no track has been played/selected yet, the first element in the list will be played and selected.
	if(currentTrack == 0) {
		currentTrack = 1;
		var firstTrackURL = $('#first-track').attr('href'); 
		$('#first-track').addClass('current_track');
		$('.track-player-name').html($('#first-track').find('.track-name').html());
		getTrackSource(firstTrackURL);
	}
});

$('body').on('click', '.track-forward', function() {
	isPlaying = false;
	playNextSong();
});

$('body').on('click', '.track-backward', function() {
	isPlaying = false;
	playPreviousSong();
});

function getTrackSource(url) {
  // Check if YouTube or SoundCloud
  if(url.indexOf('soundcloud') != -1) {
    retrieveSCTrackID(url); // Retrieve SoundCloud Track ID by URL
  } else {
    // Set Source if YouTube URL
    setPlayerSource(url);
  }
}


function setPlayerSource(url) {
  var player = mejs.players['mep_0'];
  player.setSrc(url);
  player.load();
  if (!mejs.Features.isiOS && !mejs.Features.isAndroid) {
    player.play();
  }
  
  // Prevent stuck on broken link
  setTimeout(function() { //alert(isPlaying);
	  }, 2500);
}

function retrieveSCTrackID(url) {
  var encodedURL = encodeURIComponent(url);
  requestURL = 'https://api.soundcloud.com/resolve.json?url=' + encodedURL + '&client_id=' + clientID;

  $.get(requestURL, function( data ) {
    if(data) {
      return trackID = data.id;
    }
  });
}

function getQueryStringValue (key) {
  return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}

function playNextSong() {
	if(currentTrack == $('.tracklist li').length) {
		// Play first song again and remove active state from last child
		currentTrack = 1;
		$('.tracklist li:last-child').find('a').removeClass('current_track');
	} else {
		currentTrack++;
	}
	
	var element = $( ".tracklist li:nth-child(" + currentTrack + ")");
	var elementTrackURL = element.find('a').attr('href'); 
	element.prev().find('a').removeClass('current_track');
	element.find('a').addClass('current_track');
	$('.track-player-name').html(element.find('.track-name').html());
	getTrackSource(elementTrackURL);
}

function playPreviousSong() {
	if(currentTrack == 1) {
		// Play first song again and remove active state from last child
		currentTrack = $('.tracklist li').length;
		$('.tracklist li:first-child').find('a').removeClass('current_track');
	} else {
		currentTrack--;
	}
	
	var element = $( ".tracklist li:nth-child(" + currentTrack + ")");
	var elementTrackURL = element.find('a').attr('href'); 
	element.next().find('a').removeClass('current_track');
	element.find('a').addClass('current_track');
	$('.track-player-name').html(element.find('.track-name').html());
	getTrackSource(elementTrackURL);
}

  // These media types cannot play at all on iOS, so disabling them
  if (mejs.Features.isiOS) {
    sourcesSelector[i].querySelector('option[value^="rtmp"]').disabled = true;
    if (sourcesSelector[i].querySelector('option[value$="webm"]')) {
      sourcesSelector[i].querySelector('option[value$="webm"]').disabled = true;
    }
    if (sourcesSelector[i].querySelector('option[value$=".mpd"]')) {
      sourcesSelector[i].querySelector('option[value$=".mpd"]').disabled = true;
    }
    if (sourcesSelector[i].querySelector('option[value$=".ogg"]')) {
      sourcesSelector[i].querySelector('option[value$=".ogg"]').disabled = true;
    }
    if (sourcesSelector[i].querySelector('option[value$=".flv"]')) {
      sourcesSelector[i].querySelector('option[value*=".flv"]').disabled = true;
    }
  }

document.addEventListener('DOMContentLoaded', function () {
  	mejs.i18n.language('en');

    $('audio').mediaelementplayer({
      stretching: 'auto',
      success: function (player, media) {
	      // MediaElement FB/FF		  
		  $('.mejs__playpause-button').prepend("<span class='fas fa-backward track-backward'></span>");
		  $('.mejs__playpause-button').append("<span class='fas fa-forward track-forward'></span>");

	    player.addEventListener('ended', function(e){
		    isPlaying = false;
			playNextSong();
	    });
	    
	    player.addEventListener('playing', function(e){
		    isPlaying = true;
	    });
	    
	    player.addEventListener('error', function(e){
		    playNextSong();
	    });
      },
    });
    
    // BS classes player
    $('.mejs__time-rail').addClass('col-md-8');
    $('.mejs__play>button').addClass('fas');
});