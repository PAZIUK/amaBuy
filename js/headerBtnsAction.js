"use strict"

let headerBtns = document.querySelectorAll("nav.preferences ul li button");
headerBtns.forEach((item)=>{
	let menu = item.parentElement.querySelector("section.toggleHeaderBtnsMenu");
	if (menu) {
		item.addEventListener("click",function(){
			menu.classList.toggle("active");
		})
	}

	let href = item.getAttribute("link");
	if (href) {
		item.addEventListener("click",function(){
			window.location.href = href;
		})
	}	
})
let firstPreferenceButton =  document.querySelectorAll("nav.preferences ul li section.toggleHeaderBtnsMenu button")[0];
firstPreferenceButton.addEventListener("mouseenter",function(){
	this.parentElement.classList.add("hoverActive")
})
firstPreferenceButton.addEventListener("mouseout",function(){
	this.parentElement.classList.remove("hoverActive")
})
let headerBtnsInside = document.querySelectorAll("nav.preferences ul li section.toggleHeaderBtnsMenu");
headerBtnsInside.forEach(menus=>{
	menus.querySelectorAll('button').forEach(item=>{
		item.addEventListener("click",function(){
			let href = this.getAttribute("link");
			if (href) window.location.href = href;
		})
	})
})