function Saw(data, criteria){
	this.data = data;
	this.criteria = criteria;	
	this.getResult = function(){
		return "data ="+data+" criteria ="+criteria;
	}
}