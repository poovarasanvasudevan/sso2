/**
 * Created by poovarasanv on 24/6/16.
 */
/******* Material Framework by Tim Nguyen ********/
/** https://github.com/nt1m/material-framework/ **/
"use strict";function Material(a){this.initialised=!1;var b=a&&a.hasOwnProperty("modules")?a.modules:null,c=a&&a.hasOwnProperty("options")?a.options:null;this.init(b,c)}var console=window.console=window.console||{};Material.prototype.init=function(a,b){if(!this.initialised){if(!a)var a=["Dialog","Responsive","SideMenu","Ripple","DropdownMenu","FancyHeader"];for(var c=0,d=a.length;d>c;c++){var e=a[c];if(!window.hasOwnProperty(e)||!window[e].hasOwnProperty("init")||!window[e].isMaterialModule)return void console.warn("[material.init] Module not found : "+e);b&&b[e]?window[e].init(b[e]):window[e].init()}this.initialised=!0}};var Responsive={initialised:!1,isMaterialModule:!0,constructor:Responsive,init:function(){this.initialised||(this.onResize(),window.addEventListener("resize",this.onResize.bind(this)),this.initialised=!0)},onResize:function(){var a=window.innerWidth,b=this.device;a>1e3?this.device="desktop":a>450?this.device="tablet":this.device="phone",document.body.classList.remove(b),document.body.classList.add(this.device)},addResizeHandler:function(a){window.addEventListener("resize",a)},removeResizeHandler:function(a){window.removeEventListener("resize",a)}},Theme={isMaterialModule:!0,toggle:function(a){var b=a||document.body;b.classList.contains("dark-theme")?b.classList.remove("dark-theme"):b.classList.add("dark-theme")},setTheme:function(a,b){var c=b||document.body;switch(a){case"light":c.classList.remove("dark-theme");break;case"dark":c.classList.add("dark-theme");break;default:console.log("[Theme.setTheme] Unknown theme : "+a)}}},SideMenu={initialised:!1,isMaterialModule:!0,constructor:SideMenu,init:function(a){this.initialised||(this.createOverlay(),a&&a.overlay&&this.setOverlay(a.overlay),this.overlay.addEventListener("click",function(){for(var a=document.querySelectorAll(".sidemenu"),b=0,c=a.length;c>b;b++){var d=a[b];d.hidden||d.classList.contains("sidebar")&&"undefined"!=typeof Responsive&&"desktop"===Responsive.device||this.hide(d)}}.bind(this)),"undefined"!=typeof Responsive&&Responsive.addResizeHandler(this.onResize.bind(this)),this.onResize(),this.initialised=!0)},createOverlay:function(){if(document.querySelector(".sidemenu-overlay"))return void(this.overlay=document.querySelectorAll(".sidemenu-overlay")[0]);var a=document.createElement("div");a.className="overlay sidemenu-overlay",a.hidden=!0,a.setAttribute("id","mf_overlay_"+Math.floor(1e5*Math.random())),document.body.appendChild(a),this.overlay=a},toggle:function(a){a.classList.contains("sidebar")&&"undefined"!=typeof Responsive&&"desktop"===Responsive.device||(this.overlay.hidden=!a.hidden),a.hidden=!a.hidden},show:function(a){a.classList.contains("sidebar")&&"undefined"!=typeof Responsive&&"desktop"===Responsive.device||(this.overlay.hidden=!1),a.hidden=!1},hide:function(a){this.overlay.hidden=!0,a.hidden=!0},onResize:function(){for(var a=document.querySelectorAll(".sidebar"),b=0,c=a.length;c>b;b++)"desktop"==Responsive.device?this.show(a[b]):this.hide(a[b])}},Dialog={initialised:!1,isMaterialModule:!0,callback:null,constructor:Dialog,init:function(){if(!this.initialised){this.createOverlay();for(var a=document.querySelectorAll(".dialog-confirm, .dialog-close"),b=0,c=a.length;c>b;b++)a[b].addEventListener("click",this.hideCurrentDialog.bind(this));this.initialised=!0}},createOverlay:function(){if(document.querySelector(".dialog-overlay"))return void(this.overlay=document.querySelectorAll(".dialog-overlay")[0]);var a=document.createElement("div");a.className="overlay dialog-overlay",a.hidden=!0,a.setAttribute("id","mf_overlay_"+Math.floor(1e5*Math.random())),document.body.appendChild(a),this.overlay=a},show:function(a,b){this.overlay.hidden=!1,a.hidden=!1,b&&(this.callback=b)},hide:function(a){this.overlay.hidden=!0,a.hidden=!0},toggle:function(a){this.overlay.hidden=!a.hidden,a.hidden=!a.hidden},getCurrentDialog:function(){return document.querySelector(".dialog:not([hidden])")},hideCurrentDialog:function(a){this.hide(this.getCurrentDialog()),this.callback&&(this.callback(a.target),this.callback=null)}},Ripple={isMaterialModule:!0,initialised:!1,constructor:Ripple,init:function(){this.initialised||(document.addEventListener("touchstart",function(){},!1),this.initialised=!0)},onClick:function(a){var b=a.pageX-this.offsetLeft-this.clientWidth/2,c=a.pageY-this.offsetTop-this.clientHeight/2,d=document.createElement("style"),e="data-mf-ripple_"+Math.floor(1e6*Math.random()),f=Math.floor(1e6*Math.random());this.setAttribute(e,f),d.innerHTML="["+e+"='"+f+"']::after {\nleft: "+b+"px;\ntop: "+c+"px;}",document.body.appendChild(d),setTimeout(function(){d.remove(),this.removeAttribute(e)}.bind(this),2e3)}},DropdownMenu={initialised:!1,isMaterialModule:!0,init:function(){if(!this.initialised){var a=[].slice.call(document.querySelectorAll(".dropdown .dropdown-menu"));a.forEach(function(a){a.addEventListener("click",function(a){this.classList.add("active"),a.stopPropagation()})});var b=[].slice.call(document.querySelectorAll(".dropdown .menu li"));b.forEach(function(a){a.addEventListener("click",function(a){this.parentNode.parentNode.querySelector(".dropdown-menu").innerHTML=this.childNodes[0].innerHTML,this.value&&(this.parentNode.parentNode.querySelector(".dropdown-menu").value=this.value);var b=new CustomEvent("change",{});this.parentNode.parentNode.querySelector(".dropdown-menu").dispatchEvent(b)})}),document.body.addEventListener("click",function(){var a=[].slice.call(document.querySelectorAll(".dropdown .dropdown-menu"));a.forEach(function(a){a.classList.remove("active")})})}}},FancyHeader={header:null,scrollTarget:null,state:"show",initialised:!1,isMaterialModule:!0,constructor:FancyHeader,init:function(a){if(!this.initialised){if(!a||null===a.header||null===a.scrollTarget)return void console.warn("[FancyHeader.init] You need to Setup a Header and Scroll-Target (window or obj) at least!");this.header=a.header,this.scrollTarget=a.scrollTarget,this.lastY=this.scrollTarget.scrollY,this.scrollTarget.addEventListener("scroll",this.update.bind(this),!1),this.initialised=!0}},hide:function(){"hide"!=this.state&&(this.header.classList.toggle("hide"),this.state="hide")},show:function(){"show"!=this.state&&(this.header.classList.toggle("hide"),this.state="show")},getY:function(a){a(void 0!==this.scrollTarget.pageYOffset?this.scrollTarget.pageYOffset:void 0!==this.scrollTarget.scrollTop?this.scrollTarget.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop)},update:function(){this.getY(function(a){var b=a>this.lastY?"down":"up";"down"==b?this.hide():"up"==b&&this.show(),this.lastY=a}.bind(this))}};