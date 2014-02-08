function editName(button)
{
    $(".name h3").hide();
    
    button.disabled = true;
    
    $(".name").append("<input type='text' value='" + $.trim($(".name h3").html()) + "'><button type='button' class='ok_button' onclick='saveName();'>Okay</button>");
}

function saveName()
{
    $.ajax({
        url: "tools/save_profile_info.php",
        type: "POST",
        data: "key=name&value=" + $(".name input").val(),
        success: function (m) {
            location.reload();
        }
    });
}

function editSurname(button)
{
    $(".surname h3").hide();
    
    button.disabled = true;
    
    $(".surname").append("<input type='text' value='" + $.trim($(".surname h3").html()) + "'><button type='button' class='ok_button' onclick='saveSurname();'>Okay</button>");
}

function saveSurname()
{
    $.ajax({
        url: "tools/save_profile_info.php",
        type: "POST",
        data: "key=surname&value=" + $(".surname input").val(),
        success: function () {
            location.reload();
        }
    });
}

function editEmail(button)
{
    $(".email h3").hide();
    
    button.disabled = true;
    
    $(".email").append("<input type='text' value='" + $.trim($(".email h3").html()) + "'><button type='button' class='ok_button' onclick='saveEmail();'>Okay</button>");
}

function saveEmail()
{
    $.ajax({
        url: "tools/save_profile_info.php",
        type: "POST",
        data: "key=email&value=" + $(".email input").val(),
        success: function (value) {
            location.reload();
        }
    });
}
