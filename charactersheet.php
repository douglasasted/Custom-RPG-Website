<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';

    # Constantes
    $hasDomain = false;

    if (!isset($_GET['id'])) 
        header("location: index.php");

    $id = $_GET['id'];
    $name = "";

    $sql = "SELECT * FROM characters WHERE charactersId = ". $_GET['id'];
    $result = $conn->query($sql);
    $sheet = $result->fetch_assoc();

    if ($sheet['charactersPlayer'] !== $_SESSION['username'] && $_SESSION['username'] != "douglas_asted") 
        header("location: index.php");

    $monster = false;
    if ($sheet['charactersPlayer'] == 'monster') 
        $monster = true;

    # Functions

    # Stat Function
    function EchoStats ($name, $ptname) 
    {
        global $sheet;

        echo '
        <span>
            <dt id="stats-title" class="col-sm-4 h6"><span id="' . strtolower($name) . '-title">' . $ptname . '</span></dt>
            <dd id="stats-container" class="col-sm-8 text-center">
                <input id="stats-text" type="text" value="'. $sheet['characters'. $name] .'"
                oninput="this.value = ValueChanged('. $sheet['charactersId'] . ', \'characters'. $name .'\', this.value, 100);" 
                onblur="this.value = FocusChanged(this.value, \'text\');" /> 
                    / 
                <input id="stats-text" type="text" value="'. $sheet['charactersMax'. $name ] . '"
                oninput="this.value = ValueChanged(' . $sheet['charactersId'] . ', \'charactersMax'. $name .'\', this.value, 100);" 
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
            <dt class="col-sm-4 h6" style="font-size: 14px; color: var(--grey-color);">
                ' . $ptname . '
            </dt>

            <dd class="col-sm-8 h6" style="font-weight: normal; color: white;">
                ' . $sheet["characters" . $name] . '
            </dd>
        ';
    }

    # Editable info function
    function EchoEditInfo($name, $ptname) 
    {
        global $sheet;
        Echo '
            <dt class="col-sm-4 h6" style="font-size: 14px; margin-bottom: 5px !important; color: var(--grey-color);">'. $ptname . '</dt>
            <dd class="col-sm-8 h6" style="margin-bottom: 5px !important; font-weight: normal; color: white;">    
                <input type="text" value="'. $sheet["characters" . $name] . '" 
                style="width: 100%; outline: none; background-color: transparent; color:white;" 
                placeholder="..." oninput="this.value = ValueChanged('. $sheet["charactersId"] . ', \'characters'. $name .'\', this.value, \'text\');" 
                onblur="this.value = FocusChanged(this.value, \'text\');" />
            </dd>
        ';
    }

    function EchoEditExpertise($name) 
    {
        global $conn;
        
        $sql = "SELECT * FROM expertises WHERE expertisesCharactersId = ". $_GET['id'] . " AND expertisesCategory = " . $name;
        $expertises = $conn->query($sql);

        while ($expertise = $expertises -> fetch_array()) 
        {
            $checkbox = "";
            if ($expertise['expertisesCheck'] == 1)
            {
                $checkbox = "checked";
            }
            echo " 
            <li style='background-color: transparent'>
                <tr>
                    <input type='checkbox' " . $checkbox . " onclick='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertisesCheck\", this.checked, \"check\");'/>
                    <td> 
                        <input onclick='Roll(\"expertise " . $sheet['charactersId'] . " " . $expertise['expertisesValue'] . " " . $expertise['expertisesName'] ."\");' type='image' src='imgs/dice.png' width='15' height='15'/>
                        <input type='text' value=". $expertise['expertisesValue'] . " 
                            style='width: 25px; outline: none; font-weight: bold; background-color: transparent'  
                            oninput='this.checked = ValueChanged(" . $expertise['expertisesId'] . ", \"expertiseValue\", this.value, \"charExpertise\");' 
                            onblur='this.checked = FocusChanged(this.value, \"char\");' />
                    </td>
                    <span>
                        <th>
                            <input type='text' value='" . $expertise['expertisesName'] . "' 
                                style='width: 110px; height: 25px; outline: none; color: rgb (0, 0, 161) !important; background-color: transparent' 
                                placeholder='...' oninput='this.value = ValueChanged(" . $expertise['expertisesId'] . ", \"expertisesName\", this.value, \"expertise\");' 
                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                            <span style='font-size: 0px; width: 0px; display: inline-block'>".$expertise['expertisesName']."</span>
                        </th>
                    </span>
                </tr>
            </li>";
        }
    }

    function EchoCharacteristic($name, $ptname) 
    {
        global $sheet;
        Echo '    
            <th style="width: 200px; background-color: transparent">
                <input onclick="Roll(\'charactersChar' . $name . ' ' . $sheet['charactersId'] . '\');" type=\'image\' src=\'imgs/dice.png\' width=\'15\' height=\'15\'/>
                
                <input type="text" value="' . $sheet['charactersChar' . $name] . '" 
                style="width: 25px; outline: none; font-weight: bold; background-color: transparent; color: white" 
                oninput="this.value = ValueChanged(' . $sheet['charactersId'] . ', \'charactersChar' . $name . '\', this.value, \'100\');" 
                onblur="this.value = FocusChanged(this.value, \'char\');" />

                <span class="h1" style="font-size: 13px; color: white; ">' . $ptname . '</span>
            </th>';
    }
?>

<div id="Sheet" class="sheet">
    <div class="row">

        <?php
        
        if ($_SESSION['username'] == "douglas_asted")
            echo '
            <br>
            <div class="text-center" style="margin-right: 90px">
                <spam style="margin-right: 25px;">Ficha do Personagem </spam> --
                <a onclick="openSheet(\'Config\')" href="#" style="margin-left: 25px;"> Configurações</a>
            </div>';

        ?>

        <!--Left side bar-->
        <div class="col-3">
            <br>

            <!--Current Level-->
            <h1 class="h6 text-center" style='font-size: 14px; color: var(--grey-color); margin-bottom: -20px'>
                Nivel 
                <input style="background-color: transparent" id="smallinput" type="text" value="<?php echo $sheet['charactersLevel'] ?>"
                oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersLevel', this.value, 20);" 
                onblur="this.value = FocusChanged(this.value, 'text');" />
            <h1>

            <!--Name Title-->
            <h1 class="display-6">
                <input id="normaltitle" type="text" value="<?php echo $sheet['charactersName'] ?>"
                placeholder="???" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersName', this.value, 'text');" 
                onblur="this.value = FocusChanged(this.value, 'text');" />
            <h1>

            <d1 class="row">
                <!--Status-->

                <!--Lifes Texts-->
                <!--All character sheets has life, but other stats can be blocked-->
                <?php
                    #All character sheets has life, but other stats can be blocked
                    EchoStats('Health', 'Vida'); #Echo the life
                    if (!$monster) #Echo the sanity if it's not a monster
                        EchoStats('Sanity', 'Sanidade'); 
                    if ($hasDomain) #Echo the domain if is enabled
                        EchoStats('Domain', 'Dominio'); 
                    
                    #Information for Roleplay
                    EchoEditInfo('Occupation', 'Ocupação'); #Echo player occupation
                    EchoEditInfo('Age', 'Idade'); #Echo player age
                    EchoEditInfo('Gender', 'Genêro'); #Echo player gender
                    EchoEditInfo('Residence', 'Residência'); #Echo player residence
                    EchoEditInfo('Birth', 'L. Nasc'); #Echo player born place
                ?>
            
                <br>

                <div style='padding: 0px'>
                    <div align=center style="font-size: 15px; font-weight: bold; margin-right: 50px">Pericias</div>
                    <input type="text" style="background-color: transparent; border-color: var(--grey-color); border-style: solid; border-width: 2px; margin: 8px" id="myInput" onkeyup="myFunction()" placeholder="Pesquise Pericia">
                    <ul id="myUL">
                        <?php
                            $sheetkeys = array_keys($sheet);
                            $n = 0;

                            foreach ($sheetkeys as $key) 
                            {
                                if (substr($key, 10, 4) == "Char") 
                                {
                                    $n += 1;
                                    if ($n > 8) 
                                    {
                                        $name = substr($key, 14);
                                        $check = "charactersCheck" . $name;
                                        $checkbox = "";

                                        if ($sheet[$check] == 1)
                                            $checkbox = "checked";

                                        # Some 
                                        if ($name == "ArmasDeFogo") $name = "Armas de Fogo";
                                        if ($name == "ArteEOficio") $name = "Arte e Oficio";
                                        if ($name == "Avaliacao") $name = "Avaliação";
                                        if ($name == "ConsertosElet") $name = "Consertos Elet.";
                                        if ($name == "ConsertosMec") $name = "Consertos Mec.";
                                        if ($name == "PrimeirosSocorros") $name = "Prim. Socorros";
                                        if ($name == "IdiomaNativo") $name = "Idioma (Nativo)";
                                        if ($name == "LutarBriga") $name = "Lutar (Briga)";
                                        if ($name == "OpMaquinario") $name = "Op. Maquinário";

                                        echo " 
                                            <li style='background-color: transparent'>
                                                <tr>
                                                    <input type='checkbox' " . $checkbox . " onclick='this.value = ValueChanged(" . $sheet['charactersId'] . ", \"" . $check . "\", this.checked, \"text\");'/>
                                                    <td> 
                                                        <input onclick='Roll(\"" . $key . " " . $sheet['charactersId'] . "\");' type='image' src='imgs/dice.png' width='15' height='15'/>
                                                        
                                                        <input type='text' value=". $sheet[$key] . " 
                                                        style='width: 25px; outline: none; font-weight: bold; background-color: transparent; color: white' 
                                                        oninput='this.checked = ValueChanged(" . $sheet['charactersId'] . ", \"" . $key . "\", this.value, \"100\");' 
                                                        onblur='this.checked = FocusChanged(this.value, \"char\");' />
                                                    </td>
                                                    <th>
                                                        <span style='font-weight: light; font-size: 15px; width: 700px;'>". $name . "</span>
                                                    </th>
                                                </tr>
                                            </li>";
                                        
                                        # Subcategorias
                            #            if ($name == "Ciencia") 
                            #                EchoEditExpertise("charactersCharCiencia");
                            #            if ($name == "Arte e Oficio") 
                            #                EchoEditExpertise("charactersCharArteEOficio");
                            #            else if ($name == "Sobrevivencia") 
                            #                EchoEditExpertise("charactersCharSobrevivencia");
                            #            else if ($name == "Idioma (Nativo)") 
                            #                EchoEditExpertise("charactersCharIdioma");
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </d1>
            
        </div>
        <div class="col-8" style="margin: 0px; background-color: transparent">
            <br><br>
            
            <!-- Characteristic Values -->
            <!-- #region -->
                <div class="text-center" style="font-size: 15px; font-weight: bold; margin-right: 15px">Caracteristicas</div>
                <div class="row center" style="width:550px; background-color: transparent">
                    <div class="col-4">
                        <table class="table">
                            <tbody style="border: transparent;">
                                <tr><td></td><th scope="row"></th></tr>
                                <tr> <?php EchoCharacteristic("Strength", "Força"); ?> </tr>
                                <tr> <?php EchoCharacteristic("Dexterity", "Destreza"); ?> </tr>
                                <tr> <?php EchoCharacteristic("Intelligence", "Inteligência"); ?> </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table">
                            <tbody style="border: transparent;">
                                <tr><td></td><th scope="row"></th></tr>
                                <tr> <?php EchoCharacteristic("Constitution", "Constituição"); ?> </tr>
                                <tr> <?php EchoCharacteristic("Appearance", "Aparência"); ?> </tr>
                                <tr> <?php EchoCharacteristic("Power", "Poder"); ?> </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table class="table">
                            <tbody  style="border: transparent;">
                                <tr><td></td><th scope="row"></th></tr>
                                <tr> <?php EchoCharacteristic("Size", "Tamanho"); ?> </tr>
                                <tr> <?php EchoCharacteristic("Education", "Educação"); ?> </tr>
                                <tr> <!-- Sorte --> </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <!-- #endregion -->

            <div class="row center" style="width: 450px">
                <div class="col-5" style="margin-left: 25px">
                    <table class="table" style=" border: white;">
                        <tbody style='border-color: transparent;'>
                            <tr><td></td><th scope="row"></th></tr>
                            <tr>
                                <th>
                                    <input onclick="Roll('Exp <?php echo $sheet['charactersId']?>');" type='image' src='imgs/dice.png' width='15' height='15'/>
                                    <input type="text" value="<?php echo $sheet['charactersExposure'] ?>" 
                                        style="width: 35px; font-size: 15px; outline: none; font-weight: bold;background-color: transparent; color: white" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersExposure', this.value, '100');" 
                                        onblur="this.value = FocusChanged(this.value, 'null');" />
                                    <spam class='h1' style='font-size: 13px; color: white'>Exposição</spam>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <input type="text" value="<?php echo $sheet['charactersArmor'] ?>" 
                                        style="margin-left: 18px; width: 35px; outline: none; font-weight: bold;background-color: transparent; color: white" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersArmor', this.value, '100');" 
                                        onblur="this.value = FocusChanged(this.value, 'null');" />
                                    <spam class='h1' style='font-size: 13px; color: white'>Armadura</spam>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-5">
                    <table class="table"  style=" border: white;">
                        <tbody style='border-color: transparent;'>
                            <tr><td></td><th scope="row"></th></tr>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $sheet['charactersBaseDamage'] ?>" 
                                        style="width: 35px; outline: none; font-weight: bold;background-color: transparent; color: white" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersBaseDamage', this.value, 'text');" 
                                        onblur="this.value = FocusChanged(this.value, 'text');" />
                                    <spam class='h1' style='font-size: 13px; width: 70px; color: white'>Bonus de Dano</spam>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $sheet['charactersMovement'] ?>" 
                                        style="width: 35px; outline: none; font-weight: bold; background-color: transparent; color: white" 
                                        placeholder="" oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersMovement', this.value, 12);" 
                                        onblur="this.value = FocusChanged(this.value, 'text');" />
                                    <spam class='h1' style='font-size: 13px; width: 70px; color: white'>Movimento</spam>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>                
            <br>

            <!-- #region Sketch -->
                <!--    <p>
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
                    #           <?php
                    #               $sql = "SELECT * FROM guns WHERE charactersId = ". $_GET['id'];
                    #               $guns = $conn->query($sql);
                    #
                    #               while ($gun = $guns -> fetch_array()) 
                    #               {
                    #                   echo " 
                    #                       <tr>
                    #                           <th> 
                    #                               <input type='text' value='" . $gun['name'] ."' 
                    #                                   style='width: 75px; outline: none; background-color: transparent;' 
                    #                                   oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"name\", this.value, \"gun\");' 
                    #                                   onblur='this.value = FocusChanged(this.value, \"text\");' />
                    #                           </th>
                    #                           <td> 
                    #                               <input type='text' value='" . $gun['damage'] ."' 
                    #                                   style='width: 75px; outline: none;background-color: transparent;' 
                    #                                   oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"damage\", this.value, \"gun\");' 
                    #                                   onblur='this.value = FocusChanged(this.value, \"text\");' />
                    #                           </td>
                    #                           <td> 
                    #                               <input type='text' value='" . $gun['skill'] ."' 
                    #                                   style='width: 125px; outline: none;background-color: transparent;' 
                    #                                   oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"skill\", this.value, \"gun\");' 
                    #                                   onblur='this.value = FocusChanged(this.value, \"text\");' />
                    #                           </td>
                    #                           <td> 
                    #                               <input type='text' value='" . $gun['ammo'] ."' 
                    #                                   style='width: 65px; outline: none;background-color: transparent;' 
                    #                                   oninput='this.value = ValueChanged(" . $gun['gunsId'] . ", \"ammo\", this.value, \"gun\");' 
                    #                                   onblur='this.value = FocusChanged(this.value, \"text\");' />
                    #                           </td>
                    #                       </tr>";
                    #               }
                    #           ?>
                            </table>
                            </tbody>
                            <button style='background-color: transparent; width: 100px' onclick="NewItem(<?php # echo $sheet['charactersId'] ?>, ''); window.location.reload();">Adicionar</button>
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
                    #                $sql = "SELECT * FROM rituals WHERE charactersId = ". $_GET['id'];
                    #                $rituals = $conn->query($sql);
                    #
                    #                while ($ritual = $rituals -> fetch_array()) 
                    #                {
                    #                    echo "
                    #                    <tr>
                    #                        <th>
                    #                            <textarea type='text' style='font-size:12px; border-color: transparent; width: 100%; height: 125px; resize: none; background-color: transparent;' 
                    #                            onchange='this.value = ValueChanged(". $ritual['ritualsId']. ", \"name\", this.value, \"ritual\");' >". $ritual['name'] . "</textarea>
                    #                        </th>
                    #                        <th>
                    #                            <input type='text' value='" . $ritual['sanity'] ."'
                    #                                style='width: 100%; outline: none;  background-color: transparent;' 
                    #                                oninput='this.value = ValueChanged(" . $ritual['ritualsId'] . ", \"sanity\", this.value, \"ritual\");' 
                    #                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                    #                        </th>
                    #                        <th>
                    #                            <input type='text' value='" . $ritual['domain'] ."'
                    #                                style='width: 100%; outline: none; background-color: transparent;'
                    #                                oninput='this.value = ValueChanged(" . $ritual['ritualsId'] . ", \"domain\", this.value, \"ritual\");' 
                    #                                onblur='this.value = FocusChanged(this.value, \"text\");' />
                    #                        </th>
                    #                        <td>
                    #                            <textarea type='text' style='font-size: 12px; border-color: black; border-width: 2px; background-color: transparent; width: 100%; height: 125px; resize: none;' 
                    #                            onchange='this.value = ValueChanged(". $ritual['ritualsId']. ", \"description\", this.value, \"ritual\");' >". $ritual['description'] . "</textarea>
                    #                        </td>
                    #                    </tr>";
                    #                }
                    #            ?>
                            </tbody>
                        </table>
                        <button style='background-color: transparent; width: 100px' onclick="NewItem(<?php # echo $sheet['charactersId'] ?>, 'ritual'); window.location.reload();">Adicionar</button>
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
                #                 <?php
                #                     $sql = "SELECT * FROM skills WHERE charactersId = ". $_GET['id'];
                #                     $skills = $conn->query($sql);
                #
                #                     while ($skill = $skills -> fetch_array()) 
                #                     {
                #                         echo "
                #                         <tr>
                #                             <th>
                #                                 <textarea type='text' style='border-color: transparent; background-color: transparent; width: 100px; height: 75px; resize: none;' 
                #                                 onchange='this.value = ValueChanged(". $skill['skillsId']. ", \"name\", this.value, \"skill\");' >". $skill['name'] . "</textarea>
                #                             <td>
                #                                 <textarea type='text' style=' font-size: 12px; border-color: black; border-width: 2px; background-color: transparent; width: 100%; height: 75px; resize: none;' 
                #                                 onchange='this.value = ValueChanged(". $skill['skillsId']. ", \"description\", this.value, \"skill\");' >". $skill['description'] . "</textarea>
                #                             </td>
                #                         </tr>";
                #                     }
                #                 ?>
                                </tr>
                            </tbody>
                        </table>
                        <button style='background-color: transparent; width: 100px' onclick="NewItem(<?php # echo $sheet['charactersId'] ?>, 'skill'); window.location.reload();">Adicionar</button>
                    </div>
                </div> -->
            <!-- #endregion -->

            <!--#Region Inventory -->
                <p align=center style="margin-right: 30px">
                    <a data-bs-toggle="collapse" href="#inventario" role="button" aria-expanded="false" aria-controls="collapseExample" style="padding: 0; margin-left: 5px;">
                        <spam style="font-weight: bold;"> Inventário </spam>
                    </a>
                </p>
                <div class="collapse" id="inventario" style="margin-top: -15px; margin-right: 30px">
                    <div style='background-color: transparent; border: solid var(--main-color); border-width: thin;'>
                        <div style="margin-left: 10px; margin-right: 5%">
                            <div class="col-6">
                                <spam style="font-size: 13px;"> Dinheiro $ </spam>
                                <input type="text" value="<?php echo $sheet['charactersMoney'] ?>" 
                                    style="width: 100px; outline: none; background-color: transparent; color: white" 
                                    oninput="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersMoney', this.value, 999999.99);" 
                                    onblur="this.value = FocusChanged(this.value, 'text');" />
                            </div>
                            
                            <table class="table text-center" style="font-size: 15px;">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col" style="width: 1000px;">Espaços</th>
                                    </tr>
                                </thead>
                                <tbody style="border: white;">
                                    <tr>
                                    <?php
                             #          $sql = "SELECT * FROM inventory WHERE charactersId = ". $_GET['id'];
                             #          $itens = $conn->query($sql);
            
                             #          while ($item = $itens -> fetch_array()) 
                             #          {
                             #              echo "
                             #                  <tr>
                             #                      <th>
                             #                          <textarea type='text' style='margin-left: 10px; border-color: lightgrey; background-color: white; width: 75px; height: 50px; resize: none;' 
                             #                          onchange='this.value = ValueChanged(". $item['inventoryId'] . ", \"name\", this.value, \"skill\");' >".  $item['name'] . "</textarea>
                             #                      <td>
                             #                          <textarea type='text' style='margin-left: 10px; border-color: lightgrey; background-color: white; width: 400px; height: 50px; resize: none;' 
                             #                          onchange='this.value = ValueChanged(". $item['inventoryId']. ", \"description\", this.value, \"inventory\");' >". $item['description'] . "</textarea>
                             #                      </td>
                             #                  </tr>";
                             #           }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                                if ($_SESSION['username'] == "douglas_asted")
                                    Echo '<a href="#" style=\'width: 100px\' onclick="NewItem(' . $sheet['charactersId'] . ', \'inventory\'); window.location.reload();">Adicionar Novo Slot</a>';
                            ?>
                        </div>
                    </div>
                </div>
            <!-- #endregion -->

            <br>

            <!-- Roleplay Text Area -->
            <!-- #region -->

                <div id="text-area-title" class="text-center">Anotações</div>
                <textarea type="text" style="height: 200px;" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersAnnotations', this.value, 'text');" ><?php echo $sheet['charactersAnnotations'] ?></textarea>

                <br><br>
                
                <div id="text-area-title" class="text-center">Descrição Pessoal</div>
                <textarea type="text" style="height: 200px;" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersDescription', this.value, 'text');" ><?php echo $sheet['charactersDescription'] ?></textarea>
                
                <br><br>

                <div id="text-area-title" class="text-center">História</div>
                <textarea type="text"  style="height: 200px;" placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersStory', this.value, 'text');" ><?php echo $sheet['charactersStory'] ?></textarea>

                <br><br>

                <div class="row" style="margin-left: 10%">
                    <div class="col-5">
                        <div align=center style="font-size: 15px; font-weight: bold">Pessoas Importantes</div>

                        <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: var(--grey-color); padding: 5px;
                        font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none; color: white;" 
                        placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersPeople', this.value, 'text');" ><?php echo $sheet['charactersPeople'] ?></textarea>

                        <br>
                        <br>

                        <div align=center style="font-size: 15px; font-weight: bold">Fobias e Manias</div>

                        <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: var(--grey-color); padding: 5px;
                        font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none; color: white;" 
                        placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersFears', this.value, 'text');" ><?php echo $sheet['charactersFears'] ?></textarea>

                        <br>
                        <br>

                    </div>
                    <div class="col-5">
                        <div align=center style="font-size: 15px; font-weight: bold">Marcas e Cicatrizes</div>

                        <textarea type="text" style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: var(--grey-color); padding: 5px;
                        font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none; color: white;" 
                        placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersScars', this.value, 'text');" ><?php echo $sheet['charactersScars'] ?></textarea>

                        <br>
                        <br>

                        <div align=center style="font-size: 15px; font-weight: bold">Ferimentos</div>

                        <textarea type="text"  style="border-style: solid; border-width: 2px; margin-top: 5px; border-color: var(--grey-color); padding: 5px;
                        font-size: 14px; background-color: transparent; width: 100%; height: 200px; resize: none; color: white;" 
                        placeholder="" onchange="this.value = ValueChanged(<?php echo $sheet['charactersId']?>, 'charactersWounds', this.value, 'text');" ><?php echo $sheet['charactersWounds'] ?></textarea>

                        <br>
                    </div>
                </div>

            <!-- #endregion -->
        </div>
    </div>
</div>

<div id="Config" class="sheet" style="display: none">
    <div class="row">

        <br>
        <div class="text-center" style="margin-right: 90px">
            <a onclick="openSheet('Sheet')" href="#" style="margin-right: 25px;">Ficha do Personagem </a> --
            <spam style="margin-left: 25px;"> Configurações</spam>
        </div>

        <br><br>
        <div></div>

        <div align=center>
            <h1 style="color: white;"> <?php echo $sheet["charactersName"] ?> </h1>
            
            <div style="display: inline"> Jogador </div>
            
            <input type="text" value="<?php echo $sheet["charactersPlayer"]?>" 
            style="outline: solid white; outline-width: thin; background-color: transparent; color:white;" 
            placeholder="..." oninput="this.value = ValueChanged(<?php echo $sheet['charactersId'] ?>, 'charactersPlayer', this.value, 'text');" 
            onblur="this.value = FocusChanged(this.value, 'text');" />

            <br><br><br>    
            
            <a href="#" style="color:white" onclick="duplicateCharacter('<?php echo $sheet['charactersId'] ?>')">Duplicar Personagem</a> <br>
            <a href="#" onclick="deleteCharacter('<?php echo $sheet['charactersId'] ?>')" id="special">Deletar Personagem</a>
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