function newCharacter () 
{
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/insertcharacter.inc.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            // Response
            console.log(this.responseText);
        }
    };
    xhr.send();
    location.reload();
}