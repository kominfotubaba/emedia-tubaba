// NAVBAR
var lastScrollTop; // This Varibale will store the top position

nav = document.getElementById("navbar"); // Get The NavBar

window.addEventListener("scroll", function () {
  //on every scroll this funtion will be called

  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  //This line will get the location on scroll

  if (scrollTop > lastScrollTop) {
    //if it will be greater than the previous
    navbar.style.top = "-100px";
    //set the value to the negetive of height of navbar
  } else {
    navbar.style.top = "0";
  }

  lastScrollTop = scrollTop; //New Position Stored
});

$(document).ready(function () {
  $("#owl-apk").owlCarousel({
    loop: true,
    margin: 20,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    smartSpeed: 500,
    responsive: {
      0: {
        items: 2,
      },
      600: {
        items: 4,
      },
    },
  });
});

// Berita Terkini
(function () {
  function init(item) {
    var items = item.querySelectorAll("li"),
      current = 0,
      autoUpdate = true,
      timeTrans = 4000;

    //create nav
    var nav = document.createElement("nav");
    nav.className = "nav_arrows";

    //create button prev
    var prevbtn = document.createElement("button");
    prevbtn.className = "prev";
    prevbtn.setAttribute("aria-label", "Prev");

    //create button next
    var nextbtn = document.createElement("button");
    nextbtn.className = "next";
    nextbtn.setAttribute("aria-label", "Next");

    //create counter
    var counter = document.createElement("div");
    counter.className = "counter";
    counter.innerHTML = "<span>1</span><span>" + items.length + "</span>";

    if (items.length > 1) {
      nav.appendChild(prevbtn);
      nav.appendChild(counter);
      nav.appendChild(nextbtn);
      item.appendChild(nav);
    }

    items[current].className = "current";
    if (items.length > 1) items[items.length - 1].className = "prev_slide";

    var navigate = function (dir) {
      items[current].className = "";

      if (dir === "right") {
        current = current < items.length - 1 ? current + 1 : 0;
      } else {
        current = current > 0 ? current - 1 : items.length - 1;
      }

      var nextCurrent = current < items.length - 1 ? current + 1 : 0,
        prevCurrent = current > 0 ? current - 1 : items.length - 1;

      items[current].className = "current";
      items[prevCurrent].className = "prev_slide";
      items[nextCurrent].className = "";

      //update counter
      counter.firstChild.textContent = current + 1;
    };

    item.addEventListener("mouseenter", function () {
      autoUpdate = false;
    });

    item.addEventListener("mouseleave", function () {
      autoUpdate = true;
    });

    setInterval(function () {
      if (autoUpdate) navigate("right");
    }, timeTrans);

    prevbtn.addEventListener("click", function () {
      navigate("left");
    });

    nextbtn.addEventListener("click", function () {
      navigate("right");
    });

    //keyboard navigation
    document.addEventListener("keydown", function (ev) {
      var keyCode = ev.keyCode || ev.which;
      switch (keyCode) {
        case 37:
          navigate("left");
          break;
        case 39:
          navigate("right");
          break;
      }
    });

    // swipe navigation
    // from http://stackoverflow.com/a/23230280
    item.addEventListener("touchstart", handleTouchStart, false);
    item.addEventListener("touchmove", handleTouchMove, false);
    var xDown = null;
    var yDown = null;
    function handleTouchStart(evt) {
      xDown = evt.touches[0].clientX;
      yDown = evt.touches[0].clientY;
    }
    function handleTouchMove(evt) {
      if (!xDown || !yDown) {
        return;
      }

      var xUp = evt.touches[0].clientX;
      var yUp = evt.touches[0].clientY;

      var xDiff = xDown - xUp;
      var yDiff = yDown - yUp;

      if (Math.abs(xDiff) > Math.abs(yDiff)) {
        /*most significant*/
        if (xDiff > 0) {
          /* left swipe */
          navigate("right");
        } else {
          navigate("left");
        }
      }
      /* reset values */
      xDown = null;
      yDown = null;
    }
  }
  [].slice
    .call(document.querySelectorAll(".cd-slider"))
    .forEach(function (item) {
      init(item);
    });
})();

// LOGIN 2
/*global $, document, window, setTimeout, navigator, console, location*/
$(document).ready(function () {
  "use strict";

  var usernameError = true,
    emailError = true,
    passwordError = true,
    passConfirm = true;

  // Detect browser for css purpose
  if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1) {
    $(".form form label").addClass("fontSwitch");
  }

  // Label effect
  $("input").focus(function () {
    $(this).siblings("label").addClass("active");
  });

  // Form validation
  $("input").blur(function () {
    // User Name
    if ($(this).hasClass("name")) {
      if ($(this).val().length === 0) {
        $(this)
          .siblings("span.error")
          .text("Please type your full name")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        usernameError = true;
      } else if ($(this).val().length > 1 && $(this).val().length <= 6) {
        $(this)
          .siblings("span.error")
          .text("Please type at least 6 characters")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        usernameError = true;
      } else {
        $(this)
          .siblings(".error")
          .text("")
          .fadeOut()
          .parent(".form-group")
          .removeClass("hasError");
        usernameError = false;
      }
    }
    // Email
    if ($(this).hasClass("email")) {
      if ($(this).val().length == "") {
        $(this)
          .siblings("span.error")
          .text("Please type your email address")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        emailError = true;
      } else {
        $(this)
          .siblings(".error")
          .text("")
          .fadeOut()
          .parent(".form-group")
          .removeClass("hasError");
        emailError = false;
      }
    }

    // PassWord
    if ($(this).hasClass("pass")) {
      if ($(this).val().length < 8) {
        $(this)
          .siblings("span.error")
          .text("Please type at least 8 charcters")
          .fadeIn()
          .parent(".form-group")
          .addClass("hasError");
        passwordError = true;
      } else {
        $(this)
          .siblings(".error")
          .text("")
          .fadeOut()
          .parent(".form-group")
          .removeClass("hasError");
        passwordError = false;
      }
    }

    // PassWord confirmation
    if ($(".pass").val() !== $(".passConfirm").val()) {
      $(".passConfirm")
        .siblings(".error")
        .text("Passwords don't match")
        .fadeIn()
        .parent(".form-group")
        .addClass("hasError");
      passConfirm = false;
    } else {
      $(".passConfirm")
        .siblings(".error")
        .text("")
        .fadeOut()
        .parent(".form-group")
        .removeClass("hasError");
      passConfirm = false;
    }

    // label effect
    if ($(this).val().length > 0) {
      $(this).siblings("label").addClass("active");
    } else {
      $(this).siblings("label").removeClass("active");
    }
  });

  // form switch
  $("a.switch").click(function (e) {
    $(this).toggleClass("active");
    e.preventDefault();

    if ($("a.switch").hasClass("active")) {
      $(this)
        .parents(".form-peice")
        .addClass("switched")
        .siblings(".form-peice")
        .removeClass("switched");
    } else {
      $(this)
        .parents(".form-peice")
        .removeClass("switched")
        .siblings(".form-peice")
        .addClass("switched");
    }
  });

  // Form submit
  $("form.signup-form").submit(function (event) {
    event.preventDefault();

    if (
      usernameError == true ||
      emailError == true ||
      passwordError == true ||
      passConfirm == true
    ) {
      $(".name, .email, .pass, .passConfirm").blur();
    } else {
      $(".signup, .login").addClass("switched");

      setTimeout(function () {
        $(".signup, .login").hide();
      }, 700);
      setTimeout(function () {
        $(".brand").addClass("active");
      }, 300);
      setTimeout(function () {
        $(".heading").addClass("active");
      }, 600);
      setTimeout(function () {
        $(".success-msg p").addClass("active");
      }, 900);
      setTimeout(function () {
        $(".success-msg a").addClass("active");
      }, 1050);
      setTimeout(function () {
        $(".form").hide();
      }, 700);
    }
  });

  // Reload page
  $("a.profile").on("click", function () {
    location.reload(true);
  });
});
