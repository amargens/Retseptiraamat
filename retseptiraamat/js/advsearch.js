
window.onload = function() {
	if (typeof jQuery === "undefined") {
    	var script = document.createElement('script');
    	script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js';
    	script.type = 'text/javascript';
    	document.getElementsByTagName('head')[0].appendChild(script);
    
    }
    
    if (typeof jQuery === "undefined") {
    	var script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDypSGQV6mFDr0wnoZ1IeXBb_PzvruPuUU';
    	script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
    
    var lang = getCookie('lang');
    if (lang !== "") {
        document.getElementById('sel-lang').value = lang;
        changeLang(lang);
    } else {
        changeLang('ee');
    }
	
    document.getElementById('sel-lang').addEventListener("change", function(){
        setCookie('lang', document.getElementById('sel-lang').value, 1);
        changeLang(document.getElementById('sel-lang').value);
        document.getElementById('sel-lang').action = "../application/controllers/advsearch/index"
        document.formlang.submit();
    });
    
    document.getElementById('addIng_ee').addEventListener("click", function(){
        addIngridient();
    });
    
    
}

document.addEventListener('DOMContentLoaded', function() {
    
});


function addIngridient() {
    
    var addedIng = document.createElement("li");
    addedIng.className = "addedIng";
    
    var ingredient = document.createElement("p");
    ingredient.className = "ingredient";
    ingredient.innerHTML = document.getElementById('addIngredient_ee').value;
    
    var inputIng = document.createElement("input");
    inputIng.className = "inputhidden";
    inputIng.name = "ingredient_ee[]";
    inputIng.value = document.getElementById('addIngredient_ee').value;
    
    var removeIng = document.createElement('button');
    if (document.getElementById('sel-lang').value === "ee") {
        removeIng.innerHTML = 'Eemalda';
    } else if (document.getElementById('sel-lang').value === "en") {
        removeIng.innerHTML = 'Remove';
    }
    removeIng.setAttribute("data-tag", "removeIng_ee");
    removeIng.className = "removeIng";
    removeIng.onclick = function(){
        document.getElementById('addedIngList_ee').removeChild(addedIng);
        return false;
    };
    
    addedIng.appendChild(ingredient);
    addedIng.appendChild(inputIng);
    addedIng.appendChild(removeIng);
    
    document.getElementById('addIngredient_ee').value = "";
    
    document.getElementById('addedIngList_ee').appendChild(addedIng);
}



function Translate() { 
    //initialization
    this.init =  function(attribute, lng){
        this.attribute = attribute;
        this.lng = lng;    
    };
    //translate 
    this.process = function(){
                _self = this;
                var xrhFile = new XMLHttpRequest();
                //load content data 
                xrhFile.open("GET", "../../json/advsearch_"+this.lng+".json", false);
                xrhFile.onreadystatechange = function ()
                {
                    if(xrhFile.readyState === 4)
                    {
                        if(xrhFile.status === 200 || xrhFile.status === 0)
                        {
                            var LngObject = JSON.parse(xrhFile.responseText);
                            console.log(LngObject['name1']);
                            var allDom = document.getElementsByTagName("*");
                            for(var i =0; i < allDom.length; i++){
                                var elem = allDom[i];
                                var key = elem.getAttribute(_self.attribute);
                                 
                                if(key !== null) {
                                     console.log(key);
                                     if ( key === 'search_adv' || key === 'search'){
                                        elem.placeholder = LngObject[key];
                                    } else {
                                        elem.innerHTML = LngObject[key]  ;
                                    }
                                }
                            }
                     
                        }
                    }
                };
                xrhFile.send();
    };    
}


