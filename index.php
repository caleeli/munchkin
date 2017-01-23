<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/munchkin.css" />
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/knockout/dist/knockout.js"></script>
    </head>
    <body>
        <div>
            Nombre: <input id="myName" data-bind="textInput: name"> <button type="button" data-bind="click: entrar">Entrar</button>
        </div>
        <div class="puerta">
            <div class="puerta1" data-bind="style: {backgroundImage:puerta}, click: pateaPuerta"></div>
        </div>
        <div class="tesoros">
            <div class="tesoros1" data-bind="style: {backgroundImage:tesoro}, click: robaTesoro"></div>
        </div>
        <div class="trash">
            <div name="trash" class="trash1" data-bind="style: {backgroundImage:trash}, click: toTrash"></div>
        </div>
        <div class="mano" data-bind="foreach: mano, click: roba">
            <div class="mano1" data-bind="style: {backgroundImage:$data}"></div>
        </div>
        <div class="zoom"></div>
        <script type="text/html" id="tablero">
            <div class="tablero">
                <img class="tablero" src="img/table.jpg">
                <div class="playerName" data-bind="text: name"></div>
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
                <div name="extra1"  class="card-vertical extra1" data-bind="style: {backgroundImage:extra1}, click: coloca"></div>
                <div name="extra2"  class="card-vertical extra2" data-bind="style: {backgroundImage:extra2}, click: coloca"></div>
                <div name="extra3"  class="card-vertical extra3" data-bind="style: {backgroundImage:extra3}, click: coloca"></div>
                <div name="extra4"  class="card-vertical extra4" data-bind="style: {backgroundImage:extra4}, click: coloca"></div>
                <div name="extra5"  class="card-vertical extra5" data-bind="style: {backgroundImage:extra5}, click: coloca"></div>
                <div name="backpack1"  class="card-horizontal backpack1" data-bind="style: {backgroundImage:backpack1}, click: coloca"></div>
                <div name="backpack2"  class="card-horizontal backpack2" data-bind="style: {backgroundImage:backpack2}, click: coloca"></div>
                <div name="backpack3"  class="card-horizontal backpack3" data-bind="style: {backgroundImage:backpack3}, click: coloca"></div>
                <div name="backpack4"  class="card-horizontal backpack4" data-bind="style: {backgroundImage:backpack4}, click: coloca"></div>
                <div name="backpack5"  class="card-horizontal backpack5" data-bind="style: {backgroundImage:backpack5}, click: coloca"></div>
                <div name="character" class="character" data-bind="style: {backgroundImage:character}, click: coloca"></div>
            </div>
        </script>
        <div data-bind="foreach: players">
            <div data-bind="template: {name:'tablero', data: $data}"></div>
        </div>
        <script type="text/javascript">
            function Tablero() {
                var self = this;
                this.name = ko.observable("");
                this.level = ko.observable(1);
                this.class1 = ko.observable();
                this.class2 = ko.observable();
                this.class3 = ko.observable();
                this.curse1 = ko.observable();
                this.curse2 = ko.observable();
                this.ally1 = ko.observable();
                this.ally2 = ko.observable();
                this.ally3 = ko.observable();
                this.head1 = ko.observable();
                this.head2 = ko.observable();
                this.armor1 = ko.observable();
                this.armor2 = ko.observable();
                this.feet1 = ko.observable();
                this.feet2 = ko.observable();
                this.handsLeft1 = ko.observable();
                this.handsLeft2 = ko.observable();
                this.handsRight1 = ko.observable();
                this.handsRight2 = ko.observable();
                this.extra1 = ko.observable();
                this.extra2 = ko.observable();
                this.extra3 = ko.observable();
                this.extra4 = ko.observable();
                this.extra5 = ko.observable();
                this.backpack1 = ko.observable();
                this.backpack2 = ko.observable();
                this.backpack3 = ko.observable();
                this.backpack4 = ko.observable();
                this.backpack5 = ko.observable();
                this.character = ko.observable();
                this.coloca = function(object, event){
                    transaction(function(){
                        var name =event.target.getAttribute("name");
                        if(!currentCard) {
                            $(".selected").removeClass("selected");
                            $(event.target).addClass("selected");
                            currentCard = self[name]();
                            currentSlot = self[name];
                            currentDefault = '';
                            return;
                        }
                        currentSlot(currentDefault);
                        self[name](currentCard);
                        currentCard='';
                        $(".selected").removeClass("selected");
                    });
                }
                this.minusLevel = function(){
                    transaction(function(){
                        self.level(self.level()-1);
                    });
                }
                this.plusLevel = function(){
                    transaction(function(){
                        self.level(self.level()+1);
                    });
                }
            }
            function MyViewModel() {
                var self = this;
                this.name=ko.observable("");
                this.puerta = ko.observable("url('img/Scan 0.jpeg')");
                this.tesoro = ko.observable("url('img/Scan 96.jpeg')");
                this.trash = ko.observable();
                this.mano = ko.observableArray([]);
                this.players = ko.observableArray([
                ]);
                this.pateaPuerta = function(object, event) {
                    transaction(function(){
                        var puerta;
                        if(self.puerta()=="url('img/Scan 0.jpeg')") {
                            puerta = window.data.puertas.pop();
                        } else {
                            puerta = self.puerta();
                        }
                        $(".selected").removeClass("selected");
                        $(event.target).addClass("selected");
                        self.puerta(puerta);
                        currentSlot=self.puerta;
                        currentCard = puerta;
                        currentDefault = "url('img/Scan 0.jpeg')";
                    });
                }
                this.robaTesoro = function(object, event) {
                    transaction(function(){
                        var tesoro;
                        if(self.tesoro()=="url('img/Scan 96.jpeg')") {
                            tesoro = window.data.tesoros.pop();
                        } else {
                            tesoro = self.tesoro();
                        }
                        $(".selected").removeClass("selected");
                        $(event.target).addClass("selected");
                        self.tesoro(tesoro);
                        currentSlot=self.tesoro;
                        currentCard = tesoro;
                        currentDefault = "url('img/Scan 96.jpeg')";
                    });
                }
                this.roba = function(object, event){
                    var index = $(event.target).parent().children().index(event.target);
                    transaction(function(){
                        if(!currentCard) {
                            $(".selected").removeClass("selected");
                            $(event.target).addClass("selected");
                            currentCard = self.mano()[index];
                            currentSlot = function(newVal){
                                self.mano.splice(index,1,newVal);
                                if(!newVal) {
                                    self.mano.splice(index,1);
                                } else {
                                    self.mano.splice(index,1,newVal);
                                }
                            };
                            currentDefault = '';
                            $(".selected").removeClass("selected");
                            return;
                        }
                        currentSlot(currentDefault);
                        self.mano.push(currentCard);
                        currentCard='';
                    });
                }
                this.toTrash = function(object, event) {
                    transaction(function(){
                        var name = event.target.getAttribute("name");
                        if(!currentCard) {
                            /*$(".selected").removeClass("selected");
                            $(event.target).addClass("selected");
                            currentCard = self[name]();
                            currentSlot = self[name];
                            currentDefault = '';*/
                            return;
                        }
                        name = currentCard.indexOf("Treasures")!=-1? 'tesoros':'puertas';
                        currentSlot(currentDefault);
                        window.data[name].unshift(currentCard);
                        currentCard='';
                        $(".selected").removeClass("selected");
                    });
                }
                this.entrar = function(){
                    playerName = self.name();
                    load();
                    setInterval(function(){
                        load();
                    }, REFRESH_TIME);
                }
            }
            function save(tr){
                data.puerta = vm.puerta();
                data.tesoro = vm.tesoro();
                data.manos[playerId] = vm.mano();
                data.players = ko.toJS(vm.players());
                $.ajax({
                    method:'POST',
                    data: {
                        data: JSON.stringify(window.data)
                    },
                    url: 'partida.php'+location.search+(tr?'&t='+tr:''),
                    dataType:'json',
                    success:function(newData){
                    }
                });
            }
            function load(fn){
                var tr = new Date().getTime() + Math.random();
                $.ajax({
                    method:'GET',
                    url: 'partida.php'+location.search+'&t='+tr,
                    dataType:'json',
                    success:function(data){
                        loadData(data, tr, fn);
                    }
                });
            }
            var transaction = load;
            function loadData(data, tr, fn) {
                window.data = data;
                vm.puerta(data.puerta);
                vm.tesoro(data.tesoro);
                if(playerId===null) {
                    for(var i=0,l=data.players.length;i<l;i++){
                        if(playerName==data.players[i].name) {
                            playerId = i;
                            break;
                        }
                    }
                }
                if(playerId===null) {
                    playerId=data.players.length;
                }
                if(typeof data.manos[playerId] ==='undefined') {
                    data.manos[playerId] = [];
                    for(var j=0;j<window.INITIAL_CARDS;j++) {
                        data.manos[playerId].push(data.puertas.pop());
                    }
                    for(var j=0;j<window.INITIAL_CARDS;j++) {
                        data.manos[playerId].push(data.tesoros.pop());
                    }
                }
                if(typeof data.players[playerId] ==='undefined') {
                    var tab = new Tablero();
                    data.players[playerId] = ko.toJS(tab);
                    data.players[playerId].name = playerName;
                }
                loadArray(vm.mano, data.manos[playerId]);
                for(var i=0,l=data.players.length;i<l;i++) {
                    if(typeof vm.players()[i]==='undefined') {
                        vm.players.push(new Tablero());
                    }
                    loadPlayer(vm.players()[i], data.players[i]);
                }
                if(typeof fn==='function') {
                    fn();
                }
                save(tr);
            }
            function loadPlayer(player, dataPlayer){
                for(var a in dataPlayer) {
                    if(typeof a==='string' && typeof dataPlayer[a]!="function") {
                        player[a](dataPlayer[a]);
                    }
                }
            }
            function loadArray(array, dataArray){
                array.removeAll();
                for(var i=0,l=dataArray.length;i<l;i++){
                    array.push(dataArray[i]);
                }
            }
            ////////////////////////// MAIN ////////////////////////////////////
            window.data= {time:0};
            window.INITIAL_CARDS = 4;
            var REFRESH_TIME = 5000;
            var playerName=null, playerId=null;
            var vm = new MyViewModel();
            var currentCard, currentSlot, currentDefault;
            ko.applyBindings(vm);
            $("body").mousemove(function(event){
                if(event.target.style.backgroundImage) {
                    $(".zoom").css("background-image", event.target.style.backgroundImage);
                }
            });

            function moveCard(action, card, to) {
                $.ajax({
                    url: 'log.php',
                    data: {
                        move: window.currentMove,
                        action: action,
                        card: card,
                        to: to
                    },
                    dataType: 'json',
                    success: function(pack) {
                        var data = pack.data;
                        window.currentMove = pack.currentMove;
                        for(var i=0,l=data.length;i<l;i++) {
                            var target = vm;
                            if(data[i].to.indexOf(".")!=-1) {
                                //var ids =
                            } else if(data[i].to=='puertas') {
                                target = window.data[data[i].to];
                            } else if(data[i].to=='tesoros') {
                                target = window.data[data[i].to];
                            } else {
                                target = vm[data[i].to];
                            }
                        }
                    }
                });
            }
        </script>

        <script src="https://www.gstatic.com/firebasejs/3.6.2/firebase.js"></script>
        <script>
          // Initialize Firebase
          // TODO: Replace with your project's customized code snippet
          var config = {
            apiKey: "AIzaSyBsS3jvdCDr1HJJ7YIMZq_H-eZfdHrwihw",
            authDomain: "munchkin-bb523.firebaseapp.com",
            databaseURL: "https://munchkin-bb523.firebaseio.com",
            storageBucket: "munchkin-bb523.appspot.com",
            messagingSenderId: "16912235946",
          };
          firebase.initializeApp(config);
        </script>
    </body>
</html>