$(document).ready(function ($) {
    console.log("sige admin");
    loadFilters();
    loadCategorias();
    loadCiudades();
    //// cargando las posiciones de los mapas
    if (typeof google !== 'undefined') {
        console.log(google);
        // the variable is defined
        var initialLocation = new google.maps.LatLng(23.13302, -82.38304);
        var map = $("#map-top").gmap3({
            center: [23.13302, -82.38304],
            zoom: 4
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                $("#map-top").gmap3({
                    center: [initialLocation],
                    zoom: 4
                });
            });
        }

        $.get('../api/mvpositions', function (data) {
            $(data.data).each(function (pos, item) {
                console.log("item", item, pos);
                const marker = new google.maps.Marker({
                    map: this.map,
                    position: new google.maps.LatLng(item.latitude, item.longitude),
                    title: item.title,
                    animation: google.maps.Animation.DROP,
                });
                $('#map-top').gmap3('get').marker(marker);
            })
        });
    }

    $('.listing-views a').click(function (ev) {
        ev.preventDefault();
        $('ul.listing-views li').removeClass('active');
        $(this).parent().addClass('active');
        $('.listing .row').addClass('hide');
        $('.listing .row.' + $(this).attr('name')).removeClass('hide');
    });

    $('#filter').submit(function (ev) {
        ev.preventDefault();
        console.log($(this).find('i'));
        $(this).find('i').first().addClass('hide');
        $(this).find('i').last().removeClass('hide');
        $.post('../api/filter', $('#filter').serialize(), function (data) {
            showFilterResult(data.services);
            $('#filter button').find('i').last().addClass('hide');
            $('#filter button').find('i').first().removeClass('hide');
        });
    });

    $('select[name="order"]').change(function () {
        $('.popular_listings .item').remove();
        $('.loading_popular_listings').removeClass('hide');
        $.get('../api/' + $(this).val(), function (data) {
            $('.loading_popular_listings').addClass('hide');
            $.each(data.data, function () {
                $('.loading_popular_listings').parent().append(getFilterResultElement(this));
            });
        });
    });

    $('.popular_listings button').click(function () {
        window.location.href = 'home/servicesbyfilter/' + $('select[name="order"]').val();
    })

    $('.step-views .step a').click(function (ev) {
        ev.preventDefault();
        $('.step-views .step').removeClass('active');
        $(this).parent().addClass('active');
        $('.item-step').addClass('hide');
        console.log($('#' + $(this).attr('name')));
        $('#' + $(this).attr('name')).removeClass('hide');
    });
});

//llenandolos filtros
function loadFilters() {

    $.get('../api/cities', function (data) {
        $(data.data).each(function (pos, item) {
            var newState = new Option(item.title, item.id, false, false);
            // Append it to the select
            $("#cities2").append(newState).trigger('change');
        });

    });
    //$.get('../api/categories',function(data){
    $.get('../api/allsubcategories', function (data) {
        $(data.data).each(function (pos, item) {
            var newState = new Option(item.title, item.id, false, false);
            // Append it to the select
            $("#categories").append(newState).trigger('change');
        });
    });

}

function loadCategorias() {
    $.get('../api/categoriesloaded', function (data) {
        $(data.data).each(function (pos, category) {
            var elemento = '<div class="col-md-6" *ngFor="let category of categories">' +
                '            <h5 class="industry-title">' + category.title + '</h5>' +
                '        <ul class="industry-list list-unstyled mb0">';
            $(category.subcategoriesLists).each(function (pos2, subcategory) {
                elemento += '<li><a href="home/servicesbycategories/' + category.id + '/' + subcategory.id + '">' + subcategory.title +
                    '<span class="count">' + subcategory.count + '</span></a></li>'
            });
            elemento += '</ul></div>';
            $("#listado_categoria").append(elemento);
        });
    });
}

function loadCiudades() {
    $.get('../api/cities', function (data) {
        $(data.data).each(function (pos, city) {
            var elemento = '<div class="col-md-6 industry-list list-unstyled mb0">  ' +
                '<li ><a href="click_citi()">' + city.title + '<span class="count">(' + city.servicesCount + ')</span></a></li></div>';
            $("#listado_ciudades").append(elemento);
        });
    });
}

function showFilterResult(services) {
    $('#filterresult').removeClass('hide');
    $('#filterresultcontent').children().remove();
    if (!services.length) {
        $('#filterresultcontent').append('<p>No hay servicios con esas características.</p>')
    } else {
        $.each(services, function () {
            $('#filterresultcontent').append(getFilterResultElement(this));
        });
        $('#filterresultcontent .uou-accordions').uouAccordions();
    }
    $("html, body").animate({scrollTop:$('#filterresult').offset().top - 50},800)
}

function getFilterResultElement(service) {
    var prof = '', list = '';
    if (service.professional)
        prof = '<div class="marker-ribbon">' +
            '<div class="ribbon-banner">' +
            '<div class="ribbon-text">Profesional</div>' +
            '</div>' +
            '</div>';
    var rate = service.globalrate;
    for (var i = 0; i < 10; i++) {
        if (i < rate)
            list += '<li><i class="fa fa-star"></i></li>';
        else
            list += '<li><i class="fa fa-star-o"></i></li>';
    }

    var images = '';
    $.each(service.imagesList, function () {
        images+= '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' + this.title + '" alt="" draggable="false"></li>';
    });
    var element = '<div class="col-md-4 listing-grid listing-grid-2 item">' +
        '<div class="listing-heading">' +
        prof +
        '<h5><a href="services/show/' + service.id + '">' + service.title + '</h5>' +
        '</div>' +
        '<div class="listing-inner">' +
        '<div class="flexslider default-slider">' +
        '<ul class="slides">\n' +
        '<li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;">\n' +
        '<img src="' + service.icon + '" alt="" draggable="false">' +
        '</li>\n' +
        images +
        '</ul>' +
        '<div class="reviews">' +
        '<ul class="rate">' +
        list +
        '</ul>' +
        '<span class="count">' + service.ratereviews + '</span>' +
        '</div>' +
        '<ol class="flex-control-nav flex-control-paging">\n' +
        '<li><a class="">1</a></li>\n' +
        '<li><a class="flex-active">2</a></li>\n' +
        '<li><a class="">3</a></li>\n' +
        '<li><a class="">4</a></li>\n' +
        '</ol>\n' +
        '<ul class="flex-direction-nav">\n' +
        '<li><a class="flex-prev" href="#"></a></li>\n' +
        '<li><a class="flex-next" href="#"></a></li>\n' +
        '</ul>' +
        '</div>' +
        '<ul class="uou-accordions">' +
        '<li class="">' +
        '<a href="#"><i class="fa fa-info main-icon"></i> Información</a>' +
        '<div>' +
        '<h5 class="title">' + service.subtitle + '</h5>' +
        '<p>' + service.description + '</p>' +
        '</div>' +
        '</li>' +
        '<li class="active">' +
        '<a href="#"><i class="fa fa-envelope main-icon"></i> Información adicional</a>' +
        '<div>' +
        '<ul class="contact-info list-unstyled mb0">' +
        '<li><i class="fa fa-map-marker"></i> ' + service.address + '</li>' +
        '<li><i class="fa fa-envelope-o"></i> ' + service.email + '</li>' +
        '<li><i class="fa fa-globe"></i> ' + service.url + '</li>' +
        '<li><i class="fa fa-phone"></i> ' + service.phone + '</li>' +
        '<li><i class="fa fa-fax"></i> ' + service.other_phone + '</li>' +
        '</ul>' +
        '</div>' +
        '</li>' +
        '</ul> <!-- end .uou-accordions -->' +
        '</div>' +
        '<div class="info-footer">' +
        '<img height="20" width="20" src="' + service.subcategoriesList[0].icon + '"> ' +
        '<h6>' + service.subcategoriesList[0].title + '</h6>' +
        '<a class="pull-right pl10" title="Destruir" href="services/destroy/' + service.id + '">' +
        '<i class="fa fa-trash bookmark"></i></a>' +
        '<a class="pull-right pl10" title="Editar" href="services/edit/' + service.id + '">' +
        '<i class="fa fa-edit bookmark"></i></a>' +
        '<a class="pull-right" title="Ver" href="services/show/' + service.id + '">' +
        '<i class="fa fa-eye bookmark"></i></a>' +
        '</div>' +
        '</div>';
    return element;
}