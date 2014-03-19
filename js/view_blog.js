function deleteBlog(element) {
    $.ajax({
        type: "POST",
        url: "tools/delete_blog.php",
        data: {id: $(element).parent().parent().attr("data-id")},
        success: function() {
            window.location = "blog.php";
        }
    });
}
