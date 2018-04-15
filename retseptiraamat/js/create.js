
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
    });
    
    document.getElementById('imageUpload').addEventListener("change",function(){
        var file = document.getElementById('imageUpload').files.item(0);
        if (file !== null && file.name !== ""){
            document.getElementById('imageUploadvalue').innerHTML = file.name;
        }
        readURL(this);
    });
    
    document.getElementById('addIng_ee').addEventListener("click", function(){
        addIngridient();
    });
    
    document.getElementById('addIng_eng').addEventListener("click", function(){
        addIngridientEng();
    });
    
    document.getElementById('imageUploadVis').addEventListener("click", function(){
        document.getElementById('imageUpload').click();
    });
    
    document.getElementById('submitRecipe').addEventListener("click", function(){
        if (document.getElementById('addedIngList_ee').childElementCount > 0){
            if (document.getElementById('insert_Eng').checked){
                if (document.getElementById('addedIngList_eng').childElementCount > 0){
                    document.formCreate.submit();
                } else {
                    document.formError.submit();
                }
            } else {
                document.formCreate.submit();
            }
        } else {
            document.formError.submit();
        }
            
    });
    
    document.getElementById('insert_Eng').addEventListener("change", function(){
        if (document.getElementById('insert_Eng').checked){
            document.getElementById('cont_Eng').className = "";
        } else {
            document.getElementById('cont_Eng').className = "inputhidden";
        }
    });
    
    document.getElementById('locationBox').addEventListener("change", function(){
        if (document.getElementById('locationBox').checked){
            var myLocation = ['59.4713933,24.4580691', '58.3684515,26.7325436', '58.3943961,24.501623'];
            var rand = myLocation[Math.floor(Math.random() * myLocation.length)];
            document.getElementById('locationBox').value = rand;
        } else {
            document.getElementById('locationBox').value = "";
        }
    });
    
    sendstats();
}

document.addEventListener('DOMContentLoaded', function() {
    
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
            
        reader.onload = function (e) {
            document.getElementById('showImage').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

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
    
    var amount = document.createElement("p");
    amount.className = "amount";
    amount.innerHTML = document.getElementById('addAmount_ee').value;
    
    var inputamount = document.createElement("input");
    inputamount.className = "inputhidden";
    inputamount.name = "amount_ee[]";
    inputamount.value = document.getElementById('addAmount_ee').value;
    
    var unit = document.createElement("p");
    unit.className = "unit";
    unit.innerHTML = document.getElementById('addUnit_ee').value;
    
    var inputunit = document.createElement("input");
    inputunit.className = "inputhidden";
    inputunit.name = "unit_ee[]";
    inputunit.value = document.getElementById('addUnit_ee').value;
    
    var removeIng = document.createElement('button');
    if (document.getElementById('sel-lang').value === "ee") {
        removeIng.innerHTML = 'eemalda';
    } else if (document.getElementById('sel-lang').value === "en") {
        removeIng.innerHTML = 'remove';
    }
    removeIng.setAttribute("data-tag", "removeIng_ee");
    removeIng.className = "removeIng";
    removeIng.onclick = function(){
        document.getElementById('addedIngList_ee').removeChild(addedIng);
        return false;
    };
    
    addedIng.appendChild(ingredient);
    addedIng.appendChild(inputIng);
    addedIng.appendChild(amount);
    addedIng.appendChild(inputamount);
    addedIng.appendChild(unit);
    addedIng.appendChild(inputunit);
    addedIng.appendChild(removeIng);
    
    document.getElementById('addIngredient_ee').value = "";
    document.getElementById('addAmount_ee').value = "";
    document.getElementById('addUnit_ee').value = "";
    
    document.getElementById('addedIngList_ee').appendChild(addedIng);
}

function addIngridientEng() {
    
    var addedIng = document.createElement("li");
    addedIng.className = "addedIng";
    
    var ingredient = document.createElement("p");
    ingredient.className = "ingredient";
    ingredient.innerHTML = document.getElementById('addIngredient_eng').value;
    
    var inputIng = document.createElement("input");
    inputIng.className = "inputhidden";
    inputIng.name = "ingredient_eng[]";
    inputIng.value = document.getElementById('addIngredient_eng').value;
    
    var amount = document.createElement("p");
    amount.className = "amount";
    amount.innerHTML = document.getElementById('addAmount_eng').value;
    
    var inputamount = document.createElement("input");
    inputamount.className = "inputhidden";
    inputamount.name = "amount_eng[]";
    inputamount.value = document.getElementById('addAmount_eng').value;
    
    var unit = document.createElement("p");
    unit.className = "unit";
    unit.innerHTML = document.getElementById('addUnit_eng').value;
    
    var inputunit = document.createElement("input");
    inputunit.className = "inputhidden";
    inputunit.name = "unit_eng[]";
    inputunit.value = document.getElementById('addUnit_eng').value;
    
    var removeIng = document.createElement('button');
    if (document.getElementById('sel-lang').value === "ee") {
        removeIng.innerHTML = 'eemalda';
    } else if (document.getElementById('sel-lang').value === "en") {
        removeIng.innerHTML = 'remove';
    }
    removeIng.setAttribute("data-tag", "removeIng_eng");
    removeIng.className = "removeIng";
    removeIng.onclick = function(){
        document.getElementById('addedIngList_eng').removeChild(addedIng);
        return false;
    };
    
    addedIng.appendChild(ingredient);
    addedIng.appendChild(inputIng);
    addedIng.appendChild(amount);
    addedIng.appendChild(inputamount);
    addedIng.appendChild(unit);
    addedIng.appendChild(inputunit);
    addedIng.appendChild(removeIng);
    
    document.getElementById('addIngredient_eng').value = "";
    document.getElementById('addAmount_eng').value = "";
    document.getElementById('addUnit_eng').value = "";
    
    document.getElementById('addedIngList_eng').appendChild(addedIng);
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
                xrhFile.open("GET", "../../json/create_"+this.lng+".json", false);
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
                                     if ( key === 'input_example'){ //not used
                                        elem.value = LngObject[key];
                                     }else if ( key !== 'imageUploadvalue_ee' && (this.lng !== "ee" && elem.innerHTML !== "No file chosen" ||
                                                                            this.lng !== "en" && elem.innerHTML !== "Pole valitud")){
                                        elem.innerHTML = LngObject[key];
                                     }
                                }
                            }
                     
                        }
                    }
                };
                xrhFile.send();
    };    
}


