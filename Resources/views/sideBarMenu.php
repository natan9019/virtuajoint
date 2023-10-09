
<body>
    <div class="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" style="width: 180px; display: block;" id="mySidebar">
        <div class="w3-bar w3-dark-grey">
            <span class="w3-bar-item w3-padding-16">Menú</span>
            <button onclick="w3_close()" class="w3-bar-item w3-button w3-right w3-padding-16" title="close Sidebar">X</button>
        </div>

        <div class="w3-bar-block">
            <div class="w3-dropdown-hover w3-green">
                <a class="w3-button" href="masterCatalogue.php">Catálogo Maestro <i class="fa fa-caret-down"></i></a>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a class="w3-bar-item w3-button" href="abcPaises.php">ABC Paises</a>
                    <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 2</a>
                    <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 3</a>
                </div>
            </div>
            <a class="w3-bar-item w3-button" href="/Resources/views/userHomePage.php">Mi Portal</a>
            <a class="w3-bar-item w3-button" href="javascript:void(0)">Contact</a>
            <a class="w3-bar-item w3-button" href="javascript:void(0)">Support</a>
        </div>
    </div>



    <script>
      function w3_open() {
        document.getElementById("main").style.marginLeft = "180px";
        document.getElementById("mySidebar").style.width = "180px";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
      }
      function w3_close() {
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
      }
    </script>
</body>