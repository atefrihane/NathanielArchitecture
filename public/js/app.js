webpackJsonp([1],{0:function(e,n,t){t("sV/x"),t("xZZD"),e.exports=t("aMfE")},LVSI:function(e,n,t){"use strict";(function(e){e("#project-date").datepicker({format:"dd-mm-yyyy"})}).call(n,t("7t+N"))},WRGp:function(e,n,t){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),function(e){t("fmQo"),t("LVSI"),t("odmc");var n=t("q99D");t.n(n),t("nx/F");window._=t("M4fF");try{window.$=t("7t+N")}catch(e){}window.axios=t("mtWM"),window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";var o=document.head.querySelector('meta[name="csrf-token"]');o?window.axios.defaults.headers.common["X-CSRF-TOKEN"]=o.content:console.error("CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"),window.Dropzone=t("oLnp"),Dropzone.autoDiscover=!1}.call(n,t("7t+N"))},aMfE:function(e,n){},fmQo:function(e,n,t){"use strict";(function(e){e("#datatable").DataTable({})}).call(n,t("7t+N"))},"nx/F":function(e,n,t){"use strict";(function(e){var n;n=document.createEvent("UIEvents"),window.EVENT=n,n.initUIEvent("resize",!0,!1,window,0),window.addEventListener("load",function(){window.dispatchEvent(n)}),e("a").filter('[href^="http"], [href^="//"]').not('[href*="'+window.location.host+'"]').attr("rel","noopener noreferrer").attr("target","_blank"),document.addEventListener("click",function(){window.dispatchEvent(window.EVENT)}),window.addEventListener("load",function(){var e=document.getElementById("loader");setTimeout(function(){e.classList.add("fadeOut")},300)}),window.setTimeout(function(){e(".alert").fadeTo(500,0).slideUp(500,function(){e(this).remove()})},3500)}).call(n,t("7t+N"))},odmc:function(e,n,t){"use strict";(function(e){e(".sidebar .sidebar-menu li a").on("click",function(){var n=e(this);n.parent().hasClass("open")?n.parent().children(".dropdown-menu").slideUp(200,function(){n.parent().removeClass("open")}):(n.parent().parent().children("li.open").children(".dropdown-menu").slideUp(200),n.parent().parent().children("li.open").children("a").removeClass("open"),n.parent().parent().children("li.open").removeClass("open"),n.parent().children(".dropdown-menu").slideDown(200,function(){n.parent().addClass("open")}))}),e(".sidebar").find(".sidebar-link").each(function(n,t){e(t).removeClass("active")}).filter(function(){var n=e(this).attr("href");return("/"===n[0]?n.substr(1):n)===window.location.pathname.substr(1)}).addClass("active"),e(".sidebar-toggle").on("click",function(n){e(".app").toggleClass("is-collapsed"),n.preventDefault()}),e("#sidebar-toggle").click(function(e){e.preventDefault(),setTimeout(function(){window.dispatchEvent(window.EVENT)},300)})}).call(n,t("7t+N"))},q99D:function(e,n,t){(function(e){e("#tags").select2({placeholder:"Select one or more tags"})}).call(n,t("7t+N"))},"sV/x":function(e,n,t){t("WRGp")},xZZD:function(e,n){}},[0]);