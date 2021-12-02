"use strict"
const signinBtn = document.querySelector(".signinBtn");
const signupBtn = document.querySelector(".signupBtn");
const formBox = document.querySelector(".formBox");
const forgetPasswordBtn = document.querySelector(".formBox .form.signinForm div");
const forgetPasswordBlock = document.querySelector("#forgetPassword");
const forgetPasswordBlockCrossBtn = document.querySelector("#forgetPassword .forgetPasswordBlock header i");
const forgetPasswordBlockBtn = document.querySelector("#forgetPassword .forgetPasswordBlock footer button");

signinBtn.addEventListener("click",function() {
	formBox.classList.remove("active")
})
signupBtn.addEventListener("click",function() {
	formBox.classList.add("active")
})
forgetPasswordBtn.addEventListener("click",function(){
	forgetPasswordBlock.classList.add("active");
	window.scroll(0,0);
	document.body.style.overflow = "hidden";
})
forgetPasswordBlockCrossBtn.addEventListener("click",function(){
	forgetPasswordBlock.classList.remove("active");
	document.body.style.overflow = "unset";
})
forgetPasswordBlockBtn.addEventListener("click",function(){
	forgetPasswordBlock.classList.remove("active");
	document.body.style.overflow = "unset";
})