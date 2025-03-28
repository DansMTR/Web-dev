
    var icons =document.getElementById("icon");
    var pass= document.getElementById("fpassword");
    
  

function fshow() {
  if (icons.src.match("eye-solid.svg")) 
  {   
      pass.type="text" ;
      icons.src ="eye-slash-solid.svg";
      icons.title="hide";
  }
    else 
  { 
       pass.type="password" ;
      icons.src ="eye-solid.svg";
      icons.title="show";
  }
}


