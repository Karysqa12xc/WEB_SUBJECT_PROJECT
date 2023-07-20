$(document).ready(function() {
    $(".app__displayPost-like").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest('.app__displayPostForm');
      var $post_id = $form.find('.app__displayPostID').val();
      $.ajax({
        url: 'displayLikeAjax.php',
        type: 'post',
        dataType: 'html',
        data: {
          postID: $post_id
        }
      }).done(function(result) {
        $form.find('.app__displayPost-countLike').html(result);
      });
    });
  });