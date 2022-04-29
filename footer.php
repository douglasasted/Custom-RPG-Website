
    <br>                        
    
    <div
        style="
        -position: webkit-fixed; 
        position: fixed;
        border: solid white;
        border-width: 1px 1px;
        right: 0px;
        top: 1;
        bottom: 20px; 
        float: right; 
        height: 50px;
        padding: 10px; 
        width: 24%; 
        background: black;">
        <input onclick='openForm()' type='image' src='imgs/arrow up.png' width='30' height='30' 
                style="position: fixed"/>
        <h1 class="h5 text-center">Chat </h1>
    </div>

    <div
        id="chatForm"
        style="
        display: none;
        -position: webkit-fixed; 
        position: fixed;
        border: solid white;
        border-width: 1px 1px;
        right: 0px;
        top: 1;
        bottom: 20px; 
        float: right; 
        height: 500px;
        padding: 10px; 
        width: 24%; 
        background: black;">
            <input onclick='closeForm()' type='image' src='imgs/arrow down.png' width='30' height='30' style="position: fixed"/>
            <h1 class="h5 text-center">Chat </h1>
            <div id='chat' type='text' style='
            font-size: 15px;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 5px;
            margin-bottom: 10px;
            width: 100%; height: 75%' onload="UpdateChat(); scrollTop = scrollHeight;" class="chat">

            </div>

            <textarea maxlength="300" contenteditable="true" autocomplete="off" spellcheck="true" id="message" 
            style="overflow-y: auto;width: 100%; font-size: 15px; border-style: solid; border-width: 0.5px 0.5px; border-color: var(--white-color); color: var(--white-color); height: 50px; background-color: transparent"></textarea>
            
            <button id="message-button" style="width: 20%; border-style: solid; border-color: var(--grey-color); color: var(--white-color); background-color: black; font-weight: bold; margin-top: 5px; margin-left: 80%; font-size: 14px; "
            onclick="SendMessage(document.getElementById('message').value);
            document.getElementById('message').value = '';">Enviar</button>
            
            <script src="javascript/chat.js"></script>
    </div>
    
    <br><br>

    <div class="text-center">Criado por Douglas Asted</div>

    <br><br>
</body>
</html>