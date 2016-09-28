+function ($) {
  $('#favoriteModal').on('hidden.bs.modal', function() {
      $(this).removeData('bs.modal');
  })
}(jQuery);
