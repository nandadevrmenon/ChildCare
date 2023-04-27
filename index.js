

		var header = document.querySelector(".navbar-start"); //get the navbar div

    window.onscroll = function(event) { //whenever we scroll
      if (window.scrollY >= 10) {   //if the scroll position is greater than 10
        header.classList.remove("navbar-start");
        header.classList.add("scrolled");   //add this class to make navbar slimmer

      } else {
        header.classList.remove("scrolled");    //else go back to normal state
        header.classList.add("navbar-start");   //i.e will go back ot normal at the top of the page
      }
    }



    //logic for message deletion 

    const messageList = document.querySelectorAll(".customerMessage button.btn-danger");    //get the list of all the message delete buttons
    
    messageList.forEach((element)=>{
      element.addEventListener('click',changeModalID);
    })

    function changeModalID(event){
      const messageId = event.target.dataset.id;
      const modalDeleteButton = document.querySelector("#deleteMessageModal form button");
      modalDeleteButton.value=messageId;
      console.log( modalDeleteButton.value);

    }