

var header = document.querySelector(".navbar-start"); //get the navbar div

window.onscroll = function(event) { //whenever we scroll
  if (window.scrollY >= 20) {   //if the scroll position is greater than 10
    header.classList.remove("navbar-start");
    header.classList.add("scrolled");   //add this class to make navbar slimmer

  } else {
    header.classList.remove("scrolled");    //else go back to normal state
    header.classList.add("navbar-start");   //i.e will go back ot normal at the top of the page
  }
}



//logic for message deletion 

const deleteMessageButtonList = document.querySelectorAll(".customerMessage button.btn-danger");    //get the list of all the message delete buttons
const modalDeleteButton = document.querySelector("#deleteMessageModal form button");

deleteMessageButtonList.forEach((element)=>{
  element.addEventListener('click',changeMessageModalID);
})

function changeMessageModalID(event){
  const messageId = event.target.dataset.id;
  modalDeleteButton.value=messageId;
  console.log( modalDeleteButton.value);

}



//logic for registration dropdown 

const planDropDown = document.querySelector("#plan");   //the drop down for the different planss
const feeInput = document.querySelector("#fees");     //the fee input which will be updated with the corect fee info
const feeNodes = document.querySelectorAll("#feeBoxContainer>div>div>div>h4");    //all the fee nodes which are rendered into the page  //faster than getting them from db

const feeValuesArray =[];   //hols all the fees for each input in plandropDown
feeValuesArray.push("");    //first input is emtpy and thus fees should be empty
for(let i = 0 ; i <feeNodes.length;i++){    //populates the rest of the fee values
  const feeText = feeNodes[i].textContent;
  const feeNum = feeText.substring(feeText.length-3,feeText.length);
  feeValuesArray.push(feeNum);
}

if(planDropDown!=null){
    updateFeeInput({target:planDropDown});    //I pass in a dummy event object with a target so I can update fee info on page load just incase there is a value already there beause of the sticky form
    planDropDown.addEventListener("change",updateFeeInput);  //update fee everytime that dropdown is changed
}




function updateFeeInput(event){
  const feeID = event.target.value;   //gets fee id from form
  if(feeID=="") feeInput.value="";
  else feeInput.value="€"+feeValuesArray[feeID];   //feeds tht value isto the disabled fee input 
}



//logic for delete child modal

const UnregisterButtonsList = document.querySelectorAll("#childListContainer > div > div > div >div > button");
const deleteChildButtonInModal = document.querySelector("#profilePageModal form button");
const deleteChildFormInModal = document.querySelector("#profilePageModal form ");
const modalTextDiv = document.querySelector("#profilePageModal .modal-body");
const childNameNodes = document.querySelectorAll("#childListContainer > div > div > div > div > h5");

//for delete user as well using the same function 
const deleteAccountButton = document.querySelector("#deleteAccount");

UnregisterButtonsList.forEach((element,index)=>{
  element.addEventListener('click',changeRegistrationModal);
  element.dataset.name=childNameNodes[index].textContent;
})

if(deleteAccountButton!=null) deleteAccountButton.addEventListener("click",changeRegistrationModal);

function changeRegistrationModal(event){
  const childID = event.target.dataset.id;
  const action = event.target.dataset.action;
  deleteChildButtonInModal.value=childID;
  if(action=="account"){
    deleteChildFormInModal.action="/ChildCare/scripts/deleteAcc.php"
    modalTextDiv.textContent="Are you sure you want to delete the account?"
  }
  else if(action =="child"){
    deleteChildFormInModal.action="/ChildCare/pages/profile.php"
    modalTextDiv.textContent="Are you sure you want to unregister "+event.target.dataset.name+" ?"
  }

}

//for delete testimonial

const deleteTestButtons = document.querySelectorAll(".testimonial div > button");
const deleteTestimonialModalText = document.querySelector("#deleteTestimonialModal  > div > div .modal-body");
const deleteTestimonialButtonInModal = document.querySelector(".modal-footer form button");

console.log(deleteTestButtons);
console.log(deleteTestimonialModalText);
console.log(deleteTestimonialButtonInModal);


deleteTestButtons.forEach((element)=>{
  element.addEventListener('click',changeTestimonialModal);
});

function changeTestimonialModal(event){
  const testID = event.target.dataset.id;
  deleteTestimonialButtonInModal.value=testID;
}
