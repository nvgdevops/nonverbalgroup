@extends('userlayout.quiz_main')
@section('title','Quiz')
@section('main-container')

<style>
       progress::-webkit-progress-bar {background-color: rgb(255 255 255 / 20%); !important}
    progress {background-color: black; height:0.25rem !important}
    
    progress::-webkit-progress-value {background-color: white !important;}
    progress::-moz-progress-bar {background-color: white !important;}
    progress {color: #fff;}
    label.w-checkbox.checkbox_field.selected { background: #fff; color: #000; border: 2px solid; }
    .grid-questions{display:block;}
    .btn-skip:hover {
    opacity: .75;
} 
</style>
   <div class="navigation">
      <div class="nav">
        <div class="padding-global full-width nav-top">
          <div class="navigation_practise">
             <div class="nav_burger" onclick="$('.ml').toggle();">
              <div class="menu-line ml"></div>
              <div class="menu-line ml"></div>
              <div class="menu-line ml"></div>
              <div class="cross ml" style="display:none;">
                  <svg width="23" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;stroke:#FFF;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><title/><g id="cross"><line class="cls-1" x1="7" x2="25" y1="7" y2="25"/><line class="cls-1" x1="7" x2="25" y1="25" y2="7"/></g></svg>
              </div>
            </div>
            <div class="progess_bar-wrapper">
              <div class="label-size-regular"> </div>
              <?php if($answers != 'complete') { ?>
                    <progress style="width:100%;height: 0.5rem;border: 1px solid var(--black--40);" id="quiz_progress" class="progress hide" value="<?php echo $answers; ?>" max="<?php echo count($question); ?>"> </progress>
                <?php } ?>
              <div class="hide">
                <a w-el="logo_dashboard" href="#" class="nav_logo w-inline-block">
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
            <a href="#" class="button-back background-color-black back-link w-inline-block">
              <div class="back_button-wrapper">
                <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H8V8H0V0ZM1 1H7V7H1V1Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10H8V18H0V10ZM1 11H7V17H1V11Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 10V18H18V10H10ZM17 11H11V17H17V11Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0H18V8H10V0ZM11 1H17V7H11V1Z" fill="currentColor"></path>
                  </svg></div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
      <div class="navside_bar-copy">
        <div class="navside_bar">
          <div class="sidebar-wrapper">
            <div class="grid-auto-column align-left margin-bottom margin-small">
              <?php $u = \App\Models\User::find(Auth::id()); ?>
              <h6 w-el="user_name">{{ $u->name }}</h6>
            </div>
            <!-- the-social-edge-onboarding -->
            <a href="/phase" class="sidebar-link is-first w-inline-block">
              <div>DASHBOARD</div>
            </a>
            <a href="#" class="sidebar-link hide w-inline-block">
              <div>ACCOUNT SETTINGS</div>
            </a>
             <a href="mailto:<?php echo config('app.CONTACT_MAIL_EMAIL');  ?>?subject=<?php echo config('app.CONTACT_MAIL_SUBJECT'); ?>" class="sidebar-link w-inline-block">
              <div>CONTACT</div>
            </a>
            <a href="#" class="sidebar-link hide w-inline-block">
              <div>CALENDAR</div>
            </a>
            <a href="#" class="sidebar-link hide w-inline-block">
              <div>CHANGE COURSE</div>
            </a>
            <a href="#" class="sidebar-link hide w-inline-block">
              <div>COMMUNITY</div>
            </a>
            <a w-el="logout_btn" onclick='if(confirm("Are you sure you want to logout?")) { window.location.href = "<?php echo URL("/") ?>/logout"; }' style="cursor:pointer;" class="sidebar-link logout is-last w-inline-block">
              <div>Logout</div>
            </a>
          </div>
        </div>
      </div>
    </div>

<div class="main-inner">
    <main class="main-wrapper">
        <section class="section_full vertical">
            <div class="padding-global">
                <div class="padding-section-medium">
                    <div class="container-large">
                        <div id="quiz-form" data-name="" aria-label="" class="practise_test w-form">
                            <form  method="post"  id="wf-form-" name="wf-form-" data-name="" method="get" aria-label=""
                                data-wf-page-id="655b434272e0596d7e6126dc"
                                data-wf-element-id="de825dac-121b-716a-ba67-9122cced1565">
                                @csrf
                                <div data-delay="4000" data-animation="outin" class="slider w-slider"
                                    data-autoplay="false" data-easing="ease" data-hide-arrows="false"
                                    data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3"
                                    data-duration="500" data-infinite="false" fs-cmsslider-element="slider" id="slider">
                                    <div id="mask" class="mask w-slider-mask">
                                        <div class="slide w-slide 111"></div>


                                    </div>
                                    <div class="slider_left-arrow w-slider-arrow-left">
                                        <div id="w-node-de825dac-121b-716a-ba67-9122cced15ad-7e6126dc"
                                            class="next-btn background-color-black">
                                            <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 22 12"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5 11.5L5.79 10.78L1.9 6.5L22 6.5L22 5.5L1.9 5.5L5.79 1.22L5.28 0.499999L4.80825e-07 6L5 11.5Z"
                                                        fill="currentColor"></path>
                                                </svg></div>
                                        </div>
                                    </div>
                                    <div class="slider_right-arrow w-slider-arrow-right" >
                                        <div fs-mirrorclick-element="target"
                                            id="w-node-de825dac-121b-716a-ba67-9122cced15b0-7e6126dc"
                                            class="next-btn background-color-black">
                                            <div class="embed w-embed"><svg width="100%" style="" viewbox="0 0 22 12"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_615_455)">
                                                        <path
                                                            d="M17 0.5L16.21 1.22L20.1 5.5L0 5.5L0 6.5L20.1 6.5L16.21 10.78L16.72 11.5L22 6L17 0.5Z"
                                                            fill="currentColor"></path>
                                                    </g>
                                                    <defs>
                                                        <clippath id="clip0_615_455">
                                                            <rect width="22" height="11" fill="currentColor"
                                                                transform="translate(0 0.5)"></rect>
                                                        </clippath>
                                                    </defs>
                                                </svg></div>
                                        </div>
                                    </div>
                                    <div class="hide w-slider-nav w-round w-num"></div>
                                </div>
                                
                                <div class="hide"><input type="text" class="w-input" maxlength="256" name="User-ID"
                                        data-name="User ID" placeholder="Example Text" id="User-ID"
                                        w-el="input_quiz_author" required=""><input type="text" class="w-input"
                                        maxlength="256" name="User-Email" data-name="User Email"
                                        placeholder="Example Text" id="User-Email" w-el="input_quiz_author_name"
                                        required="">
                                    <div>
                                        <div class="w-dyn-list">
                                            <div role="list" class="w-dyn-items">
                                                <div role="listitem" class="w-dyn-item">
                                                    <div fs-cmsselect-element="text-value"></div>
                                                </div>
                                            </div>
                                            <div class="w-dyn-empty">
                                                <div>No items found.</div>
                                            </div>
                                        </div><select id="select-cms" name="Quiz-Name" data-name="Quiz Name"
                                            fs-cmsselect-element="select" class="w-select"></select>
                                    </div>
                                </div>
                                
                                <div class="w-dyn-list">
                                    <div id="grid-list" fs-cmsslider-element="list" fs-cmsstatic-element="list"
                                        fs-cmsfilter-element="list" role="list" class="grid-auto-row w-dyn-items">
                                        <input type="hidden" value="{{$lesson->quiz_id}}" name="quiz_id" id="quiz_id">
                                        <input type="hidden" value="{{$lesson->id}}" name="lesson_id" id="lesson_id">
                                        
                                        <?php  $q_id = 1; ?>
                                        @foreach($question as $q)
                                        
                                            <?php 
                                                if($answers >= $q_id || $answers == 'complete') { $q_id++; continue; } 
                                                $last = (count($question) == $q_id) ? 1 : 0;
                                            ?>
                                        
                                        <div role="listitem" class="w-dyn-item">
                                            <div class="container-medium">
                                                <div class="practise_content">
                  <!--                                  <div style="width:100%;text-align:center;">
                                                        <progress style="width:60%;height: 0.5rem;border: 1px solid var(--black--40);" class="progress" value="{{($q_id-1)}}" max="<?php echo count($question); ?>"> </progress>
                                                    </div>-->
                                                    <div class="practise_question">
                                                        <div class="practise_title">
                                                            <div class="grid-auto-column align-left">
                                                                <div class="label-size-small text-weight-light items-count"><?php echo count($question); ?></div>
                                                                <div class="label-size-small text-weight-light">/</div>
                                                                <div class="label-size-small text-weight-light">{{$q_id++}}</div>
                                                                <div class="label-size-small text-weight-light">- QUESTION </div>
                                                            </div>
                                                            <h2 class="heading-style-h2"> {{$q->question}} </h2>
                                                        </div>
                                                        <div class="text-size-regular margin-bottom margin-small">{{$q->more_information}}</div>
                                                    </div>
                                                    <div class="grid-questions text-input-wrapper">
                                                        <div id="w-node-de825dac-121b-716a-ba67-9122cced15d1-7e6126dc"
                                                            class="practise_answer">
                                                            <input type="hidden" value="{{$q->id}}" name="question_id" id="question_id{{$q->id}}">
                                                            <input type="hidden" value="{{$q->question_type}}" name="question_type" id="question_type{{$q->id}}">
                                                            
                                                            @if($q->question_type == 'multiple')
                                                            
                                                                @foreach(json_decode($q->answer) as $key => $a)
                                                            
                                                                    <label class="w-checkbox checkbox_field multibox">
                                                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox_button"></div>
                                                                        <input type="checkbox" id="que_option{{$q_id}}{{$key}}" name="options{{$q->id}}" value="{{ $a }}" class="select_option" onchange="multipleChange({{$q->id}})" style="opacity:0;position:absolute;z-index:-1">
                                                                        <span fs-cmsfilter-field="category" fs-cmsfilter-active="is-active" class="checkbox_label w-form-label" for="que_option{{$q_id}}{{$key}}">
                                                                            {{ $a }}
                                                                        </span>
                                                                    </label>
                                                                
                                                                @endforeach
                                                            
                                                            @elseif($q->question_type == 'ranking')
                                                            
                                                                @foreach(json_decode($q->answer) as $key => $a)
                                                            
                                                                    <label class="w-checkbox checkbox_field radiobox">
                                                                        <div class="w-checkbox-input w-checkbox-input--inputType-custom checkbox_button"></div>
                                                                        <input type="radio" id="que_option{{$q_id}}{{$key}}" name="options{{$q->id}}" value="{{ $a }}" class="select_option" onchange="rankingChange({{$q->id}})" style="opacity:0;position:absolute;z-index:-1">
                                                                        <span fs-cmsfilter-field="category" fs-cmsfilter-active="is-active" class="checkbox_label w-form-label" for="que_option{{$q_id}}{{$key}}">
                                                                            {{ $a }}
                                                                        </span>
                                                                    </label>
                                                                
                                                                @endforeach
                                                            
                                                            @else
                                                            
                                                                <textarea id="field" name="answer" maxlength="5000"
                                                                    data-name="Field" onkeyup="textinputChange({{$q->id}})" placeholder="Your Answer here..."
                                                                    class="textarea answer{{$q->id}} text-item margin-bottom margin-medium w-node-de825dac-121b-716a-ba67-9122cced15d2-7e6126dc w-input"></textarea>
                                                            
                                                            @endif
                                                            
                                                        </div>
                                                        
                                                        <div id="w-node-de825dac-121b-716a-ba67-9122cced15d8-7e6126dc"
                                                            class="hide">
                                                            <div id="w-node-de825dac-121b-716a-ba67-9122cced15d9-7e6126dc"
                                                                class="w-embed"><input type="text" class="text-input"
                                                                    name="" placeholder="Enter your text here"></div>
                                                        </div>
                                                        <div id="w-node-de825dac-121b-716a-ba67-9122cced15da-7e6126dc"
                                                            class="label-size-regular text-item hide">NOT REALLY</div>
                                                    </div>
                                                    <div class="practise_bottom-wrapper">
                                                        <div id="w-node-de825dac-121b-716a-ba67-9122cced15d3-7e6126dc"
                                                        class="align-left">
                                                            <div class="position-relative mobile-full-width">
                                                                <a href="/phase" style="text-decoration:none;color:#000;" class="label-size-small btn-skip">SKIP FOR NOW</a>
                                                            </div>
                                                        </div>
                                                        <div id="w-node-de825dac-121b-716a-ba67-9122cced15d3-7e6126dc"
                                                            class="align-right">
                                                            <div class="position-relative mobile-full-width">
                                                                <button onclick="submit_answer({{$q->id}},{{$last}})" id="frmsubmit" fs-mirrorclick-element="trigger" 
                                                                    class="button mobile-full-width w-button">NEXT</button>
                                                                <div class="lock-wrapper lock{{$q->id}}"></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    <div class="w-dyn-empty">
                                        <div>No items found.</div>
                                    </div>
                                </div>
                               
                                <?php if($answers == 'complete') { ?> 
                                <div id="bottom-submit" fs-cmsstatic-order="10" fs-cmsstatic-element="static-item"
                                    class="container-medium static-height slide">
                                    <div class="container-medium">
                                        <div class="practise_content">
                                            <div>
                                                <div class="padding-global">
                                                    <div class="container-medium">
                                                        <div class="div-block">
                                                            <div class="margin-bottom margin-medium mobile">
                                                                <h3 class="justify-center mobile">You already submitted the assessment</h3>
                                                            </div> 
                                                               @if($next_slug)
                                                                <a href="<?php echo URL("/") ?>/quizes/{{$next_slug}}" class="button is-icon label-size-regular bigger w-button">
                                                                    <div class="label-size-small">Proceed to the next lesson </div>
                                                                </a>
                                                                @endif
                                                            <a href="#" class="button-skip hide w-inline-block">
                                                                <div class="label-size-small">SKIP FOR NOW</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } else{ ?>
                                 <div id="bottom-submit" fs-cmsstatic-order="10" fs-cmsstatic-element="static-item"
                                    class="container-medium static-height slide">
                                    <div class="container-medium">
                                        <div class="practise_content">
                                            <div>
                                                <div class="padding-global">
                                                    <div class="container-medium">
                                                        <div class="div-block">
                                                            <div class="margin-bottom margin-medium mobile">
                                                                <h3 class="justify-center mobile">Thanks for your responses</h3>
                                                            </div><!-- <input type="submit" id="submit-quiz" value="Submit"
                                                                data-wait="Please wait..."
                                                                class="button is-icon label-size-regular bigger w-button"> -->
                                                            @if($next_slug)
                                                            <a href="<?php echo URL("/") ?>/quizes/{{$next_slug}}" class="button is-icon label-size-regular bigger w-button">
                                                                <div class="label-size-small">Proceed to the next lesson</div>
                                                            </a>
                                                            @endif
                                                            <a href="#" class="button-skip hide w-inline-block">
                                                                <div class="label-size-small">SKIP FOR NOW</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </form>
                            <div class="success-message w-form-done">
                                <div class="heading-style-h2 margin-bottom margin-xsmall">Thank you!<br>Your submission
                                    has been received!</div>
                                <div class="margin-bottom margin-medium">Proceed to the next assessment</div>
                                <div class="align-center">
                                    <div fs-cmsprevnext-element="next"></div>
                                </div>
                            </div>
                            <div class="w-form-fail">
                                <div>Oops! Something went wrong while submitting the form.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="hide">
            <div class="w-dyn-list">
                <div fs-cmscombine-element="list" fs-cmsprevnext-element="list" role="list" class="w-dyn-items">
                    <div role="listitem" class="w-dyn-item">
                        <a fs-cmsprevnext-element="next" href="#" class="button w-inline-block">
                            <div></div>
                        </a>
                    </div>
                </div>
                <div class="w-dyn-empty">
                    <div>No items found.</div>
                </div>
            </div>
            <div class="hide w-form">
                <form id="email-form" name="email-form" data-name="Email Form" method="get"
                    data-wf-page-id="655b434272e0596d7e6126dc"
                    data-wf-element-id="cc2eb3ce-4fc2-9272-bf58-f97fb59c928b"><input type="text" class="w-input"
                        maxlength="256" name="User-Email-2" data-name="User Email 2" placeholder="Example Text"
                        id="User-Email-2" w-el="input_quiz_author_name" required=""></form>
                <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                </div>
            </div>
        </div>
    </main>
</div>
<div w-el="loader" class="loader">
    <div class="loader-wrapper">
        <div class="lottie-wrapper">
            <div data-w-id="7644e2ed-7955-67e7-85f8-0091ceade170" data-animation-type="lottie"
                data-src="<?php echo URL("/") ?>/assets/documents/7HgSy2GWQq-1.json" data-loop="1" data-direction="1" data-autoplay="1"
                data-is-ix2-target="0" data-renderer="svg" data-default-duration="1.0677343575780234" data-duration="0">
            </div>
        </div>
    </div>
</div>
 <?php if($answers != 'complete') { ?>
 <div class="div-block-4">
          <div class="div-block-6">
            <div class="w-layout-grid grid-2">
              <div id="w-node-_30b527fe-3863-5b3c-84fe-e3eeed9ed113-7a0e9f53" class="text-block"> {{ $lesson->lesson_name }}</div>
              <div id="w-node-_43a53836-e382-27b9-93d0-afe1fe64b65b-7a0e9f53" class="div-block-5">
                <div class="div-block-9" id="progressBar" >
                  <div class="div-block-7" ></div>
                </div>
              </div>
              
              <div id="w-node-d03f0f03-e00c-07c6-c9c5-2ec1f13c5c5b-7a0e9f53" class="div-block-8">
                <div id="w-node-f48f227f-3623-b84a-1822-c4f248ffcfe8-7a0e9f53" class="text-block cpPer">12</div>
                <div class="text-block">%</div>
              </div>
            </div>
          </div>
        </div> 
<?php } ?>
<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=655b434272e0596d7e6126bc"
    type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
</script>
<script src="<?php echo URL("/") ?>/assets/js/training-nvg-platform-3c3dc0a66fa7c2e1d.js" type="text/javascript"></script>
<script>
function initializeIntercom() {
    // Retrieve the email value from the input field with the id 'User-Email'
    var userEmail = document.getElementById("User-Email").value;
    // Set the intercomSettings with the retrieved email
    window.intercomSettings = {
        api_base: "https://api-iam.intercom.io",
        app_id: "i9cie1g6",
        email: userEmail,
    };
    // Intercom widget code
    var w = window;
    var ic = w.Intercom;
    if (typeof ic === "function") {
        ic('reattach_activator');
        ic('update', w.intercomSettings);
    } else {
        var d = document;
        var i = function() {
            i.c(arguments);
        };
        i.q = [];
        i.c = function(args) {
            i.q.push(args);
        };
        w.Intercom = i;
        var l = function() {
            var s = d.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = 'https://widget.intercom.io/widget/i9cie1g6';
            var x = d.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        };
        if (document.readyState === 'complete') {
            l();
        } else if (w.attachEvent) {
            w.attachEvent('onload', l);
        } else {
            w.addEventListener('load', l, false);
        }
    }
}
// Listen for changes on the input field to re-initialize Intercom whenever the email changes
document.getElementById("User-Email").addEventListener("input", initializeIntercom);
</script>
<script>
document.body.addEventListener('click', function(event) {
    if (event.target.classList.contains('text-item')) {
        // Find the closest parent wrapper and then find the input field within it
        const inputField = event.target.closest('.text-input-wrapper').querySelector('.text-input');
        // Set the input's value to the clicked text item's content
        if (inputField) {
            inputField.value = event.target.textContent.trim();
        }
    }
});
</script>
<script>
function ensureBottomSubmitIsLast() {
    const mask = document.querySelector('#slider #mask');
    const bottomSubmit = document.getElementById('bottom-submit');
    // If the bottomSubmit is already the last child, no need to move it
    if (mask.lastChild === bottomSubmit) {
        return;
    }
    // Remove the bottomSubmit from its current position
    if (bottomSubmit) {
        bottomSubmit.remove();
    }
    // Append it to the end of the mask
    mask.appendChild(bottomSubmit);
}
// Call it initially
ensureBottomSubmitIsLast();
// Call it whenever the content of the slider might change. 
// Remember to call this function after any AJAX calls or operations that modify the slides.
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Variables for the Webflow slider, slides, and the progress bar.
        const slider = document.querySelector('.w-slider');
        const slides = document.querySelectorAll('.w-slide');
        const progressBar = document.querySelector(
        '#progressBar'); // adjust this selector if you named your progress bar differently in Webflow
        // Function to update progress
        const updateProgress = () => {
            const activeSlideIndex = Array.from(slides).findIndex(slide => slide.classList.contains(
            'w-active'));
            const progressPercentage = (activeSlideIndex / (slides.length - 1)) * 100;
            progressBar.style.width = progressPercentage + '%';
        };
        // MutationObserver to watch for slide changes
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    updateProgress();
                }
            });
        });
        // Observe each slide for class changes
        slides.forEach(slide => {
            observer.observe(slide, {
                attributes: true
            });
        });
        // Initial progress bar setup
        updateProgress();
    });
</script>
<script>
$(document).ready(function() {
    // Listen for input on text-area with class 'text-item'
    $('.text-item').on('input', function() {
        // Find the closest 'text-input' and set its value
        $(this).closest('.text-input-wrapper').find('.text-input').val($(this).val());
    });
});
</script>
<script>
$(document).ready(function() {
    /*$('.textarea').on('input', function() {
        var lockWrapper = $(this).closest('.practise_answer').find('.lock-wrapper');
        // Check if the textarea value, after trimming, has length greater than 0.
        if ($(this).val().trim().length > 0) {
            lockWrapper.addClass('hide');
        } else {
            lockWrapper.removeClass('hide');
        }
    });*/
});
</script>
<script>
$(document).ready(function() {
    $(".grid-questions").each(function() {
        let allAreNumbers = true; // Assume all children are numbers
        $(this).find(".checkbox_field").each(function() {
            if (!/^\d+$/.test($(this).text())) { // If the text is not purely a number
                allAreNumbers = false;
                return false; // Exit the each loop
            }
        });
        if (allAreNumbers) {
            $(this).addClass("numbers");
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('form').on('submit', function() {
        $(this).find('.textarea').prop('disabled', true);
    });
});
</script>
<script>
function updateProgressBar(currentSlideIndex = 0) {
    var totalSlides =  <?php echo count($question); ?>; // Replace '.yourSlideClass' with a class or selector that identifies individual slides.
  /*  var currentSlideIndex = Array.from(document.querySelectorAll('.w-slider-dot')).findIndex(slide => slide.classList
        .contains('w-active'));  */
        if(currentSlideIndex == -1){
            //currentSlideIndex = <?php echo $answers; ?>;
        } 
    var widthPercent = ((currentSlideIndex) / totalSlides) * 100;
    document.querySelector('#progressBar').style.width = `${widthPercent}%`;
    document.querySelector('.cpPer').innerHTML = `${parseInt(widthPercent)}`; 
}
// Listen for slide change. This might vary depending on how Webflow emits events.
//document.querySelector('#slider').addEventListener('change', updateProgressBar($('#quiz_progress').val()+1));
// If you're using AJAX to load more slides, after loading, call:
updateProgressBar($('#quiz_progress').val());
</script>
<script>
// This function updates the items count
function updateItemsCount() {
    const gridList = document.getElementById("grid-list");
    // Count the direct children of gridList
    const numberOfChildren = gridList.children.length;
    // Get all elements with class "items-count" and update their innerText
    const itemsCountElements = document.querySelectorAll(".items-count");
    itemsCountElements.forEach(element => {
        //element.innerText = (numberOfChildren - 1);
        //$('.progress').attr('max',(numberOfChildren - 1));
    });
}
document.addEventListener("DOMContentLoaded", function() {
    updateItemsCount(); // Update on initial page load
});
</script>
<script type="text/javascript">/*
document.addEventListener("DOMContentLoaded", function() {
    // Replace 'formId' with the ID of your form element
    var form = document.getElementById('quiz-form');
    // Replace 'selectId' with the ID of your select element
    var select = document.getElementById('select-cms');
    // Function to update the data-name attribute of the form based on the selected option
    function updateFormDataName() {
        // Get the selected option value
        var selectedOption = select.options[select.selectedIndex].value;
        // Set the data-name attribute of the form to the selected option value
        form.setAttribute('data-name', selectedOption);
    }
    // Add an event listener to the select element to trigger the data-name update
    select.addEventListener('change', updateFormDataName);
    // Call the function initially to set the initial data-name value
    updateFormDataName();
});*/
</script>
<!--  Browser Back Button  -->
<script>
$(document).ready(function() {
    $(".back-link").click(
function() { // Create any class name between the " ". Then add this class name to any back button on that page.  
        window.history.back();
    });
});
</script>

<script> 

function submit_answer(qid, last){

    var question_type = $("#question_type" + qid).val();
    
    var answer = '';
    
    if(question_type == 'multiple') {
        
        var answer = new Array();

        $("input[name=options" + qid + "]:checked").each(function () {
            answer.push(this.value);
        });

        //Display the selected CheckBox values.
      /*  if (selected.length > 0) {
            answer = selected.join(",");
        } */

    } else if(question_type == 'ranking') {
        
        answer = $('input[name=options' + qid + ']:checked').val();

    } else {
        
        answer = $(".answer" + qid).val();  
        
    }
    
    var progress = $('#quiz_progress').val();
    
    var quiz_id = $("#quiz_id").val();
    var lesson_id = $("#lesson_id").val();
    var question_id = $("#question_id" + qid).val();
   
    if(answer == '') {
        
        alert('Please submit answer');
        
    } else {
        
        $.ajax(
        {
            url: "<?php echo URL("/") ?>/post-answer",
            type: 'post',
            dataType: "JSON",
            data: {
                "answer": answer,
                "quiz_id": quiz_id,
                "lesson_id": lesson_id,
                "question_id": question_id,
                "question_type": question_type,
                "_method": 'POST',
                "_token": "{{ csrf_token() }}",
            },
            success: function (result)
            {
                $('#quiz_progress').val(progress + 1);
                updateProgressBar($('#quiz_progress').val());
                if(last == 1) {
                    submit_quiz();
                }
            }
        });
    }
    
}

function submit_quiz(){
    
    var quiz_id = $("#quiz_id").val();
    var lesson_id = $("#lesson_id").val();
    
    $.ajax(
    {
        url: "<?php echo URL("/") ?>/submit-quiz",
        type: 'post',
        dataType: "JSON",
        data: {
            "quiz_id": quiz_id,
            "lesson_id": lesson_id,
            "_method": 'POST',
            "_token": "{{ csrf_token() }}",
        },
        success: function ()
        {
            //window.location.href = "<?php echo URL("/") ?>/phase";
        }
    });
}

$('.radiobox ').click(function() {
	$(this).addClass('selected').siblings().removeClass('selected'); 
}); 

$('.multibox .checkbox_button').click(function() {
    var b = $(this).parents('.w-checkbox');  
    if(b.find('.select_option').is(":checked")) {
          $(this).parents('.w-checkbox').removeClass("selected");
    } else {
           $(this).parents('.w-checkbox').addClass("selected"); 
    } 	 
});

function multipleChange(qid) {

    var selected = new Array();

    $("input[name=options" + qid + "]:checked").each(function () {
        selected.push(this.value);
    });

    //Display the selected CheckBox values.
    if (selected.length > 0) {
        $('.lock' + qid).addClass('hide');
    } else {
        $('.lock' + qid).removeClass('hide');
    } 
    
}

function rankingChange(qid) {
    var answer = $('input[name=options' + qid + ']:checked').val();

    if (answer == '' || answer == undefined) {
        $('.lock' + qid).removeClass('hide');
    } else {
        $('.lock' + qid).addClass('hide');
    }
}

function textinputChange(qid) {
    var answer = $('.answer' + qid).val();

    if (answer == '' || answer == undefined) {
        $('.lock' + qid).removeClass('hide');
    } else {
        $('.lock' + qid).addClass('hide');
    }
}
</script>

@endsection