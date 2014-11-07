/**
*
*   Matrix operations for life.
*   First we create cells x cells array with 0 values.
*   After we get data.
*   forEach data element
*       if matrix x,y is not 0, we add item
*       else we get a random number between 0 and 1, if it's 1 we add data.
*
* As an input we should have cells x cells matrix. empty squares have 0 value.
* On each iteration
*   We have to get every neighboors, using torus.
*       for each neighboor we have to count each distinct species number
*       this gives us neighboorSpecies array
*           if element.species != 0
*               if neighboorSpecies[element.species]==2 or neighboorSpecies[element.species]==3
*                   Element Survives
*               else if neighboorSpecies[element.species]<2
*                   Element dies
*               else if neighboorSpecies[element.species]>3
*                   Element dies
*           else if element.species == 0
*                  if one of neighborSpecies == 3
*                       then element.species = neighborSpecies 3 value
*/

function Life(cells,species,squares){
    this.cells = cells;
    this.species = species;
    if(typeof squares == "undefined")
    {
        this.squares = new Array();
    
        for(x=0;x<cells;x++){
            this.squares[x] = Array.apply(null, new Array(cells)).map(Number.prototype.valueOf,0);
            for(y=0;y<cells;y++){
                this.squares[x][y] = Math.floor(Math.random() * species) 
            }
        }
    }
    else
    {
        this.squares = squares;
    }
}

Life.prototype.iterate = function (){
    for(x=0;x<this.cells;x++){
        for(y=0;y<this.cells;y++){
            
            var xBefore = x-1;
            var xAfter = x+1;
            var yBefore = y-1;
            var yAfter = y+1;
            
             if(xBefore<0){var xBefore = x - 1 + this.cells;}
             if(xAfter>this.cells-1){var xAfter = x + 1 - this.cells;}
             if(yBefore<0){var yBefore = y - 1 + this.cells;}
             if(yAfter>this.cells-1){var yAfter = y + 1 - this.cells;}
            var neighboors = [
                                this.squares[xBefore][yAfter],
                                this.squares[x][yAfter],
                                this.squares[xAfter][yAfter],
                                this.squares[xBefore][y],
                                this.squares[xAfter][y],
                                this.squares[xBefore][yBefore],
                                this.squares[x][yBefore],
                                this.squares[xAfter][yBefore],
                            ];
        
        var decide = this.decide(this.squares[x][y],neighboors);
        
        if(decide==false)
        {
            this.squares[x][y] = 0;
        }
        
        if(typeof decide === 'number')
        {
            this.squares[x][y] = decide;
        }
        
        }
    }
    return this.squares;
};

Life.prototype.decide = function(value,neighboors){
    var neighboorSpecies = Array.apply(null, new Array(this.species)).map(Number.prototype.valueOf,0);
    neighboors.forEach(function(element)
    {
        if(element!=0)
        {
            neighboorSpecies[element]++;
        }
    });
    if(value!=0)
    {
        if(neighboorSpecies[value]==2 || neighboorSpecies[value]==3)
        {
            return true;
        }
        if(neighboorSpecies[value]<2)
        {
            return false;
        }
        if(neighboorSpecies[value]>3)
        {
            return false;
        }
    }
    else
    {
        for (var i=0; i<neighboorSpecies.length; i++){
            if(neighboorSpecies[i]==3)
            {
                return i;
            }
        }
    }
}

Life.prototype.getSquares = function (){
    return this.squares;
}

self.onmessage = function(e) {
	if(e.data=="stop"){
	    self.close();
	}
};

self.addEventListener('message', function(e) {
    var data = e.data;
    if(typeof data.squares == "undefined"){
        var theLife = new Life(data.cells,data.species);
    }
    else
    {
        var theLife = new Life(data.cells,data.species,data.squares);
    }
    self.postMessage(theLife.getSquares());
    for(i=0;i<data.iterations;i++)
    {
          self.postMessage(theLife.iterate());
    }
}, false);