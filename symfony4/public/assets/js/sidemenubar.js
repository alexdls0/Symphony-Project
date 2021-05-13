var x = window.matchMedia("(max-width: 380px)")

function openSM() {

    if (x.matches) {
        document.getElementById("mySidemenu").style.width = "100%";
    }
    else {
        document.getElementById("mySidemenu").style.width = "400px";
    }
    document.getElementById('burger').style.opacity = '0';
    document.getElementById("mySidemenu").style.zIndex = "1000";
    document.getElementById("mySidemenu").style.opacity = "1";
}

function closeSM() {
    document.getElementById("mySidemenu").style.width = "0";
    document.getElementById("mySidemenu").style.opacity = "0";
    document.getElementById("wrapper").style.marginLeft = "0";
    document.getElementById("wrapper").style.overflow = 'visible';
    document.getElementById('burger').style.opacity = '1';
}
