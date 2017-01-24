var QueryString = function () {
    // This function is anonymous, is executed immediately and
    // the return value is assigned to QueryString!
    var query_string = {};
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        // If first entry with this name
        if (typeof query_string[pair[0]] === "undefined") {
            query_string[pair[0]] = decodeURIComponent(pair[1]);
            // If second entry with this name
        } else if (typeof query_string[pair[0]] === "string") {
            var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
            query_string[pair[0]] = arr;
            // If third or later entry with this name
        } else {
            query_string[pair[0]].push(decodeURIComponent(pair[1]));
        }
    }
    return query_string;
}();

function Tablero(index) {
    var self = this;
    this.name = ko.observable("");
    this.level = ko.observable(1);
    this.gold = ko.observable(0);
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
    this.backpack1 = ko.observable();
    this.backpack2 = ko.observable();
    this.backpack3 = ko.observable();
    this.backpack4 = ko.observable();
    this.backpack5 = ko.observable();
    this.extra1 = ko.observable();
    this.extra2 = ko.observable();
    this.extra3 = ko.observable();
    this.extra4 = ko.observable();
    this.extra5 = ko.observable();
    this.character1 = ko.observable();
    this.character2 = ko.observable();
    this.mano = ko.observable();
    this.trash1Index = ko.observable();
    this.trash2Index = ko.observable();
    for (var a in self)
        if (typeof self[a] === 'function') {
            self[a].path = "vm.players()[" + index + "]." + a;
        }
    this.mano.subscribe(function () {
        if (index === playerId) {
            vm.mano(self.mano());
        }
    });
    this.trash1Index.subscribe(function () {
        var trash = vm.trash1();
        var i = trash.length - self.trash1Index();
        vm.trash1Last(trash.length > 0 ? trash[i - 1] : "url('img/Scan 0 dark.jpeg')");
    });
    this.trash2Index.subscribe(function () {
        var trash = vm.trash2();
        var i = trash.length - self.trash2Index();
        vm.trash2Last(trash.length > 0 ? trash[i - 1] : "url('img/Scan 96 dark.jpeg')");
    });
    this.manoBack = hiddenCard(self.mano, index);
    this.backpack1Back = hiddenCard(self.backpack1, index);
    this.backpack2Back = hiddenCard(self.backpack2, index);
    this.backpack3Back = hiddenCard(self.backpack3, index);
    this.backpack4Back = hiddenCard(self.backpack4, index);
    this.backpack5Back = hiddenCard(self.backpack5, index);
    this.extra1Back = hiddenCard(self.extra1, index);
    this.extra2Back = hiddenCard(self.extra2, index);
    this.extra3Back = hiddenCard(self.extra3, index);
    this.extra4Back = hiddenCard(self.extra4, index);
    this.extra5Back = hiddenCard(self.extra5, index);
    this.coloca = function (object, event) {
        transaction(function () {
            var name = event.target.getAttribute("name");
            if (player().mano()) {
                moveFrom(player().mano, self[name]);
                return;
            } else if (self[name]()) {
                moveFrom(self[name], player().mano);
            }
        });
    }
    this.minusLevel = function () {
        transaction(function () {
            setLevel(index, self.level() - 1);
        });
    }
    this.plusLevel = function () {
        transaction(function () {
            setLevel(index, self.level() + 1);
        });
    }
}
function hiddenCard(original, index) {
    return ko.computed(function () {
        var card = original();
        var back = "";
        if (card) {
            back = card.indexOf("Treasures") !== -1 ? "url('img/Scan 96.jpeg')" : "url('img/Scan 0.jpeg')";
        }
        return index !== playerId ? back : card;
    });
}
//a-->b
function moveFrom(a, b, index) {
    window.moves.push({action: 'moveFromDo', arguments: [a.path, b.path, index]});
}
function moveFromDo(ap, bp, index) {
    var aux;
    var a = eval(ap);
    var b = eval(bp);
    var av = a();
    var bv = b();
    if (!av) {
        return;
    }
    console.log('> ' + (av && typeof (av.push) === 'function' ? ap : av), (index !== null ? '[' + index + ']' : ''), '-->', b.path, '/', (bv && typeof (bv.push) === 'function' ? bp : bv));
    if (typeof (av.push) === 'function') {
        if (bv && typeof (bv.push) === 'function') {
            var av0;
            if (typeof index !== 'undefined' && index !== null) {
                av0 = a.splice(index, 1)[0];
            } else {
                av0 = a.pop();
            }
            if (av0) {
                b.push(av0);
            }
        } else {
            var av0;
            if (typeof index !== 'undefined' && index !== null) {
                av0 = a.splice(index, 1)[0];
            } else {
                av0 = a.pop();
            }
            if (av0) {
                b(av0);
            }
            if (bv) {
                a.push(bv);
            }
        }
    } else {
        if (bv && typeof (bv.push) === 'function') {
            b.push(av);
            a('');
        } else {
            b(av);
            a(bv);
        }
    }
}
function addPlayer(name) {
    window.moves.push({action: 'addPlayerDo', arguments: [name]});
    //index is loaded from server
}
function addPlayerDo(name) {
    var tab = new Tablero(vm.players().length);
    tab.name(name);
    vm.players.push(tab);
    vm.players().forEach(function (p, index) {
        if (p.name() === playerName) {
            playerId = index;
        }
    });
    initialDrawCard(vm.players().length - 1);
}
function setLevel(player, level) {
    window.moves.push({action: 'setLevelDo', arguments: [player, level]});
}
function setLevelDo(player, level) {
    vm.players()[player].level(level);
}
function addCard(name, target) {
    window.moves.push({action: 'addCardDo', arguments: [name, target]});
}
function addCardDo(name, targetPath) {
    moveFromDo('aux=function(){return ' + JSON.stringify(name) + ';}', targetPath);
}
function rotateUp(array) {
    window.moves.push({action: 'rotateUpDo', arguments: [array.path]});
}
function rotateUpDo(arrayPath) {
    var aux;
    var array = eval(arrayPath);
    array.unshift(array.pop());
}
function rotateDown(array) {
    window.moves.push({action: 'rotateDownDo', arguments: [array.path]});
}
function rotateDownDo(arrayPath) {
    var aux;
    var array = eval(arrayPath);
    array.push(array.shift());
}
function MyViewModel() {
    var self = this;
    this.name = ko.observable("");
    this.puerta = ko.observable("");
    this.tesoro = ko.observable("");
    this.puertas = ko.observableArray([]);
    this.tesoros = ko.observableArray([]);
    this.trash1 = ko.observableArray([]);
    this.trash2 = ko.observableArray([]);
    this.players = ko.observableArray([]);
    this.mano = ko.observable("");
    for (var a in self)
        if (typeof self[a] === 'function') {
            self[a].path = "vm." + a;
        }
    this.puertaOBack = ko.computed(function () {
        return self.puerta() ? self.puerta() : "url('img/Scan 0.jpeg')";
    });
    this.tesoroOBack = ko.computed(function () {
        return self.tesoro() ? self.tesoro() : "url('img/Scan 96.jpeg')";
    });
    this.trash1.subscribe(function () {
        player().trash1Index('');
        player().trash1Index(0);
    });
    this.trash2.subscribe(function () {
        player().trash2Index('');
        player().trash2Index(0);
    });
    this.trash1Last = ko.observable();
    this.trash2Last = ko.observable();
    this.trash1RotateUp = function () {
        transaction(function () {
            //rotateUp(self.trash1);
            var i = player().trash1Index();
            i--;
            if (i < 0)
                i = 0;
            player().trash1Index(i);
        });
    }
    this.trash1RotateDown = function () {
        transaction(function () {
            //rotateDown(self.trash1);
            var i = player().trash1Index();
            i++;
            if (i >= vm.trash1().length)
                i = vm.trash1().length - 1;
            player().trash1Index(i);
        });
    }
    this.trash2RotateUp = function () {
        transaction(function () {
            //rotateUp(self.trash2);
            var i = player().trash2Index();
            i--;
            if (i < 0)
                i = 0;
            player().trash2Index(i);
        });
    }
    this.trash2RotateDown = function () {
        transaction(function () {
            //rotateDown(self.trash2);
            var i = player().trash2Index();
            i++;
            if (i >= vm.trash2().length)
                i = vm.trash2().length - 1;
            player().trash2Index(i);
        });
    }
    this.pateaPuerta = function (object, event) {
        transaction(function () {
            if (self.puerta()) {
                moveFrom(self.puerta, player().mano);
            } else {
                moveFrom(self.puertas, self.puerta);
            }
        });
    }
    this.robaTesoro = function (object, event) {
        transaction(function () {
            if (self.tesoro()) {
                moveFrom(self.tesoro, player().mano);
            } else {
                moveFrom(self.tesoros, self.tesoro);
            }
        });
    }
    this.toTrash1 = function (object, event) {
        transaction(function () {
            if (player().mano()) {
                moveFrom(player().mano, self.trash1);
            } else {
                moveFrom(self.trash1, player().mano, self.trash1().length - 1 - player().trash1Index());
            }
        });
    }
    this.toTrash2 = function (object, event) {
        transaction(function () {
            if (player().mano()) {
                moveFrom(player().mano, self.trash2);
            } else {
                moveFrom(self.trash2, player().mano, self.trash2().length - 1 - player().trash2Index());
            }
        });
    }
}

function transaction(fn, fn2) {
    if (typeof fn === 'function') {
        fn();
    }
    $.ajax({
        method: 'POST',
        url: 'partida2.php' + location.search + '&c=' + window.counter,
        data: {
            data: JSON.stringify(window.moves)
        },
        dataType: 'json',
        success: function (data) {
            loadData(data);
            if (typeof fn2 === 'function') {
                fn2();
            }
        }
    });
    window.moves.length = 0;
}
function loadData(data) {
    window.counter = data.counter;
    data.moves.forEach(function (move) {
        console.log(move.action + JSON.stringify(move.arguments));
        window[move.action].apply(window, move.arguments);
    });
}
function abrir() {
    playerName = $("#myName").val();
    transaction(function () {}, function () {
        transaction(function () {
            vm.players().forEach(function (p, index) {
                if (p.name() === playerName) {
                    playerId = index;
                }
            });
            if (playerId === null) {
                addPlayer(playerName);
            }
        }, function () {
            $("#game").show();
            ko.applyBindings(vm);
        });
        setInterval(function () {
            transaction();
        }, REFRESH_TIME);
    });
}
function entrar() {
    QueryString.name = $("#myName").val();
    QueryString.p = $("#myGame").val();
    refresh();
}
function crearPartida() {
    QueryString.name = $("#myName").val();
    QueryString.p = new Date().getTime() + Math.random();
    refresh();
}
function controlZ() {
    if (QueryString.z)
        QueryString.z++;
    else
        QueryString.z = 1;
    refresh();
}
function initialDrawCard(index) {
    var handSlots = [
        vm.players()[index].backpack1,
        vm.players()[index].backpack2,
        vm.players()[index].backpack3,
        vm.players()[index].backpack4,
        vm.players()[index].backpack5,
        vm.players()[index].extra5,
        vm.players()[index].extra4,
        vm.players()[index].extra3,
        vm.players()[index].extra2,
        vm.players()[index].extra1,
    ];
    var j = 0;
    function draw(from) {
        moveFromDo(from.path, handSlots[j].path);
        j++;
    }
    transaction(function () {
        for (var i = 0; i < 4; i++) {
            draw(vm.puertas);
            draw(vm.tesoros);
        }
    });
}
function player() {
    return vm.players()[playerId];
}
function refresh() {
    var search = "?p=" + QueryString.p;
    search = search + (QueryString.name ? "&name=" + encodeURIComponent(QueryString.name) : "");
    search = search + (QueryString.z ? "&z=" + QueryString.z : "");
    location.search = search;
}
////////////////////////// MAIN ////////////////////////////////////
window.counter = 0;
window.moves = [];
var REFRESH_TIME = 2000;
var playerName = null, playerId = null;
var vm = new MyViewModel();
$("body").mousemove(function (event) {
    if (event.target.style.backgroundImage) {
        $(".zoom").css("background-image", event.target.style.backgroundImage);
    }
});
if (QueryString.name) {
    $("#myGame").val(QueryString.p);
    $("#myName").val(QueryString.name);
    abrir();
}