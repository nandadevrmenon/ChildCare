
		var header = document.querySelector(".navbar-start");

    window.onscroll = function(event) {
      if (window.scrollY >= 10) {
        header.classList.remove("navbar-start");
        header.classList.add("scrolled");

      } else {
        header.classList.remove("scrolled");
        header.classList.add("navbar-start");
      }
    }