<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';

    if (!isset($_GET['id'])) 
    {
        header("location: index.php");
    }

    $id = $_GET['id'];
    $name = "";

    $sql = "SELECT * FROM characters WHERE charactersId = ". $_GET['id'];
    $result = $conn->query($sql);
    $sheet = $result->fetch_assoc();

    if ($sheet['charactersPlayer'] !== $_SESSION['username'] && $_SESSION['username'] != "Douglas_Asted") 
    {
        header("location: index.php");
    }
?>

<div class="row">
    <div class="col-3">
        <h1 class="h6 text-center">Nivel 1<h1>
        <h1 class="display-6 text-center"><?php echo $sheet['charactersName']; ?><h1>
        <d1 class="row">
            <!--Status-->

            <dt class="col-sm-4 h6">Vida</dt>
            <dd class="col-sm-8">
                <div class="progress" style="background-color: rgb(37, 37, 37);">
                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="9" aria-valuemin="0" aria-valuemax="9" style="width:100%">
                    9/9
                    </div>
                </div>
            </dd>

            <dt class="col-sm-4 h6">Sanidade</dt>
            <dd class="col-sm-8">
                <div class="progress" style="background-color: rgb(37, 37, 37);">
                    <div class="progress-bar" role="progressbar" aria-valuenow="9" aria-valuemin="0" aria-valuemax="9" style="width:100%">
                    50/50
                    </div>
                </div>
            </dd>

            <dt class="col-sm-4 h6">Dominio</dt>
            <dd class="col-sm-8">
                <div class="progress" style="background-color: rgb(37, 37, 37);">
                    <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="15" style="width:100%; background-color: purple;">
                    15/15
                    </div>
                </div>
            </dd>

            <dt></dt><dd></dd>
            <dt></dt><dd></dd>
            <dt></dt><dd></dd>
            <dt></dt><dd></dd>

            <!--Roleplay-->
            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Jogador</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;"><?php echo $sheet['charactersPlayer']; ?></dd>

            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Arquetipo</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">Investigador</dd>
            
            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Ocupação</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">Técnico Informatica</dd>
            
            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Idade</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">18</dd>

            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Genêro</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">Masculino</dd>

            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Residência</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">Casa</dd>

            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">L. Nasc</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">Casa</dd>
        
            <br>

            <h1 class="h6" style="margin-left: 45px; font-size: 20px;">Pericias</h1>

            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pesquise Pericia">
            
            <ul id="myUL">
                <tbody>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Antropologia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Arqueologia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Arremesar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Arte</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Artes Marciais</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Astronomia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Barganha</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Biologia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Cavalgar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Chaveiro</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Computação</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Contabilidade</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Crédito</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Direito</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Dirigir</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Disfarce</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Eletrônica</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Encontrar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Engenharia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Escalar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Esconder</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Escutar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Esquiva</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Farmácia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Fisica</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Fotografia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Furtividade</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Geologia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">História</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">História Natural</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Lábia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Lingua Nativa</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Localizar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Medicina</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Nadar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Navegar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Ocultar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Outra Língua</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Persuadir</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Pesquisar</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Pistola</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Primeiros Socorros</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Psicanálise</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Psicologia</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Pulo</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Quimica</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Rastrear</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Reparo Elétrico</a></th></tr></li>
                    <li><tr><input type="checkbox" id="vehicle3" name="vehicle3" value="Boat"><td> 10 </td><th><a href="#">Submetralhadora</a></th></tr></li>
                </tbody>
            </ul>
        </d1>
        
    </div>
    <div class="col-6">
        <br><br>
        <div class="row">
            <div class="col-4">
                <table class="table">
                    <tbody style="border: white;">
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <td>
                                <button onclick="Roll('For <?php echo $sheet['charactersId']?>');">Força</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersFor'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'FOR', this.value);" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Dex <?php echo $sheet['charactersId']?>');">Destreza</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersDex'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'DEX', this.value);" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Con <?php echo $sheet['charactersId']?>');">Constituição</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersCon'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'CON', this.value);" />
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <table class="table">
                    <tbody style="border: white;">
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Tam <?php echo $sheet['charactersId']?>');">Tamanho</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersTam'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'TAM', this.value);" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Pod <?php echo $sheet['charactersId']?>');">Vontade</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersPod'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'POD', this.value);" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Car <?php echo $sheet['charactersId']?>');">Carisma</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersCar'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'CAR', this.value);" />
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <table class="table">
                    <tbody  style="border: white;">
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Int <?php echo $sheet['charactersId']?>');">Inteligência</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersInt'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'INT', this.value);" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Edu <?php echo $sheet['charactersId']?>');">Educação</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersEdu'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'EDU', this.value);" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Sor <?php echo $sheet['charactersId']?>');">Sorte</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charactersSor'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="0" oninput="this.value = ValueChanged(this.value);" 
                                       onblur="this.value = FocusChanged(<?php echo $sheet['charactersId']?>, 'SOR', this.value);" />
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <table class="table" style=" border: white;">
                    <tbody>
                        <tr><td></td><th scope="row"></th></tr>
                        <tr><td><a href="#">Exposição Paranormal</a></td><th scope="row">50</th></tr>
                        <tr><td>Armadura</td><th scope="row">0</th></tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table"  style=" border: white;">
                    <tbody>
                        <tr><td></td><th scope="row"></th></tr>
                        <tr><td>Bonus de Dano</td><th scope="row">1d8</th></tr>
                        <tr><td>Movimento</td><th scope="row">8</th></tr>
                    </tbody>
                </table>
            </div>
        </div>                
        <br>
        <p>
            <a data-bs-toggle="collapse" href="#arma" role="button" aria-expanded="false" aria-controls="collapseExample" style="color: rgb(161, 0, 0); padding: 0; margin-left: 5px;">
                <img src="imgs/gun.png" width="20px"> Armas
            </a>
        </p>
        <div class="collapse" id="arma">
            <div class="card card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Dano</th>
                            <th scope="col">Estilo</th>
                            <th scope="col">Pericia</th>
                            <th scope="col">Munição</th>
                        </tr>
                    </thead>
                    <tbody style="border: white;">
                        <tr>
                            <th>Briga</th>
                            <td>1d3 + bd</td>
                            <td>Pessoal</td>
                            <td><a href="#">Artes Marciais</a></td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <th>P90</th>
                            <td>1d10</td>
                            <td>Tripple ou Burst</td>
                            <td><a href="#">Submetralhadora</a></td>
                            <td>50/50</td>
                        </tr>
                        <tr>
                            <th>Corrente</th>
                            <td>1d4 + bd</td>
                            <td>Pessoal</td>
                            <td><a href="#">Artes Marciais</a></td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                    </tbody>
                    </table>
            </div>
        </div>

        <br>

        <p>
            <a data-bs-toggle="collapse" href="#rituais" role="button" aria-expanded="false" aria-controls="collapseExample" style="color: rgb(161, 0, 0); padding: 0; margin-left: 5px;">
                <img src="imgs/ritual.png" width="20px">Rituais
            </a>
        </p>
        <div class="collapse" id="rituais">
            <div class="card card-body">
                <table class="table text-center" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Sanidade</th>
                            <th scope="col">Dominio</th>
                            <th scope="col" style="width: 1000px;">Descrição</th>
                        </tr>
                    </thead>
                    <tbody style="border: white;">
                        <tr>
                            <th>Teleportar</th>
                            <td>0 / 1d6</td>
                            <td>3</td>
                            <td><div style="text-align: justify;">Criaturas sobrenaturais vão literalmente te puxar desse mundo e te enviar para outra posição no mesmo mundo que você estava anteriormente. Você também vai tomar 20d20 de dano.</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br>

        <p>
            <a data-bs-toggle="collapse" href="#skills" role="button" aria-expanded="false" aria-controls="collapseExample" style="color: rgb(161, 0, 0); padding: 0; margin-left: 5px;">
                <img src="imgs/skill.png" width="20px">Habilidades
            </a>
        </p>
        <div class="collapse" id="skills">
            <div class="card card-body">
                <table class="table text-center" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" style="width: 1000px;">Descrição</th>
                        </tr>
                    </thead>
                    <tbody style="border: white;">
                        <tr>
                            <th>Teleportar</th>
                            <td><div style="text-align: justify;">Criaturas sobrenaturais vão literalmente te puxar desse mundo e te enviar para outra posição no mesmo mundo que você estava anteriormente. Você também vai tomar 20d20 de dano. Só que agora você só pode fazer uma vez por dia</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br>

        <p>
            <a data-bs-toggle="collapse" href="#inventario" role="button" aria-expanded="false" aria-controls="collapseExample" style="color: rgb(161, 0, 0); padding: 0; margin-left: 5px;">
                <img src="imgs/bag.png" width="20px">Inventario
            </a>
        </p>
        <div class="collapse" id="inventario">
            <div class="card card-body">
                <div class="row" style="margin-left: 100px;">
                    <div class="col-4">
                        <strong> Peso </strong> 3 / 20
                    </div>
                    <div class="col-6">
                        <strong> Dinheiro </strong> 0.00 $
                    </div>
                </div>
                
                <br>
                
                <table class="table text-center" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Peso</th>
                            <th scope="col" style="width: 1000px;">Descrição</th>
                        </tr>
                    </thead>
                    <tbody style="border: white;">
                        <tr>
                            <th>Crowbar</th>
                            <td>3</td>
                            <td><div style="text-align: justify;">Uma crowbar.</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                        <tr>
                            <th>---</th>
                            <td>---</td>
                            <td><div style="text-align: justify;">---</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
        </div>

        <br>
        
        <div>Descrição Pessoal</div>

        <textarea class="form-control" rows="4" cols="50" style="width: 525px; resize: none;"></textarea>

        <br>

        <div>História</div>

        <textarea class="form-control" rows="4" cols="50" style="width: 525px; height: 325px; resize: none;"></textarea>

        <br>
        <div class="row">
            <div class="col-6">
                <div>Pessoas Importantes</div>

                <textarea class="form-control" rows="4" cols="50" style="width: 225px; height: 240px; resize: none;"></textarea>

                <br>

                <div>Fobias e Manias</div>

                <textarea class="form-control" rows="4" cols="50" style="width: 240px; height: 240px; resize: none;"></textarea>

                <br>

            </div>
            <div class="col-6">
                <div>Marcas e Cicatrizes</div>

                <textarea class="form-control" rows="4" cols="50" style="width: 240px; height: 240px; resize: none;"></textarea>

                <br>

                <div>Ferimentos</div>

                <textarea class="form-control" rows="4" cols="50" style="width: 240px; height: 240px; resize: none;"></textarea>

                <br>
                
            </div>
        </div>
    </div>
    <div class="col-3">
        <?php
            include_once 'includes/chat.inc.php';
        ?>
    </div>
</div>

<script>
$(".btn-success").click(function() {
    $(".collapse").collapse('show');
});
$(".btn-warning").click(function() {
    $(".collapse").collapse('hide');
});
</script>

<script src="js/filter.js"></script>
<script src="js/characterssheet.js"></script>
<?php
    include_once 'footer.php';
?>