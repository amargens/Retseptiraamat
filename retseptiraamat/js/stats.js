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
        document.getElementById('sel-lang').action = "../application/controllers/stats/index"
        document.formlang.submit();
    });
    
    sendstats();
    loadbrowser();
    loadtime();
    loadpage();
    setInterval(function(){ loadstats(); }, 5000);
    
}

function loadstats(){
    
    var a = [];
    var results = $.ajax({
        type: "GET",
        url: "pushstats",
        async: false,
        dataType: "json",
        success: function(results){
            for(i in results){
                a.push(results[i]);
            }
            dataBrowser = a[0];
            dataTime = a[1];
            datapage = a[2];
            loadbrowser();
            loadtime();
            loadpage();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("data push ended");
        }
    }).responseJSON;
    
}

function loadbrowser(){
    // Load google charts
    var arr = [];
    var count = 0;
    //alert(dataBrowser);
    for (var i = 0; i<dataBrowser.length; i++){
        arr.push([dataBrowser[i]['browser'], parseInt(dataBrowser[i]['count(browser)']) ]);
        count += parseInt(dataBrowser[i]['count(browser)']);
    }
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawbrowser);
    
    // Draw the chart and set the chart values
    function drawbrowser() {
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'browser');
        data.addColumn('number', 'count(browser)');
        data.addRows(arr);
        
        var options = {
          sliceVisibilityThreshold: 0
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('checkBrowser'));
        chart.draw(data, options);
    }
    document.getElementById('countBrowser').innerHTML = "data count: " + count;
    //alert(count);
}

function loadtime(){
    // Load google charts
    // google.charts.load('current', {'packages':['corechart']});
    var arr = [];
    var count = 0;
    for (var i = 0; i<dataTime.length; i++){
        arr.push([dataTime[i]['visittime'], parseInt(dataTime[i]['count(visittime)']) ]);
        count += parseInt(dataTime[i]['count(visittime)']);
    }
    google.charts.setOnLoadCallback(drawtime);
    // Draw the chart and set the chart values
    function drawtime() {
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'visittime');
        data.addColumn('number', 'count(visittime)');
        data.addRows(arr);
        
        var options = {
          sliceVisibilityThreshold: 0
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('getTime'));
        chart.draw(data, options);
    }
    document.getElementById('countTime').innerHTML = "data count: " + count;
}

function loadpage(){
    // Load google charts
    // google.charts.load('current', {'packages':['corechart']});
    var arr = [];
    var count = 0;
    for (var i = 0; i<datapage.length; i++){
        arr.push([datapage[i]['page'], parseInt(datapage[i]['count(page)']) ]);
        count += parseInt(datapage[i]['count(page)']);
    }
    google.charts.setOnLoadCallback(drawpage);
    
    // Draw the chart and set the chart values
    function drawpage() {
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'page');
        data.addColumn('number', 'count(page)');
        data.addRows(arr);
        
        var options = {
          sliceVisibilityThreshold: 0
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('getpage'));
        chart.draw(data, options);
    }
    document.getElementById('countPage').innerHTML = "data count: " + count;
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
                xrhFile.open("GET", "../../json/stats_"+this.lng+".json", false);
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