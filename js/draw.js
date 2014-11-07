function getColor(noOfColors){
    var colors = [];
    frequency=5/noOfColors;
    for (var i = 0; i < noOfColors; ++i){
        r =   Math.sin(frequency*i + 0) * (127) + 128;
        g =   Math.sin(frequency*i + 2) * (127) + 128;
        b =   Math.sin(frequency*i + 4) * (127) + 128;                
        color='rgb({r},{g},{b})';
        color=color.replace("{r}",Math.floor(r));
        color=color.replace("{g}",Math.floor(g));
        color=color.replace("{b}",Math.floor(b));
        colors.push(color);
    }
    return colors; 
}

function draw(square,cells,species) {

	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
    var width = canvas.width;
    var cellSize = Math.floor(width/cells);
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    var colors =  getColor(species);
    for(x=0;x<cells;x++)
    {
        for(y=0;y<cells;y++){
                                //console.log(square[x][y]);
            if( square[x][y] != 0 ){
                ctx.fillStyle = colors[square[x][y]-1];
                ctx.fillRect (x*cellSize, y*cellSize, cellSize-1, cellSize-1);
            }
        }
    }
}