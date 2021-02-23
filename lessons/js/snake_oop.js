"use strict"

class Cell {

    constructor(status = "empty", x = 0, y = 0, w = 0, h = 0) {

        debugger;
        //dati del nostro oggetto
        this.x = x;
        this.y = y;
        this.id = `f-${x}-${y}`;

        //assumiamo di lavorare in termini generali con il dom
        //potremmo però utilizzare la classe field per gestire le politiche di accesso al DOM
        let cell = document.getElementById(this.id);

        if (cell) {
            this.cell = cell;
        } else {

            this.cell = document.createElement("div");
            //dati del Node Element
            this.cell.id = this.id;
            this.cell.style.width = w + "px";
            this.cell.style.height = h + "px";

        }

        this.setStatus(status);
    }

    setStatus(status) {
        this.cell.className = "cell " + status;
    }

    getElement() {
        return this.cell;
    }


}

class Snake extends Cell {

    static SNAKE_WALK = 1;

    constructor() {
        super("snake");
        this.direction = [0, SNAKE_WALK];
        this.snakePositions = [];
    }

    setDirection(direction) {
        this.direction = direction;
    }

    move() {

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
}

class Apple extends Cell {

    constructor() {
        super("apple");
    }
}

class Field {

    constructor(cellDimension) {

        this.field = document.getElementById("field");
        this.fw = field.clientWidth / cellDimension;
        this.fh = field.clientHeight / cellDimension;
        this.cellDimension = cellDimension;

        this.init();
    }

    init() {

        for (let x = 0; x < this.fw; x++) {

            this.matrix[x] = [];

            for (let y = 0; y < this.fh; y++) {
                this.matrix[x][y] = new Cell(Cell.EMPTY, x, y, this.cellDimension);
                field.append(this.matrix[x][y].getElement());
            }
        }
    }


}

class Game {

    constructor() {
        this.field = new Field(10);
        this.snake = new Snake(0, 0);
        this.apple = new Apple(10, 10);
        this.gameInterval = null;
        this.appleInterval = null;
    }

    run() {
        this.gameInterval = setInterval(this.move, 1000);
        this.appleInterval = setInterval(this.newApple, 10000);
    }

    move() {

        this.snake.move();

    }

    newApple() {

    }

}

