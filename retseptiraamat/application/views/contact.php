<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 data-tag="header"></h2>
        <label  data-tag="Tiim"></label><br />
<!--        Kui Retseptiraamatu kausta vahel pole, siis vaja panna: http://localhost/application/assets/team.xml-->
        <?php
        $feed = new SimpleXMLElement("http://localhost/retseptiraamat/application/assets/team.xml",NULL,TRUE);
        $namespaces = $feed->getNamespaces(true);

        $getChildren=$feed->children($namespaces["s"]);
        echo $getChildren->nimi."<br>";
        echo $getChildren->nimi2."<br>";
        echo $getChildren->nimi3."<br>";
        ?>
        <br />
        <label  data-tag="Info"></label><br />
        <?php
        $feed = new SimpleXMLElement("http://localhost/retseptiraamat/application/assets/team.xml",NULL,TRUE);
        $namespaces = $feed->getNamespaces(true);
        echo $getChildren->email."<br>";
        echo $getChildren->aadress."<br>";
        ?>
    </div>
</div>

