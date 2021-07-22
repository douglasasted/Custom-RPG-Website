<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';

    # Constantes
    $hasDomain = false;
    $hasArchetype = false;

    if (!isset($_GET['id'])) 
        header("location: index.php");

    $id = $_GET['id'];
    $name = "";

    $sql = "SELECT * FROM characters WHERE charactersId = ". $_GET['id'];
    $result = $conn->query($sql);
    $sheet = $result->fetch_assoc();

    if ($sheet['player'] !== $_SESSION['username'] && $_SESSION['username'] != "Douglas_Asted") 
        header("location: index.php");

    $monster = false;
    if ($sheet['player'] == 'monster') 
        $monster = true;

    # Functions

    # Stat Function
    function EchoStats ($name, $ptname) 
    {
        global $sheet;
        echo '
        <span>
            <dt id="stats-title" class="'. strtolower($name) .'-shadow col-sm-4 h6"><span style="color:transparent">A</span>' . $ptname . '</dt>
            <dd id="stats-container" class="'. strtolower($name) .'-shadow col-sm-8 text-center">
                <input id="stats-text" type="text" value="'. $sheet['current'. $name] .'"
                oninput="this.value = ValueChanged('. $sheet['charactersId'] . ', \'current'. $name .'\', this.value, 100);" 
                onblur="this.value = FocusChanged(this.value, \'text\');" /> 
                    / 
                <input id="stats-text" type="text" value="'. $sheet['max'. $name ] . '"
                oninput="this.value = ValueChanged(' . $sheet['charactersId'] . ', \'max'. $name .'\', this.value, 100);" 
                onblur="this.value = FocusChanged(this.value, \'text\');" /> 
            </dd>
        </span>
        <br>
        ';
    }

    # Non editable info function
    function EchoInfo($name, $ptname) 
    {
        global $sheet;
        Echo '
            <dt class="col-sm-4 h6" style="font-size: 14px; color: white;">
                ' . $ptname . '
            </dt>

            <dd class="col-sm-8 h6" style="font-weight: normal; color: white;">
                ' . $sheet[$name] . '
            </dd>
        ';
    }

    # Editable info function
    function EchoEditInfo($name, $ptname) 
    {
        global $sheet;
        Echo '
            <dt class="col-sm-4 h6" style="font-size: 14px; margin-bottom: 5px !important; color: white;">'. $ptname . '</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal; color: white;">    
                <input type="text" value="'. $sheet[$name] . '" 
                style="width: 100%; outline: none; background-color: transparent; color:white;" 
                placeholder="" oninput="this.value = ValueChanged('. $sheet["charactersId"] . ', \''. $name .'\', this.value, \'text\');" 
                onblur="this.value = FocusChanged(this.value, \'text\');" />
            </dd>
        ';
    }
?>

<div class="row">
    <!--Left side bar-->
    <div class="col-3">
        <br>

        <!--Current Level-->
        <h1 class="h6 text-center" style='color: white;'>
            Nivel 
            <input style="background-color: transparent" id="smallinput" type="text" value="<?php echo $sheet['level'] ?>"
            oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'level', this.value, 20);" 
            onblur="this.value = FocusChanged(this.value, 'text');" />
        <h1>

        <!--Name Title-->
        <h1 class="display-6 text-center">
            <input id="normaltitle" type="text" value="<?php echo $sheet['name'] ?>"
            placeholder="???" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'name', this.value, 'text');" 
            onblur="this.value = FocusChanged(this.value, 'text');" />
        <h1>

        <d1 class="row">
            <!--Status-->

            <!--Lifes Texts-->
            <!--All character sheets has life, but other stats can be blocked-->
            <?php
                # All character sheets has life, but other stats can be blocked
                # Echo the life
                EchoStats('Life', 'Vida');

                # Echo the sanity if it's not a monster
                if (!$monster) EchoStats('Sanity', 'Sanidade');

                # Echo the domain if is enabled
                if ($hasDomain) EchoStats('Domain', 'Dominio');

                
                #Information for Roleplay

                #Echo player name
                EchoInfo('player', 'Jogador');

                #Echo player archetype if is enabled
                #Archetype is only got after a certain level
                if ($hasArchetype) EchoEditInfo('archetype', 'Arquétipo');

                #Echo player occupation
                EchoEditInfo('occupation', 'Ocupação');

                #Echo player age
                EchoEditInfo('age', 'Idade');

                #Echo player gender
                EchoEditInfo('gender', 'Genêro');

                #Echo player residence
                EchoEditInfo('res', 'Residência');

                #Echo player born place
                EchoEditInfo('nasc', 'L. Nasc');
            ?>
        
            <br>

            <div style='padding: 0px'>
                <div align=center style="font-size: 15px; font-weight: bold">Pericias</div>
                <input type="text" style="background-color: transparent; border-color: black; border-style: solid; border-width: 2px; margin: 8px" id="myInput" onkeyup="myFunction()" placeholder="Pesquise Pericia">
                <ul id="myUL">
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
                                    $check = "chec" . $name;
                                    $checkbox = "";
                                    if ($sheet[$check] == 1)
                                    {
                                        $checkbox = "checked";
                                    }

                                    if ($name == "PrimeirosSocorros") $name = "Prim. Socorros";
                                    if ($name == "ArmasDFogo") $name = "Armas de Fogo";
                                    if ($name == "Linguagem") $name = "Idioma (Natural)";
                                    echo " 
                                        <li style='background-color: transparent'>
                                            <tr>
                                                <input type='checkbox' " . $checkbox . " onclick='this.value = ValueChanged(" . $sheet['charactersId'] . ", \"" . $check . "\", this.checked, \"text\");'/>
                                                <td> 
                                                    <input onclick='Roll(\"" . $key . " " . $sheet['charactersId'] . "\");' type='image' src='imgs/dice.png' width='15' height='15'/>
                                                    
                                                    <input type='text' value=". $sheet[$key] . " 
                                                    style='width: 25px; outline: none; font-weight: bold; background-color: transparent' 
                                                    oninput='this.checked = ValueChanged(" . $sheet['charactersId'] . ", \"" . $key . "\", this.value, \"20\");' 
                                                    onblur='this.checked = FocusChanged(this.value, \"char\");' />
                                                </td>
                                                <th>
                                                    <span style='font-weight: light; font-size: 15px; width: 700px;'>". $name . "</span>
                                                </th>
                                            </tr>
                                        </li>";
                                    
                                    # Subcategorias
                                    if ($name == "Briga") 
                                    {
                                        $sql = "SELECT * FROM expertises WHERE charactersId = ". $_GET['id'] . " AND category = 'charBriga'";
                                        $expertises = $conn->query($sql);
                
                                        while ($expertise = $expertises -> fetch_array()) 
                                        {
                                            $checkbox = "";
                                            if ($expertise['expertiseCheck'] == 1)
                                            {
                                                $checkbox = "checked";
                                            }
                                            echo " 
                                            <li style=' background-color: transparent'>
                                                <tr>
                                                    <input type='checkbox' " . $checkbox . " onclick='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseCheck\", this.checked, \"check\");'/>
                                                    <td> 
                                                        <input onclick='Roll(\"expertise " . $sheet['charactersId'] . " " . $expertise['expertiseValue'] . " " . $expertise['expertiseName'] ."\");' type='image' src='imgs/dice.png' width='15' height='15'/>
                                                        <input type='text' value=". $expertise['expertiseValue'] . " 
                                                            style='width: 25px; outline: none; font-weight: bold;  background-color: transparent' 
                                                            oninput='this.checked = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseValue\", this.value, \"charExpertise\");' 
                                                            onblur='this.checked = FocusChanged(this.value, \"char\");' />
                                                    </td>
                                                    <th>
                                                        <span>
                                                            <input type='text' value='" . $expertise['expertiseName'] . "' 
                                                                style='width: 110px; height: 25px; outline: none; color: rgb (0, 0, 161) !important; font-size: 15px;  background-color: transparent' 
                                                                placeholder='...' oninput='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseName\", this.value, \"expertise\");' 
                                                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                                                            <span style='font-size: 0px; width: 0px; display: inline-block'>".$expertise['expertiseName']."</span>
                                                        </span>
                                                    </th>
                                                </tr>
                                            </li>";
                                        }

                                    }
                                    else if ($name == "Sobrevivencia") 
                                    {
                                        $sql = "SELECT * FROM expertises WHERE charactersId = ". $_GET['id'] . " AND category = 'charSobrevivencia'";
                                        $expertises = $conn->query($sql);
                
                                        while ($expertise = $expertises -> fetch_array()) 
                                        {
                                            $checkbox = "";
                                            if ($expertise['expertiseCheck'] == 1)
                                            {
                                                $checkbox = "checked";
                                            }
                                            echo " 
                                            <li style='background-color: transparent'>
                                                <tr>
                                                    <input type='checkbox' " . $checkbox . " onclick='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseCheck\", this.checked, \"check\");'/>
                                                    <td> 
                                                        <input onclick='Roll(\"expertise " . $sheet['charactersId'] . " " . $expertise['expertiseValue'] . " " . $expertise['expertiseName'] ."\");' type='image' src='imgs/dice.png' width='15' height='15'/>
                                                        <input type='text' value=". $expertise['expertiseValue'] . " 
                                                            style='width: 25px; outline: none; font-weight: bold; background-color: transparent' 
                                                            oninput='this.checked = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseValue\", this.value, \"charExpertise\");' 
                                                            onblur='this.checked = FocusChanged(this.value, \"char\");' />
                                                    </td>
                                                    <th>
                                                        <span>
                                                            <input type='text' value='" . $expertise['expertiseName'] . "' 
                                                                style='width: 110px; height: 25px; outline: none; color: rgb (0, 0, 161) !important;background-color: transparent' 
                                                                placeholder='...' oninput='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseName\", this.value, \"expertise\");' 
                                                                onblur='this.value = FocusChanged(this.value, \"text\");' />   
                                                            <span style='font-size: 0px; width: 0px; display: inline-block'>".$expertise['expertiseName']."</span>
                                                        </span>
                                                    </th>
                                                </tr>
                                            </li>";
                                        }
                                    }
                                    else if ($name == "Armas de Fogo") 
                                    {
                                        $sql = "SELECT * FROM expertises WHERE charactersId = ". $_GET['id'] . " AND category = 'charArmasDFogo'";
                                        $expertises = $conn->query($sql);
                
                                        while ($expertise = $expertises -> fetch_array()) 
                                        {
                                            $checkbox = "";
                                            if ($expertise['expertiseCheck'] == 1)
                                            {
                                                $checkbox = "checked";
                                            }
                                            echo " 
                                            <li style='background-color: transparent'>
                                                <tr>
                                                    <input type='checkbox' " . $checkbox . " onclick='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseCheck\", this.checked, \"check\");'/>
                                                    <td> 
                                                        <input onclick='Roll(\"expertise " . $sheet['charactersId'] . " " . $expertise['expertiseValue'] . " " . $expertise['expertiseName'] ."\");' type='image' src='imgs/dice.png' width='15' height='15'/>
                                                        <input type='text' value=". $expertise['expertiseValue'] . " 
                                                            style='width: 25px; outline: none; font-weight: bold; background-color: transparent' 
                                                            oninput='this.checked = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseValue\", this.value, \"charExpertise\");' 
                                                            onblur='this.checked = FocusChanged(this.value, \"char\");' />
                                                    </td>
                                                    <th>
                                                        <span>
                                                            <input type='text' value='" . $expertise['expertiseName'] . "' 
                                                                style='width: 110px; height: 25px; outline: none; color: rgb (0, 0, 161) !important;background-color: transparent' 
                                                                placeholder='...' oninput='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseName\", this.value, \"expertise\");' 
                                                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                                                            <span style='font-size: 0px; width: 0px; display: inline-block'>".$expertise['expertiseName']."</span>
                                                        </span>
                                                    </th>
                                                </tr>
                                            </li>";
                                        }

                                    }
                                    else if ($name == "Idioma (Natural)") 
                                    {
                                        $sql = "SELECT * FROM expertises WHERE charactersId = ". $_GET['id'] . " AND category = 'charLinguagem'";
                                        $expertises = $conn->query($sql);
                
                                        while ($expertise = $expertises -> fetch_array()) 
                                        {
                                            $checkbox = "";
                                            if ($expertise['expertiseCheck'] == 1)
                                            {
                                                $checkbox = "checked";
                                            }
                                            echo " 
                                            <li style='background-color: transparent'>
                                                <tr>
                                                    <input type='checkbox' " . $checkbox . " onclick='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseCheck\", this.checked, \"check\");'/>
                                                    <td> 
                                                        <input onclick='Roll(\"expertise " . $sheet['charactersId'] . " " . $expertise['expertiseValue'] . " " . $expertise['expertiseName'] ."\");' type='image' src='imgs/dice.png' width='15' height='15'/>
                                                        <input type='text' value=". $expertise['expertiseValue'] . " 
                                                            style='width: 25px; outline: none; font-weight: bold; background-color: transparent'  
                                                            oninput='this.checked = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseValue\", this.value, \"charExpertise\");' 
                                                            onblur='this.checked = FocusChanged(this.value, \"char\");' />
                                                    </td>
                                                    <span>
                                                        <th>
                                                            <input type='text' value='" . $expertise['expertiseName'] . "' 
                                                                style='width: 110px; height: 25px; outline: none; color: rgb (0, 0, 161) !important; background-color: transparent' 
                                                                placeholder='...' oninput='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseName\", this.value, \"expertise\");' 
                                                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                                                            <span style='font-size: 0px; width: 0px; display: inline-block'>".$expertise['expertiseName']."</span>
                                                        </th>
                                                    </span>
                                                </tr>
                                            </li>";
                                        }

                                    }
                                }
                            }
                        }
                    ?>
                </ul>
            </div>
        </d1>
        
    </div>
    <div class="col-9">
        <br>
        <div align=center style="font-size: 15px; font-weight: bold">Caracteristicas</div>
        <div class="row">
            <div class="col-4">
                <table class="table">
                    <tbody style="border: transparent;">
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <th>
                                <input onclick="Roll('For <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charFor'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold; background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charFOR', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Força</span>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Dex <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charDex'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charDEX', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Destreza</span>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Con <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charCon'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charCON', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Constituição</span>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <table class="table">
                    <tbody style="border: transparent;">
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Tam <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charTam'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charTAM', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Tamanho</span>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Pod <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charPod'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charPOD', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Vontade</span>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Car <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charCar'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charCAR', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Carisma</span>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <table class="table">
                    <tbody  style="border: transparent;">
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Int <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charInt'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charINT', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Inteligência</span>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Edu <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charEdu'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charEDU', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Educação</span>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Sor <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['charSor'] ?>" 
                                       style="width: 25px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charSOR', this.value, '20');" 
                                       onblur="this.value = FocusChanged(this.value, 'char');" />
                            </th>
                            <th>
                                <span class="h1" style="font-size: 15px;">Sorte</span>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <table class="table" style=" border: white;">
                    <tbody style='border-color: transparent'>
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <th>
                                <input onclick="Roll('Exp <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                <input type="text" value="<?php echo $sheet['paranormalExposure'] ?>" 
                                       style="width: 35px; font-size: 15px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'paranormalExposure', this.value, '100');" 
                                       onblur="this.value = FocusChanged(this.value, 'null');" />
                            </th>
                            <th><div class='h1' style='font-size: 15px; width: 150px; margin-right: 50px'>Exposição</div></th>
                        </tr>
                        <tr>
                            <th>
                                <input type="text" value="<?php echo $sheet['armor'] ?>" 
                                       style="margin-left: 18px; width: 35px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'armor', this.value, '100');" 
                                       onblur="this.value = FocusChanged(this.value, 'null');" />
                            </th>
                            <th><div class='h1' style='font-size: 15px'>Armadura</div></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table"  style=" border: white;">
                    <tbody style='border-color: transparent'>
                        <tr><td></td><th scope="row"></th></tr>
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $sheet['baseDamage'] ?>" 
                                       style="margin-left: 18px; width: 35px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'baseDamage', this.value, 'text');" 
                                       onblur="this.value = FocusChanged(this.value, 'text');" />
                            </td>
                            <th><div class='h1' style='font-size: 15px; margin-right: 100px'>Bonus de Dano</div></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $sheet['movement'] ?>" 
                                       style="margin-left: 18px; width: 35px; outline: none; font-weight: bold;background-color: transparent" 
                                       placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'movement', this.value, 12);" 
                                       onblur="this.value = FocusChanged(this.value, 'text');" />
                            </td>
                            <th><div class='h1' style='font-size: 15px'>Movimento</div></th>
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
            <div class="card card-body" style='background-color: transparent; border-style: solid; border-width: 2px; border-color: black'>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Dano</th>
                            <th scope="col">Pericia</th>
                            <th scope="col">Munição</th>
                        </tr>
                    </thead>
                    <tbody style="border: transparent;">
                        <?php
                            $sql = "SELECT * FROM guns WHERE charactersId = ". $_GET['id'];
                            $guns = $conn->query($sql);
    
                            while ($gun = $guns -> fetch_array()) 
                            {
                                echo " 
                                    <tr>
                                        <th> 
                                            <input type='text' value='" . $gun['name'] ."' 
                                                style='width: 75px; outline: none; background-color: transparent;' 
                                                oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"name\", this.value, \"gun\");' 
                                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                                        </th>
                                        <td> 
                                            <input type='text' value='" . $gun['damage'] ."' 
                                                style='width: 75px; outline: none;background-color: transparent;' 
                                                oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"damage\", this.value, \"gun\");' 
                                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                                        </td>
                                        <td> 
                                            <input type='text' value='" . $gun['skill'] ."' 
                                                style='width: 125px; outline: none;background-color: transparent;' 
                                                oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"skill\", this.value, \"gun\");' 
                                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                                        </td>
                                        <td> 
                                            <input type='text' value='" . $gun['ammo'] ."' 
                                                style='width: 65px; outline: none;background-color: transparent;' 
                                                oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"ammo\", this.value, \"gun\");' 
                                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                                        </td>
                                    </tr>";
                            }
                        ?>
                    </table>
                    </tbody>
                    <button style='background-color: transparent; width: 100px' onclick="NewItem(<?php echo $sheet['charactersId'] ?>, ''); window.location.reload();">Adicionar</button>
            </div>
        </div>

        <br>

        <p>
            <a data-bs-toggle="collapse" href="#rituais" role="button" aria-expanded="false" aria-controls="collapseExample" style="color: rgb(161, 0, 0); padding: 0; margin-left: 5px;">
                <img src="imgs/ritual.png" width="20px">Rituais
            </a>
        </p>
        <div class="collapse" id="rituais">
            <div class="card card-body" style='background-color: transparent; border-style: solid; border-width: 2px; border-color: black'>
                <table class="table text-center" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 300px">Nome</th>
                            <th scope="col">Sanidade</th>
                            <th scope="col">Dominio</th>
                            <th scope="col" style="width: 1000px;">Descrição</th>
                        </tr>
                    </thead>
                    <tbody style="border: transparent;">
                        <?php
                            $sql = "SELECT * FROM rituals WHERE charactersId = ". $_GET['id'];
                            $rituals = $conn->query($sql);

                            while ($ritual = $rituals -> fetch_array()) 
                            {
                                echo "
                                <tr>
                                    <th>
                                        <textarea type='text' style='font-size:12px; border-color: transparent; width: 100%; height: 125px; resize: none; background-color: transparent;' 
                                        onchange='this.value = ValueChanged(". $ritual['ritualsId']. ", \"name\", this.value, \"ritual\");' >". $ritual['name'] . "</textarea>
                                    </th>
                                    <th>
                                        <input type='text' value='" . $ritual['sanity'] ."'
                                            style='width: 100%; outline: none;  background-color: transparent;' 
                                            oninput='this.value = ValueChanged(" . $ritual['ritualsId'] . ", \"sanity\", this.value, \"ritual\");' 
                                            onblur='this.value = FocusChanged(this.value, \"text\");' />
                                    </th>
                                    <th>
                                        <input type='text' value='" . $ritual['domain'] ."'
                                            style='width: 100%; outline: none; background-color: transparent;'
                                            oninput='this.value = ValueChanged(" . $ritual['ritualsId'] . ", \"domain\", this.value, \"ritual\");' 
                                            onblur='this.value = FocusChanged(this.value, \"text\");' />
                                    </th>
                                    <td>
                                        <textarea type='text' style='font-size: 12px; border-color: black; border-width: 2px; background-color: transparent; width: 100%; height: 125px; resize: none;' 
                                        onchange='this.value = ValueChanged(". $ritual['ritualsId']. ", \"description\", this.value, \"ritual\");' >". $ritual['description'] . "</textarea>
                                    </td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <button style='background-color: transparent; width: 100px' onclick="NewItem(<?php echo $sheet['charactersId'] ?>, 'ritual'); window.location.reload();">Adicionar</button>
            </div>
        </div>

        <br>
        
        <p>
            <a data-bs-toggle="collapse" href="#skill" role="button" aria-expanded="false" aria-controls="collapseExample" style="color: rgb(161, 0, 0); padding: 0; margin-left: 5px;">
                <img src="imgs/skill.png" width="20px">Habilidades
            </a>
        </p>
        <div class="collapse" id="skill">
            <div class="card card-body" style='background-color: transparent; border-style: solid; border-width: 2px; border-color: black; width: 100%'>
                <table class="table text-center" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" style="width: 1000px;">Descrição</th>
                        </tr>
                    </thead>
                    <tbody style="border: transparent;">
                        <tr>
                            <?php
                                $sql = "SELECT * FROM skills WHERE charactersId = ". $_GET['id'];
                                $skills = $conn->query($sql);

                                while ($skill = $skills -> fetch_array()) 
                                {
                                    echo "
                                    <tr>
                                        <th>
                                            <textarea type='text' style='border-color: transparent; background-color: transparent; width: 100px; height: 75px; resize: none;' 
                                            onchange='this.value = ValueChanged(". $skill['skillsId']. ", \"name\", this.value, \"skill\");' >". $skill['name'] . "</textarea>
                                        <td>
                                            <textarea type='text' style=' font-size: 12px; border-color: black; border-width: 2px; background-color: transparent; width: 100%; height: 75px; resize: none;' 
                                            onchange='this.value = ValueChanged(". $skill['skillsId']. ", \"description\", this.value, \"skill\");' >". $skill['description'] . "</textarea>
                                        </td>
                                    </tr>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <button style='background-color: transparent; width: 100px' onclick="NewItem(<?php echo $sheet['charactersId'] ?>, 'skill'); window.location.reload();">Adicionar</button>
            </div>
        </div>

        <br>

        <p>
            <a data-bs-toggle="collapse" href="#inventario" role="button" aria-expanded="false" aria-controls="collapseExample" style="color: rgb(161, 0, 0); padding: 0; margin-left: 5px;">
                <img src="imgs/bag.png" width="20px">Inventario
            </a>
        </p>
        <div class="collapse" id="inventario">
            <div class="card card-body" style='background-color: transparent; border-style: solid; border-width: 2px; border-color: black'>
                <div class="col-6">
                    <strong> Dinheiro </strong>  $
                        <input type="text" value="<?php echo $sheet['money'] ?>" 
                            style="width: 100px; outline: none;" 
                            oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'money', this.value, '10000');" 
                            onblur="this.value = FocusChanged(this.value, 'text');" />
                </div>
                
                <br>
                
                <table class="table text-center" style="font-size: 15px;">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col" style="width: 1000px;">Descrição</th>
                        </tr>
                    </thead>
                    <tbody style="border: white;">
                        <tr>
                            <?php
                                $sql = "SELECT * FROM inventory WHERE charactersId = ". $_GET['id'];
                                $itens = $conn->query($sql);

                                while ($item = $itens -> fetch_array()) 
                                {
                                    echo "
                                        <tr>
                                            <th>
                                                <textarea type='text' style='margin-left: 10px; border-color: lightgrey; background-color: white; width: 75px; height: 50px; resize: none;' 
                                                onchange='this.value = ValueChanged(". $item['inventoryId'] . ", \"name\", this.value, \"skill\");' >".  $item['name'] . "</textarea>
                                            <td>
                                                <textarea type='text' style='margin-left: 10px; border-color: lightgrey; background-color: white; width: 400px; height: 50px; resize: none;' 
                                                onchange='this.value = ValueChanged(". $item['inventoryId']. ", \"description\", this.value, \"inventory\");' >". $item['description'] . "</textarea>
                                            </td>
                                        </tr>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <button style='background-color: transparent; width: 100px' onclick="NewItem(<?php echo $sheet['charactersId'] ?>, 'inventory'); window.location.reload();">Adicionar</button>
            </div>
        </div>

        <br>

        <div align=center style="font-size: 15px; font-weight: bold">Anotações</div>

        <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: black; padding: 5px;
                font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none;" 
        placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'annotations', this.value, 'text');" ><?php echo $sheet['annotations'] ?></textarea>

        <br>
        
        <div align=center style="font-size: 15px; font-weight: bold">Descrição Pessoal</div>
            <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: black; padding: 5px;
                font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'personalDescription', this.value, 'text');" ><?php echo $sheet['personalDescription'] ?></textarea>
        <br>

        <div align=center style="font-size: 15px; font-weight: bold">História</div>

        <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: black; padding: 5px;
                font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none;" 
        placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'story', this.value, 'text');" ><?php echo $sheet['story'] ?></textarea>

        <br>
        <div class="row">
            <div class="col-6">
                <div align=center style="font-size: 15px; font-weight: bold">Pessoas Importantes</div>

                
                <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: black; padding: 5px;
                font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'people', this.value, 'text');" ><?php echo $sheet['people'] ?></textarea>

                <br>

                <div align=center style="font-size: 15px; font-weight: bold">Fobias e Manias</div>

                <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: black; padding: 5px;
                font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'fears', this.value, 'text');" ><?php echo $sheet['fears'] ?></textarea>

                <br>

            </div>
            <div class="col-6">
                <div align=center style="font-size: 15px; font-weight: bold">Marcas e Cicatrizes</div>

                <textarea type="text" style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: black; padding: 5px;
                font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'scars', this.value, 'text');" ><?php echo $sheet['scars'] ?></textarea>

                <br>

                <div align=center style="font-size: 15px; font-weight: bold">Ferimentos</div>

                <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: black; padding: 5px;
                font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none;" 
                placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'wounds', this.value, 'text');" ><?php echo $sheet['wounds'] ?></textarea>

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

<script src="javascript/filter.js"></script>
<script src="javascript/characterssheet.js"></script>
<?php
    include_once 'footer.php';
?>