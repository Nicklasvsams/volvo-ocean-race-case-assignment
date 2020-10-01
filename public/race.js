let canvas_parent = document.getElementById('race');
let teams = document.querySelectorAll("div.teaminfo");

let canvas = document.createElement("canvas");
canvas.width = 800;
canvas.height = 350;
context = canvas.getContext("2d");
canvas_parent.appendChild(canvas),
components = [],
boatobjects = [],
imgsrcs = [],
points = [];

class boat{
    constructor(point, src, name){
        this.point = point;
        this.img = new Image();
        this.img.src = src;
    }
}

function component(width, height, color, x, y){
    this.width = width;
    this.height = height;
    this.color = color;
    this.x = x;
    this.y = y;
}

for (let i = 0; i < 5; i++) {
    components.push(new component(750, 100, "blue", 0, i*70, "background"))
    boatobjects.push(new boat(teams[i].getAttribute("points"), teams[i].getAttribute("imgsrc")));
}

function render_race(components){
    components.forEach(component => {
        context.beginPath();
        context.moveTo(0, component.y + 70);
        context.lineTo(canvas.width, component.y + 70);
        context.stroke();

        for (let i = 50; i < canvas.width; i = i+100) {
            context.font = "10px Consolas";
            context.fillStyle = "white";
            context.fillText(`${(i/10)}`, component.x + i, component.y + 67);
        }
    });
    window.onload = function(){
        for (let i = 0; i < boatobjects.length; i++) {
            let imgsrc = boatobjects[i].img.src;
            let imgObj = new Image();
            imgObj.src = imgsrc;
            imgObj.width = imgObj.width*0.09;
            imgObj.height = imgObj.height*0.09;

            let imgx = (boatobjects[i].point * 10) - 18;
            let imgy = i*70;

            context.drawImage(imgObj, imgx, imgy-8, imgObj.width, imgObj.height);
        }
    }
}

render_race(components);