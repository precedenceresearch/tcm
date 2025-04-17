function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage:"en"},"google_translate_element")}!function(){"use strict";$(function(){$("#slider1").owlCarousel({loop:!1,margin:10,dots:!1,nav:!0,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],responsive:{0:{items:1},600:{items:3},1000:{items:4}}}),$("#slider2").owlCarousel({loop:!1,margin:10,dots:!1,nav:!0,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],responsive:{0:{items:1},600:{items:2},1000:{items:3}}}),$("#slider3").owlCarousel({loop:!1,margin:10,dots:!1,nav:!0,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],responsive:{0:{items:1},600:{items:2},1000:{items:3}}}),$(document).ready(function(){$("#play-video").on("click",function(e){$(".fh5co_hide").fadeOut(),$("#video")[0].src+="&autoplay=1",e.preventDefault()})}),$(document).ready(function(){$("#play-video_2").on("click",function(e){$(".fh5co_hide_2").fadeOut(),$("#video_2")[0].src+="&autoplay=1",e.preventDefault()})}),$(document).ready(function(){$("#play-video_3").on("click",function(e){$(".fh5co_hide_3").fadeOut(),$("#video_3")[0].src+="&autoplay=1",e.preventDefault()})}),$(document).ready(function(){$("#play-video_4").on("click",function(e){$(".fh5co_hide_4").fadeOut(),$("#video_4")[0].src+="&autoplay=1",e.preventDefault()})}),$(".animate-box").waypoint(function(e){"down"!==e||$(this.element).hasClass("animated-fast")||($(this.element).addClass("item-animate"),setTimeout(function(){$("body .animate-box.item-animate").each(function(e){var a=$(this);setTimeout(function(){var e=a.data("animate-effect");"fadeIn"===e?a.addClass("fadeIn animated-fast"):"fadeInLeft"===e?a.addClass("fadeInLeft animated-fast"):"fadeInRight"===e?a.addClass("fadeInRight animated-fast"):a.addClass("fadeInUp animated-fast"),a.removeClass("item-animate")},50*e,"easeInOutExpo")})},100))},{offset:"85%"}),$(".js-gotop").on("click",function(e){return e.preventDefault(),$("html, body").animate({scrollTop:$("html").offset().top},500,"swing"),!1}),$(window).scroll(function(){$(window).scrollTop()>200?$(".js-top").addClass("active"):$(".js-top").removeClass("active")}),$(window).on("load",function(){$(".goog-te-combo").addClass("form-control")})})}();

$(window).on('load', function(){	
	setTimeout(function(){
		$('#exampleModal').modal('show');
	}, 30000);
});

var customize_error = false;
var email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

$('#customize_email').on('input', function(e) {
    var helperText = '';
    if (e.target.value && !email_regex.test(e.target.value)) {
        document.querySelector('#modalcustomize_email_error').style.display = "block";
        helperText = "Please enter a valid email";
        document.querySelector('#modalcustomize_email_error').innerText = helperText;
        customize_error = true;
    } else if (e.target.value.length) {
        var genericEmail = verifyGenericEmail(e.target.value);
        if (["generic"].indexOf(genericEmail) > -1) {
            document.querySelector('#modalcustomize_email_error').style.display = "block";
            helperText = "Please enter your business email";
            document.querySelector('#modalcustomize_email_error').innerText = helperText;
            customize_error = true;
        } else {
            customize_error = false;
            document.querySelector('#modalcustomize_email_error').style.display = "none";
        }
    } else if (!e.target.value && !e.target.value.trim().length) {
        document.querySelector('#modalcustomize_email_error').style.display = "block";
        helperText = "Please enter a valid email id";
        document.querySelector('#modalcustomize_email_error').innerText = helperText;
        customize_error = true;
    }
});

function verifyGenericEmail(email) {
    var domain_full = email.split('@')[1];
    var domain_name = domain_full.split('.')[0];
    var domain_surname = domain_full.split('.')[domain_full.split('.').length - 1];
    var domain_arr = ["gmail", "yahoo", "hotmail", "aol", "msn", "wanadoo", "orange", "comcast", "live", "rediffmail", "free", "gmx", "web", "yandex", "ymail", "libero", "outlook", "mail", "googlemail", "rocketmail", "freenet", "mac", "icloud"];
    var list_of_generic_emails = domain_arr;
    if (list_of_generic_emails.indexOf(domain_name) !== -1 || email.indexOf("naver") !== -1) {
        return 'generic';
    } else if (domain_surname === 'edu' || domain_full.indexOf(".ac.") !== -1 || email.indexOf("student") !== -1) {
        return 'educational';
    } else return 'valid';
}
$('#customizeFrommodal').on('hidden.bs.modal', function(e) {
    document.querySelector('#modalcustomize_email_error').style.display = "none";
    document.querySelector('#modalcustomize_adress_error').style.display = "none";
    var customize_loader = document.querySelector('#customize-loader');
    if (customize_loader && customize_loader.style) {
        customize_loader.style.display = 'none';
    }
});