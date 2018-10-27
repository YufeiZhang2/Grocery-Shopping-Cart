<?php
session_start();

?>

<div class="browser">


    <!-- main-categories-->
    <img src="imgs/main catagories.png" width="600px" id="SubCategoryMap" height="227" usemap="#SubCategoryMap" alt="">
    <map name="SubCategoryMap" >
        <area shape="rect" coords="6,131,113,248" onMouseOver="ShowFreshFood()" onMouseOut="HideFreshFood()">
        <area shape="rect" coords="124,131,233,245" onMouseOver="ShowFrozenFood()" onMouseOut="HideFrozenFood()" >
        <area shape="rect" coords="243,130,353,250" onMouseOver="ShowHomeHealth()" onMouseOut="HideHomeHealth()">
        <area shape="rect" coords="365,131,471,247" onMouseOver="ShowBeverages()" onMouseOut="HideBeverages()">
        <area shape="rect" coords="482,130,588,246" onMouseOver="ShowPetFood()" onMouseOut="HidePetFood()">
    </map>


    <!-- sub-categories-->
    <img src="imgs/fresh food.png" width="600px" height="227" id="freshFood" alt="" onMouseOver="ShowFreshFood()" usemap="#FreshFoodMap">
    <map name="FreshFoodMap">
        <area shape="rect" coords="5,46,73,105" href="index.php?productId=3002">
        <area shape="rect" coords="78,46,145,105" href="index.php?productId=3005">
        <area shape="rect" coords="154,45,223,105" href="index.php?productId=3006">
        <area shape="rect" coords="227,46,299,108" href="index.php?productId=3007">
        <area shape="rect" coords="304,46,374,105" href="index.php?productId=3004">
        <area shape="rect" coords="378,46,448,106" href="index.php?productId=3003">
        <area shape="rect" coords="455,134,522,180" href="index.php?productId=3000">
        <area shape="rect" coords="529,134,597,181" href="index.php?productId=3001">
    </map>



    <img src="imgs/frozen food.png" alt="" name="frozenFood" width="600px" height="227" id="frozenFood" onMouseOver="ShowFrozenFood()" usemap="#FrozenFoodMap">
    <map name="FrozenFoodMap" id="FrozenFoodMap">
        <area shape="rect" coords="6,44,95,142" href="index.php?productId=1002">
        <area shape="rect" coords="105,46,197,126" href="index.php?productId=1003">
        <area shape="rect" coords="204,134,296,180" href="index.php?productId=1000">
        <area shape="rect" coords="305,135,396,180" href="index.php?productId=1001">
        <area shape="rect" coords="405,135,495,181" href="index.php?productId=1004">
        <area shape="rect" coords="503,135,594,180" href="index.php?productId=1005">
    </map>

    <img src="imgs/home health.png" width="600px" height="227" id="homeHealth" alt="" onMouseOver="ShowHomeHealth()" usemap="#homeHealthMap">
    <map name="homeHealthMap">
        <area shape="rect" coords="4,46,83,104" href="index.php?productId=2002">
        <area shape="rect" coords="89,46,167,103" href="index.php?productId=2005">
        <area shape="rect" coords="175,46,255,106" href="index.php?productId=2006">
        <area shape="rect" coords="263,133,340,182" href="index.php?productId=2000">
        <area shape="rect" coords="346,133,427,181" href="index.php?productId=2001">
        <area shape="rect" coords="433,134,512,180" href="index.php?productId=2003">
        <area shape="rect" coords="519,135,598,180" href="index.php?productId=2004">
    </map>


    <img src="imgs/beverages.png" width="600" height="227" id="beverages" alt="" onMouseOver="ShowBeverages()" usemap="#beveragesMap">
    <map name="beveragesMap">
        <area shape="rect" coords="3,42,96,96" href="index.php?productId=4005">
        <area shape="rect" coords="104,124,197,167" href="index.php?productId=4003">
        <area shape="rect" coords="205,125,297,167" href="index.php?productId=4004">
        <area shape="rect" coords="303,140,397,183" href="index.php?productId=4000">
        <area shape="rect" coords="403,139,497,185" href="index.php?productId=4001">
        <area shape="rect" coords="504,141,596,182" href="index.php?productId=4002">
    </map>


    <img src="imgs/pet food.png" alt="" width="600" height="227" id="petFood" onMouseOver="ShowPetFood()" usemap="#petFoodMap" >
    <map name="petFoodMap">
        <area shape="rect" coords="8,44,115,107" href="index.php?productId=5002">
        <area shape="rect" coords="125,46,234,107" href="index.php?productId=5003">
        <area shape="rect" coords="246,46,355,104" href="index.php?productId=5004">
        <area shape="rect" coords="364,133,475,181" href="index.php?productId=5001">
        <area shape="rect" coords="485,133,595,181" href="index.php?productId=5000">
    </map>

</div>

<script>

    var freshFood = document.getElementById("freshFood");
    var frozenFood = document.getElementById("frozenFood");
    var homeHealth = document.getElementById("homeHealth");
    var beverages = document.getElementById("beverages");
    var petFood = document.getElementById("petFood");


    //fresh food
    function ShowFreshFood()
    {
        freshFood.style.display="block";
        HideFrozenFood();
        HideHomeHealth();
        HideBeverages();
        HidePetFood();
    }

    function HideFreshFood()
    {
        freshFood.style.display="none";
    }


    //frozen food
    function ShowFrozenFood()
    {
        frozenFood.style.display="block";
        HideFreshFood();
        HideHomeHealth();
        HideBeverages();
        HidePetFood();
    }

    function HideFrozenFood()
    {
        frozenFood.style.display="none";
    }

    //home health
    function ShowHomeHealth()
    {
        homeHealth.style.display="block";
         HideFreshFood();
         HideFrozenFood();
         HideBeverages();
         HidePetFood();
    }

    function HideHomeHealth()
    {
        homeHealth.style.display="none";
    }

    //beverages

    function ShowBeverages()
    {
        beverages.style.display="block";
        HideFreshFood();
         HideFrozenFood();
         HideHomeHealth();
         HidePetFood();
    }

    function HideBeverages()
    {
        beverages.style.display="none";
    }


    //pet food
    function ShowPetFood()
    {
        petFood.style.display="block";
        HideFreshFood();
         HideFrozenFood();
         HideHomeHealth();
         HideBeverages();
    }


    function HidePetFood()
    {
        petFood.style.display="none";
    }


</script>


