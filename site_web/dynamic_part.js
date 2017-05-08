function add_showMore_link(hideContent, link) {
    link.on("click", function () {

        var $this = $(this);
        var $content = $this.parent().prev("div.content");
        $content.repl
        var linkText = $this.text().toUpperCase();

        if (linkText === "SHOW MORE") {
            linkText = "Show less";
            $content.addClass('showContent').removeClass(hideContent);
        } else {
            linkText = "Show more";
            $content.addClass(hideContent).removeClass('showContent');
        }
        ;

        $this.text(linkText);
    });

}

function add_resizable_table(number_roles) {


    if (number_roles > 10) {

        var parent = document.getElementById("actors");
        var toWrap = document.getElementById("actors_table");
        var wrapper = document.createElement('div');
        wrapper.className += "content hideContent-actors";
        parent.replaceChild(wrapper, toWrap);
        wrapper.appendChild(toWrap);
        var link_div = document.createElement('div');
        var link = document.createElement('a');
        var linkText = document.createTextNode("Show more");
        link.appendChild(linkText);
        link.href = "#Acteurs";
        link_div.appendChild(link);
        link_div.className += "show-more";
        parent.appendChild(link_div);

    }


}


function add_plots(havePlot) {
    if (havePlot != 0) {
        var parent = document.getElementById("resume_block");
        var link_div = document.createElement('div');
        var link = document.createElement('a');
        var linkText = document.createTextNode("Show more");
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




