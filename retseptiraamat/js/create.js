
window.onload = function() {
    if (typeof jQuery === "undefined") {
    var script = document.createElement('script');
    script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js';
    script.type = 'text/javascript';
    document.getElementsByTagName('head')[0].appendChild(script);
}
    
    document.getElementById('imageUpload').addEventListener("change",function(){
        readURL(this);
    });
    
    document.getElementById('addIng').addEventListener("click", function(){
        addIngridient();
    });
    
}

document.addEventListener('DOMContentLoaded', function() {
    
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
            
        reader.onload = function (e) {
            document.getElementById('showImage').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function addIngridient() {
    
    var addedIng = document.createElement("li");
    addedIng.className = "addedIng";
    
    var ingredient = document.createElement("p");
    ingredient.className = "ingredient";
    ingredient.innerHTML = document.getElementById('addIngredient').value;
    
    var inputIng = document.createElement("input");
    inputIng.type = "hidden";
    inputIng.name = "ingredient[]";
    inputIng.value = document.getElementById('addIngredient').value;
    
    var amount = document.createElement("p");
    amount.className = "amount";
    amount.innerHTML = document.getElementById('addAmount').value;
    
    var inputamount = document.createElement("input");
    inputamount.type = "hidden";
    inputamount.name = "amount[]";
    inputamount.value = document.getElementById('addAmount').value;
    
    var unit = document.createElement("p");
    unit.className = "unit";
    unit.innerHTML = document.getElementById('addUnit').value;
    
    var inputunit = document.createElement("input");
    inputunit.type = "hidden";
    inputunit.name = "unit[]";
    inputunit.value = document.getElementById('addUnit').value;
    
    var removeIng = document.createElement('button');
    removeIng.innerHTML = 'eemalda';
    removeIng.className = "removeIng";
    removeIng.onclick = function(){
        document.getElementById('addedIngList').removeChild(addedIng);
        return false;
    };
    
    addedIng.appendChild(ingredient);
    addedIng.appendChild(inputIng);
    addedIng.appendChild(amount);
    addedIng.appendChild(inputamount);
    addedIng.appendChild(unit);
    addedIng.appendChild(inputunit);
    addedIng.appendChild(removeIng);
    
    document.getElementById('addIngredient').value = "";
    document.getElementById('addAmount').value = "";
    document.getElementById('addUnit').value = "";
    
    document.getElementById('addedIngList').appendChild(addedIng);
}

