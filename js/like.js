//add liked projects
let hearths = document.querySelectorAll(".shop .shop_cat .shop_cat-item .head .btns .bx");
hearths.forEach(item=>{
	item.addEventListener("click",function(){
		let ID = item.parentElement.parentElement.parentElement.querySelector(".id").getAttribute("shopitemid");
		if(item.classList.contains("bx-heart")){
			//add
			this.classList.remove("bx-heart");
			this.classList.add("bxs-heart");

			$.ajax({
	            type: 'POST',
	            url: window.location.href,
	            dataType: 'json',
	            data: {likeID : ID},
	            success: function(response){
	                console.log(response)
	            },
	            error: function (response) {
	             	console.log(response)
	            }
	        });
		} else if(item.classList.contains("bxs-heart")){
			//remove
			this.classList.remove("bxs-heart");
			this.classList.add("bx-heart");
		}
	})
})
function addProjectToSaved(id){
	let saved;
	if (localStorage.getItem("saved")) {
		saved = localStorage.getItem("saved").split(",").map( s => +s );
	} else {
		saved = [];
	}
	if (!saved.includes(+id)) {
		saved.push(+id);
	}
	localStorage.setItem("saved",saved);
	console.log(saved)
}
function removeProjectToSaved(id){
	let saved = localStorage.getItem("saved").split(",").map( s => +s );
	let index = saved.indexOf(+id);
	if (index > -1) {
	  saved.splice(index, 1);
	}
	localStorage.setItem("saved",saved);
	console.log(saved)
}

let compares = document.querySelectorAll(".shop .shop_cat .shop_cat-item .head .btns .bx");
compares.forEach(item=>{
	item.addEventListener("click",function(){
		item.classList.toggle("active")
		if(item.classList.contains("active")){
			// addProjectToSaved(this.parentElement.parentElement.parentElement.firstChild.id.substr(1));
		} else{
			// removeProjectToSaved(this.parentElement.parentElement.parentElement.firstChild.id.substr(1));
		}
	})
})