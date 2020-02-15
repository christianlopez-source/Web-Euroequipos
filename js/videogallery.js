// Tab Code for Video's Page video switchout functionality

  // Makes sure the videos still show up if jquery does not work.
  $('.secondary-videos .videos, .main-video').addClass('active-jq');

  $('.secondary-videos .videos').click(function() {
    // Number of video selected to use to target main video with same number
    var number = $(this).attr('class').split(" ")[1].split("-")[1];

    $('.secondary-videos .videos').removeClass('selected-video');
    $(this).addClass('selected-video');

    // This code makes sure that the previously selected video stops playing if the user played it and moved to a new video.
    $('.main-video').each(function() {
      if ($(this).hasClass('show-video')) {
        var video = $(this).find('.video-wrapper iframe').attr("src");
        $(this).find('.video-wrapper iframe').attr("src", "");
        $(this).find('.video-wrapper iframe').attr("src", video);
      }
    });

    // Hides all videos and then displays only the one that was selected.
    $('.main-video').removeClass('show-video');
    $('.main-video-' + number).addClass('show-video');
  })

  // Make sure the main videos show up if its on a mobile device, instead of the video switchout function
  var isMobile = false;
  if ($('.videos').css('float') == 'none') {
    isMobile = true;
    $('.secondary-videos .videos, .main-video').removeClass('active-jq');
  }


