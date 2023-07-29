 //hide and show--toggle, dmth checks for visibility
    //scrollY-property of the Window interface, kthen numrin e pixel-ave qe dokumenti eshte currently scrolled vertikalisht ne nje dritare
    //If the document isn't scrolled at all up or down, then scrollY is 0... bon edhe pa ata?
    window.addEventListener('scroll',function(){
        const header= document.querySelector('header');
        header.classList.toggle("sticky",window.scrollY>0)
    })
    
     var inputList = document.getElementsByTagName("input")
    
    /    document.getElementById('signupbtn').addEventListener('click',function(event){
       if(inputList[0].value==""||inputList[1].value==""||inputList[2].value==""||inputList[3].value==""){
            alert("Please fill all the required information!");
        }
        if(inputList[2].value!=inputList[3].value){
            alert("Passwords don't match!")
       }
    });
    
    document.getElementById('signinbtn').addEventListener('click',function(event){
        if(inputList[4].value==""||inputList[5].value==""){
            alert("Please fill all the required information!");
        }
    });
    
    
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    
    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
    
    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
    
    
    document.getElementById("password").addEventListener("keyup",function(event){
        var password = document.getElementById("password").value;
        var error = "";
        var re=/[a-z]/;
        if (password.length <= 5) 
            error =  "Your password needs a minimum of 6 characters ";
        if (!re.test(password)) 
            error = "Your password needs a lower case letter ";
            re=/[A-Z]/;
        if (!re.test(password)) 
            error = "Your password needs an uppser case letter ";
            re=/[0-9]/;
        if (!re.test(password)) 
            error ="Your password needs a number";
        
        document.getElementById('validatepass').style.color = 'black';
        document.getElementById('validatepass').innerHTML = error;
    })
    
    
    document.getElementById("name").addEventListener("keyup",function(event){
        var usern = document.getElementById("name").value;
        var error = "";
        var re=/[0-9]/;
        if (usern.length <= 2) 
            error =  "Your username should contain more than 2 letter ";
        if (re.test(usern)) 
            error ="Your username can not contain numbers";
        
        document.getElementById('validate-user').style.color = 'black';
        document.getElementById('validate-user').innerHTML = error;
    })




    const GTInput = document.querySelectorAll(".gt-input");

for (let i = 0; i < GTInput.length; i++) {
  let currentLabel = GTInput[i].parentElement.firstElementChild;

  GTInput[i].addEventListener("focus", function () {
    currentLabel.classList.add("move-up");
  })

  GTInput[i].addEventListener("blur", function () {
    if (GTInput[i].value === "") {
      currentLabel.classList.remove("move-up");
    }
  })
}
    