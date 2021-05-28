            </div>
            <div class="col-3"><br>
                <div  style="-position: webkit-sticky; position: sticky; top: 28px; bottom: 4px; float: right;background-color: rgb(235, 235, 235); padding: 10px; border-style: solid; border-width: thin; border-color: grey; width: 275px;">
                    <h1 class="h5 text-center">Chat</h1>
                    <div onload="UpdateChat();" class="chat">

                    </div>
                    <input id="message"></input>
                    <button style="width: 60px" onclick="
                        SendMessage(document.getElementById('message').value);
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