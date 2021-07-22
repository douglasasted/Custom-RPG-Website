            </div>
            <div class="col-3"><br>
                <div  style="
                    -position: webkit-sticky; 
                    position: sticky; 
                    top: 28px; 
                    bottom: 0; 
                    float: right; 
                    padding: 10px; 
                    width: 100%; 
                    height: 94vh">
                    <h1 class="h5 text-center">Chat</h1>
                        <div id='chat' type='text' style='
                        font-size: 15px;
                        overflow-x: hidden;
                        overflow-y: auto;
                        padding: 5px;
                        width: 100%; height: 80%' onload="UpdateChat(); scrollTop = scrollHeight;" class="chat">

                        </div>
                        <input id="message" style="width: 100%; font-size: 15px; border-style: solid; border-color: black; color: black; height: 50px; background-color: transparent"></input>
                        <button 
                        style="width: 25%; border-style: solid; border-color: black; color: black; font-weight: bold; margin-left: 75%; margin-top: 5px; background: url('imgs/paper.png')" 
                        onclick="SendMessage(document.getElementById('message').value);
                        document.getElementById('message').value = '';"> Roll</button>
                        <script src="javascript/chat.js"></script>
                </div>
                <br>
            </div>
            <br>
            <div class="text-center">Criado por Douglas Asted - 2021</div>
            <br><br>
        </div>
    </div>
    <br>
</body>
</html>