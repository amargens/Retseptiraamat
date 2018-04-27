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
        document.getElementById('sel-lang').action = "../application/controllers/map/index"
        document.formlang.submit();
    });
    
    myMap();
    
    sendstats();
}


function myMap() {
    
    var map = L.map('map').setView([58.6252185, 25.8454569], 7);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    var markers = L.markerClusterGroup();

    customCircleMarker = L.Marker.extend({
        options: { 
            id: 'id'
        }
    });
    
    
    for (i = 0; i < data.length; i++) {
        var recipe = data[i];
        var loc = recipe['_location'].split(','); 
        var pos = {
              lat: loc[0],
              lng: loc[1]
            };
        var marker = L.marker(pos);
        var popup = L.popup().setContent(recipe['_recipeID']);
        marker.bindPopup(popup).on('click', onClick);
        
        function onClick(event) {
            event.target.closePopup();
            var arr = event.target._popup._content; 
            //alert("siin" + arr);
            document.getElementById('inputmap').value = arr;
            document.getElementById('inputmap').action = "../application/controllers/map/index"
            document.formmap.submit();
        }
        
        
        markers.addLayer(marker);
    }
    markers.on('clusterclick', function (a) {
        var arr = "";
        var dot = a.layer.getAllChildMarkers();
        arr += dot[0]._popup._content;
        for (i = 1; i < dot.length; i++){
            arr += ",";
            arr += dot[i]._popup._content;
        }      
        //alert("siin" + arr);
        document.getElementById('inputmap').value = arr;
        document.getElementById('inputmap').action = "../application/controllers/map/index"
        document.formmap.submit();
    });
    
    map.addLayer(markers);
    
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
                xrhFile.open("GET", "../../json/map_"+this.lng+".json", false);
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
                                    elem.innerHTML = LngObject[key]  ;
                                }
                            }
                     
                        }
                    }
                };
                xrhFile.send();
    };    
}