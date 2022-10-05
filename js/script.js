if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
  if(screen.width>=768){
    $('.nav-link').mouseover(function(){
        var myAudio = new Audio('audio/logsound.mp3');
        console.log(myAudio);
        myAudio.play();
      });
      $('.dropdown-item').mouseover(function(){
        var myAudio = new Audio('audio/logcatsound.mp3');
        myAudio.play();
      });
  }


