"use strict"
/*
    SNAKE JS FUNCTIONAL
*/

//la usiamo per attivare e disattivare console log
var debug = false;

//grandezza di una cella del campo
const FIELD_CELL_W = 10;
const FIELD_CELL_H = 10;

//costanti per gli indici degli offset (coordinate cartesiane)
const X = 0, Y = 1;
//costante per la gestione della "velocità" di pixel
const SNAKE_WALK = 1;

//direzione x,y (left,top)
var snakeDirection = [0, SNAKE_WALK];
//posizione dell mela
var applePosition = [0, 0];
//conta le mele mangiate
var eatedAppleCount = 0;
//contiene la posizione corrente dello snake
var snakePositions = [[0, 0]];


/*
Overrides
 */


// Warn if overriding existing method
if (Array.prototype.equals)
    console.warn("Overriding existing Array.prototype.equals. " +
        "Possible causes: New API defines the method, there's " +
        "a framework conflict or you've got double inclusions in your code."
    );

// attach the .equals method to Array's prototype to call it on any array
Array.prototype.equals = function (array) {
    // if the other array is a falsy value, return
    if (!array)
        return false;

    // compare lengths - can save a lot of time
    if (this.length != array.length)
        return false;

    for (var i = 0, l = this.length; i < l; i++) {
        // Check if we have nested arrays
        if (this[i] instanceof Array && array[i] instanceof Array) {
            // recurse into the nested arrays
            if (!this[i].equals(array[i]))
                return false;
        } else if (this[i] != array[i]) {
            // Warning - two different object instances will never be equal: {x:20} != {x:20}
            return false;
        }
    }
    return true;
}
// Hide method from for-in loops
Object.defineProperty(Array.prototype, "equals", {enumerable: false});


/*
* Oggetti del dom
* */

//spazio di movimento del gioco
var field = document.getElementById("field");
//mele mangiate
var eatedApple = document.getElementById("eatedCount");


const FIELD_W = field.clientWidth / FIELD_CELL_W;
const FIELD_H = field.clientHeight / FIELD_CELL_H;

const EMPTY_CELL = 1,
    SNAKE_HEAD = 2,
    SNAKE_BODY = 3,
    APPLE_CELL = 4,
    WALL_CELL = 5;


//la matrice di campo
var fieldMatrix = [];

//inizializziamo il campo;
fieldMatrixInit();

//inizializziamo il ciclo di gioco
var gameInterval = setInterval(snakeMove, 60);
//vent
var appleInterval = setInterval(newApple, 10000);


function fieldMatrixInit() {

    for (let x = 0; x < FIELD_W; x++) {
        fieldMatrix[x] = [];
        for (let y = 0; y < FIELD_H; y++) {

            var cell = document.createElement("div");

            cell.id = `f-${x}-${y}`;
            cell.className = "cell";
            cell.style.width = FIELD_CELL_W + "px";
            cell.style.height = FIELD_CELL_W + "px";

            fieldMatrix[x][y] = EMPTY_CELL;

            field.append(cell);
        }
    }

    newApple();

}


function snakeCheckApple(snakeHead) {

    if (snakeHead.equals(applePosition)) {
        //model
        eatedAppleCount++;
        //view
        eatedApple.innerText = eatedAppleCount;

        clearInterval(appleInterval);
        newApple();
        appleInterval = setInterval(newApple, 10000);

        return true;
    }

    return false;
}


function newApple() {

    //cancello la vecchia mela
    updateCell(applePosition, EMPTY_CELL);

    //logica (model)
    applePosition = [parseInt(Math.random() * FIELD_W), parseInt(Math.random() * FIELD_H)];

    //presentazione (view)
    updateCell(applePosition, APPLE_CELL);

}

function snakeCheckBound(snakePosition) {

    //human readable direction
    var hrDirection = getHumanReadableDirection();

    switch (hrDirection) {
        case "up" :
            return snakePosition[X] < 0 ? [(FIELD_H - 1), snakePosition[Y]] : snakePosition;
        case "down":
            return snakePosition[X] >= FIELD_H ? [0, snakePosition[Y]] : snakePosition;
        case "left":
            return snakePosition[Y] < 0 ? [snakePosition[X], (FIELD_W - 1)] : snakePosition;
        case "right":
            return snakePosition[Y] >= FIELD_W ? [snakePosition[X], 0] : snakePosition;
            break;
    }

}

function getHumanReadableDirection() {

    if (snakeDirection[X] >= 1 && snakeDirection[Y] == 0) {
        return "down";
    }

    if (snakeDirection[X] <= -1 && snakeDirection[Y] == 0) {
        return "up";
    }

    if (snakeDirection[X] == 0 && snakeDirection[Y] < 0) {
        return "left";
    }

    if (snakeDirection[X] == 0 && snakeDirection[Y] > 0) {
        return "right";
    }
}

/*
inverto X e Y perchè sotto il punto di
 */
function updateCell(position, value) {

    let [x, y] = position;

    //model
    fieldMatrix[x][y] = value;

    //view
    var cell = document.getElementById(`f-${x}-${y}`);
    var cellClass = "cell ";

    switch (value) {
        case EMPTY_CELL:
            cellClass += " ";
            break;
        case SNAKE_BODY:
        case SNAKE_HEAD:
            cellClass += " snake";
            break;
        case APPLE_CELL:
            cellClass += " apple";
            break;
        case WALL_CELL:
            cellClass += " wall";
            break;

    }

    cell.className = cellClass;
}

//model
function snakeMove() {

    let currentHead = snakePositions[0];
    let newHead = [0, 0]

    newHead[X] = currentHead[X] + snakeDirection[X];
    newHead[Y] = currentHead[Y] + snakeDirection[Y];

    newHead = snakeCheckBound(newHead);
    snakePositions.unshift(newHead);

    for (let body = 0; body < snakePositions.length - 1; body++) {
        updateCell(snakePositions[body], SNAKE_BODY);
    }

    var eatedApple = snakeCheckApple(newHead);

    if (!eatedApple) {
        //se mangio una mela si allunga la coda quindi non cancello l'ultimo
        let tail = snakePositions[snakePositions.length - 1];
        updateCell(tail, EMPTY_CELL);
        snakePositions.pop()
    }

}

field.onkeydown = function (event) {

    console.log(event)
    event.preventDefault();

    switch (event.key) {
        case "ArrowUp":
            snakeDirection = [-SNAKE_WALK, 0];
            break;
        case "ArrowDown" :
            snakeDirection = [+SNAKE_WALK, 0];
            break;
        case "ArrowLeft":
            snakeDirection = [0, -SNAKE_WALK];
            break;
        case "ArrowRight" :
            snakeDirection = [0, SNAKE_WALK];
            break;
    }

}
