function saveSettings()
{
    name = $("#name").val();
    surname = $("#surname").val();
    dob = $("#dob").val();
    email = $("#email").val();
    password = $("#password").val();
    password_confirmation = $("#password_confirmation").val();
    
    if (password == password_confirmation)
    {
        $.ajax({
            url: "tools/save_settings.php",
            type: "POST",
            data: "name=" + name + "&surname=" + surname + "&dob=" + dob + "&email=" + email + "&password=" + password,
            success: function (value) {
                location.reload();
            }
 
        });
    }        
    else
    {
        $("#password").addClass("invalid-password");
        $("#password_confirmation").addClass("invalid-password");
    }
}

function getXML()
{
    window.location = "tools/get_xml.php";
}
