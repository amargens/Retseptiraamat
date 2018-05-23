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
        document.getElementById('sel-lang').action = "../application/controllers/account/index";
        document.formlang.submit();
    });
    
    document.getElementById('favres').addEventListener("click", function(){
        document.getElementById('favrescont').className = "";
        document.getElementById('userrescont').className = "inputhidden";
        document.getElementById('accsetcont').className = "inputhidden";
    });
    
    document.getElementById('userres').addEventListener("click", function(){
        document.getElementById('favrescont').className = "inputhidden";
        document.getElementById('userrescont').className = "";
        document.getElementById('accsetcont').className = "inputhidden";
    });
    
    document.getElementById('accset').addEventListener("click", function(){
        document.getElementById('favrescont').className = "inputhidden";
        document.getElementById('userrescont').className = "inputhidden";
        document.getElementById('accsetcont').className = "";
    });
    
    document.getElementById('googlebtn').addEventListener("click", function(){
        
        document.formlinkgoogle.submit();
        
    });
    
    document.getElementById('checkallrecipes').addEventListener("change", function(){
        if (document.getElementById("checkallrecipes").checked) {
            document.getElementById("checkallimg").className = "";
            document.getElementById("accountbtndelall").className = "btn btn-danger";
            document.getElementById("accountbtndelkeepall").className = "btn btn-danger inputhidden";
        } else if (!document.getElementById("checkallrecipes").checked) {
            document.getElementById("checkallimg").className = "inputhide";
            document.getElementById("accountbtndelkeepall").className = "btn btn-danger";
            document.getElementById("accountbtndelall").className = "btn btn-danger inputhidden";
        }
    });
    
    document.getElementById('changepassbegin').addEventListener("click", function(){
        document.getElementById('changepass').className = "row ";
    });
    
    document.getElementById('changepasscancel').addEventListener("click", function(){
        document.getElementById('changepass').className = "row inputhidden";
    });
    
    
    sendstats();
}


function favbtn() {
    document.formfav.submit();
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
                xrhFile.open("GET", "../../json/account_"+this.lng+".json", false);
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
                                if ( key === 'favbtn' || key === 'delbtn'){
                                    if (elem.innerHTML.slice(0,1) !== "<"){
                                        elem.innerHTML = LngObject[key] + " " + elem.innerHTML.slice(elem.innerHTML.indexOf(" ")+1);;
                                    } else {
                                        elem.innerHTML = LngObject[key] + " " + elem.innerHTML;
                                    }
                                }else if ( key === 'changeidnum' || key === 'oldpass' || key === 'newpass'){
                                    elem.placeholder = LngObject[key];
                                }else if(key !== null) {
                                    console.log(key);
                                    elem.innerHTML = LngObject[key]  ;
                                }
                            }
                     
                        }
                    }
                };
                xrhFile.send();
    };    
}