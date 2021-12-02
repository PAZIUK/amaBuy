"use strict"
const selectBlocks = document.querySelectorAll("#content .wrapper .addItemContainer form ul li.addItemBlock select");

selectBlocks.forEach(item=>{
	item.addEventListener("click",function(){
		item.parentElement.classList.toggle("active");
	})
})