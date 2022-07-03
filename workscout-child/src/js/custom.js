(function ($) {

  function init() {
    $('#search-job, #search-location').on('keydown', function(event) {
      if(event.which == 13) {
        var jobs = $('#search-job').val().trim();
        var location = $('#search-location').val().trim();
        window.location.replace(fc.site_url+'/browse-jobs/'+'?search_keywords='+jobs+'&search_location='+location);
      }

    });
  }


  $(document).ready(init);

  }(jQuery));
