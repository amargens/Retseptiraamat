
window.onload = function() {
	
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
	
	document.getElementById('excludeIng_ee').addEventListener("click", function(){
        excludeIngridient();
    });
    
    document.getElementById('offlinealert').addEventListener("click", function(){
        $.ajax({
            type: "GET",
            url: "concheck",
            success: function(msg){
                document.getElementById('offlinealert').className = "container inputhidden";
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                document.getElementById('offlinealert').className = "container";
            }
        });
    });
    
    document.getElementById('searchbtn').addEventListener("click", function(){
        searchCon();
    });
    
    document.getElementById('searchIngBtn').addEventListener("click", function(){
        if (document.getElementById('addedIngList_ee').childElementCount > 0){
            document.getElementById('offlinealertsearchnoing').className = "container inputhidden";
            searchIngCon();
        }
        else {
            document.getElementById('offlinealertsearchnoing').className = "container";
        }
    });
    
    sendstats();
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

function excludeIngridient() {
    
    var excludedIng = document.createElement("li");
    excludedIng.className = "excludedIng";
    
    var ex_ingredient = document.createElement("p");
    ex_ingredient.className = "ex_ingredient";
    ex_ingredient.innerHTML = document.getElementById('excludeIngredient_ee').value;
    
    var inputExIng = document.createElement("input");
    inputExIng.className = "inputhidden";
    inputExIng.name = "ex_ingredient_ee[]";
    inputExIng.value = document.getElementById('excludeIngredient_ee').value;
    
    var removeExIng = document.createElement('button');
    if (document.getElementById('sel-lang').value === "ee") {
        removeExIng.innerHTML = 'Eemalda';
    } else if (document.getElementById('sel-lang').value === "en") {
        removeExIng.innerHTML = 'Remove';
    }
    removeExIng.setAttribute("data-tag", "removeIng_ee");
    removeExIng.className = "removeExIng";
    removeExIng.onclick = function(){
        document.getElementById('excludedIngList_ee').removeChild(excludedIng);
        return false;
    };
    
    excludedIng.appendChild(ex_ingredient);
    excludedIng.appendChild(inputExIng);
    excludedIng.appendChild(removeExIng);
    
    document.getElementById('excludeIngredient_ee').value = "";
    
    document.getElementById('excludedIngList_ee').appendChild(excludedIng);
}

function searchIngCon(){
    $.ajax({
        type: "GET",
        url: "concheck",
        success: function(msg){
            document.getElementById('offlinealert').className = "container inputhidden";
            document.getElementById('offlinealertsearch').className = "container inputhidden";
            document.getElementById('offlinealertsearching').className = "container inputhidden";
            document.searchingform.submit();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            
            document.getElementById('offlinealert').className = "container";
            var recipeIds = [];
            var keys = document.getElementById('addedIngList_ee').getElementsByClassName("ingredient");
            for (var i = 0; i<data.length; i++){
                for (var j = 0; j<keys.length; j++){
                    if (data[i]['_ingredient'].toLowerCase().indexOf(keys[j].innerHTML.toLowerCase()) !== -1){
                        recipeIds.push(data[i]['_recipeID']);
                    } 
                }
            }
            var ids = Array.from(new Set(recipeIds));
            for (var i = 0; i<ids.length; i++){
                if (recipeIds.filter(function(x){return x==ids[i]}).length !== keys.length){
                    var index = ids.indexOf(ids[i]);
                    if (index > -1) {
                        ids.splice(index, 1);
                        i-=1;
                    }
                }
            }
            var rows = document.getElementsByTagName("tr");
            var count = 0;
            for (var i = 0; i<rows.length; i++){
                if (i !== 0 && ids.indexOf(rows[i].id) !== -1 ){
                    count +=1;
                    rows[i].className = "";
                } else if(i !== 0) {
                    rows[i].className = "inputhidden";
                }
            }
            if (count === 0){
                document.getElementById('offlinealertsearching').className = "container";
                for (var i = 0; i<rows.length; i++){
                    if (i !== 0){
                        rows[i].className = "";
                    }
            }
            } else {
                document.getElementById('offlinealertsearching').className = "container inputhidden";
            }
        }
    });
}

function searchCon(){ //test lauaarvutiga ja lisada offline teatele refresh nupp
    $.ajax({
        type: "GET",
        url: "concheck",
        success: function(msg){
            document.getElementById('offlinealert').className = "container inputhidden";
            document.getElementById('offlinealertsearch').className = "container inputhidden";
            document.searchform.submit();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            
            document.getElementById('offlinealert').className = "container";
            var key = document.getElementById('search').value;
            var rows = document.getElementsByTagName("tr");
            var count = 0;
            for (var i = 0; i<rows.length; i++){
                var str = rows[i].firstElementChild.innerHTML;
                if (i !== 0 && str.toLowerCase().indexOf(key.toLowerCase()) !== -1){
                    count +=1;
                    rows[i].className = "";
                } else if(i !== 0) {
                    rows[i].className = "inputhidden";
                }
            }
            if (count === 0){
                document.getElementById('offlinealertsearch').className = "container";
                for (var i = 0; i<rows.length; i++){
                    if (i !== 0){
                        rows[i].className = "";
                    }
            }
            } else {
                document.getElementById('offlinealertsearch').className = "container inputhidden";
            }
        }
    });
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
                                    if ( key === 'search'){
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


