<!DOCTYPE html>

<html lang="FR">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Snake Game 🐍</title>
        <link rel="icon" type="image" href="../Favicon/snake.png" />
        <style>
            canvas {
                border: 2px solid black;
            }
        </style>

    </head>

    <body>

        <canvas width="400" height="400"></canvas>

        <script>

            const canvas = document.querySelector('canvas');
            const ctx = canvas.getContext('2d');
            const width = canvas.width;
            const height = canvas.height;

            let box = 20;

            let snake = [];
            snake[0] = { x: 10 * box, y: 10 * box }

            let food = {
                x: Math.floor(Math.random() * 15 + 1) * box,
                y: Math.floor(Math.random() * 15 + 1) * box
            }

            let score = 0;

            let d

            document.addEventListener("keydown", direction);

            // e = Event
            function direction(e) {
                let key = e.keyCode;
                if (key == 37 && d != "RIGHT") {
                    d = 'LEFT';
                }
                else if (key == 38 && d != "DOWN") {
                    d = 'UP';
                }
                else if (key == 39 && d != "LEFT") {
                    d = 'RIGHT';
                }
                else if (key == 40 && d != "UP") {
                    d = 'DOWN';
                }
            }

            // ctx = Context
            function draw() {
                ctx.clearRect(0, 0, 400, 400);

                for (let i = 0; i < snake.length; i++) {
                    ctx.fillStyle = (i == 0) ? "green" : "yellow";
                    ctx.fillRect(snake[i].x, snake[i].y, box, box);
                    ctx.strokeStyle = "black"
                    ctx.strokeRect(snake[i].x, snake[i].y, box, box);
                }
                ctx.fillStyle = "red";
                ctx.fillRect(food.x, food.y, box, box);

                let snakeX = snake[0].x
                let snakeY = snake[0].y

                if (d == "LEFT") 
                    snakeX -= box;
                if (d == "RIGHT") 
                    snakeX += box;
                if (d == "UP") 
                    snakeY -= box;
                if (d == "DOWN") 
                    snakeY += box;
                
                if (snakeX == food.x && snakeY == food.y) {
                    score += 10;
                    food = {
                        x: Math.floor(Math.random() * 15 + 1) * box,
                        y: Math.floor(Math.random() * 15 + 1) * box
                    }
                }
                else {
                    snake.pop();
                }


                let newHead = {
                    x: snakeX,
                    y: snakeY
                }

                if (snakeX < 0 || snakeY < 0 || snakeX > 19 * box || snakeY > 19 * box || collision(newHead, snake)) {
                    clearInterval(game);
                    alert("Noob ...")
                }

                snake.unshift(newHead);

                ctx.fillStyle = "green";
                ctx.font = "30px, Arial";
                ctx.fillText("Score: " + score, 2 * box, 1.6 * box);

            }

            function collision(head, array) {
                for (let j = 0; j < array.length; j++) {
                    if (head.x == array[j].x && head.y == array[j].y) {
                        return true;
                    }
                }
                return false;
            }

            let game = setInterval(draw, 100);

        </script>

    </body>

</html>