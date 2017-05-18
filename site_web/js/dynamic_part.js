function add_showMore_link_action(hideContent, link) {
    link.on("click", function () {

        const $this = $(this);
        const $content = $this.parent().prev("div.content");
        console.log($content)
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

function add_resizable_table(table_id, _parent, section_id, number_elements) {

    console.log(_parent);
    if (number_elements > 10) {

        const parent = document.getElementById(_parent);
        console.log(parent);
        const toWrap = document.getElementById(table_id);
        const wrapper = document.createElement('div');
        wrapper.className += "content hideContent-actors";
        parent.replaceChild(wrapper, toWrap);
        wrapper.appendChild(toWrap);
        const link_div = document.createElement('div');
        const link = document.createElement('a');
        const linkText = document.createTextNode("Show more");
        link.appendChild(linkText);
        link.href = section_id;
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

function add_dynamic_part_person(number_roles, number_written, number_directed) {
    add_resizable_table("roles_table", "roles-container", "#Roles", number_roles);
    add_resizable_table("written_table", "written-container", "#Written", number_written);
    add_resizable_table("directed_table", "directed-container", "#Directed", number_directed);
    add_showMore_link_action("hideContent-actors", $(".show-more a"));
}

function add_dynamic_part_series(havePlot, hideContent) {
    add_plots(havePlot);
    add_showMore_link_action(hideContent, $(".show-more-plot a"));
}

function add_dynamic_part_filmAndEp(havePlot, number_roles, hideContent_plot, hideContent_actors) {

    add_plots(havePlot);
    add_showMore_link_action(hideContent_plot, $(".show-more-plot a"));
    add_resizable_table("actors_table", "actors", "#Acteurs", number_roles);
    add_showMore_link_action(hideContent_actors, $(".show-more a"))

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
        ul.innerHTML += "<li><a class=\"page-scroll\" href=#" + args[arg][1] + " " + "data-toggle=\"pill\">" + args[arg][0] + "</a></li>"
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
    const button_del = document.createElement('button');
    button_del.className += "addButton";
    button_del.id += section.id;
    const del = document.createElement('img');
    if (section.id == "resume-title") {
        add.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACzUlEQVRYhcWWz0sbQRTH51httRdLLx5KG5tK6s5YPRR6bmt/nBX9EzwIQhV6yy24sjsj0sJKoqUohGVmtBbxx11UcimWHloo/YGgpFpLNGldI6+HNNE0WXfVCT54p32zn+/7MT8Q8mmB8XBtkzC7MGdRTdAEkWwLS+pgSR1N0k1N0ATmLKpx2hkYD9f6/a+nBe2BIOF0TJPm7+bJIfDjWLIMljTWOKE3nBrcYlnVWFIDS5r1Cy4RItg+4cZgvdlbdSL4rbhxk3Dzw2nBJUI4XQ3ZkYAvuBbX72DBfqiC551ImgzZOvHMvBLwYhEulbj6+tlFlWU/rh1lZwJLaqiCtM2NwpP5sWMqYepF8KA9EDzLtB/1R3OjsLb7C9YzKXi68Mp1dxS1gnA6phKet/VMCh7Pj7q0gkURQgi12Nblkxwybt46NQzdi5PgHGQLAr7ubMP92ahLFWi6LtZfg5qE2aUi8y+pn9Cz9AZ6lqbBOcjCt51teOACPxRhdCDMWVRV2Z2DLPQsTUP34hQ8nI15rsXctJAmaEJVzwEAPqe2oHVq2Nd6zNkyIpJtqYJ/392GtjnvzPNOJE0iLKlzHvCcALZ3YgGq4AUBmqSb5wEvtMDvEKqGF4bQzzasBDwnwLSQxmmnV+DC2ifl8H8C2lFgPFyLJcu4Bd17+xL+ZPfVwwVNX7HDl/JXccwt8HliFgAAMlkH5tc+KoHnBpCNFG7Dxgm9AQu2Xy6wb2UG+lZm4O70CyXg5skhwJI6t+P6jaI3AeHGoCqAtwAWKXkRtVhWNZHsfaXhRJrvroXDF8q+C0N2JEAkTVYMLthG00Tkeln4oQidVEIEEWwjFDfwsfCjlcCcrqosu2fm/1u92VtFpKm77Q6/044li7j23H81WBQLmvYNFjRNJBsp2WpnsbpYfw0WRgfmpoU5WyaSJolkezmnSczZcu6b2V444XzYX91CT5vRTRG8AAAAAElFTkSuQmCC";
    } else {
        add.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADvUlEQVRYhbWWX0xaZxTAzxtrneCSsixtlplO6/6kky1Z19UF05JZtUO7roBQtYCKVVEKKbXMgvingjrTLf2LwfmwJbVdU13YVgQu6J5MfJhDkS6ZyN4aWq4vQyc0OXtoNGtzddyvepLf083vO+c733fvPQDpB1dwOFchOS9y6hyy6U6XJt5LaZO9lDbZ4dI81jlk05LzIud7R3LlAMBlse7mkbk7M0/SKhq2eRtXvvq1BdOhx9OwfNIoGuLyObkvknvnZw2HBuz+pif9k81Igp1qTJXUf9wPADvY7XoXZ59hWB7qm9TiVqD/Vhbk8jk5aSXf9QbvA8uP6kd9k024lVhGVTF+dpbgf3duHlM96p1oxO3APKqMbdaJDP2wLGSfaMDtRDckCTLeieKGgwP2iTPIhrHQIN6bu8nKsU+cwWLNgb7nW5/X7at7YgvUIxv+WvoDF+l5Vo4tUI/d3trUM0dxwlg43BPQIFueFhBm7fUENHj83CfOp9lfAZ7VrVq5FKhDtqwVQOK231cmACAT9h/eq7jkr0MS1gsg9N8WZsvguKHA2e2vRRLW7gCpLz57yAH118qmu/w1SEJ06QFG6Hkit8tfg5qr4ikwjSriXZQaSVgvgNBvvSuPgcVdneykVMjED7PXMEqHMbr0gJF/Usu4kkps+DxKh/FO8Arj2p2UCi3u6lUwu6uSHZQSmbgdvIIL8RBGaGZWUglcTv694fOFeAhv/f4149odlBLN7qpVMN6TPrZSp5GE6FIYI3SIyLVSp/HcXWkMaq+WTlt91UhClA5jJB4icq2+alR/UzIFYv1BZ7uvCklYpMO4EJ8jctt9VXjs7EcOeKvwdbnFV4kkrBVA6ucV7JECAHBNropli7cS2bJeAIF7wSVLAMDLAABwzHBgyOw9hWxZpOdxIT7H2jN7T2GJ7sPB9b8hl8/JNd2vSF30KpANEXoe/4zPsnIuehVo+kWW5LzKefOZmeBIjaC/zSNHNnw/M4Df/dbPymnzyFGo3G9jGsl21t48OtvmqcDtpObG0RkAeIlxKOTwOTm6O2WxLz0y3A5aRsoe8ni8vRsNpQAAkJWdIWi5LY6ZxqW4lTTfEj/M2pORv2ny/3ZCfePToGlcgluB+rpohseDzXfOEDsK1e/2GX8+kbowfhJJMP70eVKofMe24Zmn241i3ftO/Vh5otX9BaaDfqw8UdQsGOTwnnvVXjAy9xXslhVp8x2Vl4VTTSOlMYOrfNXgKl9tGimNVV4WThVp8x05Ba9JYe0Ll0b8CxNQdU/XcVuxAAAAAElFTkSuQmCC";

    }
    if (section.id == "detail-title") {
        del.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAC6klEQVRYhbWWO08bQRCAtwwkISWNC5QccQGY42aGCoRcgs1hGhD8ISQQPwDOiJ6OBikVIsDtRrawRZQag4+HHCiNDUTaFLEtP/Z86wuMNN3tft/Nzj4Y04wDwxhwAVY5QNolygjEB070XMt7lyjDAdIu4sqBYQzozhsYJ7FYlBPtCsTKj8lJqZMC8VEg7hyZ5nBocBagnyNuCsQ/umCFyIsA2NiLRPp6gh+Pj38VAL/CghUi54eWZWjBvwNYnOj3a8HryYlKp6ZpBv75W8CbJXwr8W1w8L1f2TMzMz3DsvG473Ioe4IjbqoGeI4jq54nc7atDc+nUvLp9lZ6juMnsd4CP4nFoqpu9xxH1kNXog6vh0pCIL60LAUn2lWVvXp9LZsjSCK/sCCrTXAppaxcXMjM1FRnPwCkGWOMZQE++R0yOdvWlvCDn83O+jVkeT8a/chcgNVuJdWRyNu2rN7ctMILBV94Q8KylhkHSAeuqwJQl1AJVi4v5dncXGC/CMQt5hJltDrbR0IFz2nAawKCCcQH7e2lkGiBX11pw2t9UGKc6Fl3gF+zSSllpViUuURCe56awNPrCiSToQTuteGplBIeVoITlfSbUAGvFIuyWiyGlhCIQm8bth2vjYZLJGQumQwt8W8bIq50hS8udsLbtlpYCW5ZS+zAMAYE4mNYeENifl5WPU9bghOV90ZGPjDGGBOIO+0fZOPxTnih0PWE85NQvSc40XbjNjwyzWGB+NL+UfN1HAT3k1Bdx5zo+XR09EvLm0AAbKgm9Byn662mlLBtWfU83weJS7TW8SLKAvS7RD9VA1T3eVBmpqfVnQ+Q3x0aeqd8Fx5alsGJSr3CdFMg3h2PjX1WwutxaprmW0gIxLvjiYnxrvDmSgjE81eDA+QD/7w99iKRPoG4rtodusmJnl2iNd81160GB0hzonIP4DIn2u7Yav8T+9HoR25ZywJxSyAKTlTiRE+1LAlEIRC3uGUtNU44jfgLUwkn+JzAd8QAAAAASUVORK5CYII="
    }
    button.appendChild(add);
    button_del.appendChild(del);
    section.insertBefore(button, section.children[1]);
    section.insertBefore(button_del, section.children[1]);
    button.addEventListener("click", function () {

        if (section.id === "actor-title") {
            document.getElementById('formContainerActor').style.display = "block";
        } else if (section.id === "director-title") {
            document.getElementById('formContainerDirector').style.display = "block";
        } else if (section.id === "writer-title") {
            document.getElementById('formContainerWriter').style.display = "block";
        } else if (section.id === "detail-title") {
            document.getElementById('formContainerDetails').style.display = "block";
        } else if (section.id === "roles-title") {
            document.getElementById('formContainerActorPerson').style.display = "block";
        } else if (section.id === "director-person-title") {
            document.getElementById('formContainerDirectorPerson').style.display = "block";
        } else if (section.id === "writer-person-title") {
            document.getElementById('formContainerWriterPerson').style.display = "block";
        } else { //resume
            document.getElementById('formContainerResume').style.display = "block";
        }

    });
    button_del.addEventListener("click", function () {
        if (section.id = "detail-title") {
            document.getElementById('formContainerDetailsDelete').style.display = "block";
        }

    });

}

function addheaderOptions(type) {

    $("#intro").append(
        $('<button class = "deleteFromDB">Supprimer</button>')
            .append(
                $('<img src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAC6klEQVRYhbWWO08bQRCAtwwkISWNC5QccQGY42aGCoRcgs1hGhD8ISQQPwDOiJ6OBikVIsDtRrawRZQag4+HHCiNDUTaFLEtP/Z86wuMNN3tft/Nzj4Y04wDwxhwAVY5QNolygjEB070XMt7lyjDAdIu4sqBYQzozhsYJ7FYlBPtCsTKj8lJqZMC8VEg7hyZ5nBocBagnyNuCsQ/umCFyIsA2NiLRPp6gh+Pj38VAL/CghUi54eWZWjBvwNYnOj3a8HryYlKp6ZpBv75W8CbJXwr8W1w8L1f2TMzMz3DsvG473Ioe4IjbqoGeI4jq54nc7atDc+nUvLp9lZ6juMnsd4CP4nFoqpu9xxH1kNXog6vh0pCIL60LAUn2lWVvXp9LZsjSCK/sCCrTXAppaxcXMjM1FRnPwCkGWOMZQE++R0yOdvWlvCDn83O+jVkeT8a/chcgNVuJdWRyNu2rN7ctMILBV94Q8KylhkHSAeuqwJQl1AJVi4v5dncXGC/CMQt5hJltDrbR0IFz2nAawKCCcQH7e2lkGiBX11pw2t9UGKc6Fl3gF+zSSllpViUuURCe56awNPrCiSToQTuteGplBIeVoITlfSbUAGvFIuyWiyGlhCIQm8bth2vjYZLJGQumQwt8W8bIq50hS8udsLbtlpYCW5ZS+zAMAYE4mNYeENifl5WPU9bghOV90ZGPjDGGBOIO+0fZOPxTnih0PWE85NQvSc40XbjNjwyzWGB+NL+UfN1HAT3k1Bdx5zo+XR09EvLm0AAbKgm9Byn662mlLBtWfU83weJS7TW8SLKAvS7RD9VA1T3eVBmpqfVnQ+Q3x0aeqd8Fx5alsGJSr3CdFMg3h2PjX1WwutxaprmW0gIxLvjiYnxrvDmSgjE81eDA+QD/7w99iKRPoG4rtodusmJnl2iNd81160GB0hzonIP4DIn2u7Yav8T+9HoR25ZywJxSyAKTlTiRE+1LAlEIRC3uGUtNU44jfgLUwkn+JzAd8QAAAAASUVORK5CYII=">')
            )
    );

    if (type === "serie") {
        $("#intro").append(
            $('<button id = "add_episode" class = "addEpisode">Episode  </button>')
                .append(
                    $('<img src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADvUlEQVRYhbWWX0xaZxTAzxtrneCSsixtlplO6/6kky1Z19UF05JZtUO7roBQtYCKVVEKKbXMgvingjrTLf2LwfmwJbVdU13YVgQu6J5MfJhDkS6ZyN4aWq4vQyc0OXtoNGtzddyvepLf083vO+c733fvPQDpB1dwOFchOS9y6hyy6U6XJt5LaZO9lDbZ4dI81jlk05LzIud7R3LlAMBlse7mkbk7M0/SKhq2eRtXvvq1BdOhx9OwfNIoGuLyObkvknvnZw2HBuz+pif9k81Igp1qTJXUf9wPADvY7XoXZ59hWB7qm9TiVqD/Vhbk8jk5aSXf9QbvA8uP6kd9k024lVhGVTF+dpbgf3duHlM96p1oxO3APKqMbdaJDP2wLGSfaMDtRDckCTLeieKGgwP2iTPIhrHQIN6bu8nKsU+cwWLNgb7nW5/X7at7YgvUIxv+WvoDF+l5Vo4tUI/d3trUM0dxwlg43BPQIFueFhBm7fUENHj83CfOp9lfAZ7VrVq5FKhDtqwVQOK231cmACAT9h/eq7jkr0MS1gsg9N8WZsvguKHA2e2vRRLW7gCpLz57yAH118qmu/w1SEJ06QFG6Hkit8tfg5qr4ikwjSriXZQaSVgvgNBvvSuPgcVdneykVMjED7PXMEqHMbr0gJF/Usu4kkps+DxKh/FO8Arj2p2UCi3u6lUwu6uSHZQSmbgdvIIL8RBGaGZWUglcTv694fOFeAhv/f4149odlBLN7qpVMN6TPrZSp5GE6FIYI3SIyLVSp/HcXWkMaq+WTlt91UhClA5jJB4icq2+alR/UzIFYv1BZ7uvCklYpMO4EJ8jctt9VXjs7EcOeKvwdbnFV4kkrBVA6ucV7JECAHBNropli7cS2bJeAIF7wSVLAMDLAABwzHBgyOw9hWxZpOdxIT7H2jN7T2GJ7sPB9b8hl8/JNd2vSF30KpANEXoe/4zPsnIuehVo+kWW5LzKefOZmeBIjaC/zSNHNnw/M4Df/dbPymnzyFGo3G9jGsl21t48OtvmqcDtpObG0RkAeIlxKOTwOTm6O2WxLz0y3A5aRsoe8ni8vRsNpQAAkJWdIWi5LY6ZxqW4lTTfEj/M2pORv2ny/3ZCfePToGlcgluB+rpohseDzXfOEDsK1e/2GX8+kbowfhJJMP70eVKofMe24Zmn241i3ftO/Vh5otX9BaaDfqw8UdQsGOTwnnvVXjAy9xXslhVp8x2Vl4VTTSOlMYOrfNXgKl9tGimNVV4WThVp8x05Ba9JYe0Ll0b8CxNQdU/XcVuxAAAAAElFTkSuQmCC">')
                )
        );

        $("#add_episode").click(function () {
            document.getElementById('formContainerAddEpisode').style.display = "block";
        })
    }

    $("#titre").css("display", "block")
        .append($('<button id = "edit_title" class = "editButton"></button>')
            .append(
                $('<img src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACzUlEQVRYhcWWz0sbQRTH51httRdLLx5KG5tK6s5YPRR6bmt/nBX9EzwIQhV6yy24sjsj0sJKoqUohGVmtBbxx11UcimWHloo/YGgpFpLNGldI6+HNNE0WXfVCT54p32zn+/7MT8Q8mmB8XBtkzC7MGdRTdAEkWwLS+pgSR1N0k1N0ATmLKpx2hkYD9f6/a+nBe2BIOF0TJPm7+bJIfDjWLIMljTWOKE3nBrcYlnVWFIDS5r1Cy4RItg+4cZgvdlbdSL4rbhxk3Dzw2nBJUI4XQ3ZkYAvuBbX72DBfqiC551ImgzZOvHMvBLwYhEulbj6+tlFlWU/rh1lZwJLaqiCtM2NwpP5sWMqYepF8KA9EDzLtB/1R3OjsLb7C9YzKXi68Mp1dxS1gnA6phKet/VMCh7Pj7q0gkURQgi12Nblkxwybt46NQzdi5PgHGQLAr7ubMP92ahLFWi6LtZfg5qE2aUi8y+pn9Cz9AZ6lqbBOcjCt51teOACPxRhdCDMWVRV2Z2DLPQsTUP34hQ8nI15rsXctJAmaEJVzwEAPqe2oHVq2Nd6zNkyIpJtqYJ/392GtjnvzPNOJE0iLKlzHvCcALZ3YgGq4AUBmqSb5wEvtMDvEKqGF4bQzzasBDwnwLSQxmmnV+DC2ifl8H8C2lFgPFyLJcu4Bd17+xL+ZPfVwwVNX7HDl/JXccwt8HliFgAAMlkH5tc+KoHnBpCNFG7Dxgm9AQu2Xy6wb2UG+lZm4O70CyXg5skhwJI6t+P6jaI3AeHGoCqAtwAWKXkRtVhWNZHsfaXhRJrvroXDF8q+C0N2JEAkTVYMLthG00Tkeln4oQidVEIEEWwjFDfwsfCjlcCcrqosu2fm/1u92VtFpKm77Q6/044li7j23H81WBQLmvYNFjRNJBsp2WpnsbpYfw0WRgfmpoU5WyaSJolkezmnSczZcu6b2V444XzYX91CT5vRTRG8AAAAAElFTkSuQmCC">')
            )
        );


    $("#date").css("display", "block")
        .append($('<button id = "edit_date" class = "editButton"></button>')
            .append(
                $('<img src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACzUlEQVRYhcWWz0sbQRTH51httRdLLx5KG5tK6s5YPRR6bmt/nBX9EzwIQhV6yy24sjsj0sJKoqUohGVmtBbxx11UcimWHloo/YGgpFpLNGldI6+HNNE0WXfVCT54p32zn+/7MT8Q8mmB8XBtkzC7MGdRTdAEkWwLS+pgSR1N0k1N0ATmLKpx2hkYD9f6/a+nBe2BIOF0TJPm7+bJIfDjWLIMljTWOKE3nBrcYlnVWFIDS5r1Cy4RItg+4cZgvdlbdSL4rbhxk3Dzw2nBJUI4XQ3ZkYAvuBbX72DBfqiC551ImgzZOvHMvBLwYhEulbj6+tlFlWU/rh1lZwJLaqiCtM2NwpP5sWMqYepF8KA9EDzLtB/1R3OjsLb7C9YzKXi68Mp1dxS1gnA6phKet/VMCh7Pj7q0gkURQgi12Nblkxwybt46NQzdi5PgHGQLAr7ubMP92ahLFWi6LtZfg5qE2aUi8y+pn9Cz9AZ6lqbBOcjCt51teOACPxRhdCDMWVRV2Z2DLPQsTUP34hQ8nI15rsXctJAmaEJVzwEAPqe2oHVq2Nd6zNkyIpJtqYJ/392GtjnvzPNOJE0iLKlzHvCcALZ3YgGq4AUBmqSb5wEvtMDvEKqGF4bQzzasBDwnwLSQxmmnV+DC2ifl8H8C2lFgPFyLJcu4Bd17+xL+ZPfVwwVNX7HDl/JXccwt8HliFgAAMlkH5tc+KoHnBpCNFG7Dxgm9AQu2Xy6wb2UG+lZm4O70CyXg5skhwJI6t+P6jaI3AeHGoCqAtwAWKXkRtVhWNZHsfaXhRJrvroXDF8q+C0N2JEAkTVYMLthG00Tkeln4oQidVEIEEWwjFDfwsfCjlcCcrqosu2fm/1u92VtFpKm77Q6/044li7j23H81WBQLmvYNFjRNJBsp2WpnsbpYfw0WRgfmpoU5WyaSJolkezmnSczZcu6b2V444XzYX91CT5vRTRG8AAAAAElFTkSuQmCC">')
            )
        );

    $(".deleteFromDB").click(function () {

        if (type === "work" || type === "serie") {
            if (confirm("Etes vous sûr de vouloir supprimer cette Oeuvre ?")) {
                remove_work(type);
            }
        } else if (type === "person") {
            if (confirm("Etes vous sûr de vouloir supprimer cette Personne ?")) {
                remove_person();
            }
        }
    });


    $("#edit_date").click(function () {
        if (type === "serie") {
            document.getElementById('formContainerEditDateSerie').style.display = "block";
        } else {
            document.getElementById('formContainerEditDate').style.display = "block";
        }

    });

    $("#edit_title").click(function () {
        document.getElementById('formContainerEditTitle').style.display = "block";
    });
}


function addAdminElementsFilmEpisode(plot) {
    addAdminElements(document.getElementById("actor-title"));
    addAdminElements(document.getElementById("director-title"));
    addAdminElements(document.getElementById("writer-title"));
    addAdminElements(document.getElementById("detail-title"));
    addAdminElements(document.getElementById("resume-title"));
    $('#resume').val($('#resume').val() + plot);
    addheaderOptions("work");

}

function addAdminElementsPerson() {
    addAdminElements(document.getElementById("roles-title"));
    addAdminElements(document.getElementById("director-person-title"));
    addAdminElements(document.getElementById("writer-person-title"));

}


function addAdminElementsSerie(plot) {
    addAdminElements(document.getElementById("resume-title"));
    $('#resume').val($('#resume').val() + plot);
    addheaderOptions("serie");

}


function modifyRows() {
    $('.row_t').attr('class', "clickable-row");

    $(".clickable-row").append(
        $('<td></td>')
            .append(
                $('<button class = "deleteButton"></button>')
                    .append(
                        $('<img src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAC6klEQVRYhbWWO08bQRCAtwwkISWNC5QccQGY42aGCoRcgs1hGhD8ISQQPwDOiJ6OBikVIsDtRrawRZQag4+HHCiNDUTaFLEtP/Z86wuMNN3tft/Nzj4Y04wDwxhwAVY5QNolygjEB070XMt7lyjDAdIu4sqBYQzozhsYJ7FYlBPtCsTKj8lJqZMC8VEg7hyZ5nBocBagnyNuCsQ/umCFyIsA2NiLRPp6gh+Pj38VAL/CghUi54eWZWjBvwNYnOj3a8HryYlKp6ZpBv75W8CbJXwr8W1w8L1f2TMzMz3DsvG473Ioe4IjbqoGeI4jq54nc7atDc+nUvLp9lZ6juMnsd4CP4nFoqpu9xxH1kNXog6vh0pCIL60LAUn2lWVvXp9LZsjSCK/sCCrTXAppaxcXMjM1FRnPwCkGWOMZQE++R0yOdvWlvCDn83O+jVkeT8a/chcgNVuJdWRyNu2rN7ctMILBV94Q8KylhkHSAeuqwJQl1AJVi4v5dncXGC/CMQt5hJltDrbR0IFz2nAawKCCcQH7e2lkGiBX11pw2t9UGKc6Fl3gF+zSSllpViUuURCe56awNPrCiSToQTuteGplBIeVoITlfSbUAGvFIuyWiyGlhCIQm8bth2vjYZLJGQumQwt8W8bIq50hS8udsLbtlpYCW5ZS+zAMAYE4mNYeENifl5WPU9bghOV90ZGPjDGGBOIO+0fZOPxTnih0PWE85NQvSc40XbjNjwyzWGB+NL+UfN1HAT3k1Bdx5zo+XR09EvLm0AAbKgm9Byn662mlLBtWfU83weJS7TW8SLKAvS7RD9VA1T3eVBmpqfVnQ+Q3x0aeqd8Fx5alsGJSr3CdFMg3h2PjX1WwutxaprmW0gIxLvjiYnxrvDmSgjE81eDA+QD/7w99iKRPoG4rtodusmJnl2iNd81160GB0hzonIP4DIn2u7Yav8T+9HoR25ZywJxSyAKTlTiRE+1LAlEIRC3uGUtNU44jfgLUwkn+JzAd8QAAAAASUVORK5CYII=">')
                    )
            )
    );


    $(".deleteButton").click(function () {
        if (confirm("Etes vous sûr de vouloir supprimer cet élément ?")) {
            const table = $(this).parent().parent().parent().parent().attr('id');
            const id = $(this).parent().prev().text();
            const row = $(this).parent().parent();
            console.log(table);
            if (table === "actors_table") {
                const id_element = id.split(';');
                remove_person_from_work(id_element[1], id_element[0], id_element[2], 'actor', row);
            } else if (table === "directors_table") {
                const id_element = id.split(';');
                remove_person_from_work(id_element[1], id_element[0], id_element[2], 'director', row);
            } else if (table === "writers_table") {
                const id_element = id.split(';');
                remove_person_from_work(id_element[1], id_element[0], id_element[2], 'writer', row);
            } else if (table === "roles_table") {
                remove_elem_from_person(id, 'role', row);
            } else if (table === "written_table") {
                remove_elem_from_person(id, "written", row);
            } else if (table === "directed_table") {
                remove_elem_from_person(id, "directed", row);
            }
        }
    });
}

function remove_elem_from_person(_id, type, row) {
    console.log(_id, type);

    $.ajax({
        url: "adminRequests.php?type=remove_" + type + "_from_person", //This is the current doc
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({id: _id}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            row.remove();
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });

}


function remove_work(type) {

    console.log("adminRequests.php?type=remove_" + type);
    $.ajax({
        url: "adminRequests.php?type=remove_" + type,
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            console.log(data);
            location.href = "welcome_page.php"
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });

}

function remove_person() {

    console.log("In remove_person")

    $.ajax({
        url: "adminRequests.php?type=remove_person",
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            location.href = "welcome_page.php"
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });

}


function edit_header_movie_episode(type) {

    if (type === "title") {
        var form = $("#formContainerEditTitle");
        var info = $('#title_f').val();
        var to_modify = $("#titre");

        var invalid = false;
        if ($.trim(info) === "") {
            $('#titre').css("border-color", "red")
            invalid = true
        } else {
            $('#titre').css("border-color", "#fed136")
        }

        if (invalid) return;


    } else if (type === "date") {
        console.log("hi")
        var form = $("#formContainerEditDate");
        var info = $('#date_f').val();

        var invalid = false;
        if ($.trim(info) === "" || isNaN(info)) {
            $('#date_f').css("border-color", "red")
            invalid = true
        } else {
            $('#date_f').css("border-color", "#fed136")
        }

        if (invalid) return;
    }

    if (confirm("Etes vous sûr de vouloir modifier ce champ ? ")) {

        $.ajax({
            url: "adminRequests.php?type=edit_" + type,
            type: "GET",
            dataType: 'json', // add json datatype to get json
            data: ({info: info}),
            error: function (xhr, status) {
                alert(status);
            },
            success: function (data) {
                console.log(data);
                form.css("display", "none");
                location.reload();

            },
            fail: function () {
                alert("Une erreur est survenue")

            }
        });
    }
}


function edit_header_serie() {

    const start_date = $("#start_date").val();
    const end_date = $("#end_date").val();

    if (confirm("Etes vous sûr de vouloir modifier ce champ ? ")) {

        $.ajax({
            url: "adminRequests.php?type=edit_date_serie",
            type: "GET",
            dataType: 'json', // add json datatype to get json
            data: ({start_date: start_date, end_date: end_date}),
            error: function (xhr, status) {
                alert(status);
            },
            success: function (data) {
                $("formContainerEditDateSerie").css("display", "none");
                location.reload();
            },
            fail: function () {
                alert("Une erreur est survenue")

            }
        });
    }
}


function remove_person_from_work(_name, _fn, _num, type, row) {

    console.log(_name, _fn, _num, type);
    console.log("adminRequests.php?type=remove_" + type + "_from_work");

    $.ajax({
        url: "adminRequests.php?type=remove_" + type + "_from_work",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({name: _name, fn: _fn, num: _num}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            row.remove();
        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });


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

function add_written_or_directed_by(id, titre, option) {
    $.ajax({
        url: "adminRequests.php?type=add_" + option + "_by_person",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({id: id}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            console.log(data);
            if (data === "Success") {
                alert(titre + " a bien été ajouté dans la liste.");
                $('#formContainerWriterPerson').css("display", "none");
                location.reload();
            } else {
                alert("Une erreur est survenue.");

            }


        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });


}


function edit_plot(havePlot) {
    var text = $('#resume').val();
    console.log(havePlot);
    console.log("fsiiefsjesi");

    if (havePlot !== 0) {
        $.ajax({
            url: "adminRequests.php?type=edit_plot",
            type: "GET",
            dataType: 'json', // add json datatype to get json
            data: ({content: text}),
            error: function (xhr, status) {
                alert(status);
            },
            success: function () {
                $('#formContainerResume').css("display", "none");
                $("#text_plot").html(text);
            },
            fail: function () {
                alert("Une erreur est survenue")

            },
            always: function () {
                $('#load_spinner').hide()

            }
        });
    } else {
        $.ajax({
            url: "adminRequests.php?type=add_plot",
            type: "GET",
            dataType: 'json', // add json datatype to get json
            data: ({content: text}),
            error: function (xhr, status) {
                alert(status);
            },
            success: function (data) {
                console.log(data)
                $('#formContainerResume').css("display", "none");
                $("#text_plot").html(text);
            },
            fail: function () {
                alert("Une erreur est survenue")

            },
            always: function () {
                $('#load_spinner').hide()

            }
        });

    }
}

function add_role_by_actor_name(name, fn, num, role) {
    $.ajax({
        url: "adminRequests.php?type=add_role_by_actor_name",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn, role: role, num: num}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            if (data === "Success") {
                console.log(data);
                alert(fn + " " + name + " a bien été ajouté dans les acteurs.\nRole : " + role)
                $('#formContainerActor').css("display", "none");
                location.reload();
            } else {
                alert("Une Erreur est survenue")
            }


        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}

function add_person_in_tb(name, fn, num, tbName) {
    console.log("add_person_in_tb: ", name, fn, num)
    $.ajax({
        url: "adminRequests.php?type=add_in_tb_" + tbName,
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn, num: num}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            if(data === "Success") {
                if (tbName == "directedBy") {
                    alert(fn + " " + name + " a bien été ajouté dans les directeurs.");
                    $('#formContainerDirector').css("display", "none");
                    location.reload();

                } else if (tbName == "writtenBy") {
                    alert(fn + " " + name + " a bien été ajouté dans les auteurs.");
                    $('#formContainerWriter').css("display", "none");
                    location.reload();

                }
            } else {
                alert("Une erreur est surevenue.")
            }


        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}

function add_role_by_oeuvre_id(id, name) {
    var role = $('#oeuvre_role').val();
    $.ajax({
        url: "adminRequests.php?type=add_role_by_oeuvre_id",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({id: id, role: role}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            if(data === "Success") {
                alert(name + " a bien été ajouté dans les rôles.");
                $('#formContainerActorPerson').css("display", "none");
                location.reload();
            } else {
                alert("Une erreur est survenue.")
            }


        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}


function add_person(name, fn, genre, callback) {
    $.ajax({
        url: "adminRequests.php?type=add_person",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn, genre: genre}),
        error: function (xhr, status) {
            alert(status);

        },
        success: function (numero) {
            console.log("add_person_OK")
            console.log(numero);
            if (callback != null) {
                callback(name, fn, numero);
            } else {
                alert("Personne ajoutée")
            }
        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}

function add_actor_role(name, fn, number) {
    add_person_in_tb(name, fn, number, "actor");
    var role = $('#actor_role').val();
    add_role_by_actor_name(name, fn, number, role);
}

function add_director_directedBy(name, fn, number) {
    add_person_in_tb(name, fn, number, "director");
    add_person_in_tb(name, fn, number, "directedBy");

}

function add_writer_writtenBy(name, fn, number) {
    add_person_in_tb(name, fn, number, "writer");
    add_person_in_tb(name, fn, number, "writtenBy");

}

function edit_actors_from_oeuvre() {

    var name = $('#actor_name').val();
    var fn = $('#actor_fn').val();
    var genre = $('#actor_genre').find(":selected").text();
    var invalid = false;

    if ($.trim(name) === "") {
        $('#actor_name').css("border-color", "red")
        invalid = true
    } else {
        $('#actor_name').css("border-color", "#fed136")
    }

    if ($.trim(fn) === "") {
        $('#actor_fn').css("border-color", "red")
        invalid = true
    } else {
        $('#actor_fn').css("border-color", "#fed136")
    }

    if ($.trim($('#actor_role').val()) === "") {
        $('#actor_role').css("border-color", "red")
        invalid = true
    } else {
        $('#actor_role').css("border-color", "#fed136")
    }

    if (invalid) return;

    console.log(name, fn);

    $.ajax({
        url: "adminRequests.php?type=check_person",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                if (confirm("Cette personne n'est pas encore enregistrée.\nVoulez vous ajouter " + fn + " " + name + " à la base de donnée ?")) {
                    add_person(name, fn, genre, add_actor_role);
                } else {
                    //TODO

                }

            } else {
                createList(data, "actor");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }

    });

}

function edit_directors_from_oeuvre() {

    var name = $('#director_name').val();
    var fn = $('#director_fn').val();
    var genre = $('#director_genre').find(":selected").text();
    console.log(name, fn);
    var invalid = false;

    if ($.trim(name) === "") {
        $('#director_name').css("border-color", "red")
        invalid = true
    } else {
        $('#director_name').css("border-color", "#fed136")
    }

    if ($.trim(fn) === "") {
        $('#director_fn').css("border-color", "red")
        invalid = true
    } else {
        $('#director_fn').css("border-color", "#fed136")
    }

    if (invalid) return;

    $.ajax({
        url: "adminRequests.php?type=check_person",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                if (confirm("Cette personne n'est pas encore enregistrée.\nVoulez vous ajouter " + fn + " " + name + " à la base de donnée ?")) {
                    add_person(name, fn, genre, add_director_directedBy);
                }

            } else {
                createList(data, "director");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }

    });

}

function edit_writers_from_oeuvre() {

    var name = $('#writer_name').val();
    var fn = $('#writer_fn').val();
    var genre = $('#writer_genre').find(":selected").text();
    var invalid = false;

    if ($.trim(name) === "") {
        $('#writer_name').css("border-color", "red")
        invalid = true
    } else {
        $('#writer_name').css("border-color", "#fed136")
    }

    if ($.trim(fn) === "") {
        $('#writer_fn').css("border-color", "red")
        invalid = true
    } else {
        $('#writer_fn').css("border-color", "#fed136")
    }

    if (invalid) return;


    console.log(name, fn);

    $.ajax({
        url: "adminRequests.php?type=check_person",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({name: name, fn: fn}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                if (confirm("Cette personne n'est pas encore enregistrée.\nVoulez vous ajouter " + fn + " " + name + " à la base de donnée ?")) {
                    add_person(name, fn, genre, add_writer_writtenBy);
                }

            } else {
                createList(data, "writer");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }

    });

}

function edit_details() {
    var genre = $('#genre').val();
    var language = $('#language').val();
    var country = $('#country').val();

    console.log(genre, language, country);

    if (!(genre.length === 0)) {
        add_details(genre, "genre");
    }
    if (!(language.length === 0)) {
        add_details(language, "language");
    }
    if (!(country.length === 0)) {
        add_details(country, "country");
    }
}

function add_details(field_data, field_type) {
    $.ajax({
        url: "adminRequests.php?type=add_details",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({type_field: field_type, data_field: field_data}),
        error: function (xhr, status) {
            alert(status);

        },
        success: function (res) {
            console.log("add_details")
            console.log(res);
            $('#formContainerDetails').css("display", "none");
            alert(res);
            location.reload();
        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}

function remove_details() {
    var genre = $('#genre_rm_detail').val();
    var language = $('#language_rm_detail').val();
    var country = $('#country_rm_detail').val();

    console.log(genre, language, country);

    if (!(genre.length === 0)) {
        rm_details(genre, "genre");
    }
    if (!(language.length === 0)) {
        rm_details(language, "language");
    }
    if (!(country.length === 0)) {
        rm_details(country, "country");
    }

}

function rm_details(field_data, field_type) {
    console.log("in rm details")
    $.ajax({
        url: "adminRequests.php?type=remove_details",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({type_field: field_type, data_field: field_data}),
        error: function (xhr, status) {
            alert(status);

        },
        success: function (res) {
            console.log("remove_details")
            console.log(res);
            $('#formContainerDetailsDelete').css("display", "none");
            alert(res);
            location.reload();
        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {
            $('#load_spinner').hide()

        }
    });
}
function createList(data, type) {
    console.log(data);
    var titre;
    if (type === "actor" || type === "director" || type === "writer") {
        titre = "Sélectionnez une personne dans la liste";
    } else {
        titre = "Sélectionnez une oeuvre dans la liste";
    }
    $("body").append(
        $('<div class="listContainer" id="persons_list_container" </div>').append(
            $('<div class="popupAdd form_popup" id="popupAddList"</div>').append(
                $('<h2 class="h2popup">' + titre + '</h2>')
            )
        )
    );

    $('#popupAddList').append(
        $('<hr class="hrpopup"></hr>')
    );

    $('#popupAddList').append(
        $('<ul class="list-group" id="list"></ul>')
    );

    $('#popupAddList').append(
        $('<button class="submit_form" id="cancel_button" onclick="cancel_persons_list()">Annuler</button>')
    );

    for (var i in data) {

        if (type === "actor" || type === "director" || type === "writer") {
            const nom = data[i][1];
            const prenom = data[i][0];
            const numero = data[i][2];

            if (data[i][2] == "NA") {
                $("#list").append(
                    $('<button type="button" class="list-group-item list_elem">' + prenom + " " + nom + '</button>').data({
                        "prenom": prenom,
                        "nom": nom,
                        "numero": numero,
                        "itemType": type
                    })
                );
            } else {
                $("#list").append(
                    $('<button type="button" class="list-group-item list_elem">' + prenom + " " + nom + " " + numero + '</button>').data({
                        "prenom": prenom,
                        "nom": nom,
                        "numero": numero,
                        "itemType": type
                    })
                );
            }
        } else {
            const titre = data[i][1];
            const date = data[i][2];
            const id = data[i][0];

            $("#list").append(
                $('<button type="button" class="list-group-item list_elem">' + id + '</button>').data({
                    "titre": titre,
                    "date": date,
                    "id": id,
                    "itemType": type
                })
            );


        }

    }
    if (type === "actor" || type === "director" || type === "writer") {

        $("#list").append(
            $('<button type="button" class="list-group-item" id="new_person_button">Ajouter une nouvelle personne</button>')
        );
    }

    $('.list_elem').click(function () {
        console.log($(this).data("itemType"));
        if ($(this).data("itemType") === "actor") {
            add_actor_role($(this).data("nom"), $(this).data("prenom"), $(this).data("numero"));

        } else if ($(this).data("itemType") === "director") {
            console.log("s")
            add_director_directedBy($(this).data("nom"), $(this).data("prenom"), $(this).data("numero"));

        } else if ($(this).data("itemType") === "writer") {
            add_writer_writtenBy($(this).data("nom"), $(this).data("prenom"), $(this).data("numero"));

        } else if ($(this).data("itemType") === "role") {
            add_role_by_oeuvre_id($(this).data("id"), $(this).data("titre"));

        } else if ($(this).data("itemType") === "writtenBy") {
            add_written_or_directed_by($(this).data("id"), $(this).data("titre"), "written");

        } else if ($(this).data("itemType") === "directedBy") {
            add_written_or_directed_by($(this).data("id"), $(this).data("titre"), "directed");

        }
        cancel_persons_list();

    })

    $('#new_person_button').click(function () {
        var name = $('#actor_name').val();
        var fn = $('#actor_fn').val();
        var genre = $('#actor_genre').find(":selected").text();
        add_person(name, fn, genre, add_actor_role);
        cancel_persons_list();
    })

}

function cancel_persons_list() {
    $('#persons_list_container').remove();

}

function checkForm(formID, num_required) {
    var counter = 0;
    $(formID).filter(':input').each(function () {
        if (!$.trim($(this).val())) {
            counter++;
        }
    });
    if (counter < num_required) {
        alert("Remplissez tous les champs !");
        return false;
    }
    return true;

}

//Partie Person

function edit_actors_from_person() {

    const titreOeuvre = $('#oeuvre_name_actor').val();
    var invalid = false;

    if ($.trim(titreOeuvre) === "") {
        $('#oeuvre_name_actor').css("border-color", "red")
        invalid = true
    } else {
        $('#oeuvre_name_actor').css("border-color", "#fed136")
    }

    if ($.trim($('#oeuvre_role')) === "") {
        $('#oeuvre_role').css("border-color", "red")
        invalid = true
    } else {
        $('#oeuvre_role').css("border-color", "#fed136")
    }

    if (invalid) return;

    $.ajax({
        url: "adminRequests.php?type=check_oeuvre",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({titreOeuvre: titreOeuvre}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                alert("Aucune Oeuvre n'a été trouvée pour le titre " + titreOeuvre + "\nVeuillez ajouter l'oeuvre depuis la page administrateur puis rééssayer.")
            } else {
                createList(data, "role");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {

        }

    });

}

function edit_writers_from_person() {

    const titreOeuvre = $('#oeuvre_name_writer').val();
    var invalid = false;

    if ($.trim(titreOeuvre) === "") {
        $('#oeuvre_name_writer').css("border-color", "red")
        invalid = true
    } else {
        $('#oeuvre_name_writer').css("border-color", "#fed136")
    }

    if (invalid) return;


    $.ajax({
        url: "adminRequests.php?type=check_oeuvre",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({titreOeuvre: titreOeuvre}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                alert("Aucune Oeuvre n'a été trouvée pour le titre " + titreOeuvre + "\nVeuillez ajouter l'oeuvre depuis la page administrateur puis rééssayer.")
            } else {
                console.log(data);
                createList(data, "writtenBy");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {

        }

    });

}

function edit_directors_from_person() {
    const titreOeuvre = $('#oeuvre_name_director').val();
    var invalid = false;

    if ($.trim(titreOeuvre) === "") {
        $('#oeuvre_name_director').css("border-color", "red")
        invalid = true
    } else {
        $('#oeuvre_name_director').css("border-color", "#fed136")
    }

    if (invalid) return;

    $.ajax({
        url: "adminRequests.php?type=check_oeuvre",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({titreOeuvre: titreOeuvre}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            if (data == "not found") {
                alert("Aucune Oeuvre n'a été trouvée pour le titre " + titreOeuvre + "\nVeuillez ajouter l'oeuvre depuis la page administrateur puis rééssayer.")
            } else {
                createList(data, "directedBy");
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {

        }

    });

}

function createSection(titre) {
    console.log("hey", "table_container_" + titre);
    var $element = $('#' + titre);
    if (!$element.length) {

        var oeuvre_section = document.createElement("SECTION");
        oeuvre_section.setAttribute('id', titre);
        oeuvre_section.setAttribute('class', "blue");

        div_container = document.createElement('div');
        div_row = document.createElement('div');
        div_row.setAttribute('id', 'div_row');
        div_text = document.createElement('div');
        div_text.setAttribute("class", "text-center table_container");
        div_text.setAttribute("id", "table_container_" + titre);


        h2 = document.createElement('h2');
        h2.setAttribute("class", "titre-section");
        h2.innerHTML = titre;

        div_text.appendChild(h2);
        div_row.appendChild(div_text);
        div_container.appendChild(div_row);
        oeuvre_section.appendChild(div_container);
        document.body.appendChild(oeuvre_section);
    }
}


function addMovie() { //fct appelée lors du clique sur le bouton

    const title = $('#movie_name').val();
    const date = $('#movie_date').val();
    const note = $('#movie_note').val();

    var invalid = false;

    if ($.trim(title) === "") {
        $('#movie_name').css("border-color", "red")
        invalid = true
    } else {
        $('#movie_name').css("border-color", "#fed136")
    }

    if ($.trim(date) === "" || (isNaN(date))) {
        $('#movie_date').css("border-color", "red")
        invalid = true
    } else {
        $('#movie_date').css("border-color", "#fed136")
    }

    if ($.trim(note) !== "") {
        if (isNaN(note)) {
            $('#movie_note').css("border-color", "red")
            invalid = true
        } else {
            if (note < 0 || note > 10) {
                $('#movie_date').css("border-color", "red")
                invalid = true;
            } else {
                $('#movie_date').css("border-color", "#fed136")
            }

        }
    } else {
        $('#movie_date').css("border-color", "#fed136")

    }


    if (invalid) return;


    console.log(title, date);

    console.log("apres return");
    check_nb_works(title, date, "movie");

}

function insert_movie(title, id, date) { //fct qui fait l insertion dans la db
    var note = $('#movie_note').val();
    if ($.trim(note) === "") {
        note = -1
    }


    $.ajax({
        url: "adminRequests.php?type=add_movie",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({id: id, title: title, date: date, note: note}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            window.location.href = "film.php?id=" + encodeURIComponent(id);

        },
        fail: function () {


        },
        always: function () {

        }

    });


}

function insert_serie(title, id, date) {
    var note = $('#serie_note').val();
    var end_date = $('#serie_end_year').val();
    if ($.trim(note) === "") {
        note = -1
    }
    if ($.trim(end_date) === "") {
        end_date = 0
    }

    $.ajax({
        url: "adminRequests.php?type=add_serie",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({id: id, title: title, start_date: date, end_date: end_date, note: note}),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data, textStatus, xhr) {
            window.location.href = "serie.php?id=" + encodeURIComponent(id);

        },
        fail: function () {


        },
        always: function () {

        }

    });
}


function build_movie_id(title, date, num) {

    var id;

    if (num === ('I')) { // il y avait pas d'oeuvre du meme nom

        console.log("id : ", title + " (" + date + ")");
        id = title + " (" + date + ")"
    } else {

        console.log("id : ", title + " (" + date + "/" + num + ")");
        id = title + " (" + date + "/" + num + ")"
    }
    insert_movie(title, id, date);


}

function build_serie_id(title, date, num) {
    var id;

    if (num === ('I')) { // il y avait pas d'oeuvre du meme nom

        console.log("id : ", title + " (" + date + ")");
        id = "\"" + title + "\"" + " (" + date + ")"
    } else {

        console.log("id : ", title + " (" + date + "/" + num + ")");
        id = "\"" + title + "\"" + " (" + date + "/" + num + ")"
    }
    insert_serie(title, id, date);
}


function check_nb_works(title, date, work_type) {
    console.log("checking nb works", title, date)
    $.ajax({
        url: "adminRequests.php?type=check_nb_works",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({title: title, date: date}),
        error: function (xhr, status) {
            console.log();
            alert(status);
        },
        success: function (data) {
            console.log(data);
            if (work_type === "movie") {
                build_movie_id(title, date, data);
            } else if (work_type === "serie") {
                build_serie_id(title, date, data);
            }

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {

        }

    });

}

function addSerie() { //fct appelée lors du clique sur le bouton

    const title = $('#serie_name').val();
    const start_date = $('#serie_start_year').val()
    const end_date = $('#serie_end_year').val()
    const note = $('#serie_note').val();

    var invalid = false;
    if ($.trim(title) === "") {
        $('#serie_name').css("border-color", "red")
        invalid = true
    } else {
        $('#serie_name').css("border-color", "#fed136")
    }

    if ($.trim(start_date) === "" || isNaN(start_date)) {
        $('#serie_start_year').css("border-color", "red")
        invalid = true
    } else {
        $('#serie_start_year').css("border-color", "#fed136")
    }

    if ($.trim(end_date) !== "") {
        if (!isNaN(end_date)) {
            if (end_date < start_date) {
                $('#serie_end_year').css("border-color", "red")
                //TODO: show endYear < startDate
                invalid = true
            } else {
                $('#serie_end_year').css("border-color", "#fed136")


            }
        } else {
            $('#serie_end_year').css("border-color", "red")
            invalid = true;
            //TODO: show endYear != int

        }

    } else {
        $('#serie_end_year').css("border-color", "#fed136")

    }

    if ($.trim(note) !== "") {
        if (isNaN(note)) {
            $('#serie_note').css("border-color", "red")
            invalid = true
        } else {
            if (note < 0 || note > 10) {
                $('#serie_note').css("border-color", "red")
                invalid = true;
            } else {
                $('#serie_note').css("border-color", "#fed136")
            }

        }
    } else {
        $('#serie_note').css("border-color", "#fed136")

    }


    if (invalid) return;

    console.log(title, start_date);


    console.log("apres return");
    check_nb_works(title, start_date, "serie");

}

function addEpisode(dateAndTitle) { //fct appelée lors du clique sur le bouton


    var serieTitleDate = dateAndTitle.split("|");

    const saison = $('#episode_saison').val();
    const numero = $('#episode_num').val();
    const sid = "\"" + serieTitleDate[1] + "\" " + "(" + serieTitleDate[0] + ")";

    console.log("add episode for ", sid);

    check_if_episode_exist(saison, numero, sid);


}


function build_episode_id(sid) {

    console.log("building episode id");

    const title = $('#episode_name').val();
    const saison = $('#episode_saison').val();
    const numero = $('#episode_num').val();
    const note = $('#episode_note').val();
    const date = $('#episode_date').val();
    const episode_id = sid + " {" + title + " (#" + saison + "." + numero + ")}"

    insert_episode(title, saison, numero, episode_id, date, note, sid);
}

function check_if_episode_exist(saison, numero, sid) {
    console.log("checking if episode exist");
    $.ajax({
        url: "adminRequests.php?type=check_if_episode_exist",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({saison: saison, numero: numero, sid: sid}),
        error: function (xhr, status) {
            console.log();
            alert(status);
        },
        success: function (data) {
            console.log(data);
            if (data === "exist") {
                return;
            }
            build_episode_id(sid)

        },
        fail: function () {
            alert("Une erreur est survenue")

        },
        always: function () {

        }

    });
}

function insert_episode(title, saison, numero, episode_id, date, note, sid) {

    console.log("title", title);
    console.log("saison", saison);
    console.log("numero", numero);
    console.log("episode_id", episode_id);
    console.log("date", date);
    console.log("note", note);
    console.log("sid", sid);

    console.log("inserting episode");
    $.ajax({
        url: "adminRequests.php?type=insert_episode",
        type: "GET",
        dataType: 'json', // add json datatype to get json
        data: ({
            saison: saison,
            numero: numero,
            sid: sid,
            title: title,
            episode_id: episode_id,
            date: date,
            note: note
        }),
        error: function (xhr, status) {
            alert(status);
        },
        success: function (data) {
            console.log(data);
            window.location.href = "episode.php?id=" + encodeURIComponent(episode_id);

        },
        fail: function () {
            alert("Une erreur est survenue")

        }
    });
}



