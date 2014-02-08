function signOut()
{
     $.ajax({
        type: "POST",
        url: "tools/signout.php",
        success: function () {
            location.reload();
        }
    });
}
