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
    
    document.getElementById('formlogin').addEventListener("submit", function(e){
        if (document.getElementById("kasutajanimi").value !== "") {
            if (document.getElementById("passwrdLabel").checked) {
                document.getElementById('formlogin').action = "login";
                if (document.getElementById("parool").value !== "") {
                    return true;
                }
            } else if (document.getElementById("googleLabel").checked) {
                document.getElementById('formlogin').action = "loginGoogle";
                return true;
            }
        }
    });
    
    document.getElementById('passwrdLabel').addEventListener("change", function(){
        if (document.getElementById("passwrdLabel").checked) {
            document.getElementById("parooldiv").className = "form-group";
            document.getElementById("parool").disabled = false;
        }
    });
    document.getElementById('googleLabel').addEventListener("change", function(){
        if (document.getElementById("googleLabel").checked) {
            document.getElementById("parooldiv").className = "form-group inputdisabled";
            document.getElementById("parool").disabled = true;
        }
    });
    
    sendstats();
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
                xrhFile.open("GET", "../../json/login_"+this.lng+".json", false);
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
                                    if ( key === 'username' || key === 'psword'){
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