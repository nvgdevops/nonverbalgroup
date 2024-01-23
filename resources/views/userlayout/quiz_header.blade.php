<!DOCTYPE html><!--  Last Published: Mon Nov 20 2023 11:32:44 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="655b434272e0596d7e6126da" data-wf-site="655b434272e0596d7e6126bc">
<head>
  <meta charset="utf-8">
  <title>@yield('title') | Training NVG Platform</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link rel="stylesheet" href="<?php echo URL("/") ?>/assets/css/normalize.css">
  <link rel="stylesheet" href="<?php echo URL("/") ?>/assets/css/components.css">
  <link rel="stylesheet" href="<?php echo URL("/") ?>/assets/css/training-nvg-platform.css">
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon"><!--  [Attributes by Finsweet] CMS Nest  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmsnest@1/cmsnest.js"></script>
  <!--  [Attributes by Finsweet] CMS PrevNext  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmsprevnext@1/cmsprevnext.js"></script>
  <!--  [Attributes by Finsweet] CMS Slider  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmsslider@1/cmsslider.js"></script>
  <!--  [Attributes by Finsweet] Mirror click events  -->
  <script defer="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-mirrorclick@1/mirrorclick.js"></script>
  <!--  [Attributes by Finsweet] CMS Static  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmsstatic@1/cmsstatic.js"></script>
  <!--  [Attributes by Finsweet] CMS Filter  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmsfilter@1/cmsfilter.js"></script>
  <!--  [Attributes by Finsweet] CMS Combine  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmscombine@1/cmscombine.js"></script>
  <!--  [Attributes by Finsweet] CMS Sort  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmssort@1/cmssort.js"></script>
  <!--  [Attributes by Finsweet] CMS Select  -->
  <script async="" src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-cmsselect@1/cmsselect.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lazysizes@4.1.8/lazysizes.min.js" integrity="sha256-fTBo7ekO22pjfhP1rQs1prKEo4Iu8eVPODvm0oOL5Xc=" crossorigin="anonymous"></script>
  <script>
(function(window, factory) {
	var globalInstall = function(){
		factory(window.lazySizes);
		window.removeEventListener('lazyunveilread', globalInstall, true);
	};
	factory = factory.bind(null, window, window.document);
	if(typeof module == 'object' && module.exports){
		factory(require('lazysizes'));
	} else if(window.lazySizes) {
		globalInstall();
	} else {
		window.addEventListener('lazyunveilread', globalInstall, true);
	}
}(window, function(window, document, lazySizes) {
	/*jshint eqnull:true */
	'use strict';
	var dummyParent = {nodeName: ''};
	var supportPicture = !!window.HTMLPictureElement && ('sizes' in document.createElement('img'));
	var config = window.lazySizes && lazySizes.cfg;
	var handleLoadingElements = function(e){
		var i, isResponsive, hasTriggered, onload, loading;
		var loadElements = e.target.querySelectorAll('img, iframe');
		for(i = 0; i < loadElements.length; i++){
			isResponsive = loadElements[i].getAttribute('srcset') || (loadElements[i].parentNode || dummyParent).nodeName.toLowerCase() == 'picture';
			if(!supportPicture && isResponsive){
				lazySizes.uP(loadElements[i]);
			}
			if(!loadElements[i].complete && (isResponsive || loadElements[i].src)){
				e.detail.firesLoad = true;
				if(!onload || !loading){
					loading = 0;
					/*jshint loopfunc:true */
					onload = function(evt){
						loading--;
						if((!evt || loading < 1) && !hasTriggered){
							hasTriggered = true;
							e.detail.firesLoad = false;
							lazySizes.fire(e.target, '_lazyloaded', {}, false, true);
						}
						if(evt && evt.target){
							evt.target.removeEventListener('load', onload);
							evt.target.removeEventListener('error', onload);
						}
					};
					setTimeout(onload, 3500);
				}
				loading++;
				loadElements[i].addEventListener('load', onload);
				loadElements[i].addEventListener('error', onload);
			}
		}
	};
	config.getNoscriptContent =  function(noScript){
		return noScript.textContent || noScript.innerText;
	};
	window.addEventListener('lazybeforeunveil', function(e){
		if(e.detail.instance != lazySizes || e.defaultPrevented || e.target.getAttribute('data-noscript') == null){return;}
		var noScript = e.target.querySelector('noscript, script[type*="html"]') || {};
		var content = config.getNoscriptContent(noScript);
		if(content){
			e.target.innerHTML = content;
			handleLoadingElements(e);
		}
	});
}));
</script>
</head>
<body>
  <div style="opacity:0" class="page-wrapper">
    <div class="global-styles w-embed">
      <style>
  html { font-size: 1.1875rem; }
  @media screen and (max-width:1920px) { html { font-size: calc(0.4374999999999999rem + 0.6250000000000001vw); } }
  @media screen and (max-width:1440px) { html { font-size: calc(0.8126951092611863rem + 0.20811654526534862vw); } }
  @media screen and (max-width:479px) { html { font-size: calc(0.7494769874476988rem + 0.8368200836820083vw); } }
/* Make text look crisper and more legible in all browsers */
body {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  overscroll-behavior: none;
}
/* remove-horizontal-scroll-bar-on-mobile */
::-webkit-scrollbar {
display: none;
}
/* Focus state style for keyboard navigation for the focusable elements */
*[tabindex]:focus-visible,
  input[type="file"]:focus-visible {
   outline: 0.125rem solid #4d65ff;
   outline-offset: 0.125rem;
}
/* Get rid of top margin on first element in any rich text element */
.w-richtext > :not(div):first-child, .w-richtext > div:first-child > :first-child {
  margin-top: 0 !important;
}
/* Get rid of bottom margin on last element in any rich text element */
.w-richtext>:last-child, .w-richtext ol li:last-child, .w-richtext ul li:last-child {
	margin-bottom: 0 !important;
}
/* Prevent all click and hover interaction with an element */
.pointer-events-off {
	pointer-events: none;
}
/* Enables all click and hover interaction with an element */
.pointer-events-on {
  pointer-events: auto;
}
/* Create a class of .div-square which maintains a 1:1 dimension of a div */
.div-square::after {
	content: "";
	display: block;
	padding-bottom: 100%;
}
/* Make sure containers never lose their center alignment */
.container-medium,.container-small, .container-large {
	margin-right: auto !important;
  margin-left: auto !important;
}
/* 
Make the following elements inherit typography styles from the parent and not have hardcoded values. 
Important: You will not be able to style for example "All Links" in Designer with this CSS applied.
Uncomment this CSS to use it in the project. Leave this message for future hand-off.
*/
/*
a,
.w-input,
.w-select,
.w-tab-link,
.w-nav-link,
.w-dropdown-btn,
.w-dropdown-toggle,
.w-dropdown-link {
  color: inherit;
  text-decoration: inherit;
  font-size: inherit;
}
*/
  input:focus~.floating-label,
  input:not(:focus):valid~.floating-label,
  input[type=email]:not(:placeholder-shown)~.floating-label {
    top: 4px;
    font-size: 11px;
  }
	textarea:valid~.floating-label,
	textarea:focus~.floating-label{
	top: 4px;
	font-size: 11px;
}
	.input-text:focus {
    outline: none;
  }
  .input-textarea:focus {
    outline: none;
  }
  .floating-label {
    pointer-events: none;
  }
/* Apply "..." after 3 lines of text */
.text-style-3lines {
	display: -webkit-box;
	overflow: hidden;
	-webkit-line-clamp: 3;
	-webkit-box-orient: vertical;
}
/* Apply "..." after 2 lines of text */
.text-style-2lines {
	display: -webkit-box;
	overflow: hidden;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
}
/* Adds inline flex display */
.display-inlineflex {
  display: inline-flex;
}
/* These classes are never overwritten */
.hide {
  display: none !important;
}
@media screen and (max-width: 991px) {
    .hide, .hide-tablet {
        display: none !important;
    }
}
  @media screen and (max-width: 767px) {
    .hide-mobile-landscape{
      display: none !important;
    }
}
  @media screen and (max-width: 479px) {
    .hide-mobile{
      display: none !important;
    }
}
.margin-0 {
  margin: 0rem !important;
}
.padding-0 {
  padding: 0rem !important;
}
.spacing-clean {
padding: 0rem !important;
margin: 0rem !important;
}
.margin-top {
  margin-right: 0rem !important;
  margin-bottom: 0rem !important;
  margin-left: 0rem !important;
}
.padding-top {
  padding-right: 0rem !important;
  padding-bottom: 0rem !important;
  padding-left: 0rem !important;
}
.margin-right {
  margin-top: 0rem !important;
  margin-bottom: 0rem !important;
  margin-left: 0rem !important;
}
.padding-right {
  padding-top: 0rem !important;
  padding-bottom: 0rem !important;
  padding-left: 0rem !important;
}
.margin-bottom {
  margin-top: 0rem !important;
  margin-right: 0rem !important;
  margin-left: 0rem !important;
}
.padding-bottom {
  padding-top: 0rem !important;
  padding-right: 0rem !important;
  padding-left: 0rem !important;
}
.margin-left {
  margin-top: 0rem !important;
  margin-right: 0rem !important;
  margin-bottom: 0rem !important;
}
.padding-left {
  padding-top: 0rem !important;
  padding-right: 0rem !important;
  padding-bottom: 0rem !important;
}
.margin-horizontal {
  margin-top: 0rem !important;
  margin-bottom: 0rem !important;
}
.padding-horizontal {
  padding-top: 0rem !important;
  padding-bottom: 0rem !important;
}
.margin-vertical {
  margin-right: 0rem !important;
  margin-left: 0rem !important;
}
.padding-vertical {
  padding-right: 0rem !important;
  padding-left: 0rem !important;
}
.nav_burger {
    color:#ffffff;
    background:#000;
}
.cross.ml {
    justify-content: center;
    display: flex;
}
</style>
    </div>
   