// $(document).ready(function(){
//     $('.btn_AddFriend').click(function(e){
//         e.preventDefault();
//         var $form = $(this).closest('form');
//         var $userIdOfFriend = $form.find('.userNameIdOfFriends').val();
//         $.ajax({
//             url: 'addFriend.php',
//             type: 'post',
//             datatype: 'html',
//             data:{
//                 friendId: $userIdOfFriend,
//             }
//         })
//     })
// });