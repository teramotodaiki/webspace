/*var canvas = document.getElementById("quickstart");
var context = canvas.getContext("2d");
//fillRect(x, y, width, height);
context.fillStyle = "rgb(255, 215, 0)";
context.fillRect(1,1,10,10);*/

window.onload = startFunk;  
i = 1;
j = 50; 
k = 0;

// This function is called on page load.
function draw() {

    canvas = document.getElementById("canvas");

    context = canvas.getContext("2d");

    context.fillStyle = 'rgb(255)';
    DrawFrame(0, 960, 0, 540);

    context.fillStyle = "rgb(255, 215, 0)";

    context.fillRect (15, 15, 50, 50);

    context.fillStyle = "rgba(0, 0, 200, 0.3)";

    context.fillRect (40, 40, 40, 40);


    context.fillStyle = "rgba(90, 50, 200, 0.6)";
    context.fillRect (400, 200, 70, 140);

    canvas.addEventListener('mousedown', DownFunk, true);
    canvas.addEventListener('mouseup', UpFunk, true);
    canvas.addEventListener('click', ClickFunk, true);
    document.addEventListener('keydown',KeyDownFunk,true);
}

function drawloop(){
    if(i > 960){
        clearInterval(timer);
    }else{
        context.fillStyle = "rgba("+(k * 255/960)+", 50, 200, 0.5)";
        context.fillRect(i,0,1,540);
        i+= 1;
        k++;
    }
    //j = 50;
}

function DrawFrame(fx1, fx2, fy1, fy2){
    DrawLine(fx1,fy1,fx1,fy2);
    DrawLine(fx1,fy1,fx2,fy1);
    DrawLine(fx2,fy1,fx2,fy2);
    DrawLine(fx1,fy2,fx2,fy2);
}

function DrawLine(x1, y1, x2, y2){
	context.moveTo(x1, y1);
	context.lineTo(x2, y2);
	context.stroke();
}

function ClickFunk(e){
    var rect = e.target.getBoundingClientRect();
    context.fillStyle = 'rgba('+e.clientX+','+e.clientY+',100, 0.3)';
    context.fillRect(e.clientX - rect.left-5, e.clientY - rect.top-5, 10,10);
}

function DownFunk(e){

}

function UpFunk(e){

}

function KeyDownFunk(e){
    if(timer){
        clearInterval(timer);
    }else{
        timer = setInterval('drawloop()', 50);
    }
}

function startFunk(){
    draw();
    timer = setInterval('drawloop()', 50);
}