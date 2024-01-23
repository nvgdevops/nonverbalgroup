<!DOCTYPE html><!--  Last Published: Fri Nov 10 2023 10:42:33 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="651f058e03afa94d69f85ce0" data-wf-site="6477958971ec2048ea86cf88">
<head>
  <meta charset="utf-8">
  <title>Training NVG Platform</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <!-- <link href="css/normalize.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="/assets/css/normalize.css">
  <link rel="stylesheet" href="/assets/css/components.css">
  <link rel="stylesheet" href="/assets/css/training-nvg-platform.css">
  <!-- <link href="css/components.css" rel="stylesheet" type="text/css"> -->
  <!-- <link href="css/training-nvg-platform.css" rel="stylesheet" type="text/css"> -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
  <script src="https://embed.wized.com/FVgRYapZu5V2Hw4JKhSl.js"></script>
  <script data-wized-id="FVgRYapZu5V2Hw4JKhSl" src="https://embed.wized.com"></script>
  <!--  [Attributes by Finsweet] CMS Nest  -->
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
</head>
<body>
  <div class="page-wrapper">
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
.error {
    color: #cd4d4d;
    padding: 10px;
    background: #f9f1f1;
    border-radius: 10px;
    text-align: center;
    font-size: 13px;
}

.success_msg {
    color: green;
    padding: 10px;
    background: #e3f9e0;
    border-radius: 10px;
    text-align: center;
    font-size: 13px;
}
.main-inner {
    padding-bottom: 0%;
}
</style>
    </div>
    <div class="main-inner">
      <main class="main-wrapper">
        <div class="section_full-copy">
          <div id="w-node-_77534a26-80d9-e96b-01b1-49e77b20692b-69f85ce0" class="pane-left background-color-black">
            <div class="padding-global">
              <div class="home_content margin-bottom margin-xlarge">
                <h1 id="w-node-ac329a8f-17ca-0fc9-e3fb-b9e3746dc588-69f85ce0" class="heading-style-medium">The Social Edge</h1>
              </div>
            </div>
            <div class="position-absolute-bottom">
              <div class="align-center">
                <a href="#" class="nav_logo smaller w-inline-block">
                  <div class="embed-logo w-embed"><svg width="100%" style="" viewbox="0 0 252 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.00475 1.09994H0.544746C0.444746 1.09994 0.364746 1.15994 0.364746 1.27994V2.65994C0.364746 2.75994 0.444746 2.83994 0.544746 2.83994H3.82475V13.8199C3.82475 13.9399 3.90475 13.9999 4.00475 13.9999H5.54475C5.66475 13.9999 5.72475 13.9399 5.72475 13.8199V2.83994H9.00475C9.10475 2.83994 9.18475 2.75994 9.18475 2.65994V1.27994C9.18475 1.15994 9.10475 1.09994 9.00475 1.09994Z" fill="white"></path>
                      <path d="M22.9585 1.09994H21.4185C21.2985 1.09994 21.2385 1.15994 21.2385 1.27994V6.63994H15.8185V1.27994C15.8185 1.15994 15.7385 1.09994 15.6385 1.09994H14.0985C13.9785 1.09994 13.9185 1.15994 13.9185 1.27994V13.8199C13.9185 13.9399 13.9785 13.9999 14.0985 13.9999H15.6385C15.7385 13.9999 15.8185 13.9399 15.8185 13.8199V8.37994H21.2385V13.8199C21.2385 13.9399 21.2985 13.9999 21.4185 13.9999H22.9585C23.0785 13.9999 23.1385 13.9399 23.1385 13.8199V1.27994C23.1385 1.15994 23.0785 1.09994 22.9585 1.09994Z" fill="white"></path>
                      <path d="M36.7262 2.83994C36.8262 2.83994 36.8862 2.75994 36.8862 2.65994V1.27994C36.8862 1.15994 36.8262 1.09994 36.7262 1.09994H29.2262C29.1062 1.09994 29.0462 1.15994 29.0462 1.27994V13.8199C29.0462 13.9399 29.1062 13.9999 29.2262 13.9999H36.7262C36.8262 13.9999 36.8862 13.9399 36.8862 13.8199V12.4399C36.8862 12.3399 36.8262 12.2599 36.7262 12.2599H30.9462V8.33994H36.1262C36.2262 8.33994 36.2862 8.25994 36.2862 8.15994V6.77994C36.2862 6.67994 36.2262 6.59994 36.1262 6.59994H30.9462V2.83994H36.7262Z" fill="white"></path>
                      <path d="M59.0388 1.09994H57.4788C57.3788 1.09994 57.2988 1.15994 57.2988 1.27994V7.51994C57.2988 8.61994 57.2988 9.71994 57.3988 11.2199C56.7188 9.71994 56.0588 8.61994 55.3788 7.51994L51.4788 1.21994C51.4388 1.13994 51.3588 1.09994 51.2788 1.09994H49.5988C49.4788 1.09994 49.4188 1.15994 49.4188 1.27994V13.8199C49.4188 13.9399 49.4788 13.9999 49.5988 13.9999H51.1388C51.2388 13.9999 51.3188 13.9399 51.3188 13.8199V7.59994C51.3188 6.47994 51.3188 5.39994 51.2188 3.91994C51.8988 5.39994 52.5588 6.49994 53.2388 7.59994L57.1388 13.8799C57.1988 13.9599 57.2588 13.9999 57.3588 13.9999H59.0388C59.1388 13.9999 59.1988 13.9399 59.1988 13.8199V1.27994C59.1988 1.15994 59.1388 1.09994 59.0388 1.09994Z" fill="white"></path>
                      <path d="M64.913 10.6999C64.913 13.0199 66.013 14.1599 69.593 14.1599H69.713C73.293 14.1599 74.393 13.0199 74.393 10.6999V4.39994C74.393 2.07994 73.293 0.939941 69.713 0.939941H69.593C66.013 0.939941 64.913 2.07994 64.913 4.39994V10.6999ZM66.813 10.6999V4.39994C66.813 3.13994 67.253 2.67994 69.593 2.67994H69.713C72.053 2.67994 72.493 3.13994 72.493 4.39994V10.6999C72.493 11.9599 72.053 12.4199 69.713 12.4199H69.593C67.253 12.4199 66.813 11.9599 66.813 10.6999Z" fill="white"></path>
                      <path d="M89.7239 1.09994H88.1639C88.0639 1.09994 87.9839 1.15994 87.9839 1.27994V7.51994C87.9839 8.61994 87.9839 9.71994 88.0839 11.2199C87.4039 9.71994 86.7439 8.61994 86.0639 7.51994L82.1639 1.21994C82.1239 1.13994 82.0439 1.09994 81.9639 1.09994H80.2839C80.1639 1.09994 80.1039 1.15994 80.1039 1.27994V13.8199C80.1039 13.9399 80.1639 13.9999 80.2839 13.9999H81.8239C81.9239 13.9999 82.0039 13.9399 82.0039 13.8199V7.59994C82.0039 6.47994 82.0039 5.39994 81.9039 3.91994C82.5839 5.39994 83.2439 6.49994 83.9239 7.59994L87.8239 13.8799C87.8839 13.9599 87.9439 13.9999 88.0439 13.9999H89.7239C89.8239 13.9999 89.8839 13.9399 89.8839 13.8199V1.27994C89.8839 1.15994 89.8239 1.09994 89.7239 1.09994Z" fill="white"></path>
                      <path d="M104.698 1.09994H103.078C102.978 1.09994 102.918 1.11994 102.878 1.23994L100.758 7.89994C100.418 8.97994 100.078 10.0799 99.758 11.7999C99.418 10.0599 99.078 8.97994 98.7381 7.89994L96.618 1.23994C96.578 1.11994 96.5181 1.09994 96.4181 1.09994H94.798C94.678 1.09994 94.5981 1.17994 94.6381 1.29994L98.6981 13.8199C98.7381 13.9399 98.8181 13.9999 98.9181 13.9999H100.578C100.678 13.9999 100.758 13.9399 100.798 13.8199L104.858 1.29994C104.898 1.17994 104.818 1.09994 104.698 1.09994Z" fill="white"></path>
                      <path d="M117.297 2.83994C117.397 2.83994 117.457 2.75994 117.457 2.65994V1.27994C117.457 1.15994 117.397 1.09994 117.297 1.09994H109.797C109.677 1.09994 109.617 1.15994 109.617 1.27994V13.8199C109.617 13.9399 109.677 13.9999 109.797 13.9999H117.297C117.397 13.9999 117.457 13.9399 117.457 13.8199V12.4399C117.457 12.3399 117.397 12.2599 117.297 12.2599H111.517V8.33994H116.697C116.797 8.33994 116.857 8.25994 116.857 8.15994V6.77994C116.857 6.67994 116.797 6.59994 116.697 6.59994H111.517V2.83994H117.297Z" fill="white"></path>
                      <path d="M131.454 13.7799L129.014 9.21994C130.634 8.87994 131.334 7.81994 131.334 5.95994V4.47994C131.334 2.17994 130.254 1.09994 127.674 1.09994H122.894C122.774 1.09994 122.714 1.15994 122.714 1.27994V13.8199C122.714 13.9399 122.774 13.9999 122.894 13.9999H124.434C124.534 13.9999 124.614 13.9399 124.614 13.8199V9.33994H127.034L129.334 13.8599C129.394 13.9799 129.454 13.9999 129.554 13.9999H131.314C131.454 13.9999 131.534 13.9199 131.454 13.7799ZM124.614 2.83994H127.254C129.094 2.83994 129.434 3.17994 129.434 4.47994V5.95994C129.434 7.25994 129.094 7.61994 127.254 7.61994H124.614V2.83994Z" fill="white"></path>
                      <path d="M143.885 7.41994C144.985 7.05994 145.385 6.29994 145.385 4.93994V4.37994C145.385 2.21994 144.345 1.09994 141.725 1.09994H137.045C136.925 1.09994 136.865 1.15994 136.865 1.27994V13.8199C136.865 13.9399 136.925 13.9999 137.045 13.9999H142.185C144.825 13.9999 145.845 12.8799 145.845 10.7199V10.0199C145.845 8.49994 145.345 7.69994 143.885 7.41994ZM141.305 2.81994C143.125 2.81994 143.485 3.15994 143.485 4.43994V4.99994C143.485 6.27994 143.125 6.61994 141.305 6.61994H138.745V2.81994H141.305ZM143.945 10.6599C143.945 11.9399 143.565 12.2799 141.745 12.2799H138.745V8.33994H141.745C143.565 8.33994 143.945 8.67994 143.945 9.95994V10.6599Z" fill="white"></path>
                      <path d="M160.376 13.7999L156.036 1.23994C155.996 1.11994 155.916 1.09994 155.836 1.09994H154.416C154.316 1.09994 154.236 1.11994 154.196 1.23994L149.856 13.7999C149.816 13.9399 149.896 13.9999 150.016 13.9999H151.616C151.716 13.9999 151.796 13.9599 151.836 13.8599L152.796 11.0399H157.456L158.416 13.8599C158.456 13.9599 158.536 13.9999 158.616 13.9999H160.236C160.356 13.9999 160.416 13.9399 160.376 13.7999ZM153.376 9.31994L154.176 6.93994C154.496 6.01994 154.816 5.07994 155.116 3.71994C155.436 5.07994 155.756 6.01994 156.056 6.93994L156.876 9.31994H153.376Z" fill="white"></path>
                      <path d="M172.208 12.2599H167.028V1.27994C167.028 1.15994 166.948 1.09994 166.848 1.09994H165.308C165.188 1.09994 165.128 1.15994 165.128 1.27994V13.8199C165.128 13.9399 165.188 13.9999 165.308 13.9999H172.208C172.308 13.9999 172.388 13.9399 172.388 13.8199V12.4399C172.388 12.3399 172.308 12.2599 172.208 12.2599Z" fill="white"></path>
                      <path d="M191.553 4.91994H193.093C193.213 4.91994 193.273 4.83994 193.273 4.73994V4.39994C193.273 2.07994 192.173 0.939941 188.653 0.939941H188.533C185.033 0.939941 183.933 2.07994 183.933 4.39994V10.6999C183.933 13.0199 185.033 14.1599 188.533 14.1599H188.653C192.173 14.1599 193.273 13.0199 193.273 10.6999V7.37994C193.273 7.27994 193.213 7.21994 193.093 7.21994H188.933C188.833 7.21994 188.753 7.27994 188.753 7.37994V8.73994C188.753 8.83994 188.833 8.89994 188.933 8.89994H191.373V10.6999C191.373 11.9599 190.933 12.4199 188.653 12.4199H188.533C186.273 12.4199 185.833 11.9599 185.833 10.6999V4.39994C185.833 3.13994 186.273 2.67994 188.533 2.67994H188.653C190.933 2.67994 191.373 3.13994 191.373 4.39994V4.73994C191.373 4.83994 191.433 4.91994 191.553 4.91994Z" fill="white"></path>
                      <path d="M207.63 13.7799L205.19 9.21994C206.81 8.87994 207.51 7.81994 207.51 5.95994V4.47994C207.51 2.17994 206.43 1.09994 203.85 1.09994H199.07C198.95 1.09994 198.89 1.15994 198.89 1.27994V13.8199C198.89 13.9399 198.95 13.9999 199.07 13.9999H200.61C200.71 13.9999 200.79 13.9399 200.79 13.8199V9.33994H203.21L205.51 13.8599C205.57 13.9799 205.63 13.9999 205.73 13.9999H207.49C207.63 13.9999 207.71 13.9199 207.63 13.7799ZM200.79 2.83994H203.43C205.27 2.83994 205.61 3.17994 205.61 4.47994V5.95994C205.61 7.25994 205.27 7.61994 203.43 7.61994H200.79V2.83994Z" fill="white"></path>
                      <path d="M212.685 10.6999C212.685 13.0199 213.785 14.1599 217.365 14.1599H217.485C221.065 14.1599 222.165 13.0199 222.165 10.6999V4.39994C222.165 2.07994 221.065 0.939941 217.485 0.939941H217.365C213.785 0.939941 212.685 2.07994 212.685 4.39994V10.6999ZM214.585 10.6999V4.39994C214.585 3.13994 215.025 2.67994 217.365 2.67994H217.485C219.825 2.67994 220.265 3.13994 220.265 4.39994V10.6999C220.265 11.9599 219.825 12.4199 217.485 12.4199H217.365C215.025 12.4199 214.585 11.9599 214.585 10.6999Z" fill="white"></path>
                      <path d="M227.776 10.6999C227.776 13.0199 228.876 14.1599 232.316 14.1599H232.436C235.876 14.1599 236.976 13.0199 236.976 10.6999V1.27994C236.976 1.15994 236.916 1.09994 236.796 1.09994H235.256C235.156 1.09994 235.076 1.15994 235.076 1.27994V10.6999C235.076 11.9599 234.636 12.4199 232.436 12.4199H232.316C230.116 12.4199 229.676 11.9599 229.676 10.6999V1.27994C229.676 1.15994 229.596 1.09994 229.496 1.09994H227.956C227.836 1.09994 227.776 1.15994 227.776 1.27994V10.6999Z" fill="white"></path>
                      <path d="M247.789 1.09994H242.969C242.849 1.09994 242.789 1.15994 242.789 1.27994V13.8199C242.789 13.9399 242.849 13.9999 242.969 13.9999H244.509C244.609 13.9999 244.689 13.9399 244.689 13.8199V9.59994H247.789C250.309 9.59994 251.429 8.49994 251.429 6.21994V4.47994C251.429 2.19994 250.309 1.09994 247.789 1.09994ZM249.529 6.21994C249.529 7.49994 249.169 7.87994 247.329 7.87994H244.689V2.83994H247.329C249.169 2.83994 249.529 3.21994 249.529 4.47994V6.21994Z" fill="white"></path>
                    </svg></div>
                </a>
              </div>
            </div>
          </div>
         
          <div id="w-node-_07c63409-b9c9-c9bf-88e3-7e180461c51b-69f85ce0" class="pane-right">
            <div class="padding-global">
              <div>
              @if(Session::has('error'))
              <p class="error">{{ Session::get('error') }}</p>
              @endif
              
              @if(Session::has('success'))
              <p class="success_msg">{{ Session::get('success') }}</p>
              @endif
                <div data-current="Tab 1" data-easing="ease" data-duration-in="250" data-duration-out="100" class="home_tabs w-tabs">
                  <div class="tabs-menu w-tab-menu">
                    <a data-w-tab="Tab 1" class="home_tab-link w-inline-block w-tab-link w--current">
                      <div>Log in</div>
                    </a>
                    <a data-w-tab="Tab 2" class="home_tab-link w-inline-block w-tab-link">
                      <div>Create Account</div>
                    </a>
                  </div>
                  <div class="w-tab-content">
                    <div data-w-tab="Tab 1" class="w-tab-pane w--tab-active">
                      <div class="login-form w-form">
                        <form action="{{ route('post-login') }}" method="post"  id="wf-form-Login-Form" name="wf-form-Login-Form" data-name="Login Form"  class="form" data-wf-page-id="651f058e03afa94d69f85ce0" data-wf-element-id="8e3a1d49-54a7-b113-3938-89b78948bf1c">
                        @csrf
                          <div class="padding-section-small">
                            <div class="form-wrapper">
                              <div class="field-wrap"><input type="email" class="input-text w-input" maxlength="256" name="email" data-name="Email" placeholder="john@doe.com" id="email" w-el="signin_email" required="">
                                <div class="floating-label">Email address</div>
                              </div>
                              <input type="submit" value="Log in with Email" data-wait="Please Wait..." class="button hide w-button">
                              <button fs-mirrorclick-element="trigger-99" data-w-id="8b9d3c23-5252-d5cd-7c0c-3eba90a219bd" href="#" class="button anim w-inline-block">
                                <div class="content-block">
                                  <div style="width:0px" class="block-lottie">
                                    <div class="icon _20px filter-invert" data-w-id="8b9d3c23-5252-d5cd-7c0c-3eba90a219c0" data-animation-type="lottie" data-src="https://uploads-ssl.webflow.com/64d2258b0582aa5f823d1181/64edf8295ca61e3541901607_loading.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-duration="0"></div>
                                  </div>
                                   <div>Log in with Email</div> 
                                </div>
                              </button> 
                            </div>
                            <div class="line hide"></div>
                            <div id="w-node-cb7a29a4-0134-977a-7333-572de7331777-69f85ce0" class="form-wrapper hide">
                              <a href="#" class="button is-social w-inline-block">
                                <div id="w-node-_4ce346f4-7bb4-a44b-1919-1051b6128194-69f85ce0" class="icon-arrow">
                                  <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M23.25 12.0676C23.2497 9.91778 22.6334 7.81304 21.474 6.00258C20.3147 4.19211 18.6608 2.75175 16.7083 1.852C14.7558 0.952245 12.5864 0.630788 10.4568 0.925682C8.32731 1.22058 6.32687 2.11947 4.69233 3.51595C3.0578 4.91243 1.85762 6.74801 1.23389 8.8054C0.610155 10.8628 0.588985 13.0558 1.17288 15.1248C1.75678 17.1939 2.9213 19.0523 4.52857 20.4801C6.13584 21.9078 8.11856 22.8452 10.242 23.1811V15.3193H7.3875V12.0676H10.2435V9.58889C10.2435 6.76926 11.9235 5.21189 14.4926 5.21189C15.3363 5.22359 16.1781 5.29691 17.0111 5.43126V8.20026H15.591C15.3492 8.16838 15.1034 8.19126 14.8716 8.26719C14.6399 8.34313 14.4282 8.47019 14.2521 8.63898C14.0761 8.80777 13.9403 9.01397 13.8547 9.24232C13.7691 9.47068 13.7359 9.71536 13.7576 9.95826V12.0676H16.8784L16.3793 15.3193H13.7576V23.1811C16.4041 22.7625 18.8142 21.4132 20.5544 19.3758C22.2945 17.3385 23.2504 14.747 23.25 12.0676Z" fill="black"></path>
                                    </svg></div>
                                </div>
                                <div class="label-size-regular">Facebook login</div>
                              </a>
                              <a href="#" class="button is-social w-inline-block">
                                <div id="w-node-b6f29229-8b55-6033-c23c-33939299422c-69f85ce0" class="icon-arrow">
                                  <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M22.4277 10.0227H12.0469V14.4717H17.9299C16.9902 17.4376 14.6674 18.4261 11.9997 18.4261C10.9661 18.4275 9.94742 18.1796 9.0301 17.7033C8.11277 17.2271 7.32386 16.5366 6.7303 15.6904C6.13674 14.8443 5.75604 13.8674 5.62051 12.8427C5.48498 11.8181 5.59862 10.7758 5.95178 9.80447C6.30494 8.83309 6.8872 7.96123 7.64916 7.26287C8.41112 6.5645 9.33029 6.06024 10.3287 5.79286C11.3271 5.52549 12.3753 5.50289 13.3843 5.72698C14.3933 5.95107 15.3333 6.41525 16.1247 7.08012L19.3575 4.00137C18.0557 2.8037 16.4813 1.94176 14.7709 1.49034C13.0605 1.03892 11.2658 1.01166 9.54249 1.41092C7.81918 1.81017 6.21931 2.62389 4.88169 3.78147C3.54407 4.93904 2.5091 6.40552 1.86658 8.05366C1.22405 9.70181 0.993383 11.4818 1.19458 13.2393C1.39577 14.9968 2.02275 16.6786 3.02112 18.1389C4.01949 19.5992 5.3591 20.7939 6.92372 21.6192C8.48834 22.4445 10.2307 22.8757 11.9997 22.8751C17.9963 22.8751 23.4162 18.9207 22.4277 10.0227Z" fill="black"></path>
                                    </svg></div>
                                </div>
                                <div class="label-size-regular">Google login</div>
                              </a>
                            </div>
                          </div>
                        </form>
                        <div class="success-msg w-form-done"></div>
                        <div class="form-error w-form-fail">
                          <div>Ooops... something went wrong.<br>Please refresh the page and try again</div>
                        </div>
                      </div>
                    </div>
                    <div data-w-tab="Tab 2" class="w-tab-pane">
                      <div class="login-form w-form">
                        <form action="{{ route('post-registration') }}" method="post" id="wf-form-Signup-Form" name="wf-form-Signup-Form" data-name="Signup Form" method="post" class="form" data-wf-page-id="651f058e03afa94d69f85ce0" data-wf-element-id="d41f369d-fab0-b855-33dd-bd5b6167c7cf">
                          @csrf
                          <div class="padding-section-small">
                            <div class="form-wrapper">
                              <div class="field-wrap"><input type="text" class="input-text w-input" maxlength="256" name="name" data-name="Email 2" placeholder="john@doe.com" id="email-2" w-el="signup_name" required="">
                                <div class="floating-label">Name</div>
                              </div>
                              <div class="field-wrap"><input type="email" class="input-text w-input" maxlength="256" name="email" data-name="Email 2" placeholder="john@doe.com" id="email-2" w-el="signup_email" required="">
                                <div class="floating-label">Email address</div>
                              </div>
                              <label id="w-node-d41f369d-fab0-b855-33dd-bd5b6167c7da-69f85ce0" class="w-checkbox c-checkbox-field hide">
                                <div class="w-checkbox-input w-checkbox-input--inputType-custom c-checkbox"></div><input type="checkbox" id="privacy-checkbox-2" name="privacy-checkbox-2" data-name="Privacy Checkbox 2" style="opacity:0;position:absolute;z-index:-1"><span class="w-form-label" for="privacy-checkbox-2">By filling out this contact form you agree to our terms and privacy policy.</span>
                              </label><input type="submit" value="Start now" data-wait="Please Wait..."   w-el="signup_submit" class="button hide w-button">
                              <button  href="#" class="button anim w-inline-block">
                                <div class="content-block">
                                  <div style="width:0px" class="block-lottie">
                                    <div class="icon _20px filter-invert" data-w-id="80154231-8c1e-3673-d59f-8bb793f4ee4d" data-animation-type="lottie" data-src="https://uploads-ssl.webflow.com/64d2258b0582aa5f823d1181/64edf8295ca61e3541901607_loading.json" data-loop="1" data-direction="1" data-autoplay="1" data-is-ix2-target="0" data-renderer="svg" data-duration="0"></div>
                                  </div>
                                  <div>Start Now</div>
                                </div>
                             </button>
                            </div>
                            <div class="line hide"></div>
                            <div id="w-node-d41f369d-fab0-b855-33dd-bd5b6167c7e0-69f85ce0" class="form-wrapper hide">
                              <a href="#" class="button is-social w-inline-block">
                                <div id="w-node-d41f369d-fab0-b855-33dd-bd5b6167c7e2-69f85ce0" class="icon-arrow">
                                  <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M23.25 12.0676C23.2497 9.91778 22.6334 7.81304 21.474 6.00258C20.3147 4.19211 18.6608 2.75175 16.7083 1.852C14.7558 0.952245 12.5864 0.630788 10.4568 0.925682C8.32731 1.22058 6.32687 2.11947 4.69233 3.51595C3.0578 4.91243 1.85762 6.74801 1.23389 8.8054C0.610155 10.8628 0.588985 13.0558 1.17288 15.1248C1.75678 17.1939 2.9213 19.0523 4.52857 20.4801C6.13584 21.9078 8.11856 22.8452 10.242 23.1811V15.3193H7.3875V12.0676H10.2435V9.58889C10.2435 6.76926 11.9235 5.21189 14.4926 5.21189C15.3363 5.22359 16.1781 5.29691 17.0111 5.43126V8.20026H15.591C15.3492 8.16838 15.1034 8.19126 14.8716 8.26719C14.6399 8.34313 14.4282 8.47019 14.2521 8.63898C14.0761 8.80777 13.9403 9.01397 13.8547 9.24232C13.7691 9.47068 13.7359 9.71536 13.7576 9.95826V12.0676H16.8784L16.3793 15.3193H13.7576V23.1811C16.4041 22.7625 18.8142 21.4132 20.5544 19.3758C22.2945 17.3385 23.2504 14.747 23.25 12.0676Z" fill="black"></path>
                                    </svg></div>
                                </div>
                                <div class="label-size-regular">Facebook login</div>
                              </a>
                              <a href="#" class="button is-social w-inline-block">
                                <div id="w-node-d41f369d-fab0-b855-33dd-bd5b6167c7e7-69f85ce0" class="icon-arrow">
                                  <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M22.4277 10.0227H12.0469V14.4717H17.9299C16.9902 17.4376 14.6674 18.4261 11.9997 18.4261C10.9661 18.4275 9.94742 18.1796 9.0301 17.7033C8.11277 17.2271 7.32386 16.5366 6.7303 15.6904C6.13674 14.8443 5.75604 13.8674 5.62051 12.8427C5.48498 11.8181 5.59862 10.7758 5.95178 9.80447C6.30494 8.83309 6.8872 7.96123 7.64916 7.26287C8.41112 6.5645 9.33029 6.06024 10.3287 5.79286C11.3271 5.52549 12.3753 5.50289 13.3843 5.72698C14.3933 5.95107 15.3333 6.41525 16.1247 7.08012L19.3575 4.00137C18.0557 2.8037 16.4813 1.94176 14.7709 1.49034C13.0605 1.03892 11.2658 1.01166 9.54249 1.41092C7.81918 1.81017 6.21931 2.62389 4.88169 3.78147C3.54407 4.93904 2.5091 6.40552 1.86658 8.05366C1.22405 9.70181 0.993383 11.4818 1.19458 13.2393C1.39577 14.9968 2.02275 16.6786 3.02112 18.1389C4.01949 19.5992 5.3591 20.7939 6.92372 21.6192C8.48834 22.4445 10.2307 22.8757 11.9997 22.8751C17.9963 22.8751 23.4162 18.9207 22.4277 10.0227Z" fill="black"></path>
                                    </svg></div>
                                </div>
                                <div class="label-size-regular">Google login</div>
                              </a>
                            </div>
                          </div>
                        </form>
                        <div class="success-msg w-form-done"></div>
                        <div class="form-error w-form-fail">
                          <div>Ooops... something went wrong.<br>Please refresh the page and try again</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6477958971ec2048ea86cf88" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="<?php echo URL("/") ?>/assets/js/training-nvg-platform-3c3dc0a66fa7c2e1d.js" type="text/javascript"></script>
   
</body>
</html>