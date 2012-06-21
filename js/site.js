$(document).ready( function() {
  $('a').click( function (event) {
    var filename = $(this).attr('href');
    if (filename != "not_nice") {
      if (filename == "STOP") {
        alert("You should consider NOT being a dick.");
      }
      $.post('/play.php', { filename: filename, ask: 'nicely' } );
    } else {
      alert("Your machine's IP address has been logged. \n\n I suggest you at least start looking busy.");
    }
    event.preventDefault();
  });

  $('#say').submit(function() {
    var phrase = $('input:first').val();
    phrase = phrase.replace(/["']{1}/gi,"");
    $.post('/say.php', { phrase: phrase} );
    return false;
  });
  
  $('#youtube').submit(function() {
    var link = $('input.youtubevideo').val();
    $.post('/youtube.php', { link: link} );
    alert("This could take a while...so do not close your window.")
    return false;
  });
});
