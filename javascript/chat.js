const chatMessages = document.querySelector(".chat");
var scrolled = false;
var currentMessage = "";

// #region Functions

window.onload = function() {    
    UpdateChat();
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

setInterval(() =>
{
    UpdateChat();
}, 500);

function Roll (_roll) 
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

function UpdateChat() 
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
    
    var message = document.getElementById('chat').textContent;

    if (currentMessage != message) 
    {
        // Update the text
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    currentMessage = message;

    if(!scrolled)
    {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
}

$("#chat").on('scroll', function(){
    scrolled=true;
});

function SendMessage(_message) 
{
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
        roll : "message",
        message : _message
    }));
}

function openForm() 
{
    document.getElementById("chatForm").style.display = "block";
}

function closeForm() 
{
    document.getElementById("chatForm").style.display = "none";
}

// #endregion

var input = document.getElementById("message");
input.addEventListener("keypress", function(event) 
{
  if (event.key === "Enter") 
  {
    event.preventDefault();
    document.getElementById("message-button").click();
  }
});