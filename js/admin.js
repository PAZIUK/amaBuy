"use strict"

window.addEventListener("load",minHeightForContentBlock);
window.addEventListener("resize",minHeightForContentBlock);
function minHeightForContentBlock(){
	const adminPanelItems = document.querySelectorAll("#content .wrapper aside.adminPanel .panelItem");
	let adminPanelHeight = 0;
	for (let i = 0; i < adminPanelItems.length; i++) {
		let marginTop = parseFloat(window.getComputedStyle(adminPanelItems[i],null).getPropertyValue("margin-top"));
		let marginBottom = parseFloat(window.getComputedStyle(adminPanelItems[i],null).getPropertyValue("margin-bottom"));
		adminPanelHeight += (adminPanelItems[i].offsetHeight+marginTop+marginBottom);
	}
	const contentBlock = document.querySelector("#content");
	if (adminPanelHeight>contentBlock.offsetHeight) {
		contentBlock.style.minHeight = adminPanelHeight+"px";
	}
}

const adminPanelBtns = document.querySelectorAll(".wrapper aside.adminPanel .panelItem");

adminPanelBtns.forEach(item=>{
	item.addEventListener("click",function() {
		window.location.href = item.getAttribute("link");
	})
})

const adminShopItemsTableItems = document.querySelectorAll("#content .wrapper .meItem table tr");
for (let i = 0; i < adminShopItemsTableItems.length; i++) {
	if (i%2!=0) {
		adminShopItemsTableItems[i].classList.add("gray");
	}
}

window.onload = function(){
	adminShopItemsTableItems.forEach(item=>{
		item.querySelectorAll("td.btns button").forEach(btn=>{
			btn.addEventListener("click",function(){
				let mainBlockClass = btn.getAttribute("itemAction")+item.parentElement.parentElement.parentElement.classList[1];
				if(btn.getAttribute("itemAction")!="change"){
					document.querySelector(`#content .wrapper .areYouSure main.${mainBlockClass}`).classList.add('active');
				}
				adminAction(
					btn.getAttribute("itemAction"),
					item.querySelectorAll("td")[0].textContent,
					item.parentElement.parentElement.parentElement.classList[1]
				)
			})
		})
	})
}

let areYouSureBlock,areYouSureBlockInput;

if(document.querySelector("#content .wrapper .areYouSure")!=undefined){
	areYouSureBlock = document.querySelector("#content .wrapper .areYouSure");
	areYouSureBlockInput = areYouSureBlock.querySelector(".areYouSureBlock footer input[type='hidden']");
}

function adminActionValueHash(ID,where){
	return where.split("").reverse().join(ID);
}

function adminAction(action,value,where){

	areYouSureBlockInput.setAttribute("name",action);
	if (action=="delete") {
		let hash = adminActionValueHash(value,where);
		areYouSureBlockInput.setAttribute("value",hash);

		areYouSureBlock.classList.add("active");
	} else if(action=="add"){
		if (where=="shOpcAtEgOrIEs") {
			areYouSureBlock.querySelector("main.addshOpcAtEgOrIEs input").addEventListener("input",function(){
				areYouSureBlockInput.setAttribute("value",this.value+":"+where);
			})
		} else if(where=="shOpItEmswAItIng"){
			areYouSureBlock.querySelector("footer input[type='hidden']").setAttribute("value",value+":"+where);
		} else if (where=="shOpprOdUcErs") {
			areYouSureBlock.querySelector("main.addshOpprOdUcErs input").addEventListener("input",function(){
				areYouSureBlockInput.setAttribute("value",this.value+":"+where);
			})
		}

		areYouSureBlock.classList.add("active");
	} else if(action=="hide"){
		if (where=="shOpItEms") {
			areYouSureBlock.querySelector("footer input[type='hidden']").setAttribute("value",value+":"+where);
		}

		areYouSureBlock.classList.add("active");
	} else if(action=="change"){
		window.location.href = `index.php?action=change&${where}=${value}`
	}

}

const crossHeaderButtons = document.querySelectorAll(".areYouSure header i");
crossHeaderButtons.forEach(item=>{
	item.addEventListener("click",function(){
        this.parentElement.parentElement.parentElement.classList.remove("active");
        this.parentElement.parentElement.classList.remove("active");
        areYouSureBlockInput.removeAttribute("name");
        areYouSureBlockInput.removeAttribute("value");
	})
})


const inputAdd = document.querySelectorAll("#content .wrapper .areYouSure.add .areYouSureBlock main input");

inputAdd.forEach(item=>{
	item.addEventListener("input",function(){
		item.parentElement.parentElement.querySelector("footer form input[type='hidden']").setAttribute('value',item.value);
	})
})