"use strict"
/*
    SNAKE JS FUNCTIONAL
*/

//la usiamo per attivare e disattivare console log
var debug = false;

//costanti per gli indici degli offset (coordinate cartesiane)
const X = 0, Y = 1;
//costante per la gestione della "velocità" di pixel
const SNAKE_WALK = 10;

//contiene la posizione corrente dello snake
var snakePosition = [100, 100];
//la dimensione dello snake
var snakeheadDimension = [50, 50];
//direzione x,y (left,top)
var snakeDirection = [SNAKE_WALK, 0];
//posizione dell mela
var applePosition = [0, 0];
//conta le mele mangiate
var eatedAppleCount = 0;

//testa dello snake
var snakeHead = document.getElementById("head");
//spazio di movimento del gioco
var world = document.getElementById("world");
//la mela
var apple = document.getElementById("apple");
//mele mangiate
var eatedApple = document.getElementById("eatedCount");


world.onkeydown = function (event) {

    console.log(event)
    event.preventDefault();

    switch (event.key) {
        case "ArrowUp":
            snakeDirection = [0, -SNAKE_WALK];
            break;
        case "ArrowDown" :
            snakeDirection = [0, +SNAKE_WALK];
            break;
        case "ArrowLeft":
            snakeDirection = [-SNAKE_WALK, 0];
            break;
        case "ArrowRight" :
            snakeDirection = [SNAKE_WALK, 0];
            break;
    }

}

//inizializzo una nuova mela;
newApple();

//inizializziamo il ciclo di gioco
var gameplay = setInterval(play, 60);
var appleChange = setInterval(newApple, 10000);


function play() {

    snakeMove();
    snakeCheckApple();
    snakeCheckBound();
    snakeUpdate();

}

function snakeCheckApple() {

    var snake_apple_collision = checkCollision(apple, snakeHead);

    if (snake_apple_collision) {
        //model
        eatedAppleCount++;
        //view
        eatedApple.innerText = eatedAppleCount;

        newApple();
    }

}

function checkCollision(div1, div2) {

    var x1 = div1.offsetLeft;
    var y1 = div1.offsetTop;
    var x2 = div2.offsetLeft;
    var y2 = div2.offsetTop;
    if ((y1 + div1.offsetHeight) < y2 ||
        y1 > (y2 + div2.offsetHeight) ||
        (x1 + div1.offsetWidth) < x2 ||
        x1 > (x2 + div2.offsetWidth))
        return false;
    return true;
}

function newApple() {

    //logica (model)
    applePosition = [Math.random() * world.clientWidth, Math.random() * world.clientHeight];

    //presentazione (view)
    apple.style.left = applePosition[X] + "px";
    apple.style.top = applePosition[Y] + "px";
}

function snakeCheckBound() {

    //human readable direction
    var hrDirection = getHumanReadableDirection();

    switch (hrDirection) {
        case "left":
            (snakePosition[X] <= 0) ? snakePosition[X] = (world.clientWidth - snakeheadDimension[X]) : false;
            break;
        case "right":
            (snakePosition[X] + snakeheadDimension[X] >= world.clientWidth) ? snakePosition[X] = 0 : false;
            break;
        case "up" :
            (snakePosition[Y] <= 0) ? snakePosition[Y] = (world.clientHeight - snakeheadDimension[Y]) : false;
            break;
        case "down":
            (snakePosition[Y] + snakeheadDimension[Y] >= world.clientHeight) ? snakePosition[Y] = 0 : false;
            break;
    }

}

function getHumanReadableDirection() {

    if (snakeDirection[X] >= 1 && snakeDirection[Y] == 0) {
        return "right";
    }

    if (snakeDirection[X] <= -1 && snakeDirection[Y] == 0) {
        return "left";
    }

    if (snakeDirection[X] == 0 && snakeDirection[Y] < 0) {
        return "up";
    }

    if (snakeDirection[X] == 0 && snakeDirection[Y] > 0) {
        return "down";
    }
}
//model
function snakeMove() {
    snakePosition[X] += snakeDirection[X];
    snakePosition[Y] += snakeDirection[Y];
}
//view
function snakeUpdate() {
    snakeHead.style.left = snakePosition[X] + "px";
    snakeHead.style.top = snakePosition[Y] + "px";
}
