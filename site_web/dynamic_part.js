function add_showMore_link(hideContent, link) {
    link.on("click", function () {

        const $this = $(this);
        const $content = $this.parent().prev("div.content");
        let linkText = $this.text().toUpperCase();

        if (linkText === "SHOW MORE") {
            linkText = "Show less";
            $content.addClass('showContent').removeClass(hideContent);
        } else {
            linkText = "Show more";
            $content.addClass(hideContent).removeClass('showContent');
        }

        $this.text(linkText);
    });

}

function add_resizable_table(number_roles) {


    if (number_roles > 10) {

        const parent = document.getElementById("actors");
        const toWrap = document.getElementById("actors_table");
        const wrapper = document.createElement('div');
        wrapper.className += "content hideContent-actors";
        parent.replaceChild(wrapper, toWrap);
        wrapper.appendChild(toWrap);
        const link_div = document.createElement('div');
        const link = document.createElement('a');
        const linkText = document.createTextNode("Show more");
        link.appendChild(linkText);
        link.href = "#Acteurs";
        link_div.appendChild(link);
        link_div.className += "show-more";
        parent.appendChild(link_div);

    }


}


function add_plots(havePlot) {
    if (havePlot != 0) {
        const parent = document.getElementById("resume_block");
        const link_div = document.createElement('div');
        const link = document.createElement('a');
        const linkText = document.createTextNode("Show more");
        link.appendChild(linkText);
        link.href = "#Resume";
        link_div.appendChild(link);
        link_div.className += "show-more-plot";
        parent.appendChild(link_div);
    } else {

        $('#plot').find('span').text('Aucun résumé disponible');
        $('#plot.content.hideContent-plot').height("auto");

        $('#resume_block').css("padding-bottom", 0);
        $('#resume_block').css("padding-top", 0);

    }

}


function add_dynamic_part_series(havePlot, hideContent) {
    add_plots(havePlot);
    add_showMore_link(hideContent, $(".show-more-plot a"))

}

function add_dynamic_part_filmAndEp(havePlot, number_roles, hideContent_plot, hideContent_actors) {

    add_plots(havePlot);
    add_showMore_link(hideContent_plot, $(".show-more-plot a"));
    add_resizable_table(number_roles);
    add_showMore_link(hideContent_actors, $(".show-more a"))

}

function add_navbar(args) {
    var body = document.getElementsByTagName("body");

    var section = document.createElement("section");
    section.setAttribute("id", "Tabs");
    section.setAttribute("class", "bg-light-gray");

    var div1 = document.createElement("div");
    div1.setAttribute("class", "container");

    var div2 = document.createElement("div");
    div2.setAttribute("class", "col-lg-12 text-center");

    var ul = document.createElement("ul");
    ul.setAttribute("class", "nav nav-pills nav-justified");
    ul.setAttribute("id", "nav_bar");

    for (var arg in args) {
        ul.innerHTML += "<li><a class=\"page-scroll\" href=#" + args[arg][1]  +" " + "data-toggle=\"pill\">" + args[arg][0] + "</a></li>"
    }

    div2.appendChild(ul);
    div1.appendChild(div2);
    section.appendChild(div1);
    document.body.insertBefore(section, body.firstChild);


}


// FOR ADMIN

function clearAllInputs(parent) {
    var children = parent.children;
    console.log(children.length);
    for (var i = 0; i < children.length; i++) {
        var child = children[i];
        parent.removeChild(child)

    }
}

function addAdminElements(section) {
    /*create the "add" link*/
    const button = document.createElement('button');
    button.className += "addButton";
    button.id += section.id;
    const add = document.createElement('img');
    if (section.id == "resume-title"){
        add.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAA50lEQVRYR82XQQ7DIAwEycvbvLyVoxBBMbDYa9RccgFmbEDZHGnP874x+f1Qjw18gb5uzplSqiSiBUp4rrWSiBTQ4I1ElMAIXklECCDwR4ItsAIXiZMpsAyXG8ESMMGlBQwBM5wh4IJ7BdxwjwAFbhWgwS0CVPiqAB2+IhACRwXC4IhAKHwmEA5nCjRRC416s28B0gUzvNcBgZbBEYpWaMW/47QOfCQoABKuyrNIT+BKKwMJCry3BdIBNUIXQs0PBnsLyvVo1WqSoy3YIjG7htbOwvP+UqA8hHAlwEC1WPQMAOtPh6gCX5L0PiE3hQmGAAAAAElFTkSuQmCC";
    } else {
        add.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADMklEQVRYR8XXSaiWZRQH8N8No6I0a5PrBlKkdBNEVEjYQFlERmYtmmiAWigRGi0SF1HRALXJBigqW1UOURgNWjYuzAYjaHIbZRqVqYjE//K88vL1vfc+771iZ/MtvvOc83/P+D8j6mUqFuACzMHJmFae/4GfsRXv4Q38VWN6pELpNCzHYhyD/fgWPyCOI8cjerMwBbuxGg8VvU43YwGIs5VYgiOwHi/gHfzZYTFRugg3lGgF7GNYgT3D3nQBOBWv4Qy8ibvxXUW02iqzi/MA+hJX4adBG8MAzMUGHIc78XxPx4Pqt+KJkq6A+aqtMAggX/4RjsRl+GSSzpvn55bCTBrOaUeiDSA5/wynYP4hdN6AOA9vl1Sejb35ow3gYdyDmw5B2LsCdzuewoO4tw0gLZTWCsKEvlZSJ5Gqni+66aLzS8v+2ETgOdyIVG6fal+HA7iyFnHprHTFs7gtANK7v5Sv72MoPjcWx/N6AIjqW0hNnBQAmXCZWunT13samiiAa/EKFgXAMyX8J/TM5WQiEF+/xXcAfI6jyoLpGYAJpyB+Ums7AyBINmFhX++TqIG4ysY8KwD24SXc3AEgrZYaaVZvWy1jO5I1PCi7Sn3902H3RVxTCyAApw8xNBaA33E9xgXwKz74P1OQIjwaZx7mGjhYhE+X+X/iGESjC9tE50B8JfKjbdgMhavxas8oTBRAM/xGizBVnlH8Lq44TABCeMILZjTLKNPwlrIotvUAsaYso4zxWknnfIFVuKMBECaUdRxKfUmtpcKSo97VasNMvV++fmaofJuQhCQsy4os+6EHjmrVu/AkHsB9edUGkFb8FKfjQmyuNlunmJWd3H9TIvAfShYzuXY+LnPhcnxYZ3tcrThfi7+L8+3Ni2G0PAMp1CzXTo6SFMtkJGF/FDtwMb5uG+s6TBKJzIRUbNpz6eDDCkR5+zjy9VvKqD/45WNFoPkvNXF/uYpy7yV/Oc3yu7MDQCZcvjL8MkdINu0j5cQbzfmg1BynuRPSHdfh2NL335ejswEShpNWDrvOHRmW/HI5TnM1d0oNgOZxJualA+d5s6Kz+3P3he2Gdod0puDGlX8BJ+erZNd+SnYAAAAASUVORK5CYII=";

    }
    button.appendChild(add);
    section.insertBefore(button, section.children[1]);
    button.addEventListener("click", function () {

        if (section.id === "actor-title") {
            document.getElementById('formContainerActor').style.display = "block";
        } else if (section.id === "director-title") {
            document.getElementById('formContainerDirector').style.display = "block";
        } else if (section.id === "writer-title") {
            document.getElementById('formContainerWriter').style.display = "block";
        } else if (section.id === "detail-title") {
            document.getElementById('formContainerDetails').style.display = "block";
        } else { //resume
            document.getElementById('formContainerResume').style.display = "block";
        }

    });


}


function addAdminElementsFilmEpisode(plot) {
    console.log("hi")
    addAdminElements(document.getElementById("actor-title"));
    addAdminElements(document.getElementById("director-title"));
    addAdminElements(document.getElementById("writer-title"));
    addAdminElements(document.getElementById("detail-title"));
    addAdminElements(document.getElementById("resume-title"));
    $('#resume').val($('#resume').val() + plot);
}




//form pop_up
function check_empty() {
    if (document.getElementById('name').value == "" || document.getElementById('firstName').value == "" || document.getElementById('role').value == "") {
        alert("Completer tous les champs S.V.P");
    } else {
        document.getElementById('form').submit();
        alert("Opération réussie");
    }
}

//for details form
function check_valid() {
    if (document.getElementById('genre').value == "" && document.getElementById('language').value == "") {
        alert("Completer au moins un champ  S.V.P");
    } else {
        document.getElementById('form').submit();
        alert("Opération réussie");
    }
}

//hidePopup
function div_hide(id) {
    console.log(id)
    document.getElementById(id).style.display = "none";
}


function update_resume() {
    //$('#plot').update($('#resume').val());

}


function startRequest(requestType) {
    var loader = $("#load_spinner")
    if ($('#load_spinner').is(":visible")) {
        // Don't do anything if there's already content or if we're already loading
        return;
    }

    var text = $('#resume').val();
    //var text = "blbl";

    loader.show();
    console.log("adminRequests.php?type=" + requestType);
    $.ajax({
        url: "adminRequests.php?type=" + requestType, //This is the current doc
        type: "POST",
        dataType: 'json', // add json datatype to get json
        data: ({content: text}),

        done: document.getElementById('#formContainerResume').style("display", "none")
        ,
        success: console.log(data)
        ,
        always: loader.hide()


    });
}

