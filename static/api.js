let szerelo=document.querySelector("#szerelo");
let helyek=document.querySelector("#helyek");
let anyagar=document.querySelector("#anyagar");
let siteroot=document.querySelector("#SITEROOT");
let eredmeny=document.querySelector("#eredmeny");

function lekeres()
{
    fetch(siteroot.value+"apiTibor?szerelo="+szerelo.value+"&helyek="+helyek.value+"&anyagar="+anyagar.value)
    .then(data=>data.json())
    .then(data=>
        {
            eredmeny.innerHTML="";
            data.adat.forEach(element => 
                {
                eredmeny.innerHTML+=element.telepules+" "+element.anyagar+" <br>";
                
            });
        console.log(data)
         });
}


szerelo.addEventListener("change",lekeres);
helyek.addEventListener("change",lekeres);
anyagar.addEventListener("change",lekeres);