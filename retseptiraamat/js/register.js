window.onload = function() {
    
    if (typeof jQuery === "undefined") {
    	var script = document.createElement('script');
    	script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js';
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
                xrhFile.open("GET", "../../../json/register_"+this.lng+".json", false);
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
                                     if ( key === 'name' || key === 'email' || key === 'username' || key === 'pswrd' || key === 'pswrdR'){
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