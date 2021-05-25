const chatMessages = document.querySelector(".chat");

setInterval(() =>
{
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "includes/getchat.inc.php", true);
    xhr.onload = ()=>
    {
        if (xhr.readyState === XMLHttpRequest.DONE) 
        {
            if (xhr.status = 200) 
            {
                let data = xhr.response;
                chatMessages.innerHTML = data;
            }
        }
    }
    xhr.send();
}, 500);

function Roll (_roll, name) 
{
    console.log(_roll);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/sendmessage.inc.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            // Response
            console.log(this.responseText);
        }
    };
    xhr.send(JSON.stringify({
        roll: _roll
    }));
}