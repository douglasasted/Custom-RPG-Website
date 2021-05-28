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

    if ($sheet['player'] !== $_SESSION['username'] && $_SESSION['username'] != "Douglas_Asted") 
    {
        header("location: index.php");
    }
?>

<div class="row">
    <div class="col-4">
        <br>
        <h1 class="h6 text-center" style="margin-bottom: 0px;">
            Nivel 
            <input type="text" value="<?php echo $sheet['level'] ?>"
                    style="width: 25px; height: 25  px; outline: none; font-weight: normal;" 
                    placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'level', this.value, 20);" 
                    onblur="this.value = FocusChanged(this.value, 'text');" />
        <h1>
        <h1 class="display-6 text-center" style="margin-bottom: 0px !important; margin-top: 0px;">
                <input type="text" value="<?php echo $sheet['name'] ?>"
                       style="width: 500px; height: 60px; outline: none; font-weight: normal;" 
                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'name', this.value, 'text');" 
                       onblur="this.value = FocusChanged(this.value, 'text');" />
        <h1>
        <d1 class="row">
            <!--Status-->
            <dt class="col-sm-4 h6" style="color: white; background-color: #E60101; border-bottom: 2px solid black; border-top: 2px solid black;">Vida</dt>
            <dd class="col-sm-8 text-center" style="border-right: 2px solid black; color: white; font-size: 18px; background-color: #E60101; border-bottom: 2px solid black; border-top: 2px solid black;">
                <input type="text" value="<?php echo $sheet['currentLife'] ?>"
                style="width: 35px; background-color: #E60101; color: white; outline: none; font-weight: normal;" 
                placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'currentLife', this.value, <?php echo $sheet['maxLife']; ?>);" 
                onblur="this.value = FocusChanged(this.value, 'text');" /> 
                    / 
                <input type="text" value="<?php echo $sheet['maxLife'] ?>"
                style="width: 35px; background-color: #E60101; color: white; outline: none; font-weight: normal;" 
                placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'maxLife', this.value, 100);" 
                onblur="this.value = FocusChanged(this.value, 'text');" /> 
            </dd>

            <dt class="col-sm-4 h6" style="color: white; background-color: #1796E6; border-bottom: 2px solid black; border-top: 2px solid black;">Sanidade</dt>
            <dd class="col-sm-8 text-center" style="border-right: 2px solid black; color: white; font-size: 18px; border-bottom: 2px solid black; border-top: 2px solid black; background-color: #1796E6">
            <input type="text" value="<?php echo $sheet['currentSanity'] ?>"
                style="width: 35px; background-color: #1796E6; color: white; outline: none; font-weight: normal;" 
                placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'currentSanity', this.value, <?php echo $sheet['maxSanity']; ?>);" 
                onblur="this.value = FocusChanged(this.value, 'text');" /> 
                    / 
                <input type="text" value="<?php echo $sheet['maxSanity'] ?>"
                style="width: 35px; background-color: #1796E6; color: white; outline: none; font-weight: normal;" 
                placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'maxSanity', this.value, 100);" 
                onblur="this.value = FocusChanged(this.value, 'text');" /> 
            </dd>
            <!--
            <dt class="col-sm-4 h6">Dominio</dt>
            <dd class="col-sm-8">
                <?php echo $sheet['currentDomain']; ?> / <?php echo $sheet['maxDomain']; ?>
            </dd> -->

            <dt></dt><dd></dd>
            <dt></dt><dd></dd>

            <!--Roleplay-->
            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Jogador</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;"><?php echo $sheet['player']; ?></dd>

            <!-- <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Arquetipo</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;"><?php echo $sheet['archetype']; ?></dd> -->
            
            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Profissão</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">    
                <input type="text" value="<?php echo $sheet['occupation'] ?>" 
                                        style="width: 500px; outline: none;" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'occupation', this.value, 'text');" 
                                        onblur="this.value = FocusChanged(this.value, 'text');" />
            </dd>
            
            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Idade</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">    
                <input type="text" value="<?php echo $sheet['age'] ?>" 
                                        style="width: 500px; outline: none;" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'age', this.value, 200);" 
                                        onblur="this.value = FocusChanged(this.value, 'text');" />
            </dd>

            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Genêro</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">    
                <input type="text" value="<?php echo $sheet['gender'] ?>" 
                                        style="width: 500px; outline: none;" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'gender', this.value, 'text');" 
                                        onblur="this.value = FocusChanged(this.value, 'text');" />
            </dd>

            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">Residência</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">    
                <input type="text" value="<?php echo $sheet['res'] ?>" 
                                        style="width: 500px; outline: none;" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'res', this.value, 'text');" 
                                        onblur="this.value = FocusChanged(this.value, 'text');" />
            </dd>

            <dt class="col-sm-4 h6" style="margin-bottom: 5px !important;">L. Nasc</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal;">    
                <input type="text" value="<?php echo $sheet['nasc'] ?>" 
                                        style="width: 500px; outline: none;" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'nasc', this.value, 'text');" 
                                        onblur="this.value = FocusChanged(this.value, 'text');" />
            </dd>
        
            <br>

            <h1 class="h6" style="margin-left: 45px; font-size: 20px;">Pericias</h1>

            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pesquise Pericia">
            
            <ul id="myUL">
                <tbody style="font-size: 16px;">
                    <?php
                        $sheetkeys = array_keys($sheet);
                        $n = 0;

                        foreach ($sheetkeys as $key) 
                        {
                            if (substr($key, 0, 4) == "char") 
                            {
                                $n += 1;
                                if ($n > 10) 
                                {
                                    $name = substr($key, 4);
                                    if ($name == "ArteMarciais") $name = "Artes Marciais";
                                    if ($name == "PrimeirosSocorros") $name = "Prim. Socorros";
                                    echo " 
                                        <li>
                                            <tr>
                                                <input type='checkbox'/>
                                                <td> 
                                                    <input type='text' value=" . $sheet[$key] . " 
                                                        style='width: 25px; outline: none; font-weight: bold;' 
                                                        oninput='this.value = ValueChanged(" . $sheet['charactersId'] . ", \"" . $key . "\", this.value, \"20\");' 
                                                        onblur='this.value = FocusChanged(this.value, \"char\");' />
                                                </td>
                                                <th>
                                                    <button onclick='Roll(\"" . $key . " " . $sheet['charactersId'] . "\");'>" . $name ."</button>
                                                </th>
                                            </tr>
                                        </li>";
                                }
                            }
                        }
                    ?>
                </tbody>
            </ul>
        </d1>
        
    </div>
    <div class="col-8">
        <br><br><br>
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
                                <input type="text" value="<?php echo $sheet['charFor'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charFOR', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Dex <?php echo $sheet['charactersId']?>');">Destreza</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charDex'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charDEX', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Con <?php echo $sheet['charactersId']?>');">Constituição</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charCon'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charCON', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
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
                                <input type="text" value="<?php echo $sheet['charTam'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charTAM', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Pod <?php echo $sheet['charactersId']?>');">Vontade</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charPod'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charPOD', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Car <?php echo $sheet['charactersId']?>');">Carisma</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charCar'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charCAR', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
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
                                <input type="text" value="<?php echo $sheet['charInt'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charINT', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Edu <?php echo $sheet['charactersId']?>');">Educação</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charEdu'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charEDU', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="Roll('Sor <?php echo $sheet['charactersId']?>');">Sorte</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['charSor'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charSOR', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
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
                        <tr>
                            <td>
                                <button onclick="Roll('Exp <?php echo $sheet['charactersId']?>');">Exposição Paranormal</button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['paranormalExposure'] ?>" 
                                       style="width: 35px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'paranormalExposure', this.value, '100');" 
                                       onblur="this.value = FocusChanged(this.value, 'null');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                               <button style="color : black; background-color: white !important;" disabled> 
                                    Armadura 
                                </button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['armor'] ?>" 
                                       style="width: 35px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'armor', this.value, '100');" 
                                       onblur="this.value = FocusChanged(this.value, 'null');" />
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table"  style=" border: white;">
                    <tbody>
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <td>
                               <button style="color : black; background-color: white !important;" disabled> 
                                    Bonus de Dano 
                                </button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['baseDamage'] ?>" 
                                       style="width: 35px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'baseDamage', this.value, 'text');" 
                                       onblur="this.value = FocusChanged(this.value, 'text');" />
                            </th>
                        </tr>
                        <tr>
                            <td>
                               <button style="color : black; background-color: white !important;" disabled> 
                                    Movimento
                                </button>
                            </td>
                            <th>
                                <input type="text" value="<?php echo $sheet['movement'] ?>" 
                                       style="width: 35px; outline: none; font-weight: bold;" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'movement', this.value, 12);" 
                                       onblur="this.value = FocusChanged(this.value, 'text');" />
                            </th>
                        </tr>
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

        <!--<p>
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

        <br> -->

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
        
        <div style="margin-left: 10px;">Descrição Pessoal</div>
            <textarea type="text" style="margin-left: 10px; border-color: lightgrey; background-color: rgb(235, 235, 235); width: 525px; height: 150px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'personalDescription', this.value, 'text');" > <?php echo $sheet['personalDescription'] ?>
            </textarea>
        <br>

        <div style="margin-left: 10px;">História</div>

        <textarea type="text" style="margin-left: 10px; border-color: lightgrey; background-color: rgb(235, 235, 235); width: 525px; height: 200px  ; resize: none;" 
        placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'story', this.value, 'text');" > <?php echo $sheet['story'] ?>
        </textarea>

        <br>
        <div class="row">
            <div class="col-6">
                <div style="margin-left: 10px;">Pessoas Importantes</div>

                
                <textarea type="text" style="margin-left: 10px; border-color: lightgrey; background-color: rgb(235, 235, 235); width: 225px; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'people', this.value, 'text');" > <?php echo $sheet['people'] ?>
                </textarea>

                <br>

                <div style="margin-left: 10px;">Fobias e Manias</div>

                <textarea type="text" style="margin-left: 10px; border-color: lightgrey; background-color: rgb(235, 235, 235); width: 225px; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'fears', this.value, 'text');" > <?php echo $sheet['fears'] ?>
                </textarea>

                <br>

            </div>
            <div class="col-6">
                <div>Marcas e Cicatrizes</div>

                <textarea type="text" style="margin-left: 10px; border-color: lightgrey; background-color: rgb(235, 235, 235); width: 225px; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'scars', this.value, 'text');" > <?php echo $sheet['scars'] ?>
                </textarea>

                <br>

                <div>Ferimentos</div>

                <textarea type="text" style="margin-left: 10px; border-color: lightgrey; background-color: rgb(235, 235, 235); width: 225px; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'wounds', this.value, 'text');" > <?php echo $sheet['wounds'] ?>
                </textarea>

                <br>
                
            </div>
        </div>
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