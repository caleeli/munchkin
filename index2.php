<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/munchkin.css?t=<?=filemtime('css/munchkin.css')?>" />
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/knockout/dist/knockout.js"></script>
        <link rel="shortcut icon" type="image/png" href="/munchkin1.png"/>
        <title>Munchkin</title>
    </head>
    <body>
        <div>
            Nombre: <input id="myName">
        </div>
        <div>
            Partida: <input id="myGame"> <button type="button" onclick="entrar()">Entrar</button> <button type="button" onclick="crearPartida()">Crear Partida</button>
            <!-- button type="button" onclick="controlZ()">Control+Z</button -->
        </div>
        <div id="game" style="display: none;">
            <div class="puerta">
                <div class="puerta1" data-bind="style: {backgroundImage:puertaOBack}, click: pateaPuerta"></div>
            </div>
            <div class="tesoros">
                <div class="tesoros1" data-bind="style: {backgroundImage:tesoroOBack}, click: robaTesoro"></div>
            </div>
            <div class="trash">
                <div class="trash1" data-bind="style: {backgroundImage:trash1Last}, click: toTrash1"></div>
                <div class="trash2" data-bind="style: {backgroundImage:trash2Last}, click: toTrash2"></div>
                <div class="trash1Buttons">
                    <button type="button" data-bind="click: trash1RotateUp">&lt;</button><button type="button" data-bind="click: trash1RotateDown">&gt;</button>
                </div>
                <div class="trash2Buttons">
                    <button type="button" data-bind="click: trash2RotateUp">&lt;</button><button type="button" data-bind="click: trash2RotateDown">&gt;</button>
                </div>
            </div>
            <!--div class="mano" >
                <div class="mano1" data-bind="style: {backgroundImage:mano}"></div>
            </div -->
            <div class="zoom"></div>
            <script type="text/html" id="tablero">
                <div class="tablero">
                    <img class="tablero" src="img/table.jpg">
                    <div class="playerName" data-bind="text: name"></div>
                    <div class="playerGold"><input data-bind="textInput: goldPre" /><button type="button" data-bind="click: setGold">set</button></div>
                    
                    <div class="playerLevel" data-bind="text: level"></div>
                    <div class="minusLevel" data-bind="click: minusLevel"></div>
                    <div class="plusLevel" data-bind="click: plusLevel"></div>
                    <div name="class1" class="card-vertical class1" data-bind="style: {backgroundImage:class1}, click: coloca"></div>
                    <div name="class2"  class="card-vertical class2" data-bind="style: {backgroundImage:class2}, click: coloca"></div>
                    <div name="class3"  class="card-vertical class3" data-bind="style: {backgroundImage:class3}, click: coloca"></div>
                    <div name="curse1"  class="card-vertical curse1" data-bind="style: {backgroundImage:curse1}, click: coloca"></div>
                    <div name="curse2"  class="card-vertical curse2" data-bind="style: {backgroundImage:curse2}, click: coloca"></div>
                    <div name="ally1" class="card-vertical ally1" data-bind="style: {backgroundImage:ally1}, click: coloca"></div>
                    <div name="ally2" class="card-vertical ally2" data-bind="style: {backgroundImage:ally2}, click: coloca"></div>
                    <div name="ally3" class="card-vertical ally3" data-bind="style: {backgroundImage:ally3}, click: coloca"></div>
                    <div name="head1" class="card-vertical head1" data-bind="style: {backgroundImage:head1}, click: coloca"></div>
                    <div name="head2" class="card-vertical head2" data-bind="style: {backgroundImage:head2}, click: coloca"></div>
                    <div name="armor1"  class="card-vertical armor1" data-bind="style: {backgroundImage:armor1}, click: coloca"></div>
                    <div name="armor2"  class="card-vertical armor2" data-bind="style: {backgroundImage:armor2}, click: coloca"></div>
                    <div name="feet1"  class="card-vertical feet1" data-bind="style: {backgroundImage:feet1}, click: coloca"></div>
                    <div name="feet2"  class="card-vertical feet2" data-bind="style: {backgroundImage:feet2}, click: coloca"></div>
                    <div name="handsLeft1"  class="card-vertical hands-left1" data-bind="style: {backgroundImage:handsLeft1}, click: coloca"></div>
                    <div name="handsLeft2"  class="card-vertical hands-left2" data-bind="style: {backgroundImage:handsLeft2}, click: coloca"></div>
                    <div name="handsRight1" class="card-vertical hands-right1" data-bind="style: {backgroundImage:handsRight1}, click: coloca"></div>
                    <div name="handsRight2" class="card-vertical hands-right2" data-bind="style: {backgroundImage:handsRight2}, click: coloca"></div>
                    <div name="extra1"  class="card-vertical extra1" data-bind="style: {backgroundImage:extra1Back}, click: coloca"></div>
                    <div name="extra2"  class="card-vertical extra2" data-bind="style: {backgroundImage:extra2Back}, click: coloca"></div>
                    <div name="extra3"  class="card-vertical extra3" data-bind="style: {backgroundImage:extra3Back}, click: coloca"></div>
                    <div name="extra4"  class="card-vertical extra4" data-bind="style: {backgroundImage:extra4Back}, click: coloca"></div>
                    <div name="extra5"  class="card-vertical extra5" data-bind="style: {backgroundImage:extra5Back}, click: coloca"></div>
                    <div name="mano"  class="card-horizontal backpack0" data-bind="style: {backgroundImage:manoBack}, click: coloca">draw</div>
                    <div name="backpack1"  class="card-horizontal backpack1" data-bind="style: {backgroundImage:backpack1Back}, click: coloca"></div>
                    <div name="backpack2"  class="card-horizontal backpack2" data-bind="style: {backgroundImage:backpack2Back}, click: coloca"></div>
                    <div name="backpack3"  class="card-horizontal backpack3" data-bind="style: {backgroundImage:backpack3Back}, click: coloca"></div>
                    <div name="backpack4"  class="card-horizontal backpack4" data-bind="style: {backgroundImage:backpack4Back}, click: coloca"></div>
                    <div name="backpack5"  class="card-horizontal backpack5" data-bind="style: {backgroundImage:backpack5Back}, click: coloca"></div>
                    <div name="character1" class="card-vertical character1" data-bind="style: {backgroundImage:character1}, click: coloca"></div>
                    <div name="character2" class="card-vertical character2" data-bind="style: {backgroundImage:character2}, click: coloca"></div>
                </div>
            </script>
            <div data-bind="foreach: players">
                <div data-bind="if: $data.name()===playerName">
                    <div data-bind="template: {name:'tablero', data: $data}"></div>
                </div>
            </div>
            <div data-bind="foreach: players">
                <div data-bind="if: $data.name()!==playerName">
                    <div data-bind="template: {name:'tablero', data: $data}"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="munchkin.js?t=<?=filemtime('munchkin.js')?>"></script>
    </body>
</html>